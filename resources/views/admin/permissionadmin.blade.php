@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Manajemen Undangan Rapat</h2>

    {{-- Filter Status --}}
    <form method="GET" action="{{ route('admin.permissions.index') }}" class="row mb-3">
        <div class="col-md-3">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
    </form>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Tanggal</th>
                    <th>Topik</th>
                    <th>Status</th>
                    <th>Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permissions as $permission)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $permission->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($permission->date)->translatedFormat('d F Y') }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($permission->topic, 30) }}</td>
                        <td>
                            @if($permission->status == 'approved')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($permission->status == 'rejected')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-warning">Menunggu</span>
                            @endif
                        </td>
                        <td>{{ $permission->approver->name ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.permissions.show', $permission->id) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('admin.permissions.export', $permission->id) }}" class="btn btn-sm btn-secondary">Unduh</a>

                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus undangan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data undangan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $permissions->withQueryString()->links() }}
    </div>
</div>
@endsection
