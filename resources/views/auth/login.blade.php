<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rapat Kita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #e0f7fa, #ffffff);
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 60px rgba(0, 0, 0, 0.15);
            max-width: 1000px;
            width: 100%;
            display: flex;
            overflow: hidden;
        }

        .login-image {
            background-image: url('https://img.freepik.com/free-vector/colleagues-working-project-together_52683-28612.jpg?w=740&t=st=1716464403~exp=1716465003~hmac=c6a3c9b5e8c218186d6542444c888b51e4f1b0df302fe7ed3f1b22f2ec25b878');
            background-size: cover;
            background-position: center;
            width: 50%;
        }

        .login-form {
            padding: 40px;
            width: 50%;
        }

        .login-form h2 {
            font-weight: bold;
            color: #0077b6;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0077b6;
        }

        .btn-primary {
            background-color: #0077b6;
            border: none;
        }

        .btn-primary:hover {
            background-color: #005f87;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                height: auto;
            }

            .login-image {
                width: 100%;
                height: 200px;
            }

            .login-form {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="login-container animate__animated animate__fadeInDown">
        <div class="login-image d-none d-md-block"></div>
        <div class="login-form">
            <h2 class="mb-4">Selamat Datang di <span style="color:#023e8a;">Rapat Kita</span></h2>
            <p class="text-muted mb-4">Silakan login untuk mulai mengelola undangan dan notulensi rapat Anda.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="you@example.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••"
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-100">🔐 Masuk</button>

                <div class="mt-3 text-center">
                    {{-- <small class="text-muted">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></small> --}}
                </div>
            </form>
        </div>
    </div>
</body>

</html>
