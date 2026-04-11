@extends('layouts.app')
@section('title', 'Daftar Laporan')

@push('styles')
<style>
    @media print {
        nav, .col-md-2, .fixed-bottom, .d-print-none { display: none !important; }
        .col-md-10 { width: 100% !important; padding: 0 !important; }
        .container-fluid > .row { display: block !important; }
        body { background: white !important; }
        .card { border: none !important; box-shadow: none !important; }

        .table-responsive { overflow: visible !important; }
        table { width: 100% !important; table-layout: fixed !important; font-size: 11px !important; }
        table th, table td { word-wrap: break-word !important; overflow-wrap: break-word !important; padding: 6px 4px !important; }

        table th:nth-child(1), table td:nth-child(1) { width: 4% !important; }
        table th:nth-child(2), table td:nth-child(2) { width: 22% !important; }
        table th:nth-child(3), table td:nth-child(3) { width: 13% !important; }
        table th:nth-child(4), table td:nth-child(4) { width: 11% !important; }
        table th:nth-child(5), table td:nth-child(5) { width: 15% !important; }
        table th:nth-child(6), table td:nth-child(6) { width: 13% !important; }
        table th:nth-child(7), table td:nth-child(7) { width: 12% !important; }
    }
</style>
@endpush

@section('content')

{{-- HEADER PRINT --}}
<div class="d-none d-print-block mb-4">
    <div class="text-center pb-3 mb-3 border-bottom">
        <h5 class="fw-bold mb-1">DAFTAR LAPORAN PENGADUAN SARPRAS SEKOLAH</h5>
        <p class="mb-1 small text-muted">
            Periode:
            @if(request('bulan'))
                {{ \Carbon\Carbon::createFromFormat('Y-m', request('bulan'))->locale('id')->isoFormat('MMMM YYYY') }}
            @else
                Semua Periode
            @endif
        </p>
        <p class="mb-0 small text-muted">Dicetak pada: {{ now()->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }} WIB</p>
    </div>
</div>

{{-- JUDUL + TOMBOL --}}
<div class="d-flex justify-content-between align-items-center mb-4 d-print-none">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-clipboard-data-fill me-2 text-primary"></i>Semua Laporan</h4>
        <p class="text-muted mb-0">Kelola dan pantau status laporan pengaduan.</p>
    </div>
    <button onclick="window.print()" class="btn btn-danger btn-sm rounded-3 px-3 fw-semibold">
        <i class="bi bi-file-pdf-fill me-1"></i>Ekspor PDF
    </button>
</div>

{{-- FILTER --}}
<div class="card mb-3 d-print-none">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.laporan.index') }}" class="d-flex gap-2 align-items-center flex-wrap">
            <span class="text-muted small fw-semibold me-1"><i class="bi bi-funnel me-1"></i>Filter:</span>
            <a href="{{ route('admin.laporan.index') }}"
               class="btn btn-sm {{ !request('status') && !request('bulan') && !request('kategori') ? 'btn-primary' : 'btn-outline-secondary' }}">Semua</a>
            <a href="{{ route('admin.laporan.index', array_merge(request()->except('status'), ['status' => 'menunggu'])) }}"
               class="btn btn-sm {{ request('status') == 'menunggu' ? 'btn-danger' : 'btn-outline-danger' }}">
               <i class="bi bi-hourglass-split me-1"></i>Menunggu</a>
            <a href="{{ route('admin.laporan.index', array_merge(request()->except('status'), ['status' => 'diproses'])) }}"
               class="btn btn-sm {{ request('status') == 'diproses' ? 'btn-warning' : 'btn-outline-warning' }}">
               <i class="bi bi-gear-fill me-1"></i>Diproses</a>
            <a href="{{ route('admin.laporan.index', array_merge(request()->except('status'), ['status' => 'selesai'])) }}"
               class="btn btn-sm {{ request('status') == 'selesai' ? 'btn-success' : 'btn-outline-success' }}">
               <i class="bi bi-check-circle-fill me-1"></i>Selesai</a>

            <div class="ms-auto d-flex gap-2 flex-wrap align-items-center">
                {{-- FILTER BULAN --}}
                <div class="d-flex align-items-center gap-1">
                    <label class="text-muted small fw-semibold">
                        <i class="bi bi-calendar3 me-1"></i>Bulan:
                    </label>
                    <input type="month" name="bulan"
                        class="form-control form-control-sm"
                        value="{{ request('bulan') }}"
                        style="width:auto">
                </div>

                <select name="kategori" class="form-select form-select-sm" style="width:auto">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="bi bi-check2 me-1"></i>Terapkan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ALERT PERIODE AKTIF --}}
@if(request('bulan'))
<div class="alert alert-info border-0 rounded-3 d-flex align-items-center gap-2 mb-3 d-print-none">
    <i class="bi bi-calendar3-fill text-info"></i>
    <span class="small">Menampilkan laporan bulan <strong>
        {{ \Carbon\Carbon::createFromFormat('Y-m', request('bulan'))->locale('id')->isoFormat('MMMM YYYY') }}
    </strong></span>
    <a href="{{ route('admin.laporan.index') }}" class="ms-auto btn btn-sm btn-outline-secondary rounded-3">
        <i class="bi bi-x me-1"></i>Reset
    </a>
</div>
@endif

{{-- TABEL --}}
<div class="card mb-5">
    <div class="card-body p-0">
        @if($laporans->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                Tidak ada laporan ditemukan.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Judul</th>
                        <th>Pelapor</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Tanggal Lapor</th>
                        <th>Status</th>
                        <th class="d-print-none">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($laporans as $i => $lap)
                <tr>
                    <td class="ps-4 text-muted">{{ $laporans->firstItem() + $i }}</td>
                    <td>
                        <div class="fw-semibold">{{ $lap->judul }}</div>
                        <small class="text-muted">{{ Str::limit($lap->deskripsi, 40) }}</small>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center flex-shrink-0 d-print-none"
                                 style="width:28px;height:28px">
                                <i class="bi bi-person-fill text-white" style="font-size:12px"></i>
                            </div>
                            <small class="fw-semibold">{{ $lap->nama_pelapor ?? $lap->user->name ?? 'Anonim' }}</small>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-secondary rounded-pill">
                            <i class="bi bi-tag me-1"></i>{{ $lap->kategori->nama_kategori }}
                        </span>
                    </td>
                    <td><small><i class="bi bi-geo-alt me-1 text-muted d-print-none"></i>{{ $lap->lokasi }}</small></td>
                    <td class="text-muted small">{{ $lap->created_at->format('d M Y') }}</td>
                    <td>
                        @if($lap->status == 'menunggu')
                            <span class="badge bg-danger rounded-pill">
                                <i class="bi bi-hourglass-split me-1"></i>Menunggu
                            </span>
                        @elseif($lap->status == 'diproses')
                            <span class="badge bg-warning text-dark rounded-pill">
                                <i class="bi bi-gear-fill me-1"></i>Diproses
                            </span>
                        @else
                            <span class="badge bg-success rounded-pill">
                                <i class="bi bi-check-circle-fill me-1"></i>Selesai
                            </span>
                        @endif
                    </td>
                    <td class="d-print-none">
                        <a href="{{ route('admin.laporan.show', $lap->id) }}"
                           class="btn btn-sm btn-outline-primary rounded-3">
                            <i class="bi bi-eye me-1"></i>Detail
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- FOOTER PRINT --}}
        <div class="d-none d-print-block px-4 py-3 border-top">
            <small class="text-muted">
                Total laporan: {{ $laporans->total() }}
                @if(request('bulan'))
                &nbsp;|&nbsp; Periode: {{ \Carbon\Carbon::createFromFormat('Y-m', request('bulan'))->locale('id')->isoFormat('MMMM YYYY') }}
                @endif
                &nbsp;|&nbsp; Sistem Pengaduan Sarpras Sekolah
            </small>
        </div>

        <div class="px-4 py-3 d-print-none">
            {{ $laporans->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>

@endsection