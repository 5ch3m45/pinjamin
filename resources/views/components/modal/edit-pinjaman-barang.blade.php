<div class="modal fade" id="edit-pinjaman-barang-modal" tabindex="-1" aria-labelledby="edit-pinjaman-barang-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="edit-pinjaman-barang-form" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit-pinjaman-barang-modalLabel"><i class="bi bi-boxes"></i> Edit Barang dari Peminjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Kode</th>
                                <td>
                                    <input type="text" id="edit-kode" readonly class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th>Barang</th>
                                <td>
                                    <input type="text" id="edit-nama" readonly class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl. Pengajuan</th>
                                <td>
                                    <input type="date" id="edit-tanggal_pengajuan" readonly class="form-control">
                                    @error('tanggal_pengajuan') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl. Peminjaman</th>
                                <td>
                                    <input type="date" name="tanggal_peminjaman" class="form-control">
                                    <div class="mt-2">
                                        <input class="form-check-input" type="checkbox" id="tolak-pinjaman-btn">
                                        <label class="form-check-label text-danger">
                                            Tolak pinjaman
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl. Pengembalian</th>
                                <td>
                                    <input type="date" name="tanggal_pengembalian" class="form-control">
                                    @error('tanggal_pengembalian') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>