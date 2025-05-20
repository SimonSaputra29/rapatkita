@extends('layouts.app')

@section('content')
    <div class="container mt-5 animate__animated animate__fadeInUp">

        <h1 class="display-4 text-center mb-4 animate__animated animate__fadeInDown">📅 Daftar Rapat</h1>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="alert alert-info shadow animate__animated animate__fadeInLeft">
                    <h5>Total Rapat:</h5>
                    <p class="mb-0 fw-bold">{{ $totalMeetings }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="alert alert-warning shadow animate__animated animate__fadeInDown">
                    <h5>Rapat Terbaru:</h5>
                    <p class="mb-0">
                        {{ $latestMeeting ? $latestMeeting->title : 'Tidak ada rapat.' }}
                        @if ($latestMeeting)
                            <br><small class="text-muted">{{ $latestMeeting->date->format('d-m-Y') }}</small>
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="alert alert-success shadow animate__animated animate__fadeInRight">
                    <h5>Rapat Mendatang:</h5>
                    <p class="mb-0">
                        {{ $upcomingMeeting ? $upcomingMeeting->title : 'Tidak ada rapat mendatang.' }}
                        @if ($upcomingMeeting)
                            <br><small class="text-muted">{{ $upcomingMeeting->date->format('d-m-Y') }}</small>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="text-end mb-3">
            <a href="{{ route('meetings.create') }}"
                class="btn btn-primary rounded-pill shadow animate__animated animate__pulse animate__infinite">
                ➕ Buat Rapat Baru
            </a>
        </div>

        <div class="table-responsive animate__animated animate__fadeInUp animate__delay-1s">
            <table class="table table-hover table-striped table-bordered shadow-sm align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($meetings as $rapat)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $rapat->title }}</td>
                            <td>{{ $rapat->date->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('meetings.pdf', $rapat->id) }}"
                                        class="btn btn-outline-success btn-sm rounded-pill">
                                        <i class="bi bi-file-earmark-pdf"></i> PDF
                                    </a>
                                    <a href="{{ route('meetings.show', $rapat->id) }}"
                                        class="btn btn-outline-info btn-sm rounded-pill">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-pill"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $rapat->id }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>

                                <!-- Modal Konfirmasi Hapus -->
                                <div class="modal fade" id="deleteModal{{ $rapat->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus rapat
                                                <strong>{{ $rapat->title }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('meetings.destroy', $rapat->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada rapat yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endpush
