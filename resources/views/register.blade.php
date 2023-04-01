@extends('layouts.auth')

@section('title') Login @endsection

@section('content')
    <div class="">
        
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="d-flex justify-content-center mb-4">
                    <div class="d-flex">
                        <img src="/assets/img/delivery.png" class="me-2" style="height: 2rem">
                        <h3>Pinjam Barang</h3>
                    </div>
                </div>
                <x-alert.success-and-error/>
                <div class="card mb-4">
                    <form method="POST" class="card-body">
                        @csrf
                        <h5>Register</h5>
                        <p>Lengkapi informasi di bawah ini untuk mendaftar.</p>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Unit</label>
                            <input type="text" name="unit" class="form-control" value="{{ old('unit') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/login">
                                <button type="button" class="btn btn-white">Login</button>
                            </a>
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection