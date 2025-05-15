@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-envelope-paper"></i> Buat Undangan Rapat Kantor</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date" class="form-label">📅 Tanggal Rapat</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="time" class="form-label">⏰ Waktu Rapat</label>
                        <input type="time" name="time" id="time" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">📍 Tempat Rapat</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="Contoh: Ruang Rapat Lantai 2" required>
                </div>

                <div class="mb-3">
                    <label for="topic" class="form-label">📝 Topik Rapat</label>
                    <textarea name="topic" id="topic" class="form-control" rows="3" required placeholder="Contoh: Evaluasi Kinerja Bulanan"></textarea>
                </div>

                <div class="mb-3">
                    <label for="participants" class="form-label">👥 Peserta Rapat</label>
                    <textarea name="participants" id="participants" class="form-control" rows="3" required placeholder="Contoh: Seluruh Tim Marketing, Manajer HR, dll"></textarea>
                </div>

                {{-- 
                <div class="mb-3">
                    <label for="attachment" class="form-label">📎 Lampiran Tambahan (opsional)</label>
                    <input type="file" name="attachment" id="attachment" class="form-control">
                </div>
                --}}

                <div class="mb-3">
                    <label for="note" class="form-label">🗒️ Catatan (opsional)</label>
                    <textarea name="note" id="note" class="form-control" rows="2" placeholder="Catatan tambahan jika ada..."></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send-check"></i> Kirim Undangan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
