@extends('layouts.app')

@push('styles')
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endpush

@section('content')
    <div class="container mt-4 animate__animated animate__fadeIn">
        <div class="card shadow-sm animate__animated animate__fadeInUp animate__delay-1s">
            <div class="card-header bg-primary text-white animate__animated animate__fadeInDown">
                <h4 class="mb-0"><i class="bi bi-envelope-paper"></i> Buat Undangan Rapat Kantor</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('pegawai.permissions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3 animate__animated animate__fadeInLeft animate__delay-1s">
                        <div class="col-md-6">
                            <label for="date" class="form-label">📅 Tanggal Rapat</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="time" class="form-label">⏰ Waktu Rapat</label>
                            <input type="time" name="time" id="time" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3 animate__animated animate__fadeInLeft animate__delay-2s">
                        <label for="location" class="form-label">📍 Tempat Rapat</label>
                        <input type="text" name="location" id="location" class="form-control"
                            placeholder="Contoh: Ruang Rapat Lantai 2" required>
                    </div>

                    <div class="mb-3 animate__animated animate__fadeInLeft animate__delay-2s">
                        <label for="topic" class="form-label">📝 Topik Rapat</label>
                        <textarea name="topic" id="topic" class="form-control" rows="3" required
                            placeholder="Contoh: Evaluasi Kinerja Bulanan"></textarea>
                    </div>

                    <div class="mb-3 animate__animated animate__fadeInLeft animate__delay-2s">
                        <label for="participants" class="form-label">👥 Peserta Rapat</label>
                        <textarea name="participants" id="participants" class="form-control" rows="3" required
                            placeholder="Contoh: Seluruh Tim Marketing, Manajer HR, dll"></textarea>
                    </div>

                    <div class="mb-3 animate__animated animate__fadeInLeft animate__delay-2s">
                        <label for="note" class="form-label">🗒️ Catatan (opsional)</label>
                        <textarea name="note" id="note" class="form-control" rows="2"
                            placeholder="Catatan tambahan jika ada..."></textarea>
                    </div>

                    <div class="d-flex justify-content-between animate__animated animate__fadeInUp animate__delay-3s">
                        <a href="{{ route('pegawai.permissions.index') }}" class="btn btn-outline-secondary">
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
