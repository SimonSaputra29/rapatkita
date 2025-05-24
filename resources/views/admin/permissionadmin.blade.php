@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        /* Custom styling untuk header */
        h2.mb-0 {
            font-weight: 700;
            color: #343a40;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Styling form filter */
        form.row.g-2.align-items-end.mb-4 {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Table styling */
        table.table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        table.table thead {
            background-color: #0d6efd;
            color: white;
        }

        table.table tbody tr:hover {
            background-color: #e7f1ff;
            transition: background-color 0.3s ease;
        }

        /* Badge lebih modern */
        .badge {
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 12px;
            padding: 0.4em 1em;
            letter-spacing: 0.03em;
        }

        /* Button hover effect */
        .btn-info:hover {
            background-color: #0b5ed7;
            box-shadow: 0 4px 8px rgba(11, 94, 215, 0.4);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5c636a;
            box-shadow: 0 4px 8px rgba(92, 99, 106, 0.4);
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.5);
            transition: all 0.3s ease;
        }
    </style>
@endsection

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
            <h2 class="mb-0">📅 Manajemen Undangan Rapat</h2>
        </div>

        {{-- Filter Status --}}
        <form method="GET" action="{{ route('admin.permissions.index') }}"
            class="row g-2 align-items-end mb-4 animate__animated animate__fadeIn animate__delay-1s">
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
        <div class="table-responsive animate__animated animate__fadeInUp animate__delay-2s">
            <table class="table table-bordered align-middle table-hover">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Topik</th>
                        <th>Status</th>
                        <th>Disetujui / Ditolak Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $permission)
                        <tr class="animate__animated animate__fadeIn animate__faster">
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
            <div class="d-flex justify-content-center mt-4 animate__animated animate__fadeIn animate__delay-3s">
                {{ $permissions->withQueryString()->links() }}
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteForms = document.querySelectorAll('.form-delete');

                deleteForms.forEach(form => {
                    form.addEventListener('submit', function(e) {
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
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif
    @endsection
