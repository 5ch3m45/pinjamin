<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admins = User::where('role', 'admin');
        if($request->search) {
            $admins = $admins->where(function($q) use($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }
        $admins = $admins->paginate(20)->withQueryString();
        return view('dashboard.admin.index', [
            'admins' => $admins,
            'search' => $request->search,
            'sort' => $request->sort
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'same:password'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'unit' => $request->unit,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ]);

        return redirect()->to('/dashboard/admin')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('dashboard.admin.show', [
            'admin' => $admin
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);

        return view('dashboard.admin.edit', [
            'admin' => $admin
        ]);
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
        $admin = User::where('role', 'admin')->findOrFail($id);

        $rules = [
            'name' => 'required|min:3'
        ];

        $data = [
            'name' => $request->name,
            'unit' => $request->unit
        ];

        if($request->email !== $admin->email) {
            $rules = array_merge($rules, [
                'email' => 'required|email|unique:users,email',
            ]);

            $data = array_merge($data, [
                'email' => $request->email
            ]);
        }

        if($request->password) {
            $rules = array_merge($rules, [
                'password' => 'required|min:6',
                'confirm_password' => 'same:password'
            ]);

            $data = array_merge($data, [
                'password' => Hash::make($request->password)
            ]);
        }
        
        $admin->update($data);

        return redirect()->to('/dashboard/admin/show/'.$id)->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->delete();
        return redirect()->to('/dashboard/admin')->with('success', 'Admin berhasil dihapus');
    }
}
