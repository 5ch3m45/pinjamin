<div class="modal fade" id="hapus-user-modal" tabindex="-1" aria-labelledby="hapus-user-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="hapus-user-form" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hapus-user-modalLabel"><i class="bi bi-person-dash-fill"></i> Hapus User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hapus user <span id="nama-user-hapus"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>