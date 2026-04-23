<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Sarpras Sekolah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

{{-- NAVBAR --}}
<nav class="navbar navbar-dark sticky-top shadow-sm bg-primary bg-opacity-75">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('welcome') }}">
            <div class="bg-white rounded-2 d-flex align-items-center justify-content-center"
                 style="width:32px;height:32px;">
                <i class="bi bi-building-fill text-primary"></i>
            </div>
            Sarpras Sekolah
        </a>

        <div class="d-flex gap-2">

            <a href="{{ route('publik.create') }}"
               class="btn btn-warning btn-sm fw-bold rounded-3 px-3">
                <i class="bi bi-plus-circle-fill me-1"></i>
                Buat Laporan
            </a>

            {<form action="{{ route('logout') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit"
        class="btn btn-light btn-sm fw-bold rounded-3 px-3 text-dark"
        onclick="return confirm('Yakin ingin logout?')">
        <i class="bi bi-box-arrow-right me-1"></i>
        Logout
    </button>
</form>

        </div>
    </div>
</nav>

{{-- HERO --}}
<div class="bg-primary bg-opacity-75">
    <div class="container py-4">

        <h4 class="fw-bold text-white mb-1">
            <i class="bi bi-clipboard2-data-fill me-2"></i>
            Dashboard Pengaduan
        </h4>

        <p class="text-white-50 mb-4 small">
            Pantau dan kelola laporan sarana & prasarana sekolah
        </p>

        <div class="row g-3">

            <div class="col-6 col-md-3">
                <div class="rounded-4 p-3 text-white bg-white bg-opacity-10">
                    <i class="bi bi-card-list fs-4 d-block mb-1"></i>
                    <div class="fs-3 fw-bold">{{ $totalSemua }}</div>
                    <small>Total Laporan</small>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="rounded-4 p-3 text-white bg-white bg-opacity-10">
                    <i class="bi bi-hourglass-split fs-4 d-block mb-1"></i>
                    <div class="fs-3 fw-bold">{{ $totalMenunggu }}</div>
                    <small>Menunggu</small>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="rounded-4 p-3 text-white bg-white bg-opacity-10">
                    <i class="bi bi-gear-fill fs-4 d-block mb-1"></i>
                    <div class="fs-3 fw-bold">{{ $totalDiproses }}</div>
                    <small>Diproses</small>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="rounded-4 p-3 text-white bg-white bg-opacity-10">
                    <i class="bi bi-check-circle-fill fs-4 d-block mb-1"></i>
                    <div class="fs-3 fw-bold">{{ $totalSelesai }}</div>
                    <small>Selesai</small>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success rounded-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">

            <h5 class="fw-bold mb-3">
                <i class="bi bi-list-ul me-2 text-primary"></i>
                Daftar Laporan
            </h5>

            @if($laporans->count())

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead class="table-primary">
                        <tr>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($laporans as $lap)
                            <tr>
                                <td>{{ $lap->judul }}</td>
                                <td>{{ $lap->nama_pelapor }}</td>
                                <td>{{ $lap->kategori->nama_kategori }}</td>
                                <td>{{ $lap->lokasi }}</td>

                                <td>
                                    @if($lap->status == 'menunggu')
                                        <span class="badge bg-danger">Menunggu</span>
                                    @elseif($lap->status == 'diproses')
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('publik.show', $lap->id) }}"
                                       class="btn btn-sm btn-primary rounded-3">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="mt-3">
                    {{ $laporans->links() }}
                </div>

            @else

                <div class="text-center py-5 text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                    Belum ada laporan
                </div>

            @endif

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>