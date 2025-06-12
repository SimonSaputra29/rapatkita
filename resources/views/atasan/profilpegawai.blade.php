@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 text-primary">
                <i class="fas fa-user-circle mr-2"></i>Profil Pegawai
            </h3>
        </div>
        <div class="card shadow-sm border-12">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 150px; height: 150px;">

                            @if ($user->role === 'pegawai')
                                <i class="fas fa-user fa-4x text-primary" title="Pegawai"></i>
                            @elseif ($user->role === 'atasan')
                                <i class="fas fa-user-tie fa-4x text-success" title="Atasan"></i>
                            @elseif ($user->role === 'admin')
                                <i class="fas fa-user-shield fa-4x text-danger" title="Admin"></i>
                            @else
                                <i class="fas fa-question-circle fa-4x text-secondary" title="Tidak diketahui"></i>
                            @endif
                        </div>
                        <h5 class="mt-3 mb-0">{{ $user->name }}</h5>
                        <span class="badge badge-primary mt-2 px-3 py-1">{{ ucfirst($user->role) }}</span>
                    </div>

                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th width="30%" class="text-muted">Email</th>
                                        <td>
                                            <i class="fas fa-envelope text-primary mr-2"></i>
                                            {{ $user->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">No. WhatsApp</th>
                                        <td>
                                            <i class="fab fa-whatsapp text-success mr-2"></i>
                                            {{ $user->no_wa ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Gaji</th>
                                        <td>
                                            <i class="fas fa-money-bill-wave text-success mr-2"></i>
                                            Rp {{ number_format($user->gaji, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Tanggal Bergabung</th>
                                        <td>
                                            <i class="far fa-calendar-alt text-info mr-2"></i>
                                            {{ \Carbon\Carbon::parse($user->tanggal_bergabung)->translatedFormat('d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Gender</th>
                                        <td>
                                            <i
                                                class="fas fa-{{ $user->gender == 'Laki-laki' ? 'male' : 'female' }} text-info mr-2"></i>
                                            {{ $user->gender }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Umur</th>
                                        <td>
                                            <i class="fas fa-birthday-cake text-warning mr-2"></i>
                                            {{ $user->umur ?? '-' }} tahun
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Jabatan</th>
                                        <td>
                                            <i class="fas fa-briefcase text-secondary mr-2"></i>
                                            {{ $user->jabatan ?? '-' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ route('atasan.permissions.index') }}" class="btn btn-secondary ms-2 px-4 py-2">Kembali</a>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        th {
            font-weight: 500;
        }

        .badge {
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        @media (max-width: 768px) {
            .d-flex {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn {
                margin-top: 1rem;
            }
        }
    </style>
@endsection
