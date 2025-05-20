@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📅 Manajemen Undangan Rapat</h2>
    </div>

    {{-- Filter Status --}}
    <form method="GET" action="{{ route('admin.permissions.index') }}" class="row g-2 align-items-end mb-4">
        <div class="col-auto">
            <label for="status" class="form-label mb-0 fw-semibold">Filter Status:</label>
        </div>
        <div class="col-md-3 col-sm-6">
            <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                <option value="">🌐 Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>✅ Disetujui</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>❌ Ditolak</option>
            </select>
        </div>
    </form>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered align-middle table-hover">
            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Tanggal</th>
                    <th>Topik</th>
                    <th>Status</th>
                    <th>Disetujui Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permissions as $permission)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $permission->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($permission->date)->translatedFormat('d F Y') }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($permission->topic, 30) }}</td>
                        <td class="text-center">
                            @switch($permission->status)
                                @case('approved')
                                    <span class="badge bg-success px-3 py-2">Disetujui</span>
                                    @break
                                @case('rejected')
                                    <span class="badge bg-danger px-3 py-2">Ditolak</span>
                                    @break
                                @default
                                    <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
                            @endswitch
                        </td>
                        <td>{{ $permission->approver->name ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.permissions.show', $permission->id) }}"
                                class="btn btn-sm btn-info me-1" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.permissions.export', $permission->id) }}"
                                class="btn btn-sm btn-secondary me-1" title="Unduh PDF">
                                <i class="fas fa-download"></i>
                            </a>

                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST"
                                class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Data">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">🚫 Tidak ada data undangan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $permissions->withQueryString()->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.form-delete');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: '<strong>Yakin ingin menghapus?</strong>',
                    html: '<p class="mb-1">Surat undangan ini akan <b>dihapus permanen</b>.</p>',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#6c757d',
                    confirmButtonColor: '#dc3545',
                    cancelButtonText: 'Batal',
                    confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Ya, hapus!',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-3 shadow',
                        confirmButton: 'btn btn-danger px-4',
                        cancelButton: 'btn btn-secondary px-4'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif
@endsection
