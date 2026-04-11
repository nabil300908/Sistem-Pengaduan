    @extends('layouts.app')
    @section('content')

    <h4 class="fw-bold mb-4">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
    </h4>

    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="card text-white bg-primary bg-opacity-75 text-center p-3 rounded-4 border-0">
                <div class="mb-2"><i class="bi bi-file-earmark-text fs-1"></i></div>
                <h2>{{ $total }}</h2>
                <p class="mb-0">Total Laporan</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card text-white bg-danger bg-opacity-75 text-center p-3 rounded-4 border-0">
                <div class="mb-2"><i class="bi bi-hourglass-split fs-1"></i></div>
                <h2>{{ $menunggu }}</h2>
                <p class="mb-0">Menunggu</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card text-white bg-warning bg-opacity-75 text-center p-3 rounded-4 border-0">
                <div class="mb-2"><i class="bi bi-gear fs-1"></i></div>
                <h2>{{ $diproses }}</h2>
                <p class="mb-0">Diproses</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card text-white bg-success bg-opacity-75 text-center p-3 rounded-4 border-0">
                <div class="mb-2"><i class="bi bi-check-circle fs-1"></i></div>
                <h2>{{ $selesai }}</h2>
                <p class="mb-0">Selesai</p>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.laporan.index') }}" class="btn btn-primary bg-opacity-75 mb-5 rounded-3">
        <i class="bi bi-list-ul me-1"></i> Lihat Semua Laporan
    </a>

    @endsection