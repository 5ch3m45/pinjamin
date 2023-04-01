<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pinjaman;
use App\Models\PinjamanBarang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pinjamans = Pinjaman::orderByDesc('tanggal_pengajuan');
        if($request->search) {
            $pinjamans = $pinjamans->where(function($q) use($request) {
                $q->where('kode', 'like', '%'.$request->search.'%');
            });
        }
        $pinjamans = $pinjamans->paginate(20)->withQueryString();
        return view('dashboard.pinjaman.index', [
            'pinjamans' => $pinjamans,
            'search' => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode = date('Ymd\-His', strtotime(Carbon::now())).'-'.random_int(10, 99);
        $users = User::orderBy('name')->get();

        return view('dashboard.pinjaman.create', [
            'users' => $users,
            'kode' => $kode
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
        $request->validate([
            'user_id' => 'required|integer',
            'kode' => 'required',
            'tanggal_pengajuan' => 'required|date',
            'rencana_pengembalian' => 'required|date'
        ]);

        $user_valid = User::find($request->user_id);
        if(!$user_valid) {
            return redirect()->back()->withInput()->with('error', 'User tidak ditemukan.');
        }

        $kode_sudah_terdaftar = Pinjaman::where('kode', $request->kode)->first();
        if($kode_sudah_terdaftar) {
            return redirect()->back()->withInput()->with('error', 'Kode sudah terdaftar. Silahkan refresh halaman.');
        }

        $pinjaman = Pinjaman::create([
            'kode' => $request->kode,
            'user_id' => $request->user_id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'rencana_pengembalian' => $request->rencana_pengembalian
        ]);

        return redirect()->to('/dashboard/pinjaman/show/'.$pinjaman->id)->with('success', 'Pinjaman '.$pinjaman->kode.' berhasil tersimpan. Silahkan tambahkan barang yang ingin dipinjamkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $barangs = Barang::get();
        $pinjaman_barangs = PinjamanBarang::where('pinjaman_id', $id)->paginate(20)->withQueryString();
        return view('dashboard.pinjaman.show', [
            'pinjaman' => $pinjaman,
            'barangs' => $barangs,
            'pinjaman_barangs' => $pinjaman_barangs
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
        $pinjaman = Pinjaman::findOrFail($id);
        return view('dashboard.pinjaman.edit', [
            'pinjaman' => $pinjaman,
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
        $request->validate([
            'tanggal_pengajuan' => 'nullable|date',
            'rencana_pengembalian' => 'nullable|date'
        ]);

        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->update([
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'rencana_pengembalian' => $request->rencana_pengembalian
        ]);

        return redirect()->to('/dashboard/pinjaman/show/'.$id)->with('success', 'Pinjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        // cek apa ada barang yg belum dikembalikan
        $barang_belum_dikembalikan = PinjamanBarang::where('pinjaman_id', $id)
            ->where('tanggal_peminjaman', '>', '1970-01-01')
            ->whereNull('tanggal_pengembalian')->count();

        if($barang_belum_dikembalikan) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus peminjaman. Ada barang belum dikembalikan.');
        }

        $pinjaman->delete();

        return redirect()->to('/dashboard/pinjaman')->with('success', 'Pinjaman berhasil dihapus.');
    }
}
