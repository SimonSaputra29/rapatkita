@extends('layouts.app')

@section('content')
    <div class="container py-4 animated-fadein">

        <a href="{{ route('admin.permissions.index') }}"
            class="btn btn-light mb-4 shadow-sm rounded-pill px-4 py-2 btn-back-anim">
            <i class="fa fa-arrow-left me-2"></i>Kembali ke daftar
        </a>

        <div class="card shadow border-0 rounded-4 detail-card-anim">
            <div class="card-body p-4">
                <h2 class="mb-4 fw-bold text-gradient">Detail Pengajuan Izin</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th class="w-40 text-secondary">Nama Pegawai</th>
                                <td>{{ $permission->user->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Email Pegawai</th>
                                <td>{{ $permission->user->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Tanggal</th>
                                <td>{{ \Carbon\Carbon::parse($permission->date)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Jam</th>
                                <td>{{ $permission->time }} WIB</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Tempat</th>
                                <td>{{ $permission->location }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th class="w-40 text-secondary">Topik Rapat</th>
                                <td>{{ $permission->topic }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Partisipasi</th>
                                <td>{{ $permission->participants }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Catatan</th>
                                <td>{{ $permission->note ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Status</th>
                                <td>
                                    @if ($permission->status === 'approved')
                                        <span class="badge bg-success px-3 py-2 badge-anim">Disetujui</span>
                                    @elseif($permission->status === 'rejected')
                                        <span class="badge bg-danger px-3 py-2 badge-anim">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2 badge-anim">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Disetujui oleh</th>
                                <td>{{ $permission->approver->name ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .animated-fadein {
        animation: fadeIn 1.1s ease-out forwards;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(25px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .detail-card-anim {
        animation: popUp 0.6s ease-out;
        transition: transform 0.3s;
    }

    .detail-card-anim:hover {
        transform: scale(1.01);
    }

    @keyframes popUp {
        0% {
            opacity: 0;
            transform: scale(0.97) translateY(30px);
        }

        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .badge-anim {
        animation: badgeGlow 1.5s ease-in-out infinite alternate;
        transition: transform 0.2s;
    }

    @keyframes badgeGlow {
        from {
            box-shadow: 0 0 8px rgba(22, 255, 178, 0.4);
        }

        to {
            box-shadow: 0 0 14px rgba(22, 255, 178, 0.9);
        }
    }

    .badge-anim:hover {
        transform: scale(1.08) rotate(-1deg);
    }

    .btn-back-anim {
        transition: all 0.3s ease;
    }

    .btn-back-anim:hover {
        background: linear-gradient(90deg, #1cb5e0, #97a0ee);
        color: #fff;
        transform: scale(1.05) translateX(-4px);
    }

    .text-gradient {
        background: linear-gradient(90deg, #1cb5e0, #000851);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        transition: background-color 0.3s;
    }

    .table tr:hover td {
        background-color: #f8f9fa;
    }

    .table-borderless td,
    .table-borderless th {
        border: none;
    }

    @media (max-width: 767px) {
        .card-body .row>div {
            margin-bottom: 2rem;
        }

        .table td {
            display: block;
            text-align: left;
            padding-left: 0;
        }

        .table th {
            display: block;
            text-align: left;
            padding-left: 0;
            margin-bottom: 0.25rem;
            color: #6c757d;
        }
    }
</style>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll('.table tr');
        rows.forEach((row, i) => {
            row.style.opacity = 0;
            row.style.transform = 'translateY(10px)';
            row.style.transition = `opacity 0.6s ease ${i * 0.08}s, transform 0.6s ease ${i * 0.08}s`;
            setTimeout(() => {
                row.style.opacity = 1;
                row.style.transform = 'translateY(0)';
            }, 200);
        });

        document.querySelectorAll('.badge-anim').forEach(function(badge) {
            badge.addEventListener('click', function() {
                badge.style.animation = "badgePulse 0.5s";
                setTimeout(() => {
                    badge.style.animation =
                        "badgeGlow 1.5s ease-in-out infinite alternate";
                }, 500);
            });
        });
    });
</script>
