@extends('layouts.app')

@section('title') Admin @endsection

@section('content')
    <div>
        <h3><i class="bi bi-person-workspace"></i> Admin</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Filter</h5>
                <form class="row">
                    <div class="col-12 col-md-4 col-lg-3 mb-3">
                        <label class="form-label">Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari" value="{{ $search }}">
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mb-3">
                        <label class="form-label">Urutkan</label>
                        <select name="sort" class="form-control" value="{{ $sort }}">
                            <option value="name">Nama</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mb-3">
                        <div>
                            <label class="form-label">&nbsp;</label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2"><i class="bi bi-search"></i> Cari</button>
                        <a href="/dashboard/admin/create">
                            <button type="button" class="btn btn-success">+ Baru</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive mb-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
                                <th>Unit</th>
                                <th style="width: 10%">:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr>
                                <td>
                                    <a href="/dashboard/admin/show/{{ $admin->id }}">
                                        {{ $admin->name }}
                                    </a>
                                </td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ '-' }}</td>
                                <td>{{ $admin->unit }}</td>
                                <td>
                                    <a href="/dashboard/admin/edit/{{ $admin->id }}" class="text-primary">Edit</a> |
                                    <a href="javascript:void(0)" class="text-danger hapus-admin" data-id="{{ $admin->id }}" data-nama="{{ $admin->name }}">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $admins->links() }}
            </div>
        </div>

        <div class="modal fade" id="hapus-admin-modal" tabindex="-1" aria-labelledby="hapus-admin-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form id="hapus-admin-form" method="POST" class="modal-content">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="hapus-admin-modalLabel"><i class="bi bi-person-workspace"></i> Hapus Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Hapus admin <span id="nama-admin"></span> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection