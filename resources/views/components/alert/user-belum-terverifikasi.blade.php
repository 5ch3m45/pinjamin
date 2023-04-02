@if(auth()->check() && auth()->user()->is_verified == 0)
<div class="mb-4">
    <div class="alert alert-danger" role="alert">
        Status akun Anda belum terverifikasi. 
        Pinjaman hanya akan disetujui apabila status akun Anda terverifikasi.
    </div>
</div>
@endif