<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return redirect()->back()->withInput()->with('error', 'Email belum terdaftar.');
        }

        if(!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withInput()->with('error', 'Password tidak tepat.');
        }

        Auth::login($user);

        if($user->role == 'admin') {
            return redirect('/dashboard')->with('success', 'Selamat datang, '.$user->name.'!');
        }
        return redirect('/')->with('success', 'Selamat datang, '.$user->name.'!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return Redirect
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user_exist = User::where('email', $request->email)->first();
        if($user_exist) {
            return redirect()->back()->withInput()->with('error', 'Email telah terdaftar.');
        }

        $user = User::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Selamat datang, '.$request->name.'!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function lupaPasswordIndex()
    {
        return view('lupa-password');
    }

    public function lupaPasswordStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
        
        $token = \Str::random(16);
        $expired = new \DateTime('+24 hours');
        
        $user->update([
            'reset_password_token' => $token,
            'reset_password_expired' => $expired->format('Y-m-d H:i:s')
        ]);

        try{
            $mail = new ResetPasswordToken($user, $token);
            Mail::to($user->email)->send($mail);
            return redirect()->back()->with('success', 'Token berhasil dikirimkan.');
        } catch (\Exception $e) {
            \Log::error('error send email:'.$e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan.');
        }
    }

    public function resetPasswordIndex()
    {
        return view('reset-password');
    }

    public function resetPasswordStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|min:6'
        ]);

        $user = User::where([
            'email' => $request->email,
            'reset_password_token' => $request->token,
        ])->first();
        if(!$user) {
            return redirect()->back()->with('error', 'Email/token tidak tepat.');
        }

        if(strtotime($user->reset_password_expired) < time()) {
            return redirect()->back()->with('error', 'Token telah kadaluarsa.');
        }
        
        $password = Hash::make($request->password);
        
        $user->update([
            'password' => $password,
            'reset_password_token' => NULL,
            'reset_password_expired' => NULL
        ]);

        return redirect()->to('login')->with('success', 'Password berhasil diubah. Silahkan login.');
    }
}
