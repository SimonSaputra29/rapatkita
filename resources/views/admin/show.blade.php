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

@section('styles')
    <style>
        .animated-fadein {
            animation: fadeIn 1.1s cubic-bezier(.42, 0, .58, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .detail-card-anim {
            animation: cardPop 0.7s cubic-bezier(.5, 1.7, .89, .99);
        }

        @keyframes cardPop {
            from {
                opacity: 0;
                transform: scale(.97) translateY(30px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .badge-anim {
            transition: transform .18s, box-shadow .20s;
            cursor: pointer;
        }

        .badge-anim:hover {
            transform: scale(1.09) rotate(-2deg);
            box-shadow: 0 3px 14px #16ffb2a1;
        }

        .btn-back-anim {
            transition: background 0.24s, color 0.18s, transform 0.18s;
        }

        .btn-back-anim:hover,
        .btn-back-anim:focus {
            background: linear-gradient(90deg, #1cb5e0 0%, #000851 100%);
            color: #fff;
            transform: scale(1.04) translateX(-3px);
        }

        .text-gradient {
            background: linear-gradient(90deg, #1cb5e0 0%, #000851 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .table th {
            font-weight: 600;
            vertical-align: middle;
        }

        .table td,
        .table th {
            padding: 0.75rem 0.75rem;
            transition: background .2s;
        }

        .table-borderless td,
        .table-borderless th {
            border: none !important;
        }

        @media (max-width: 767px) {
            .card-body .row>div {
                margin-bottom: 2rem;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Animasi badge jika di klik (pulse)
        document.querySelectorAll('.badge-anim').forEach(function(badge) {
            badge.addEventListener('click', function() {
                badge.style.animation = "badgePulse .5s";
                setTimeout(() => {
                    badge.style.animation = "";
                }, 500);
            });
        });
    </script>
@endsection
