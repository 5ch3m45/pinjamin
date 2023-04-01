@extends('layouts.app')

@section('title') Tambah Pinjaman @endsection

@section('content')
    <div>
        <h3><i class="bi bi-check-list"></i> Tambah Pinjaman</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/pinjaman">Pinjaman</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Pinjaman</li>
            </ol>
        </nav>

        <x-alert.success-and-error/>

        <div class="card mb-4">
            <form method="POST" class="card-body">
                @csrf
                <h5>Informasi Pinjaman</h5>
                <div class="table-responsive">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Kode</th>
                                <td>
                                    <input type="text" class="form-control" name="kode" readonly value="{{ $kode }}">
                                    @error('kode') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Peminjam</th>
                                <td>
                                    <select name="user_id" class="form-control">
                                        <option value="">Pilih user</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <td>
                                    <input type="date" class="form-control" name="tanggal_pengajuan" value="{{ date('Y-m-d') }}">
                                    @error('tanggal_pengajuan') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Rencana Pengembalian</th>
                                <td>
                                    <input type="date" class="form-control" name="rencana_pengembalian" value="{{ date('Y-m-d') }}">
                                    @error('rencana_pengembalian') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
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