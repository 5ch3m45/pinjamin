@extends('layouts.public')

@section('title') Detail Pinjaman @endsection

@section('content')
    <div>
        <h3><i class="bi bi-clock-history"></i> #{{ $pinjaman->kode }}</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/riwayat-pinjaman">Riwayat Pinjaman</a></li>
                <li class="breadcrumb-item active" aria-current="page">#{{ $pinjaman->kode }}</li>
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
                                <th>Tanggal Pengajuan</th>
                                <td>{{ date('d M Y', strtotime($pinjaman->tanggal_pengajuan)) }}</td>
                            </tr>
                            <tr>
                                <th>Rencana Pengembalian</th>
                                <td>{{ date('d M Y', strtotime($pinjaman->rencana_pengembalian)) }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $pinjaman->status_peminjam }}</td>
                            </tr>
                        </tbody>
                    </table>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pinjaman_barangs as $pinjaman_barang)
                            <tr>
                                <td style=""">
                                    <a href="/barang/show/{{ $pinjaman_barang->barang_id }}">{{ $pinjaman_barang->barang->merk }}: {{ $pinjaman_barang->barang->nama }}</a>
                                </td>
                                <td style=""">
                                    {{ $pinjaman_barang->barang->lokasi->nama }}
                                </td>
                                <td style="" id="tanggal-peminjaman-{{ $pinjaman_barang->id }}">
                                    @if($pinjaman_barang->tanggal_peminjaman)
                                        @if($pinjaman_barang->tanggal_peminjaman == '1970-01-01')
                                            <span class="text-danger">TIDAK DISETUJUI</span>
                                        @else
                                            {{ date('d M Y', strtotime($pinjaman_barang->tanggal_peminjaman)) }}
                                        @endif
                                    @else
                                        MENUNGGU KONFIRMASI ADMIN
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
                                                MENUNGGU KONFIRMASI ADMIN
                                            @endif
                                        @endif
                                    @else - @endif
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