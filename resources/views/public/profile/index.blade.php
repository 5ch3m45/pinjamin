@extends('layouts.public')

@section('title') Profile Saya @endsection

@section('content')
    <div>
        <h3><i class="bi bi-person-fill"></i> Profile Saya</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile Saya</li>
            </ol>
        </nav>

        <x-alert.success-and-error/>

        <div class="card mb-4">
            <form method="POST" class="card-body">
                @csrf
                <div class="table-responsive">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td>
                                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                                    @error('name') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Unit</th>
                                <td>
                                    <input type="text" class="form-control" name="unit" value="{{ auth()->user()->unit }}">
                                    @error('unit') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <input type="text" class="form-control" name="email" value="{{ auth()->user()->email }}">
                                    @error('email') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Nomor HP</th>
                                <td>
                                    <input type="text" class="form-control" name="phone" value="{{ auth()->user()->phone }}">
                                    @error('phone') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
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