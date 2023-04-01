@extends('layouts.app')

@section('title') Edit Pinjaman @endsection

@section('content')
    <div>
        <h3><i class="bi bi-list-check"></i> Edit Pinjaman</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/pinjaman">Pinjaman</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Pinjaman</li>
            </ol>
        </nav>

        <x-alert.success-and-error/>

        <div class="card mb-4">
            <form method="POST" class="card-body">
                @csrf
                <h5>Informasi</h5>
                <div class="table-responsive mb-2">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Kode</th>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $pinjaman->kode }}">
                                </td>
                            </tr>
                            <tr>
                                <th>Peminjam</th>
                                <td>
                                    <a href="/dashboard/user/show/{{ $pinjaman->user_id }}">
                                        <input type="text" role="button" readonly class="form-control text-primary" value="{{ $pinjaman->user->name }}">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <td>
                                    <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ $pinjaman->tanggal_pengajuan }}">
                                    @error('tanggal_pengajuan') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Rencana Pengembalian</th>
                                <td>
                                    <input type="date" name="rencana_pengembalian" class="form-control" value="{{ $pinjaman->rencana_pengembalian }}">
                                    @error('rencana_pengembaluan') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
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