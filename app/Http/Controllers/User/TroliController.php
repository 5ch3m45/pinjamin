<?php

namespace App\Http\Controllers\User;

use \Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Mail\SignupInfo;
use App\Models\Barang;
use App\Models\Pinjaman;
use App\Models\PinjamanBarang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TroliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $barangs = session('troli') ?? [];
        return view('public.troli.index', [
            'barangs' => $barangs,
            'search' => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function next(Request $request)
    {
        $kode = date('Ymd\-His', strtotime(Carbon::now())).'-'.random_int(10, 99);
        $barangs = $request->session()->get('troli');

        return view('public.troli.next', [
            'kode' => $kode,
            'barangs' => $barangs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()) {
            $request->validate([
                'kode' => 'required',
                'tanggal_pengajuan' => 'required|date',
                'rencana_pengembalian' => 'required|date'
            ]);

            $user = User::find(auth()->id());
        } else {
            $request->validate([
                'kode' => 'required',
                'tanggal_pengajuan' => 'required|date',
                'rencana_pengembalian' => 'required|date',
                'name' => 'required',
                'unit' => 'required',
                'contact' => 'required'
            ]);

            // cek apakah udah register
            $user = User::where(function($q) use ($request) {
                $q->where('email', $request->contact)
                    ->orWhere('phone', $request->contact);
            })->first();
    
            // generate email dan password
            $email = false;
            $phone = false;
            if(filter_var($request->contact, FILTER_VALIDATE_EMAIL)) {
                $email = $request->contact;
            } elseif((int)$request->contact && strlen((int)$request->contact) > 9) {
                $phone = $request->contact;
            } else {
                return redirect()->back()->withInput()->with('error', 'Email/HP tidak valid.');
            }
    
            // jika belum register
            if(!$user) {
                // registerkan
                $password = \Str::random(6);
                $user = User::create([
                    'name' => $request->name,
                    'email' => $email ? $email : preg_replace("/[^a-z]+/", "", strtolower($request->name)).'@mail7.io',
                    'phone' => $phone ? $phone : '',
                    'unit' => $request->unit,
                    'password' => Hash::make($password)
                ]);
                // kirim email info registrasi
                try {
                    $mail = new SignupInfo($user, $password);
                    Mail::to($user->email)->send($mail);
                } catch (\Exception $e) {
                    \Log::error('error send email:'.$e->getMessage());
                }
            }
    
            // loginkan
            Auth::login($user);
        }

        $kode = $request->kode;
        $kodeExist = Pinjaman::where('kode', $request->kode)->first();
        if($kodeExist) {
            $kode = date('Ymd\-His', strtotime(Carbon::now())).'-'.random_int(10, 99);
        }

        $pinjaman = Pinjaman::create([
            'kode' => $kode,
            'user_id' => $user->id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'rencana_pengembalian' => $request->rencana_pengembalian
        ]);

        $pinjaman_barangs = [];
        foreach ($request->session()->get('troli') as $barang) {
            array_push($pinjaman_barangs, [
                'pinjaman_id' => $pinjaman->id,
                'barang_id' => $barang['id']
            ]);
        }
        $pinjaman_barangs = PinjamanBarang::insert($pinjaman_barangs);
        $request->session()->put('troli', []);

        return redirect()->to('/riwayat-pinjaman')->with('success', 'Peminjaman barang berhasil diajukan.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function quickStore(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        if(!$request->session()->has('troli')) {
            $request->session()->put('troli', []);
        }
        $barangs = collect($request->session()->get('troli'));
        if(!$barangs->where('id', $id)->first()) {
            $barangs->push($barang);
            $request->session()->put('troli', $barangs);
        }
        
        return redirect()->back()->with('success', 'Barang berhasil dimasukkan ke troli pinjaman.');
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
    public function destroy($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function quickDestroy(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        if(!$request->session()->has('troli')) {
            $request->session()->put('troli', []);
        }
        $barangs = collect($request->session()->get('troli'));
        if($barangs->where('id', $id)->first()) {
            $rest = $barangs->whereNotIn('id', [$id]);
            $request->session()->put('troli', $rest);
        }
        
        return redirect()->back()->with('success', 'Barang berhasil dihapus dari troli pinjaman.');
    }
}
