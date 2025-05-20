@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Pengajuan Izin</h3>

    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary mb-3">← Kembali ke daftar</a>

    <table class="table table-bordered">
        <tr>
            <th>Nama Pegawai</th>
            <td>{{ $permission->user->name }}</td>
        </tr>
        <tr>
            <th>Email Pegawai</th>
            <td>{{ $permission->user->email }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ \Carbon\Carbon::parse($permission->date)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>Jam</th>
            <td>{{ $permission->time }} WIB</td>
        </tr>
        <tr>
            <th>Tempat</th>
            <td>{{ $permission->location }}</td>
        </tr>
        <tr>
            <th>Topik Rapat</th>
            <td>{{ $permission->topic }}</td>
        </tr>
        <tr>
            <th>Partisipasi</th>
            <td>{{ $permission->participants }}</td>
        </tr>
        <tr>
            <th>Catatan</th>
            <td>{{ $permission->note ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if($permission->status === 'approved')
                    <span class="badge bg-success">Disetujui</span>
                @elseif($permission->status === 'rejected')
                    <span class="badge bg-danger">Ditolak</span>
                @else
                    <span class="badge bg-warning">Menunggu</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Disetujui oleh</th>
            <td>{{ $permission->approver->name ?? '-' }}</td>
        </tr>
    </table>
</div>
@endsection
