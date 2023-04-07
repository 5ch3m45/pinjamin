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
                                    {{ $barang->lokasi->nama }}
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $barang->keterangan }}</td>
                            </tr>
                            <tr>
                                <th>
                                    Foto
                                </th>
                                <td>
                                    <div id="img-viewer" class="row" style="max-width: 1024px">
                                        @if($barang->fotos)
                                            @foreach($barang->fotos as $foto)
                                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex flex-column mb-3">
                                                <img src="/assets/{{ ($foto->foto) }}" class="img-barang" alt="" style="max-height: 10rem; max-width: 10rem; margin: auto 0px;">
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection