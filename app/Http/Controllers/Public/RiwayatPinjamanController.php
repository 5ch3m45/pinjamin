<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pinjaman;
use App\Models\PinjamanBarang;
use Illuminate\Http\Request;

class RiwayatPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pinjamans = Pinjaman::where('user_id', auth()->id())->paginate(20)->withQueryString();
        return view('public.riwayat-pinjaman.index', [
            'pinjamans' => $pinjamans,
            'search' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->to('/')->with('success', 'Pilih barang untuk dimasukkan ke troli pinjaman.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman_barangs = PinjamanBarang::where('pinjaman_id', $id)->get();
        $barangs = Barang::orderBy('nama')->get();
        return view('public.riwayat-pinjaman.show', [
            'pinjaman' => $pinjaman,
            'pinjaman_barangs' => $pinjaman_barangs,
            'barangs' => $barangs
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
}
