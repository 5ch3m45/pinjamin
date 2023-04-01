<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lokasis = Lokasi::orderBy('nama');
        if($request->search) {
            $lokasis = $lokasis->where('nama', 'like', '%'.$request->search.'%');
        }
        $lokasis = $lokasis->paginate(20)->withQueryString();
        return view('dashboard.lokasi.index', [
            'lokasis' => $lokasis,
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
        return view('dashboard.lokasi.create');
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
            'nama' => 'required|min:3'
        ]);

        $lokasi = Lokasi::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->to('/dashboard/lokasi/show/'.$lokasi->id)->with('success', 'Lokasi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $barangs = Barang::where('lokasi_id', $id)
            ->orderBy('nama')
            ->orderBy('merk');
        if($request->search) {
            $barangs = $barangs->where(function($q) use($request) {
                $q->where('nama', 'like', '%'.$request->search.'%')
                    ->orWhere('merk', 'like', '%'.$request->search.'%');
            });
        }
        $barangs = $barangs->paginate(20);

        return view('dashboard.lokasi.show', [
            'lokasi' => $lokasi,
            'barangs' => $barangs,
            'search' => $request->search
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
        $lokasi = Lokasi::findOrFail($id);

        return view('dashboard.lokasi.edit', [
            'lokasi' => $lokasi
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
        $lokasi = Lokasi::findOrFail($id);

        $request->validate([
            'nama' => 'required|min:3'
        ]);

        $lokasi->update([
            'nama' => trim($request->nama),
            'deskripsi' => trim($request->deskripsi)
        ]);

        return redirect()->to('/dashboard/lokasi/show/'.$id)->with('success', 'Lokasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);

        if($lokasi->barangs->count()) {
            return redirect()->back()->with('error', 'Lokasi tidak dapat dihapus. Terdapat barang di lokasi ini.');
        }

        $lokasi->delete();

        return redirect()->to('/dashboard/lokasi')->with('success', 'Lokasi berhasil dihapus.');
    }
}
