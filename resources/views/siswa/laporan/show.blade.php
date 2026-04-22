<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Laporan - Sarpras Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark shadow-sm sticky-top bg-primary bg-opacity-75">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('welcome') }}">
            <div class="bg-white rounded-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
                <i class="bi bi-building-fill text-primary" style="font-size:16px"></i>
            </div>
            Sarpras Sekolah
        </a>
        <a href="{{ route('publik.index') }}" class="btn btn-outline-light btn-sm rounded-3">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</nav>

<div class="container py-4 pb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-7">

            @if(session('success'))
                <div class="alert alert-success rounded-3 d-flex align-items-center gap-2 mb-3 border-0 shadow-sm">
                    <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
                </div>
            @endif

            {{-- DETAIL CARD --}}
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
                        <h5 class="fw-bold mb-0">{{ $laporan->judul }}</h5>
                        @if($laporan->status == 'menunggu')
                            <span class="badge bg-danger bg-opacity-75 rounded-pill px-3 py-2">
                                <i class="bi bi-hourglass-split me-1"></i>Menunggu
                            </span>
                        @elseif($laporan->status == 'diproses')
                            <span class="badge bg-warning bg-opacity-75 text-dark rounded-pill px-3 py-2">
                                <i class="bi bi-gear-fill me-1"></i>Diproses
                            </span>
                        @else
                            <span class="badge bg-success bg-opacity-75 rounded-pill px-3 py-2">
                                <i class="bi bi-check-circle-fill me-1"></i>Selesai
                            </span>
                        @endif
                    </div>

                    <table class="table table-borderless small mb-0" style="table-layout:fixed; width:100%;">
                        <tr>
                            <td class="text-muted ps-0" style="width:35%">
                                <i class="bi bi-person me-1"></i>Pelapor
                            </td>
                            <td class="fw-semibold" style="word-wrap:break-word; word-break:break-word; white-space:normal;">
                                {{ $laporan->nama_pelapor }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">
                                <i class="bi bi-tag me-1"></i>Kategori
                            </td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">
                                    {{ $laporan->kategori->nama_kategori }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">
                                <i class="bi bi-geo-alt me-1"></i>Lokasi
                            </td>
                            <td style="word-wrap:break-word; word-break:break-word; white-space:normal;">
                                {{ $laporan->lokasi }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">
                                <i class="bi bi-calendar3 me-1"></i>Tanggal
                            </td>
                            <td>{{ $laporan->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0 align-top">
                                <i class="bi bi-chat-left-text me-1"></i>Deskripsi
                            </td>
                            <td style="word-wrap:break-word; word-break:break-word; white-space:normal; max-width:0;">
                                {{ $laporan->deskripsi }}
                            </td>
                        </tr>
                    </table>

                    {{-- TOMBOL EDIT/HAPUS --}}
                    @if($laporan->status != 'selesai')
<div id="actions-{{ $laporan->id }}" class="d-none mt-3 d-flex gap-2">

    <a href="{{ route('publik.edit', $laporan->id) }}"
       class="btn btn-warning btn-sm rounded-3 fw-semibold">
        <i class="bi bi-pencil-fill me-1"></i>Edit
    </a>

    <form action="{{ route('publik.destroy', $laporan->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin hapus laporan ini?')">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger btn-sm rounded-3 fw-semibold">
            <i class="bi bi-trash-fill me-1"></i>Hapus
        </button>
    </form>

</div>
@endif

            {{-- FOTO --}}
            @if($laporan->foto)
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-image me-2 text-primary"></i>Foto Laporan
                    </h6>
                    <img src="{{ asset('storage/' . $laporan->foto) }}"
                         class="img-fluid rounded-3 w-100"
                         alt="Foto Laporan">
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const myLaporans = JSON.parse(localStorage.getItem('my_laporans') || '[]');
    const id = {{ $laporan->id }};
    if (myLaporans.includes(id)) {
        const el = document.getElementById('actions-' + id);
        if (el) el.classList.remove('d-none');
    }
</script>
</body>
</html>