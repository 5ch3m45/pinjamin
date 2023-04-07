@extends('layouts.public')

@section('title') Detail Barang @endsection

@section('content')
    <div>
        <h3><i class="bi bi-boxes"></i> {{ $barang->nama }}</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/barang">Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama }}</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Detail</h5>
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
                                <th>Kode BNM</th>
                                <td>{{ $barang->bnm_nup ? explode('#', $barang->bnm_nup)[0] : '' }}</td>
                            </tr>
                            <tr>
                                <th>NUP</th>
                                <td>{{ $barang->bnm_nup ? @explode('#', $barang->bnm_nup)[1] : '' }}</td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td>{{ $barang->nama }}</td>
                            </tr>
                            <tr>
                                <th>Merk/Type</th>
                                <td>{{ $barang->merk }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Perolehan</th>
                                <td>{{ $barang->tanggal_perolehan }}</td>
                            </tr>
                            <tr>
                                <th>Kondisi</th>
                                <td>{{ $barang->kondisi }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>
                                    <a href="/dashboard/lokasi/show/{{ $barang->lokasi_id }}">{{ $barang->lokasi->nama }}</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $barang->keterangan }}</td>
                            </tr>
                            <tr>
                                <th>
                                    Foto <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#tambah-foto-barang-modal"><i class="bi bi-cloud-arrow-up"></i> Baru</a>
                                </th>
                                <td id="img-viewer">
                                    @if($barang->fotos)
                                        @foreach($barang->fotos as $foto)
                                        <img src="/assets/{{ ($foto->foto) }}" alt="" style="max-height: 10rem; max-width: 10rem; margin: auto 0px;">
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection