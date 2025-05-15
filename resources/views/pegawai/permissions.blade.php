@extends('layouts.app')

@section('content')
<<<<<<< HEAD
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

=======
    <!-- Tambahkan Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <div class="container py-4 animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary"><i class="bi bi-envelope-paper-fill me-2"></i>Daftar Surat Undangan</h2>
            <a href="{{ route('permissions.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Ajukan Undangan Baru
            </a>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover align-middle border rounded">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Tempat</th>
                        <th>Topik</th>
                        <th>Partisipasi</th>
                        <th>File</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th>Disetujui Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($permission->date)->translatedFormat('d F Y') }}</td>
                            <td>{{ $permission->time }}</td>
                            <td>{{ $permission->location }}</td>
                            <td>{{ $permission->topic }}</td>
                            <td>{{ $permission->participants }}</td>
                            <td>
                                @if ($permission->attachment)
                                    <a href="{{ asset('storage/' . $permission->attachment) }}" target="_blank"
                                        class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-file-earmark-arrow-down"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $permission->note }}</td>
                            <td>
                                @if ($permission->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($permission->status == 'rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @endif
                            </td>
                            <td>{{ $permission->approver->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('permissions.export', $permission->id) }}"
                                    class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-download"></i> Unduh
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">Belum ada data Surat Undangan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
>>>>>>> 438602ee89af6e1ce30a85617231092f54394442
@endsection
