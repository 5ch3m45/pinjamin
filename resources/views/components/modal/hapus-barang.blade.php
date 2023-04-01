<div class="modal fade" id="hapus-barang-modal" tabindex="-1" aria-labelledby="hapus-barang-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="hapus-barang-form" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hapus-barang-modalLabel"><i class="bi bi-boxes"></i> Hapus Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hapus barang <span id="nama-barang"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>