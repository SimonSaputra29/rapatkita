<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Title --}}
    {{-- <title>{{ $title }}</title> --}}

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="font-family: 'Poppins', sans-serif;">

    @auth
        @include('layouts.nav')
    @endauth

    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ session('error') }}",
                confirmButtonColor: "#4f46e5"
            });
        </script>
    @endif

    {{-- Login Validation --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.getElementById("loginBtn");
            if (loginBtn) {
                loginBtn.addEventListener("click", function(event) {
                    const email = document.getElementById("email").value.trim();
                    const password = document.getElementById("password").value.trim();

                    if (!email || !password) {
                        event.preventDefault();
                        Swal.fire({
                            icon: "warning",
                            title: "Peringatan!",
                            text: "Email dan password wajib diisi!",
                            confirmButtonColor: "#4f46e5"
                        });
                    }
                });
            }

            const togglePassword = document.getElementById("togglePassword");
            if (togglePassword) {
                togglePassword.addEventListener("click", function() {
                    const passwordField = document.getElementById("password");
                    const eyeIcon = document.getElementById("eyeIcon");

                    if (passwordField.type === "password") {
                        passwordField.type = "text";
                        eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
                    } else {
                        passwordField.type = "password";
                        eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
                    }
                });
            }
        });
    </script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- script expor --}}
    @yield('scripts')

</body>

</html>
