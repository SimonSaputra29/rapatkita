@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📄 Daftar Surat Undangan Rapat</h2>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary shadow-sm">
            + Ajukan Undangan Baru
        </a>
    </div>

    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Tempat</th>
                    <th>Topik</th>
                    <th>Partisipasi</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Disetujui Oleh</th>
                    <th>Unduh Surat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $permission)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($permission->date)->translatedFormat('d F Y') }}</td>
                        <td>{{ $permission->time }}</td>
                        <td>{{ $permission->location }}</td>
                        <td>{{ $permission->topic }}</td>
                        <td>{{ $permission->participants }}</td>
                        <td>{{ $permission->note }}</td>
                        <td class="text-center">
                            @if($permission->status == 'approved')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($permission->status == 'rejected')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @endif
                        </td>
                        <td>{{ $permission->approver->name ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('permissions.export', $permission->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-download"></i> Unduh
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">Belum ada data Surat Undangan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
