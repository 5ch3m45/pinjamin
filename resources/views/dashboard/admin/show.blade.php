@extends('layouts.app')

@section('title') Detail Admin @endsection

@section('content')
    <div>
        <h3><i class="bi bi-person-workspace"></i> Detail Admin</h3>
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/dashboard/admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Admin</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Detail</h5>
                <div class="table-responsive">
                    <table id="form-table" class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $admin->name }}</td>
                            </tr>
                            <tr>
                                <th>Unit</th>
                                <td>{{ $admin->unit }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $admin->email }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal bergabung</th>
                                <td>{{ $admin->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection