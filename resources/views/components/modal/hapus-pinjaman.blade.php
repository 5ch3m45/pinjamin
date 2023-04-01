<div class="modal fade" id="hapus-pinjaman-modal" tabindex="-1" aria-labelledby="hapus-pinjaman-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="hapus-pinjaman-form" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            @if($redirect)
                <input type="hidden" name="redirect" vaue="{{ $redirect }}">
            @endif
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hapus-pinjaman-modalLabel"><i class="bi bi-boxes"></i> Hapus Pinjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hapus pinjaman <span id="kode-pinjaman"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>