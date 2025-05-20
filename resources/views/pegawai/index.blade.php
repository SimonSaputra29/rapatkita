@extends('layouts.app')

@push('styles')
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
    </style>
@endpush

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5 animate__animated animate__fadeInDown">
            <h1 class="display-5 fw-bold text-primary">Dashboard Pegawai</h1>
            <p class="text-muted mb-0"><strong>Selamat datang, Pegawai.</strong></p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-4 animate__animated animate__zoomIn">
                <a href="{{ route('pegawai.permissions.index') }}" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-lg text-center p-4 h-100">
                        <div class="card-body">
                            <i class="bi bi-envelope-paper-fill display-4 text-info mb-3"></i>
                            <h5 class="fw-bold">Pengajuan Rapat</h5>
                            <p class="text-muted">Ajukan undangan rapat baru dengan mudah dan cepat.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
