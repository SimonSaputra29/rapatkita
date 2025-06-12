@extends('layouts.app')

@push('styles')
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
@endpush

@section('content')
    <div class="container mt-4 animate__animated animate__fadeIn">
        <div class="card shadow-sm animate__animated animate__fadeInUp animate__delay-1s mb-4">
            <div class="card-header bg-primary text-white animate__animated animate__fadeInDown">
                <h4 class="mb-0">
                    <i class="bi bi-envelope-paper"></i> Buat Undangan Rapat Kantor
                </h4>
            </div>

            <div class="card-body">
                <form action="{{ route('atasan.permissions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3 animate__animated animate__fadeInLeft animate__delay-1s">
                        <div class="col-md-6">
                            <label for="date" class="form-label">📅 Tanggal Rapat</label>
                            <input type="date" name="date" id="date"
                                class="form-control @error('date') is-invalid @enderror" required min="{{ date('Y-m-d') }}"
                                value="{{ old('date') }}" aria-describedby="dateHelp">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small id="dateHelp" class="form-text text-muted">Pilih tanggal rapat (hari ini atau
                                setelahnya)</small>
                        </div>

                        <div class="col-md-6">
                            <label for="time" class="form-label">⏰ Waktu Rapat</label>
                            <input type="time" name="time" id="time"
                                class="form-control @error('time') is-invalid @enderror" required min="09:00"
                                max="18:00" value="{{ old('time') }}" aria-describedby="timeHelp">
                            @error('time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small id="timeHelp" class="form-text text-muted">Waktu rapat antara pukul 09:00 sampai
                                18:00</small>
                        </div>
                    </div>

                    <div class="mb-3 animate__animated animate__fadeInLeft animate__delay-2s">
                        <label for="location" class="form-label">📍 Tempat Rapat</label>
                        <input type="text" name="location" id="location"
                            class="form-control @error('location') is-invalid @enderror" placeholder="Contoh: Ruang RPS 2"
                            required value="{{ old('location') }}">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 animate__animated animate__fadeInLeft animate__delay-2s">
                        <label for="topic" class="form-label">📝 Topik Rapat</label>
                        <textarea name="topic" id="topic" class="form-control @error('topic') is-invalid @enderror" rows="3"
                            placeholder="Contoh: Bootcamp Rekayasa Perangkat Lunak" required>{{ old('topic') }}</textarea>
                        @error('topic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 animate__animated animate__fadeInLeft animate__delay-2s">
                        <label for="participants" class="form-label">👥 Peserta Rapat</label>
                        <textarea name="participants" id="participants" class="form-control @error('participants') is-invalid @enderror"
                            rows="3" placeholder="Contoh: Seluruh Guru, Siswa, dll" required>{{ old('participants') }}</textarea>
                        @error('participants')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 animate__animated animate__fadeInLeft animate__delay-2s">
                        <label for="note" class="form-label">🗒️ Catatan (opsional)</label>
                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" rows="2"
                            placeholder="Catatan tambahan jika ada...">{{ old('note') }}</textarea>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-4">
                        <a href="{{ route('atasan.permissions.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                        </a>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" name="action" value="draft" class="btn btn-secondary">
                                <i class="bi bi-file-earmark-arrow-down me-1"></i> Simpan sebagai Arsip
                            </button>

                            <button type="submit" name="action" value="submit" class="btn btn-success">
                                <i class="bi bi-send-check me-1"></i> Ajukan Surat
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('#participants');
        const tagify = new Tagify(input, {
            whitelist: @json($userList),
            dropdown: {
                maxItems: 10,
                enabled: 0,
                classname: "participants-suggestions",
                closeOnSelect: false
            }
        });
    });
</script>