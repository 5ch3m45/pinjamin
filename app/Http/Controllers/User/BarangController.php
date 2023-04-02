<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
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
                $q->where('nama', 'like', '%'.$request->search.'%')
                    ->orWhere('merk', 'like', '%'.$request->search.'%');
            });
        }

        if($request->order) {
            $barangs = $barangs->orderBy($request->order);
        } else {
            $barangs = $barangs->orderBy('nama');
        }

        $barangs = $barangs->paginate(20)->withQueryString();

        return view('public.barang.index', [
            'barangs' => $barangs,
            'search' => $request->search,
            'troli' => $request->session()->get('troli')
        ]);
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
        $barang = Barang::findOrFail($id);
        $qr = (new QRCode)->render(url('/').'/barang/show/'.$id);
        return view('public.barang.show', [
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
