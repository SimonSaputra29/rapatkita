@extends('layouts.app')

@section('content')
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 16px;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(32, 82, 149, 0.1);
        }

        .dashboard-icon {
            font-size: 3.5rem;
        }

        .bg-light-blue {
            background-color: #eaf2fb;
        }
    </style>

    <div class="container py-5">
        <div class="text-center mb-5 animate__animated animate__fadeInDown">
            <h1 class="fw-bold text-primary display-5">Selamat Datang, Admin!</h1>
            <p class="text-muted fs-5">Kelola sistem <strong>Rapat Kita</strong> dengan mudah & efisien.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-5 col-lg-4 animate__animated animate__fadeInUp">
                <a href="{{ route('admin.permissions.index') }}" class="text-decoration-none">
                    <div class="card dashboard-card shadow-sm bg-light-blue text-center p-4 h-100">
                        <div class="card-body">
                            <i class="bi bi-envelope-paper-fill text-primary dashboard-icon mb-3"></i>
                            <h5 class="fw-semibold text-dark">Kelola Undangan</h5>
                            <p class="text-secondary mb-0">Buat dan arsipkan undangan rapat dengan cepat.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-5 col-lg-4 animate__animated animate__fadeInUp animate__delay-1s">
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                    <div class="card dashboard-card shadow-sm bg-light-blue text-center p-4 h-100">
                        <div class="card-body">
                            <i class="bi bi-people-fill text-success dashboard-icon mb-3"></i>
                            <h5 class="fw-semibold text-dark">Manajemen Pengguna</h5>
                            <p class="text-secondary mb-0">Atur akun, peran & akses pengguna dengan mudah.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
