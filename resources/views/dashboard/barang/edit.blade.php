@extends('layouts.app')

@section('title') Barang @endsection

@section('content')
    <div>
        <h3><i class="bi bi-boxes"></i> Edit Barang</h3>
        
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/barang">Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Barang</li>
            </ol>
        </nav>

        <x-alert.success-and-error/>

        <div class="card mb-4">
            <form method="POST" class="card-body">
                @csrf
                <div class="table-responsive mb-2">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>QR</th>
                                <td>
                                    <img src="{{ $qr }}" alt="">
                                </td>
                            </tr>
                            <tr>
                                <th>Kode BMN</th>
                                <td>
                                    <input type="text" class="form-control" name="bnm" value="{{ $barang->bnm_nup ? @explode('#', $barang->bnm_nup)[0] : '' }}">
                                    @error('bnm') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>NUP</th>
                                <td>
                                    <input type="text" class="form-control" name="nup" value="{{ $barang->bnm_nup ? @explode('#', $barang->bnm_nup)[1] : '' }}">
                                    @error('nup') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td>
                                    <input type="text" class="form-control" name="nama" value="{{ $barang->nama }}">
                                    @error('nama') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Merk/Type</th>
                                <td>
                                    <input type="text" class="form-control" name="merk" value="{{ $barang->merk }}">
                                    @error('merk') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Tahun Perolehan</th>
                                <td>
                                    <input type="date" class="form-control" name="tanggal_perolehan" value="{{ $barang->tanggal_perolehan }}">
                                    @error('tanggal_perolehan') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td>
                                    <input type="number" class="form-control" name="jumlah" value="{{ $barang->jumlah }}">
                                    @error('jumlah') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Kondisi</th>
                                <td>
                                    <select name="kondisi" id="" class="form-control">
                                        <option value="baik" @if($barang->kondisi == 'baik') selected @endif>Baik</option>
                                        <option value="rusak_ringan" @if($barang->kondisi == 'rusak_ringan') selected @endif>Rusak Ringan</option>
                                        <option value="rusak_berat" @if($barang->kondisi == 'rusak_berat') selected @endif>Rusak Berat</option>
                                    </select>
                                    @error('kondisi') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Ruang</th>
                                <td>
                                    <select name="lokasi_id" id="" class="form-control">
                                        @foreach($lokasis as $lokasi)
                                        <option value="{{ $lokasi->id }}" @if($lokasi->id == $barang->lokasi_id) selected @endif>{{ $lokasi->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('lokasi_id') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>
                                    <textarea name="keterangan" id="" rows="3" class="form-control">{{ $barang->keterangan }}</textarea>
                                    @error('keterangan') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Foto <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#tambah-foto-barang-modal"><i class="bi bi-cloud-arrow-up"></i> Baru</a>
                                </th>
                                <td>
                                    @if($barang->fotos)
                                        @foreach($barang->fotos as $foto)
                                        <img src="{{ \Storage::url($foto->foto) }}" alt="" style="max-height: 10rem; max-width: 10rem; margin: auto 0px;">
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}">
                        <button type="button" class="btn btn-white me-2">Batal</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <x-modal.tambah-foto-barang :id="$barang->id"/>
@endsection