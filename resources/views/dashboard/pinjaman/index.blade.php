@extends('layouts.app')

@section('title') Pinjaman @endsection

@section('content')
    <div>
        <h3><i class="bi bi-list-check"></i> Pinjaman</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pinjaman</li>
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
                            <option value="kode">Kode</option>
                        </select>
                    </div>
                    <div class="col mb-3">
                        <div>
                            <label class="form-label">&nbsp;</label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2"><i class="bi bi-search"></i> Cari</button>
                        <a href="/dashboard/pinjaman/create" class="me-2">
                            <button type="button" class="btn btn-success">+ Baru</button>
                        </a>
                        @if(\Request::has('user_not_verified') && \Request::get('user_not_verified') == 1)
                        <a href="/dashboard/pinjaman">
                            <button type="button" class="btn btn-light"><i class="bi bi-chevron-left"></i> Kembali</button>
                        </a>
                        @else
                        <a href="?user_not_verified=1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dari user belum terverifikasi">
                            <button type="button" class="btn btn-danger">Pinjaman lain <span class="badge bg-danger">{{$pinjamans_unverified_user_count  }}</span></button>
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive mb-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Peminjam</th>
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
                                    <td>
                                        <a href="/dashboard/user/show/{{ $pinjaman->user_id }}">
                                            {{ $pinjaman->user->name }}
                                        </a> @if($pinjaman->user->is_verified == 0) (User belum terverifikasi) @endif
                                    </td>
                                    <td>{!! $pinjaman->status !!}</td>
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
                                                                    @if($pinjaman_barang->tanggal_peminjaman === NULL)
                                                                    <a href="javascript:void(0)" class="text-primary konfirmasi-pengembalian" data-id="{{ $pinjaman_barang->id }}">Konfirmasi pengembalian</a>
                                                                    @else 
                                                                    -
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
                <div>
                    {{ $pinjamans->links() }}
                </div>
            </div>
        </div>

        <x-modal.edit-pinjaman-barang/>
        <x-modal.hapus-pinjaman-barang/>
        <x-modal.hapus-pinjaman :redirect="url()->full()"/>
    </div>
@endsection