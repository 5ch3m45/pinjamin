@extends('layouts.app')

@section('title') Lokasi @endsection

@section('content')
    <div>
        <h3><i class="bi bi-boxes"></i> Edit Lokasi</h3>
        
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/lokasi">Lokasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Lokasi</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <form method="POST" class="card-body">
                @csrf
                <div class="table-responsive mb-2">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td>
                                    <input type="text" name="nama" class="form-control" value="{{ $lokasi->nama }}">
                                    @error('nama') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>
                                    <textarea name="deskripsi" id="" rows="3" class="form-control">{{ $lokasi->deskripsi }}</textarea>
                                    @error('deskripsi') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}">
                        <button type="button" class="btn btn-white me-2">Batal</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection