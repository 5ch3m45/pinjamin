@extends('layouts.app')

@section('title') Lokasi @endsection

@section('content')
    <div>
        <h3><i class="bi bi-buildings-fill"></i> Lokasi</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lokasi</li>
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
                        <a href="/dashboard/lokasi/create">
                            <button type="button" class="btn btn-success">+ Baru</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 50%">Nama</th>
                                <th>Barang</th>
                                <th style="width: 10%">:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lokasis as $lokasi)
                            <tr>
                                <td>
                                    <a href="/dashboard/lokasi/show/{{ $lokasi->id }}">
                                        <p class="mb-1 text-primary">
                                            {{ $lokasi->nama }}
                                        </p>
                                        <em class="text-secondary">{{ $lokasi->deskripsi }}</em>
                                    </a>
                                </td>
                                <td>
                                    @php 
                                        $counter = 0;
                                        $show = 5;
                                    @endphp
                                    @foreach($lokasi->barangs as $key => $barang)
                                        @php $counter++; @endphp
                                        @if($counter <= $show)
                                            &#x2022; {{ $barang->merk }}
                                        @endif
                                    @endforeach
                                    @if($counter > $show)
                                        &#x2022; dan {{ $counter - $show }} lainnya
                                    @endif
                                </td>
                                <td>
                                    <a href="/dashboard/lokasi/edit/{{ $lokasi->id }}" class="text-primary">Edit</a> |
                                    <a href="javascript:void(0)" class="text-danger hapus-lokasi" data-id="{{ $lokasi->id }}" data-nama="{{ $lokasi->nama }}">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $lokasis->links() }}
                </div>
            </div>
        </div>

        <x-modal.hapus-lokasi/>
    </div>
@endsection