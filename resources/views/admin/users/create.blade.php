@extends('layouts.app')

@section('content')
<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* Tombol submit animasi hover */
    button.btn-primary {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    button.btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 123, 255, 0.5);
    }

    /* Fokus input lebih jelas */
    input.form-control:focus, select.form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 6px #0d6efdaa;
        outline: none;
    }

    /* Animasi pesan error */
    .invalid-feedback {
        animation: fadeIn 0.4s ease forwards;
        opacity: 0;
    }
    .is-invalid + .invalid-feedback {
        opacity: 1;
    }
</style>

<div class="container mt-5 animate__animated animate__fadeIn">
    <h2 class="mb-4 text-primary fw-bold">Buat User Baru</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback animate__animated animate__fadeInDown">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback animate__animated animate__fadeInDown">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror"
                required>
            @error('password')
                <div class="invalid-feedback animate__animated animate__fadeInDown">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role"
                class="form-select @error('role') is-invalid @enderror" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="atasan" {{ old('role') == 'atasan' ? 'selected' : '' }}>Atasan</option>
                <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
            </select>
            @error('role')
                <div class="invalid-feedback animate__animated animate__fadeInDown">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">
            <i class="bi bi-plus-circle me-2"></i> Buat User
        </button>
    </form>
</div>
@endsection
