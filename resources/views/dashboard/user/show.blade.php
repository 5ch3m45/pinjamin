@extends('layouts.app')

@section('title') User @endsection

@section('content')
    <div>
        <h3><i class="bi bi-people-fill me-2"></i> Detail User</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/user">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail User</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Informasi User</h5>
                <div class="table-responsive">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Unit</th>
                                <td>{{ $user->unit }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                            </tr>
                            <tr>
                                <th>Nomor HP</th>
                                <td><a href="">{{ $user->phone }}</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Riwayat Peminjaman</h5>
                <div class="table-responsive">
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Status</th>
                                <th>:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pinjamans as $pinjaman)
                                <tr>
                                    <td>
                                        <a href="/dashboard/pinjaman/show/{{ $pinjaman->id }}">{{ $pinjaman->kode }}</a>
                                    </td>
                                    <td>{{ $pinjaman->status }}</td>
                                    <td>
                                        <a data-bs-toggle="collapse" href="#collapse{{ $pinjaman->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $pinjaman->id }}">Lihat Barang</a> |
                                        <a href="/dashboard/pinjaman/edit/{{ $pinjaman->id }}" class="text-primary">Edit</a> |
                                        <a href="javascript:void(0)" class="text-danger hapus-pinjaman" data-id="{{ $pinjaman->id }}" data-kode="{{ $pinjaman->kode }}">Hapus</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="p-0">
                                        <div class="collapse" id="collapse{{ $pinjaman->id }}">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Barang</th>
                                                        <th>Tgl. Pengajuan</th>
                                                        <th>Tgl. Peminjaman</th>
                                                        <th>Tgl. Pengembalian</th>
                                                        <th>:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($pinjaman->pinjaman_barangs as $pinjaman_barang)
                                                    <tr>
                                                        <td>
                                                            <a href="/dashboard/barang/show/{{ $pinjaman_barang->barang_id }}">
                                                                {{ $pinjaman_barang->barang->nama }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $pinjaman->tanggal_pengajuan }}</td>
                                                        <td id="tanggal-peminjaman-{{ $pinjaman_barang->id }}">
                                                            @if($pinjaman_barang->tanggal_peminjaman)
                                                                @if($pinjaman_barang->tanggal_peminjaman == '1970-01-01')
                                                                    <span class="text-danger">TIDAK DISETUJUI</span>
                                                                @else
                                                                    {{ $pinjaman_barang->tanggal_peminjaman }}
                                                                @endif
                                                            @else
                                                                <a href="javascript:void(0)" class="text-primary konfirmasi-pinjaman" data-id="{{ $pinjaman_barang->id }}">Konfirmasi pinjaman</a> |
                                                                <a href="javascript:void(0)" class="text-danger tolak-pinjaman" data-id="{{ $pinjaman_barang->id }}">Tolak pinjaman</a>
                                                            @endif
                                                        </td>
                                                        <td id="tanggal-pengembalian-{{ $pinjaman_barang->id }}">
                                                            @if($pinjaman_barang->tanggal_peminjaman)
                                                                @if($pinjaman_barang->tanggal_pengembalian) {{ $pinjaman_barang->tanggal_pengembalian }}
                                                                @else 
                                                                    @if($pinjaman_barang->tanggal_peminjaman == '1970-01-01')
                                                                        -
                                                                    @else 
                                                                        <a href="javascript:void(0)" class="text-primary konfirmasi-pengembalian" data-id="{{ $pinjaman_barang->id }}">Konfirmasi pengembalian</a>
                                                                    @endif
                                                                @endif
                                                            @else - @endif
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="text-primary edit-pinjaman-barang" data-id="{{ $pinjaman_barang->id }}" data-kode="{{ $pinjaman->kode }}" data-nama="{{ $pinjaman_barang->barang->nama }}" data-pengajuan="{{ $pinjaman->tanggal_pengajuan }}" data-peminjaman="{{ $pinjaman_barang->tanggal_peminjaman }}" data-pengembalian="{{ $pinjaman_barang->tanggal_pengembalian }}">Edit</a> |
                                                            <a href="javascript:void(0)" class="text-danger hapus-pinjaman-barang" data-id="{{ $pinjaman_barang->id }}" data-nama="{{ $pinjaman_barang->barang->nama }}" data-kode="{{ $pinjaman->kode }}">Hapus</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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