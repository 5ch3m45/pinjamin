@extends('layouts.public')

@section('title') Troli Pinjaman @endsection

@section('content')
    <div>
        <h3><i class="bi bi-cart-fill"></i> Troli Pinjaman</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Troli Pinjaman</li>
            </ol>
        </nav>

        <x-alert.user-belum-terverifikasi/>
        <x-alert.success-and-error/>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Filter</h5>
                <form class="row mb-3">
                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-3">
                        <label class="form-label">Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari" value="{{ $search }}">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-md-3">
                        <label class="form-label">Urutkan</label>
                        <select name="sort" class="form-control">
                            <option value="nama">Nama</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <div>
                            <label class="form-label">&nbsp;</label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2 mb-3 mb-md-0"><i class="bi bi-search"></i> Cari</button>
                        @if(auth()->check() && auth()->user()->is_verified == 0)
                        <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Akun Anda belum terverifikasi">
                            <button disabled type="button" class="btn btn-light mb-3 mb-md-0"><i class="bi bi-arrow-right-square-fill"></i> Lanjutkan peminjaman</button>
                        </span>
                        @else
                        <a href="/troli/next">
                            <button type="button" class="btn btn-success mb-3 mb-md-0"><i class="bi bi-arrow-right-square-fill"></i> Lanjutkan peminjaman</button>
                        </a>
                        @endif
                    </div>
                </form>
            </div>
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
                                    <td>{{ $barang->kondisi_text }}</td>
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