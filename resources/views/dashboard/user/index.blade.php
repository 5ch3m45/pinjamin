@extends('layouts.app')

@section('title') User @endsection

@section('content')
    <div>
        <h3><i class="bi bi-people-fill"></i> User</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
        </nav>

        <x-alert.success-and-error/>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Filter</h5>
                <form class="row">
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label">Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari" value="{{ $search }}">
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label">Urutkan</label>
                        <select name="sort" class="form-control">
                            <option value="nama">Nama</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <div>
                            <label class="form-label">&nbsp;</label>
                        </div>
                        <button type="sub" class="btn btn-primary me-2"><i class="bi bi-search"></i> Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Unit</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
                                <th>Status</th>
                                <th>:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                    <a href="/dashboard/user/show/{{ $user->id }}">{{ $user->name }}</a>
                                </td>
                                <td>{{ $user->unit }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->status_text }}</td>
                                <td>
                                    @if($user->is_verified == 0)
                                    <a id="verifikasi-user-{{ $user->id }}" href="javascript:void(0)" class="text-primary verifikasi-user" data-id="{{ $user->id }}" data-nama="{{ $user->name }}">Verifikasi</a> | 
                                    @endif
                                    <a href="javascript:void(0)" class="text-danger hapus-user" data-id="{{ $user->id }}" data-nama="{{ $user->name }}">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>{{ $users->links() }}</div>
            </div>
        </div>
    </div>

    <x-modal.hapus-user/>
    <x-modal.verifikasi-user/>
@endsection