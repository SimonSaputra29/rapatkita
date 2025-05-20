@extends('layouts.app')

@push('styles')
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endpush

@section('content')
    <div class="container py-4 animate__animated animate__fadeIn">
        <div class="mb-4 text-center animate__animated animate__fadeInDown">
            <h2 class="fw-bold text-primary">
                <i class="bi bi-envelope-paper-fill me-2"></i>Daftar Surat Undangan
            </h2>
            <p class="text-muted">Kelola dan pantau pengajuan undangan rapat Anda.</p>
        </div>

        <div class="d-flex justify-content-end mb-3 animate__animated animate__fadeInRight">
            <a href="{{ route('pegawai.create') }}" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Ajukan Undangan Baru
            </a>
        </div>

        <div class="table-responsive shadow-sm rounded animate__animated animate__fadeInUp">
            <table class="table table-hover align-middle text-center border table-striped">
                <thead class="table-primary">
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr class="animate__animated animate__fadeIn"
                            style="animation-delay: {{ $loop->index * 0.2 }}s; animation-fill-mode: both;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($permission->date)->translatedFormat('d F Y') }}</td>
                            <td>{{ $permission->time }}</td>
                            <td>{{ $permission->location }}</td>
                            <td>{{ $permission->topic }}</td>
                            <td>{{ $permission->participants }}</td>
                            <td>{{ $permission->note }}</td>
                            <td>
                                @if ($permission->status === 'approved')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>Disetujui
                                    </span>
                                @elseif ($permission->status === 'rejected')
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i>Ditolak
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-hourglass-split me-1"></i>Menunggu
                                    </span>
                                @endif
                            </td>
                            <td>{{ $permission->approver->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('permissions.export', $permission->id) }}"
                                    class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Unduh Surat">
                                    <i class="bi bi-download"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <div id="lottie-empty" style="height: 200px;"></div>
                                <p class="mt-3 text-muted">Belum ada data surat undangan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.4/lottie.min.js"></script>
    <script>
        // Tooltip init
        const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltips.forEach(t => new bootstrap.Tooltip(t));

        // Lottie animation
        @if ($permissions->isEmpty())
            lottie.loadAnimation({
                container: document.getElementById('lottie-empty'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: 'https://assets3.lottiefiles.com/packages/lf20_HXrZfZ.json' // animasi inbox kosong
            });
        @endif
    </script>
@endpush
