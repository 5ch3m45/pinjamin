<div class="modal fade" id="hapus-lokasi-modal" tabindex="-1" aria-labelledby="hapus-lokasi-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="hapus-lokasi-form" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hapus-lokasi-modalLabel"><i class="bi bi-boxes"></i> Hapus Lokasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hapus lokasi <span id="nama-lokasi"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>