@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: 'Segoe UI', 'Open Sans', Arial, sans-serif;
        }

        .formal-header {
            border-bottom: 2px solid #205295;
            padding-bottom: 12px;
            margin-bottom: 30px;
            animation: fadeInDown 0.6s ease-in-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-table {
            border: 1px solid #dbe4ee;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(32, 82, 149, 0.08);
            background: #fff;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .table thead {
            background-color: #205295;
            color: #fff;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f0f6ff;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.4em 0.8em;
            border-radius: 8px;
        }

        .btn-animate {
            transition: all 0.3s ease-in-out;
        }

        .btn-animate:hover {
            background-color: #17467c;
            color: #fff;
            transform: scale(1.03);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>

    <div class="container py-5 fade-in">
        <div class="text-center formal-header">
            <h2 class="fw-bold" style="color: #205295;">Daftar Pengguna</h2>
            <p class="text-secondary mb-0">Kelola pengguna sistem <strong>Rapat Kita</strong> secara profesional</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-lg shadow-sm btn-animate">
                <i class="bi bi-plus-circle me-2"></i> Tambah Pengguna Baru
            </a>
            <small class="text-muted">Total pengguna: <strong>{{ $users->total() }}</strong></small>
        </div>

        <div class="table-responsive card-table p-3">
            <table class="table table-hover align-middle mb-0" style="min-width: 720px;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Dibuat Pada</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $key }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span
                                    class="badge 
                                @if ($user->role == 'admin') bg-danger 
                                @elseif ($user->role == 'atasan') bg-warning text-dark 
                                @else bg-info text-white @endif
                                text-capitalize">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit Pengguna">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    class="d-inline delete-user-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Pengguna">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted fst-italic">Belum ada pengguna terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin ingin menghapus pengguna ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('form').submit();
                        }
                    });
                });
            });

            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endsection
