@extends('layouts.app')

@section('title') Admin @endsection

@section('content')
    <div>
        <h3><i class="bi bi-person-workspace"></i> Tambah Admin</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Admin</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <form method="POST" class="card-body">
                @csrf
                <div class="table-responsive mb-2">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nama Admin</th>
                                <td>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    @error('name') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                    @error('email') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Unit</th>
                                <td>
                                    <input type="text" name="unit" class="form-control" value="{{ old('unit') }}">
                                    @error('unit') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>
                                    <input type="password" name="password" class="form-control" value="">
                                    @error('password') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Konfirmasi Password</th>
                                <td>
                                    <input type="password" name="confirm_password" class="form-control" value="">
                                    @error('confirm_password') <div class="text-danger mt-2">{{ $message }}</div> @enderror
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