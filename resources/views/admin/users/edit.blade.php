@extends('layouts.app')

@section('content')
<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* Tombol dengan efek hover */
    button.btn-success {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    button.btn-success:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(25, 135, 84, 0.5);
    }

    /* Fokus input */
    input.form-control:focus, select.form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 6px #198754aa;
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

    /* Style link batal */
    a.btn-secondary {
        transition: background-color 0.2s ease, color 0.2s ease;
    }
    a.btn-secondary:hover {
        background-color: #6c757dcc;
        color: white;
        text-decoration: none;
    }
</style>

<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 text-success fw-bold">Edit Pengguna</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="mt-3" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <div class="invalid-feedback animate__animated animate__fadeInDown">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                id="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback animate__animated animate__fadeInDown">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="atasan" {{ old('role', $user->role) == 'atasan' ? 'selected' : '' }}>Atasan</option>
                <option value="pegawai" {{ old('role', $user->role) == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
            </select>
            @error('role')
                <div class="invalid-feedback animate__animated animate__fadeInDown">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password <small class="text-muted">(kosongkan jika tidak ingin ganti)</small></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                id="password" autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback animate__animated animate__fadeInDown">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-success px-4 py-2 fw-semibold">
            <i class="bi bi-save me-2"></i> Update Pengguna
        </button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2 px-4 py-2">Batal</a>
    </form>
</div>
@endsection
