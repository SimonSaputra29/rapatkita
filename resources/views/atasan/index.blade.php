@extends('layouts.app')

@section('content')
    <!-- Tambahkan Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .hover-animate:hover {
            animation: pulse 1s infinite;
        }
    </style>

    <div class="container py-5">
        <div class="text-center mb-5 animate__animated animate__fadeInDown animate__faster">
            <h1 class="display-4 fw-bold text-primary">Dashboard Atasan</h1>
            <p class="text-muted animate__animated animate__fadeInUp animate__delay-1s"><b>Selamat datang Atasan.</b></p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-4 animate__animated animate__zoomIn animate__delay-1s">
                <a href="{{ route('atasan.permissions.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg border-0 text-center p-4 h-100 hover-animate">
                        <div class="card-body">
                            <i
                                class="bi bi-envelope-paper-fill display-4 text-info mb-3 animate__animated animate__bounceIn animate__delay-2s"></i>
                            <h5 class="card-title fw-bold">Lihat Pengajuan Rapat</h5>
                            <p class="card-text text-muted">Lihat Pengajuan Undangan Rapat.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
