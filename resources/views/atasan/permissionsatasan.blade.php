@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i> Daftar Pengajuan Izin Pegawai</h4>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Tempat</th>
                            <th>Topik</th>
                            <th>Partisipasi</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permission->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($permission->date)->translatedFormat('d F Y') }}</td>
                                <td>{{ $permission->time }}</td>
                                <td>{{ $permission->location }}</td>
                                <td>{{ $permission->topic }}</td>
                                <td>{{ $permission->participants }}</td>
                                <td>{{ $permission->note }}</td>
                                <td>
                                    @if($permission->status == 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($permission->status == 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if($permission->status == 'pending')
                                        <div class="d-flex gap-1 justify-content-center">
                                            <form action="{{ route('atasan.permissions.approve', $permission->id) }}" method="POST" onsubmit="return confirm('Setujui izin ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="bi bi-check-circle"></i> Setujui
                                                </button>
                                            </form>

                                            <form action="{{ route('atasan.permissions.reject', $permission->id) }}" method="POST" onsubmit="return confirm('Tolak izin ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-x-circle"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">Belum ada pengajuan izin.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
