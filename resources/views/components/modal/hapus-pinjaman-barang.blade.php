<div class="modal fade" id="hapus-pinjaman-barang-modal" tabindex="-1" aria-labelledby="hapus-pinjaman-barang-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="hapus-pinjaman-barang-form" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hapus-pinjaman-barang-modalLabel"><i class="bi bi-boxes"></i> Hapus Barang dari Pinjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hapus barang <span id="nama-barang"></span> dari pinjaman <span id="kode-pinjaman"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>