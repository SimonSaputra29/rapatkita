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
        }
        .btn-animate:hover {
            animation: none;
            background-color: #205295;
            color: #fff;
        }
        tbody tr:hover {
            background-color: #f4f8fb;
            transition: background-color 0.2s;
        }
        .table thead {
            background: #205295;
            color: #fff;
        }
        .badge {
            font-size: 0.98em;
            padding: 0.5em 1.1em;
        }
        .card-table {
            border: 1px solid #dbe4ee;
            border-radius: 10px;
            box-shadow: 0 2px 6px 0 rgba(32,82,149,0.04);
            background: #fff;
        }
    </style>

    <div class="container py-5">
        <div class="mb-4 text-center formal-header">
            <h2 class="fw-bold" style="color: #205295;">Daftar Pengguna</h2>
            <p class="text-secondary mb-0">Kelola pengguna sistem <strong>Rapat Kita</strong> secara formal & profesional</p>
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
            <table class="table align-middle mb-0" style="min-width: 720px;">
                <thead>
                    <tr>
                        <th scope="col" style="width: 50px;">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col" style="width: 130px;">Role</th>
                        <th scope="col" style="width: 160px;">Dibuat Pada</th>
                        <th scope="col" style="width: 150px;">Aksi</th>
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
                                    @elseif($user->role == 'atasan') bg-warning text-dark
                                    @else bg-info text-white @endif
                                    text-capitalize">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="btn btn-sm btn-outline-primary me-2" title="Edit Pengguna">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline delete-user-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" title="Hapus Pengguna">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted fst-italic">Belum ada pengguna terdaftar.</td>
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
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
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
        });
    </script>
@endsection