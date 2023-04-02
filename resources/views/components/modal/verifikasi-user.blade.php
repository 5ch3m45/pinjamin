<div class="modal fade" id="verifikasi-user-modal" tabindex="-1" aria-labelledby="verifikasi-user-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="verifikasi-user-form" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hapus-pinjaman-barang-modalLabel"><i class="bi bi-person-check-fill"></i> Verifikasi User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Verifikasi user <span id="nama-user"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Verifikasi</button>
            </div>
        </form>
    </div>
</div>