@extends('layouts.app')
@section('title', 'Detail Laporan - Admin')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="fw-bold mb-0">Detail Laporan #{{ $laporan->id }}</h4>
        <small class="text-muted">Dikirim oleh {{ $laporan->nama_pelapor ?? $laporan->user->name ?? 'Anonim' }} pada {{ $laporan->created_at->format('d M Y, H:i') }}</small>
    </div>
</div>

<div class="row">
    <div class="col-md-8">

        {{-- Informasi Laporan --}}
        <div class="card rounded-4 shadow-sm border-0 mb-3">
            <div class="card-header bg-primary text-white px-4 py-3 rounded-top-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-file-text me-2"></i>Informasi Laporan</h6>
            </div>
            <div class="card-body px-4 py-3">
                <table class="table table-borderless mb-0" style="table-layout:fixed; width:100%;">
                    <tr>
                        <td class="text-muted" style="width:160px">Judul</td>
                        <td class="fw-semibold" style="word-wrap:break-word; word-break:break-word;">{{ $laporan->judul }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Pelapor</td>
                        <td style="word-wrap:break-word; word-break:break-word;">
                            <i class="bi bi-person me-1 text-muted"></i>{{ $laporan->nama_pelapor ?? $laporan->user->name ?? 'Anonim' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kategori</td>
                        <td><span class="badge bg-secondary rounded-pill">{{ $laporan->kategori->nama_kategori }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Lokasi</td>
                        <td style="word-wrap:break-word; word-break:break-word;">
                            <i class="bi bi-geo-alt me-1 text-muted"></i>{{ $laporan->lokasi }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal</td>
                        <td><i class="bi bi-calendar3 me-1 text-muted"></i>{{ $laporan->created_at->format('d M Y, H:i') }} WIB</td>
                    </tr>
                    <tr>
                        <td class="text-muted align-top">Deskripsi</td>
                        <td style="word-wrap:break-word; word-break:break-word; white-space:normal;">{{ $laporan->deskripsi }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Foto --}}
        @if($laporan->foto)
        <div class="card rounded-4 shadow-sm border-0">
            <div class="card-header bg-primary text-white px-4 py-3 rounded-top-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-image me-2"></i>Foto Laporan</h6>
            </div>
            <div class="card-body px-4 py-4">
                <img src="{{ asset('storage/' . $laporan->foto) }}"
                     alt="Foto Laporan"
                     class="img-fluid rounded-3 shadow-sm"
                     style="max-height:400px">
            </div>
        </div>
        @else
        <div class="card rounded-4 shadow-sm border-0">
            <div class="card-body text-center py-5 text-muted">
                <i class="bi bi-image fs-1 d-block mb-2"></i>
                Tidak ada foto dilampirkan.
            </div>
        </div>
        @endif

    </div>

    <div class="col-md-4">

        {{-- Status Saat Ini --}}
        <div class="card rounded-4 shadow-sm border-0 mb-3">
            <div class="card-header bg-primary text-white px-4 py-3 rounded-top-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2"></i>Status Saat Ini</h6>
            </div>
            <div class="card-body text-center py-4">
                @if($laporan->status == 'menunggu')
                    <i class="bi bi-hourglass-split text-danger d-block mb-2" style="font-size:2.5rem"></i>
                    <span class="badge bg-danger fs-6 px-3 py-2 rounded-pill">
                        <i class="bi bi-hourglass-split me-1"></i>Menunggu
                    </span>
                    <p class="text-muted small mt-3 mb-0">Laporan sedang menunggu ditinjau.</p>
                @elseif($laporan->status == 'diproses')
                    <i class="bi bi-gear-fill text-warning d-block mb-2" style="font-size:2.5rem"></i>
                    <span class="badge bg-warning text-dark fs-6 px-3 py-2 rounded-pill">
                        <i class="bi bi-gear-fill me-1"></i>Sedang Diproses
                    </span>
                    <p class="text-muted small mt-3 mb-0">Admin sedang menangani laporan ini.</p>
                @else
                    <i class="bi bi-check-circle-fill text-success d-block mb-2" style="font-size:2.5rem"></i>
                    <span class="badge bg-success fs-6 px-3 py-2 rounded-pill">
                        <i class="bi bi-check-circle-fill me-1"></i>Selesai
                    </span>
                    <p class="text-muted small mt-3 mb-0">Masalah telah berhasil diselesaikan.</p>
                @endif
            </div>
        </div>

        {{-- Ubah Status --}}
        <div class="card rounded-4 shadow-sm border-0 mb-3">
            <div class="card-header bg-primary text-white px-4 py-3 rounded-top-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Ubah Status</h6>
            </div>
            <div class="card-body px-4 py-4">
                <form action="{{ route('admin.laporan.status', $laporan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <select name="status" class="form-select form-select-lg rounded-3">
                            <option value="menunggu" {{ $laporan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai"  {{ $laporan->status == 'selesai'  ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100 rounded-3 fw-semibold">
                        <i class="bi bi-check-circle-fill me-1"></i>Simpan Status
                    </button>
                </form>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="card rounded-4 shadow-sm border-0">
            <div class="card-header bg-primary text-white px-4 py-3 rounded-top-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Timeline</h6>
            </div>
            <div class="card-body px-4 py-4">
                <div class="d-flex gap-3 align-items-start mb-3">
                    <div class="rounded-circle bg-success d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width:32px;height:32px">
                        <i class="bi bi-check text-white small"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Laporan Dibuat</div>
                        <div class="text-muted small">{{ $laporan->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
                <div class="d-flex gap-3 align-items-start mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0
                        {{ in_array($laporan->status, ['diproses','selesai']) ? 'bg-success' : 'bg-light border' }}"
                         style="width:32px;height:32px">
                        <i class="bi bi-{{ in_array($laporan->status, ['diproses','selesai']) ? 'check text-white' : 'dash text-muted' }} small"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Sedang Diproses</div>
                        <div class="text-muted small">
                            {{ in_array($laporan->status, ['diproses','selesai']) ? 'Sudah diproses oleh admin' : 'Belum diproses' }}
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-3 align-items-start">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0
                        {{ $laporan->status == 'selesai' ? 'bg-success' : 'bg-light border' }}"
                         style="width:32px;height:32px">
                        <i class="bi bi-{{ $laporan->status == 'selesai' ? 'check text-white' : 'dash text-muted' }} small"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Selesai</div>
                        <div class="text-muted small">
                            {{ $laporan->status == 'selesai' ? 'Masalah telah selesai ditangani' : 'Belum selesai' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection