{{-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-white"
            href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('admin.index') : (Auth::user()->role === 'atasan' ? route('atasan.index') : route('pegawai.index'))) : url('/') }}">
            Rapat Kita
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-4">
                            <li>
                                <a class="dropdown-item text-danger fw-semibold" href="#" onclick="confirmLogout()">
                                    <i class="fas fa-sign-out-alt me-1"></i> Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold" href="{{ url('/login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin mau keluar??',
            text: 'Kamu akan keluar dari akun ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Keluar',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Keluarr ...',
                    text: 'Tunggu sebentar ya.',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        setTimeout(() => {
                            document.getElementById('logout-form').submit();
                        }, 1000);
                    }
                });
            }
        });
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
    }

    .navbar {
        background-color: #0275d8;
        padding: 15px 20px;
    }

    .navbar-brand {
        font-size: 1.5rem;
        color: #fff !important;
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        filter: brightness(0) invert(1);
    }

    .dropdown-menu {
        border-radius: 8px;
    }

    .nav-link {
        transition: color 0.2s ease-in-out;
    }

    .nav-link:hover {
        color: #fff !important;
        text-decoration: underline;
    }

    .btn {
        transition: all 0.3s ease-in-out;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    /* Media Query untuk responsif di layar kecil */
    @media (max-width: 991px) {
        .navbar-brand {
            font-size: 1.2rem;
            /* Ukuran font lebih kecil di layar mobile */
        }

        .navbar-toggler {
            background-color: #0275d8;
        }

        .dropdown-menu {
            width: 100%;
            /* Dropdown melebar di layar kecil */
        }

        .nav-link {
            padding: 10px;
            font-size: 0.9rem;
            /* Ukuran font sedikit lebih kecil */
        }
    }
</style> --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark-gradient shadow-lg py-3 sticky-top animate__animated animate__fadeInDown">
    <div class="container">
        <a class="navbar-brand fw-bold text-brand-glow"
            href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('admin.index') : (Auth::user()->role === 'atasan' ? route('atasan.index') : route('pegawai.index'))) : url('/') }}">
            <i class="fas fa-users me-2"></i>Rapat Kita
        </a>
        <button class="navbar-toggler nav-toggler-anim" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse animate__animated animate__fadeInRight" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item dropdown nav-link-anim">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=1cb5e0&background=232946"
                                alt="avatar" class="rounded-circle me-2 avatar-anim" width="32" height="32">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow animate__animated animate__fadeInUp bg-dark-menu">
                            <li>
                                <a class="dropdown-item text-danger fw-semibold" href="#" onclick="confirmLogout()">
                                    <i class="fas fa-sign-out-alt me-1"></i> Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item nav-link-anim">
                        <a class="nav-link fw-semibold" href="{{ url('/login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<script>
    function confirmLogout() {
        Swal.fire({
            background: "#232946",
            color: "#f4faff",
            title: 'Yakin mau keluar?',
            text: 'Kamu akan keluar dari akun ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Keluar',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#b8c1ec',
            cancelButtonColor: '#393a54',
            customClass: {
                popup: 'rounded-4 animate__animated animate__bounceIn'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    background: "#232946",
                    color: "#f4faff",
                    title: 'Keluar...',
                    text: 'Tunggu sebentar ya.',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'rounded-4 animate__animated animate__fadeIn'
                    },
                    didOpen: () => {
                        Swal.showLoading();
                        setTimeout(() => {
                            document.getElementById('logout-form').submit();
                        }, 1000);
                    }
                });
            }
        });
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap');

    body {
        font-family: 'Montserrat', 'Poppins', sans-serif;
        background: #17181f;
        color: #f4faff;
    }

    /* Gradient dark background */
    .bg-dark-gradient {
        background: linear-gradient(90deg, #232946 0%, #16161a 100%) !important;
    }
    .bg-dark-menu {
        background: #16161a !important;
        color: #f4faff !important;
    }

    .navbar .navbar-brand, .navbar .nav-link, .navbar .dropdown-item {
        color: #f4faff !important;
    }

    .navbar .nav-link {
        position: relative;
        transition: color 0.18s, background 0.15s, box-shadow .2s;
        z-index: 1;
        overflow: hidden;
        border-radius: .7em;
    }

    .navbar .nav-link.active, .navbar .nav-link:focus, .navbar .nav-link:hover {
        color: #b8c1ec !important;
        background: linear-gradient(90deg, #393a54 0%, #232946 100%);
        box-shadow: 0 2px 15px #393a5433;
        transition: all .18s cubic-bezier(.4,2,.3,1);
    }

    .nav-link-anim .nav-link::after {
        content: "";
        display: block;
        position: absolute;
        left: 10%;
        right: 10%;
        bottom: 7px;
        height: 3px;
        border-radius: 2px;
        background: linear-gradient(90deg, #b8c1ec 0%, #232946 100%);
        opacity: 0;
        transform: scaleX(0);
        transition: transform .28s cubic-bezier(.4,2,.3,1), opacity .22s;
    }
    .nav-link-anim .nav-link.active::after,
    .nav-link-anim .nav-link:hover::after {
        opacity: 1;
        transform: scaleX(1);
    }

    .navbar .dropdown-menu {
        border-radius: 1.2em;
        padding: 0.6em 0.2em;
        min-width: 170px;
        border: none;
        background: #16161a;
        color: #f4faff;
    }
    .navbar .dropdown-item {
        color: #f4faff !important;
        border-radius: .6em;
        transition: background .2s, color .2s;
    }
    .navbar .dropdown-item:active, .navbar .dropdown-item:hover {
        background: #232946 !important;
        color: #b8c1ec !important;
    }
    .avatar-anim {
        box-shadow: 0 2px 10px #393a5485;
        transition: transform .15s, box-shadow .22s;
    }
    .navbar .nav-link:active .avatar-anim,
    .navbar .nav-link:hover .avatar-anim {
        transform: scale(1.11) rotate(-2deg);
        box-shadow: 0 4px 24px #b8c1ec99;
    }
    .navbar-toggler.nav-toggler-anim {
        transition: box-shadow .18s, transform .19s;
    }
    .navbar-toggler.nav-toggler-anim:focus, .navbar-toggler.nav-toggler-anim:hover {
        box-shadow: 0 2px 18px #393a54cc;
        transform: scale(1.10);
    }
    .text-brand-glow {
        background: linear-gradient(90deg, #b8c1ec 0%, #f4faff 50%, #232946 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 2px 16px #b8c1ec44, 0 1px 2px #0005;
        letter-spacing: 1.2px;
        font-size: 1.3em;
        transition: text-shadow .3s;
    }
    .text-brand-glow:hover {
        text-shadow: 0 4px 32px #b8c1ec, 0 1px 2px #0008;
    }
    @media (max-width: 991px) {
        .navbar .dropdown-menu {
            margin-top: .5em;
        }
        .navbar-brand {
            font-size: 1.05em;
        }
    }
    @media (max-width: 600px) {
        .navbar-brand {
            font-size: .95em;
        }
    }
</style>