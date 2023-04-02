<div class="modal fade" id="tambah-foto-barang-modal" tabindex="-1" aria-labelledby="tambah-foto-barang-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="tambah-foto-barang-form" action="/dashboard/barang/edit/{{ $id }}/foto" method="POST" class="modal-content" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hapus-lokasi-modalLabel"><i class="bi bi-boxes"></i> Tambah Foto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Pilih Foto</label>
                    <input type="file" multiple class="form-control" id="exampleFormControlInput1" name="images[]" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>