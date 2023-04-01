@extends('layouts.app')

@section('title') Barang @endsection

@section('content')
    <div>
        <h3><i class="bi bi-boxes"></i> Barang</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Barang</li>
            </ol>
        </nav>

        <x-alert.success-and-error/>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Filter</h5>
                <form class="row">
                    <div class="col-12 col-md-4 col-lg-3 mb-3">
                        <label class="form-label">Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari" value="{{ $search }}">
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mb-3">
                        <label class="form-label">Urutkan</label>
                        <select name="sort" class="form-control">
                            <option value="nama">Nama</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mb-3">
                        <div>
                            <label class="form-label">&nbsp;</label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2"><i class="bi bi-search"></i> Cari</button>
                        <a href="/dashboard/barang/create">
                            <button type="button" class="btn btn-success">+ Baru</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
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
                                <th>Lokasi</th>
                                <th>Status</th>
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
                                    <td>{{ $barang->tanggal_perolehan ? date('d/m/Y', strtotime($barang->tanggal_perolehan)) : '' }}</td>
                                    <td>{{ $barang->kondisi_text }}</td>
                                    <td>
                                        <a href="/dashboard/lokasi/show/{{ $barang->lokasi_id }}">
                                            {{ $barang->lokasi->nama }}
                                        </a>
                                    </td>
                                    <td>{{ $barang->status }}</td>
                                    <td>
                                        <a href="/dashboard/barang/edit/{{ $barang->id }}" class="text-primary">Edit</a> |
                                        <a href="javascript:void(0)" class="text-danger hapus-barang" data-id="{{ $barang->id }}" data-nama="{{ $barang->nama }}">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $barangs->links() }}
                </div>
            </div>
        </div>
        
        <x-modal.hapus-barang/>

    </div>
@endsection