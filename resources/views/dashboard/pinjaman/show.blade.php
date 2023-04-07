@extends('layouts.app')

@section('title') Detail Pinjaman @endsection

@section('content')
    <div>
        <h3><i class="bi bi-list-check"></i> Pinjaman #{{ $pinjaman->kode }}</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/pinjaman">Pinjaman</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pinjaman #{{ $pinjaman->kode }}</li>
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
                                <th>Kode</th>
                                <td>{{ $pinjaman->kode }}</td>
                            </tr>
                            <tr>
                                <th>Peminjam</th>
                                <td>
                                    <a href="{{ $pinjaman->user_id }}">{{ $pinjaman->user->name }}</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <td>{{ date('d M Y', strtotime($pinjaman->tanggal_pengajuan)) }}</td>
                            </tr>
                            <tr>
                                <th>Rencana Pengembalian</th>
                                <td>{{ date('d M Y', strtotime($pinjaman->rencana_pengembalian)) }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{!! $pinjaman->status !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/dashboard/pinjaman/edit/{{ $pinjaman->id }}">
                        <button class="btn btn-primary me-2"><i class="bi bi-pencil"></i> Edit</button>
                    </a>
                    <button class="btn btn-danger hapus-pinjaman" data-id="{{ $pinjaman->id }}" data-kode="{{ $pinjaman->kode }}"><i class="bi bi-trash"></i> Hapus</button>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Barang Dipinjam</h5>
                <div class="table-responsive mb-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Lokasi</th>
                                <th>Tanggal Dipinjamkan</th>
                                <th>Tanggal Dikembalikan</th>
                                <th>:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pinjaman_barangs as $pinjaman_barang)
                            <tr>
                                <td style=""">
                                    <a href="/dashboard/barang/show/{{ $pinjaman_barang->barang_id }}">{{ $pinjaman_barang->barang->nama }}: {{ $pinjaman_barang->barang->merk }}</a>
                                </td>
                                <td>
                                    <a href="/dashboard/lokasi/show/{{ $pinjaman_barang->barang->lokasi_id }}">{{ $pinjaman_barang->barang->lokasi->nama }}</a>
                                </td>
                                <td style="" id="tanggal-peminjaman-{{ $pinjaman_barang->id }}">
                                    @if($pinjaman_barang->tanggal_peminjaman)
                                        @if($pinjaman_barang->tanggal_peminjaman == '1970-01-01')
                                            <span class="text-danger">TIDAK DISETUJUI</span>
                                        @else
                                            {{ date('d M Y', strtotime($pinjaman_barang->tanggal_peminjaman)) }}
                                        @endif
                                    @else
                                        <a href="javascript:void(0)" class="text-primary konfirmasi-pinjaman" data-id="{{ $pinjaman_barang->id }}">Konfirmasi pinjaman</a> |
                                        <a href="javascript:void(0)" class="text-danger tolak-pinjaman" data-id="{{ $pinjaman_barang->id }}">Tolak pinjaman</a>
                                    @endif
                                </td>
                                <td style="" id="tanggal-pengembalian-{{ $pinjaman_barang->id }}">
                                    @if($pinjaman_barang->tanggal_peminjaman)
                                        @if($pinjaman_barang->tanggal_pengembalian) 
                                            {{ date('d M Y', strtotime($pinjaman_barang->tanggal_pengembalian)) }}
                                        @else 
                                            @if($pinjaman_barang->tanggal_peminjaman == '1970-01-01')
                                                -
                                            @else 
                                                <a href="javascript:void(0)" class="text-primary konfirmasi-pengembalian" data-id="{{ $pinjaman_barang->id }}">Konfirmasi pengembalian</a>
                                            @endif
                                        @endif
                                    @else - @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-primary edit-pinjaman-barang" data-id="{{ $pinjaman_barang->id }}" data-kode="{{ $pinjaman->kode }}" data-nama="{{ $pinjaman_barang->barang->nama }}" data-pengajuan="{{ $pinjaman->tanggal_pengajuan }}" data-peminjaman="{{ $pinjaman_barang->tanggal_peminjaman }}" data-pengembalian="{{ $pinjaman_barang->tanggal_pengembalian }}">Edit</a> |
                                    <a href="javascript:void(0)" class="text-danger hapus-pinjaman-barang" data-id="{{ $pinjaman_barang->id }}" data-nama="{{ $pinjaman_barang->barang->nama }}" data-kode="{{ $pinjaman->kode }}">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <button id="tambah-pinjaman-barang" class="btn btn-success"><i class="bi bi-plus"></i> Tambah Barang</button>
                </div>
            </div>
        </div>

        <x-modal.hapus-pinjaman />
        <x-modal.tambah-pinjaman-barang :barangs="$barangs" :pinjaman="$pinjaman"/>
        <x-modal.edit-pinjaman-barang/>
        <x-modal.hapus-pinjaman-barang/>
    </div>
@endsection