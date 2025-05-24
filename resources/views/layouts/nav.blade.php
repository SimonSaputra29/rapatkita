<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #1a3e72;">
    <div class="container">
        <a class="navbar-brand fw-bold text-white d-flex align-items-center"
            href="{{ Auth::check() ? (Auth::user()->role === 'admin' ? route('admin.index') : (Auth::user()->role === 'atasan' ? route('atasan.index') : route('pegawai.index'))) : url('/') }}">
            <i class="fas fa-users me-2"></i> Rapat Kita
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: brightness(0) invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fw-semibold px-3 py-2" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-4" style="min-width: 160px;">
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
                        <a class="nav-link text-white fw-semibold px-3 py-2" href="{{ url('/login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    .nav-link:hover,
    .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transition: background-color 0.3s ease;
    }
</style>

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
