@extends('layouts.public')

@section('title') Informasi Peminjaman @endsection

@section('content')
    <div>
        <h3><i class="bi bi-check-list"></i> Informasi Peminjaman</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/troli">Troli Pinjaman</a></li>
                <li class="breadcrumb-item active" aria-current="page">Informasi Peminjaman</li>
            </ol>
        </nav>

        <x-alert.success-and-error/>

        <div class="card mb-4">
            <form method="POST" class="card-body">
                @csrf
                <h5>Informasi Pinjaman</h5>
                <div class="table-responsive">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Kode</th>
                                <td>
                                    <input type="text" class="form-control" name="kode" readonly value="{{ $kode }}">
                                    @error('kode') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            @if(auth()->check())
                                <tr>
                                    <th>Nama</th>
                                    <td>
                                        <input type="text" class="form-control" name="" readonly value="{{ auth()->user()->name }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Instansi</th>
                                    <td>
                                        <input type="text" class="form-control" name="" readonly value="{{ auth()->user()->unit }}">
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <th>Nama</th>
                                    <td>
                                        <input type="text" required class="form-control" name="name">
                                        @error('name') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th>Unit</th>
                                    <td>
                                        <input type="text" required class="form-control" name="unit">
                                        @error('unit') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email/HP</th>
                                    <td>
                                        <input type="text" required class="form-control" name="contact">
                                        @error('contact') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <td>
                                    <input type="date" class="form-control" name="tanggal_pengajuan" value="{{ date('Y-m-d') }}">
                                    @error('tanggal_pengajuan') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Rencana Pengembalian</th>
                                <td>
                                    <input type="date" class="form-control" name="rencana_tanggal_pengembalian" value="">
                                    @error('rencana_tanggal_pengembalian') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
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

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5>Daftar Barang</h5>
                    <a href="/">
                        <button type="button" class="btn btn-success me-2">+ Tambahkan barang</button>
                    </a>
                </div>
                <div class="table-responsive mb-2">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode BNM</th>
                                <th>NUP</th>
                                <th>Nama Barang</th>
                                <th>Merk/Type</th>
                                <th>Kondisi</th>
                                <th>Lokasi</th>
                                <th>:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $barang)
                                <tr>
                                    <td>
                                        <a href="/dashboard/barang/show/{{ $barang->id }}">{{ $barang->bnm_nup ? @(explode('#', $barang->bnm_nup))[0] : '' }}</a>
                                    </td>
                                    <td>{{ $barang->bnm_nup ? @(explode('#', $barang->bnm_nup))[1] : '' }}</td>
                                    <td>{{ $barang->nama }}</td>
                                    <td>{{ $barang->merk }}</td>
                                    <td>{{ $barang->kondisi }}</td>
                                    <td>
                                        <a href="/dashboard/lokasi/show/{{ $barang->lokasi_id }}">
                                            {{ $barang->lokasi->nama }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="text-danger hapus-barang" data-id="{{ $barang->id }}" data-nama="{{ $barang->nama }}">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection