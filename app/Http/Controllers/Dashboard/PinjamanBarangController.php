<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pinjaman;
use App\Models\PinjamanBarang;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class PinjamanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'pinjaman_id' => 'required|numeric',
            'barang_id' => 'required|numeric',
            'tanggal_peminjaman' => 'nullable|date',
            'tanggal_pengembalian' => 'nullable|date'
        ]);

        $pinjaman = Pinjaman::find($request->pinjaman_id);
        if(!$pinjaman) {
            return redirect()->back()->withInput()->with('error', 'Pinjaman tidak ditemukan');
        }

        $barang = Barang::find($request->barang_id);
        if(!$barang) {
            return redirect()->back()->withInput()->with('error', 'Barang tidak ditemukan');
        }

        PinjamanBarang::create([
            'pinjaman_id' => $pinjaman->id,
            'barang_id' => $barang->id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian
        ]);

        return redirect()->to('/dashboard/pinjaman/show/'.$pinjaman->id)->with('success', 'Barang '.$barang->nama.' berhasil ditambahkan.');
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
        $request->validate([
            'tanggal_peminjaman' => 'nullable|date',
            'tanggal_pengembalian' => 'nullable|date'
        ]);


        $pinjaman_barang = PinjamanBarang::findOrFail($id);

        $pinjaman_barang->update([
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian
        ]);

        return redirect()->back()->with('success', 'Barang '.$pinjaman_barang->barang->nama.' dipinjaman '.$pinjaman_barang->pinjaman->kode.' berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjaman_barang = PinjamanBarang::findOrFail($id);

        $pinjaman_barang->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus dari pijaman');
    }

    public function konfirmasiPeminjaman($id)
    {
        $pinjaman_barang = PinjamanBarang::find($id);

        if(!$pinjaman_barang) {
            return response()->json([
                'success' => false,
                'message' => 'NOT_FOUND'
            ], 404);
        }

        $pinjaman_barang->update([
            'tanggal_peminjaman' => Carbon::now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'PINJAMAN_CONFIRMED'
        ]);
    }

    public function tolakPeminjaman($id)
    {
        $pinjaman_barang = PinjamanBarang::find($id);

        if(!$pinjaman_barang) {
            return response()->json([
                'success' => false,
                'message' => 'NOT_FOUND'
            ], 404);
        }

        $pinjaman_barang->update([
            'tanggal_peminjaman' => '1970-01-01'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'PINJAMAN_DENIED'
        ]);
    }

    public function konfirmasiPengembalian($id)
    {
        $pinjaman_barang = PinjamanBarang::find($id);

        if(!$pinjaman_barang) {
            return response()->json([
                'success' => false,
                'message' => 'NOT_FOUND'
            ], 404);
        }

        $pinjaman_barang->update([
            'tanggal_pengembalian' => Carbon::now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'PENGEMBALIAN_CONFIRMED'
        ]);
    }
}
