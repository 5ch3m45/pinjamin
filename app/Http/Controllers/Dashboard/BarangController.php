<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\FotoBarang;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use chillerlan\QRCode\QRCode;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $barangs = Barang::query();
        if($request->search) {
            $barangs = $barangs->where(function($q) use($request) {
                return $q->where('nama', 'like', '%'.$request->search.'%')
                    ->orWhere('bnm_nup', 'like', '%'.$request->search.'%')
                    ->orWhere('merk', 'like', '%'.$request->search.'%');
            });
        }
        $barangs = $barangs->paginate(20)->withQueryString();
        return view('dashboard.barang.index', [
            'barangs' => $barangs,
            'search' => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lokasis = Lokasi::orderBy('nama')->get();
        return view('dashboard.barang.create', [
            'lokasis' => $lokasis,
            'lokasi' => $request->lokasi,
            'redirect' => $request->redirect
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
            'bnm' => 'required',
            'nup' => 'required',
            'nama' => 'required',
            'merk' => 'required',
            'jumlah' => 'numeric',
            'tanggal_perolehan' => 'date',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi_id' => 'required',
            'keterangan' => 'max:1000',
        ]);

        $lokasi = Lokasi::find($request->lokasi_id);
        if(!$lokasi) {
            return redirect()->back()->withInput()->with('error', 'Lokasi tidak ditemukan');
        }

        $bnm_nup_exist = Barang::where('bnm_nup', $request->bnm.'#'.$request->nup)->first();
        if($bnm_nup_exist) {
            return redirect()->back()->withInput()->with('error', 'BNM NUP sudah terdaftar.');
        }

        $barang = Barang::create([
            'bnm_nup' => trim($request->bnm).'#'.trim($request->nup),
            'nama' => trim($request->nama),
            'merk' => trim($request->merk),
            'tanggal_perolehan' => $request->tanggal_perolehan,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
            'lokasi_id' => $request->lokasi_id,
            'keterangan' => $request->keterangan
        ]);
        
        $redirect = '/dashboard/barang/show/'.$barang->id;
        if($request->redirect) {
            $redirect = $request->redirect;
        }
        if($request->redirect_back) {
            return redirect()->back()->with('success', 'Barang berhasil disimpan.')->withInput();
        }
        return redirect()->to($redirect)->with('success', 'Barang berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        $qr = (new QRCode)->render(url('/').'/barang/show/'.$id);
        return view('dashboard.barang.show', [
            'barang' => $barang,
            'qr' => $qr
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
        $barang = Barang::findOrFail($id);
        $qr = (new QRCode)->render(url('/').'/barang/show/'.$id);
        $fotos = FotoBarang::where('barang_id', $id)->get();
        $lokasis = Lokasi::get();
        return view('dashboard.barang.edit', [
            'barang' => $barang,
            'qr' => $qr,
            'fotos' => $fotos,
            'lokasis' => $lokasis
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
            'bnm' => 'required',
            'nup' => 'required',
            'nama' => 'required',
            'merk' => 'required',
            'tanggal_perolehan' => 'date',
            'jumlah' => 'numeric',
            'keterangan' => 'max:1000',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi_id' => 'required'
        ]);

        $lokasi = Lokasi::find($request->lokasi_id);
        if(!$lokasi) {
            return redirect()->back()->withInput()->with('error', 'Lokasi tidak ditemukan');
        }

        $bnm_nup_exist = Barang::where('bnm_nup', $request->bnm.'#'.$request->nup)
            ->where('id', '!=', $id)
            ->first();
        if($bnm_nup_exist) {
            return redirect()->back()->withInput()->with('error', 'BNM NUP sudah terdaftar');
        }

        $barang = Barang::findOrFail($id);

        $barang->update([
            'bnm_nup' => trim($request->bnm).'#'.trim($request->nup),
            'nama' => trim($request->nama),
            'merk' => trim($request->merk),
            'tanggal_perolehan' => $request->tanggal_perolehan,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
            'lokasi_id' => $request->lokasi_id,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->to('/dashboard/barang/show/'.$id)->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if($barang->pinjamans && $barang->pinjamans->where('status', 'dipinjam')->count() > 0) {
            return redirect()->back()->with('error', 'Barang tidak dapat dihapus, karena ada pinjaman.');
        }

        $barang->delete();

        return redirect()->to('/dashboard/barang')->with('success', 'Barang berhasil dihapus.');
    }

    public function fotoStore($id, Request $request)
    {
        $barang = Barang::findOrFail($id);

        if($request->hasFile('images')) {
            $images = $request->file('images');
            Log::debug('images:'.json_encode($images));
            foreach ($images as $image) {
                Log::error('is image valid:'.$image->isValid());
                if($image->isValid()) {
                    $path = $image->store('barang/'.$id);
                    Log::error('path:'.$path);
                    $fotoBarang = FotoBarang::create([
                        'barang_id' => $id,
                        'foto' => $path
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Foto berhasil ditambahkan');
        }
    }

    public function getQr($barang_id)
    {
        $data = url('/barang/show/'.$barang_id);
        $renderer = new Png();
        $renderer->setHeight(300);
        $renderer->setWidth(300);
        $writer = new Writer($renderer);
        $image = $writer->writeString($data);

        return response($image)->header('Content-type','image/png');
    }
}
