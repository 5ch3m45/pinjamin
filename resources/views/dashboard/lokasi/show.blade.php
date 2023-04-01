@extends('layouts.app')

@section('title') Lokasi @endsection

@section('content')
    <div>
        <h3><i class="bi bi-buildings-fill"></i> Detail Lokasi</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/lokasi">Lokasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Lokasi</li>
            </ol>
        </nav>

        <x-alert.success-and-error/>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Detail</h5>
                <div class="table-responsive mb-2">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nama Lokasi</th>
                                <td>{{ $lokasi->nama }}</td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $lokasi->deskripsi }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/dashboard/lokasi/edit/{{ $lokasi->id }}">
                        <button class="btn btn-primary me-2"><i class="bi bi-pencil"></i> Edit</button>
                    </a>
                    <button class="btn btn-danger hapus-lokasi" data-id="{{ $lokasi->id }}" data-nama="{{ $lokasi->nama }}"><i class="bi bi-trash"></i> Hapus</button>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5>Daftar Barang</h5>
                    <form action="" class="d-flex">
                        <div>
                            <div class="me-2">
                                <input type="text" name="search" class="form-control" placeholder="Cari" value="{{ $search }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2"><i class="bi bi-search"></i></button>
                        <a href="/dashboard/barang/create?lokasi={{ $lokasi->id }}&redirect=/dashboard/lokasi/show/{{ $lokasi->id }}">
                            <button type="button" class="btn btn-success py-auto">&nbsp;<i class="bi bi-plus-square-fill"></i>&nbsp;</button>
                        </a>
                    </form>
                </div>
                <div class="table-responsive mb-2">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode BNM</th>
                                <th>NUP</th>
                                <th>Nama Barang</th>
                                <th>Merk/Type</th>
                                <th>Tahun Perolehan</th>
                                <th>Kondisi</th>
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
                                <td>{{ $barang->tanggal_perolehan ? date('d M Y', strtotime($barang->tanggal_perolehan)) : '' }}</td>
                                <td>{{ $barang->kondisi_text }}</td>
                                <td>
                                    <a href="/dashboard/barang/edit/{{ $barang->id }}" class="text-primary">Edit</a> |
                                    <a href="javascript:void(0)" class="text-danger hapus-barang" data-id="{{ $barang->id }}" data-nama="{{ $barang->nama }}">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $barangs->links() }}
            </div>
        </div>
    </div>

    <x-modal.hapus-barang/>
    <x-modal.hapus-lokasi/>
@endsection