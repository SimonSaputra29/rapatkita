@extends('layouts.app')

@section('content')
    <!-- Tambahkan Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <div class="container py-5">
        <div class="text-center mb-5 animate__animated animate__fadeInDown">
            <h1 class="display-4 fw-bold text-primary">Dashboard Admin</h1>
            <p class="text-muted"><b>Selamat datang di panel admin.</b></p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-4 animate__animated animate__zoomIn">
                <a href="{{ route('admin.permissions.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg border-0 hover-shadow text-center p-4 h-100">
                        <div class="card-body">
                            <i class="bi bi-envelope-paper-fill display-4 text-info mb-3"></i>
                            <h5 class="card-title fw-bold">Undangan Rapat</h5>
                            <p class="card-text text-muted">Kelola Semua Undangan Rapat.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4 animate__animated animate__zoomIn animate__delay-1s">
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg border-0 hover-shadow text-center p-4 h-100">
                        <div class="card-body">
                            <i class="bi bi-people-fill display-4 text-success mb-3"></i>
                            <h5 class="card-title fw-bold">Manajemen Pengguna</h5>
                            <p class="card-text text-muted">Kelola semua pengguna dan hak akses.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons (jika belum include) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
