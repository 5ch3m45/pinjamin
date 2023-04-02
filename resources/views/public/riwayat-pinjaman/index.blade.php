@extends('layouts.public')

@section('title') Riwayat Pinjaman @endsection

@section('content')
    <div>
        <h3><i class="bi bi-clock-history"></i> Riwayat Pinjaman</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat Pinjaman</li>
            </ol>
        </nav>

        <x-alert.user-belum-terverifikasi/>
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
                    <div class="col-12 col-md-4 col-lg-3 mb-3">
                        <div>
                            <label class="form-label">&nbsp;</label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2"><i class="bi bi-search"></i> Cari</button>
                        @if(auth()->check() && auth()->user()->is_verified == 0)
                        <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Akun Anda belum terverifikasi">
                            <button type="button" disabled class="btn btn-light">+ Baru</button>
                        </span>
                        @else
                        <a href="/pinjaman/create">
                            <button type="button" class="btn btn-success">+ Baru</button>
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
                                <th>Status</th>
                                <th>:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pinjamans as $pinjaman)
                                <tr>
                                    <td>
                                        <a href="/pinjaman/show/{{ $pinjaman->id }}">{{ $pinjaman->kode }}</a>
                                    </td>
                                    <td>{{ $pinjaman->status_peminjam }}</td>
                                    <td>
                                        <a data-bs-toggle="collapse" href="#collapse{{ $pinjaman->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $pinjaman->id }}">Lihat Barang</a>
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($pinjaman->pinjaman_barangs as $pinjaman_barang)
                                                    <tr>
                                                        <td>
                                                            <a href="/barang/show/{{ $pinjaman_barang->barang_id }}">
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
                                                                BELUM DIKONFIRMASI ADMIN
                                                            @endif
                                                        </td>
                                                        <td id="tanggal-pengembalian-{{ $pinjaman_barang->id }}">
                                                            @if($pinjaman_barang->tanggal_peminjaman)
                                                                @if($pinjaman_barang->tanggal_pengembalian) {{ $pinjaman_barang->tanggal_pengembalian }}
                                                                @else 
                                                                    @if($pinjaman_barang->tanggal_peminjaman == '1970-01-01')
                                                                        -
                                                                    @else 
                                                                        BELUM DIKONFIRMASI ADMIN
                                                                    @endif
                                                                @endif
                                                            @else - @endif
                                                        </td>
                                                        <td></td>
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
    </div>
@endsection