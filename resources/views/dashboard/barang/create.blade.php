@extends('layouts.app')

@section('title') Barang @endsection

@section('content')
    <div>
        <h3><i class="bi bi-boxes"></i> Tambah Barang</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/barang">Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
            </ol>
        </nav>

        <x-alert.success-and-error/>

        <div class="card mb-4">
            <form method="POST" class="card-body">
                @csrf
                <input type="hidden" name="redirect" value="{{ $redirect }}">
                <div class="table-responsive">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Kode BMN</th>
                                <td>
                                    <input type="text" name="bnm" class="form-control" value="{{ old('bnm') }}">
                                    @error('bnm') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>NUP</th>
                                <td>
                                    <input type="text" name="nup" class="form-control" value="{{ old('nup') }}">
                                    @error('nup') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td>
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Merk/Type</th>
                                <td>
                                    <input type="text" name="merk" class="form-control" value="{{ old('merk') }}">
                                    @error('merk') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Tahun Perolehan</th>
                                <td>
                                    <input type="date" name="tanggal_perolehan" class="form-control" value="{{ old('tanggal_perolehan') }}">
                                    @error('tanggal_perolehan') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td>
                                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}">
                                    @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Kondisi</th>
                                <td>
                                    <select name="kondisi" id="" class="form-control" value="{{ old('kondisi') }}">
                                        <option value="baik">Baik</option>
                                        <option value="rusak_ringan">Rusak Ringan</option>
                                        <option value="rusak_berat">Rusak Berat</option>
                                    </select>
                                    @error('kondisi') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Ruang</th>
                                <td>
                                    <select name="lokasi_id" id="" class="form-control">
                                        <option value="">Pilih Lokasi</option>
                                        @foreach($lokasis as $value)
                                        <option @if($value->id == $lokasi) selected @endif value="{{ $value->id }}">{{ $value->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('lokasi_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>
                                    <textarea name="keterangan" id="" rows="3" class="form-control">{{ old('keterangan') }}</textarea>
                                    @error('keterangan') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" name="redirect_back" type="checkbox" value="1" id="flexCheckDefault" @if(old('redirect_back')) checked @endif>
                        <label class="form-check-label" for="flexCheckDefault">
                          Kembali ke halaman ini
                        </label>
                    </div>
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}">
                            <button type="button" class="btn btn-white me-2">Batal</button>
                        </a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection