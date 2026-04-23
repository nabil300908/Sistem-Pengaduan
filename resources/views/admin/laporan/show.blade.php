@extends('layouts.app')
@section('title', 'Detail Laporan - Admin')

@section('content')

<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-outline-secondary rounded-3">
        <i class="bi bi-arrow-left"></i>
    </a>

    <div>
        <h4 class="fw-bold mb-0">Detail Laporan #{{ $laporan->id }}</h4>
        <small class="text-muted">
            Dikirim oleh {{ $laporan->nama_pelapor ?? 'Anonim' }}
            pada {{ $laporan->created_at->format('d M Y, H:i') }}
        </small>
    </div>
</div>

<div class="row">
    <div class="col-md-8">

        <div class="card rounded-4 shadow-sm border-0 mb-3">
            <div class="card-header bg-primary text-white px-4 py-3 rounded-top-4">
                <h6 class="fw-bold mb-0">
                    <i class="bi bi-file-text me-2"></i>Informasi Laporan
                </h6>
            </div>

            <div class="card-body px-4 py-3">
                <table class="table table-borderless mb-0">

                    <tr>
                        <td class="text-muted" width="160">Judul</td>
                        <td class="fw-semibold">{{ $laporan->judul }}</td>
                    </tr>

                    <tr>
                        <td class="text-muted">Pelapor</td>
                        <td>
                            <i class="bi bi-person me-1 text-muted"></i>
                            {{ $laporan->nama_pelapor ?? 'Anonim' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted">Kategori</td>
                        <td>
                            <span class="badge bg-secondary rounded-pill">
                                {{ $laporan->kategori->nama_kategori }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted">Lokasi</td>
                        <td>
                            <i class="bi bi-geo-alt me-1 text-muted"></i>
                            {{ $laporan->lokasi }}
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted">Tanggal</td>
                        <td>
                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                            {{ $laporan->created_at->format('d M Y, H:i') }} WIB
                        </td>
                    </tr>

                    <tr>
                        <td class="text-muted align-top">Deskripsi</td>
                        <td>{{ $laporan->deskripsi }}</td>
                    </tr>

                </table>
            </div>
        </div>

        @if($laporan->foto)
        <div class="card rounded-4 shadow-sm border-0">
            <div class="card-header bg-primary text-white px-4 py-3 rounded-top-4">
                <h6 class="fw-bold mb-0">
                    <i class="bi bi-image me-2"></i>Foto Laporan
                </h6>
            </div>

            <div class="card-body px-4 py-4">
                <img src="{{ asset('storage/' . $laporan->foto) }}"
                     class="img-fluid rounded-3 shadow-sm"
                     style="max-height:400px">
            </div>
        </div>
        @endif

    </div>

    <div class="col-md-4">

        <div class="card rounded-4 shadow-sm border-0 mb-3">
            <div class="card-header bg-primary text-white px-4 py-3 rounded-top-4">
                <h6 class="fw-bold mb-0">
                    <i class="bi bi-info-circle me-2"></i>Status Saat Ini
                </h6>
            </div>

            <div class="card-body text-center py-4">

                @if($laporan->status == 'menunggu')
                    <span class="badge bg-danger px-3 py-2 rounded-pill">Menunggu</span>
                @elseif($laporan->status == 'diproses')
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Diproses</span>
                @else
                    <span class="badge bg-success px-3 py-2 rounded-pill">Selesai</span>
                @endif

            </div>
        </div>

        <div class="card rounded-4 shadow-sm border-0">
            <div class="card-header bg-primary text-white px-4 py-3 rounded-top-4">
                <h6 class="fw-bold mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Ubah Status
                </h6>
            </div>

            <div class="card-body px-4 py-4">
                <form action="{{ route('admin.laporan.status', $laporan->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <select name="status" class="form-select rounded-3">
                            <option value="menunggu" {{ $laporan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100 rounded-3">
                        Simpan Status
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection