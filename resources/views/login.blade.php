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
                        <h5>Login</h5>
                        <p>Masukkan email dan password Anda untuk masuk.</p>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                        </div>
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Ingat saya
                        </label>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/register">
                                <button type="button" class="btn btn-white">Registrasi</button>
                            </a>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection