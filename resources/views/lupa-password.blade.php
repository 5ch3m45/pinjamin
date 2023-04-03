@extends('layouts.auth')

@section('title') Login @endsection

@section('content')
    <div class="">
        
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="d-flex justify-content-center mb-4">
                    <div class="d-flex">
                        <img src="/assets/img/delivery.png" class="me-2" style="height: 2rem">
                        <h3>STOK BARANG</h3>
                    </div>
                </div>
                <x-alert.success-and-error/>
                <div class="card mb-4">
                    <form method="POST" class="card-body">
                        @csrf
                        <h5>Lupa Password?</h5>
                        <p>Masukkan email untuk kami kirimkan token.</p>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">Kirimkan Token</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection