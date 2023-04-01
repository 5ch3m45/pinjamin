<div class="modal fade" id="tambah-pinjaman-barang-modal" tabindex="-1" aria-labelledby="tambah-pinjaman-barang-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="tambah-pinjaman-barang-form" action="/dashboard/pinjaman-barang/create" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="pinjaman_id" value="{{ $pinjaman->id }}">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambah-pinjaman-barang-modalLabel"><i class="bi bi-boxes"></i> Tambah Barang ke Pinjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Barang</th>
                                <td>
                                    <select id="select2-tambah-pinjaman-barang-modal" name="barang_id" class="form-control">
                                        <option value="">Pilih barang</option>
                                        @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}">{{ $barang->nama }}: {{ $barang->merk }} ({{ $barang->lokasi->nama }})</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl. Pengajuan</th>
                                <td>
                                    <input type="date" id="edit-tanggal_pengajuan" readonly class="form-control" value="{{ $pinjaman->tanggal_pengajuan }}">
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