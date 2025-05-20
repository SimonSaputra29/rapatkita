@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-person-lines-fill me-2"></i>Daftar Pengajuan Izin Pegawai
            </h5>
        </div>

        <div class="card-body">
            {{-- Flash Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Tabel Pengajuan --}}
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
                                    @switch($permission->status)
                                        @case('approved')
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Disetujui</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Ditolak</span>
                                            @break
                                        @default
                                            <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>Menunggu</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($permission->status == 'pending')
                                        <div class="d-flex justify-content-center gap-1">
                                            <form action="{{ route('atasan.permissions.approve', $permission->id) }}" method="POST" class="d-inline form-approve">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="btn btn-sm btn-outline-success btn-approve">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('atasan.permissions.reject', $permission->id) }}" method="POST" class="d-inline form-reject">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-reject">
                                                    <i class="bi bi-x-circle"></i>
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

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Tombol Setujui
    document.querySelectorAll('.btn-approve').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.form-approve');
            Swal.fire({
                title: 'Setujui izin ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#198754',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Tombol Tolak
    document.querySelectorAll('.btn-reject').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.form-reject');
            Swal.fire({
                title: 'Tolak izin ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc3545',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
