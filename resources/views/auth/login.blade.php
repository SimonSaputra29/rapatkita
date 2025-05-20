@extends('layouts.app')

@section('content')
    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            width: 380px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
            padding: 30px 25px;
        }

        .login-card h3 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            color: #333;
            letter-spacing: 1.5px;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 8px rgba(37, 117, 252, 0.6);
            transition: all 0.3s ease;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #757575;
            pointer-events: none;
            font-size: 18px;
        }

        .input-icon input {
            padding-left: 38px;
        }

        .btn-primary {
            background-color: #2575fc;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #6a11cb;
        }

        .form-check-label {
            user-select: none;
        }

        .alert {
            font-size: 14px;
        }

        .forgot-link {
            color: #2575fc;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #6a11cb;
            text-decoration: underline;
        }
    </style>

    <div class="container">
        <div class="login-card animate__animated animate__fadeInDown">
            <h3>Masuk ke Akun Anda</h3>

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3 input-icon">
                    <i class="bi bi-envelope-fill"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autofocus placeholder="Email Anda">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 input-icon">
                    <i class="bi bi-lock-fill"></i>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required placeholder="Password Anda">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Masuk
                    </button>
                </div>

                <div class="mt-3 text-center">
                    {{-- <a href="{{ route('password.request') }}" class="forgot-link">Lupa Password?</a> --}}
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
