
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sarpras Sekolah - Sistem Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top bg-primary bg-opacity-75">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="#">
            <div class="bg-white rounded-2 d-flex align-items-center justify-content-center"
                style="width:32px;height:32px;">
                <i class="bi bi-building-fill text-primary" style="font-size:16px"></i>
            </div>
            Sarpras Sekolah
        </a>
        <div class="ms-auto d-flex gap-2">

    {{-- TAMBAHAN LOGIN --}}
    <a href="{{ route('login') }}" class="btn btn-warning btn-sm px-4 rounded-3 fw-semibold">
        <i class="bi bi-box-arrow-in-right me-1"></i>Login
    </a>

    {{-- TAMBAHAN REGISTER --}}
    <a href="{{ route('register') }}" class="btn btn-light btn-sm px-4 rounded-3 fw-semibold">
    <i class="bi bi-person-plus-fill me-1"></i>Daftar
</a>

</div>
    </div>
</nav>

{{-- HERO --}}
<section class="bg-primary bg-opacity-75 d-flex align-items-center" style="min-height:88vh">
    <div class="container py-5">
        <div class="row justify-content-start">
            <div class="col-lg-7 text-white">
                <span class="badge bg-white text-primary rounded-pill px-3 py-2 mb-4 fw-semibold">
                    <i class="bi bi-star-fill me-1"></i>Sistem Informasi Sekolah
                </span>
                <h1 class="display-3 fw-bold lh-sm mb-4">
                    Sistem Pengaduan<br>
                    <span class="text-warning">Sarana & Prasarana</span><br>
                    Sekolah
                </h1>
                <p class="fs-5 text-white-50 mb-5" style="max-width:520px">
                    Laporkan kerusakan fasilitas sekolah dengan mudah dan pantau
                    progres perbaikannya secara transparan.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('publik.index') }}"
                        class="btn btn-warning bg-opacity-75 btn-lg rounded-3 px-5 fw-semibold shadow">
                        <i class="bi bi-pencil-square me-2"></i>Buat Laporan Sekarang
                    </a>
                    <a href="{{ route('publik.index') }}"
                        class="btn btn-outline-light btn-lg rounded-3 px-5">
                        <i class="bi bi-list-ul me-2"></i>Lihat Laporan
                    </a>
                </div>

                {{-- Stats --}}
                <div class="d-flex gap-3 flex-wrap mt-5">
                    <div class="px-4 py-3 rounded-4 bg-white bg-opacity-10">
                        <div class="fs-3 fw-bold text-warning">100%</div>
                        <small class="text-white-50">Berbasis Web</small>
                    </div>
                    <div class="px-4 py-3 rounded-4 bg-white bg-opacity-10">
                        <div class="fs-3 fw-bold text-warning">3</div>
                        <small class="text-white-50">Tahap Status</small>
                    </div>
                    <div class="px-4 py-3 rounded-4 bg-white bg-opacity-10">
                        <div class="fs-3 fw-bold text-warning">4</div>
                        <small class="text-white-50">Kategori Laporan</small>
                    </div>
                    <div class="px-4 py-3 rounded-4 bg-white bg-opacity-10">
                        <div class="fs-3 fw-bold text-warning">Cepat</div>
                        <small class="text-white-50">Pantau Status</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FITUR --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3">Fitur Unggulan</span>
            <h2 class="fw-bold">Kenapa Menggunakan Sistem Ini?</h2>
            <p class="text-muted">Solusi digital untuk pengelolaan pengaduan fasilitas sekolah</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-2">
                    <div class="card-body p-4 text-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-4"
                            style="width:64px;height:64px">
                            <i class="bi bi-send-fill text-primary fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Mudah Melapor</h5>
                        <p class="text-muted mb-0">Siapapun dapat membuat laporan kapan saja tanpa perlu login, cukup isi form sederhana dan lampirkan foto kerusakan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-2">
                    <div class="card-body p-4 text-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-4"
                            style="width:64px;height:64px">
                            <i class="bi bi-eye-fill text-warning fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Pantau Status</h5>
                        <p class="text-muted mb-0">Lacak perkembangan laporan secara real-time mulai dari Menunggu, Diproses, hingga Selesai.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-2">
                    <div class="card-body p-4 text-center">
                        <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-4"
                            style="width:64px;height:64px">
                            <i class="bi bi-diagram-3-fill text-success fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Terkelola Baik</h5>
                        <p class="text-muted mb-0">Admin dapat mengelola semua laporan, memfilter berdasarkan status dan kategori, serta memperbarui progres.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ALUR --}}
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3">Cara Kerja</span>
            <h2 class="fw-bold">Alur Pengaduan Sederhana</h2>
            <p class="text-muted">Hanya 3 langkah mudah untuk menyelesaikan masalah fasilitas</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="rounded-circle bg-primary bg-opacity-75 d-flex align-items-center justify-content-center mx-auto mb-3"
                    style="width:64px;height:64px">
                    <span class="text-white fw-bold fs-4">1</span>
                </div>
                <h5 class="fw-bold">Buat Laporan</h5>
                <p class="text-muted">Isi form laporan kerusakan lengkap dengan nama, foto, dan lokasi tanpa perlu login.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="rounded-circle bg-warning bg-opacity-75 d-flex align-items-center justify-content-center mx-auto mb-3"
                    style="width:64px;height:64px">
                    <span class="text-white fw-bold fs-4">2</span>
                </div>
                <h5 class="fw-bold">Admin Proses</h5>
                <p class="text-muted">Admin meninjau laporan dan mengubah status menjadi Diproses saat sedang ditangani.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="rounded-circle bg-success bg-opacity-75 d-flex align-items-center justify-content-center mx-auto mb-3"
                    style="width:64px;height:64px">
                    <span class="text-white fw-bold fs-4">3</span>
                </div>
                <h5 class="fw-bold">Selesai</h5>
                <p class="text-muted">Setelah diperbaiki, admin mengubah status menjadi Selesai dan bisa dilihat semua orang.</p>
            </div>
        </div>
    </div>
</section>

{{-- SARAN --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3">Saran & Masukan</span>
            <h2 class="fw-bold">Punya Saran untuk Kami?</h2>
            <p class="text-muted">Sampaikan saran kamu untuk membantu pengembangan sistem ini.</p>
        </div>

        @if(session('success_saran'))
        <div class="alert alert-success border-0 rounded-3 shadow-sm d-flex align-items-center gap-2 mb-4 col-lg-6 mx-auto">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
            <span class="fw-semibold">{{ session('success_saran') }}</span>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <form action="{{ route('saran.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Nama</label>
                                <input type="text" name="nama"
                                       class="form-control form-control-lg rounded-3 @error('nama') is-invalid @enderror"
                                       placeholder="Nama kamu"
                                       value="{{ old('nama') }}" required>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Saran</label>
                                <textarea name="isi_saran" rows="4" maxlength="500"
                                          class="form-control form-control-lg rounded-3 @error('isi_saran') is-invalid @enderror"
                                          placeholder="Tulis saran kamu di sini..." required>{{ old('isi_saran') }}</textarea>
                                @error('isi_saran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary bg-opacity-75 btn-lg rounded-3 fw-bold w-100">
                                <i class="bi bi-send-fill me-2"></i>Kirim Saran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-5 bg-primary bg-opacity-75">
    <div class="container py-4 text-center text-white">
        <h2 class="fw-bold mb-3">Siap Melaporkan Kerusakan?</h2>
        <p class="text-white-50 mb-4 fs-5">Laporkan sekarang dan bantu jaga fasilitas sekolah kita bersama.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('publik.index') }}"
               class="btn btn-warning bg-opacity-75 btn-lg rounded-3 px-5 fw-semibold shadow">
                <i class="bi bi-pencil-square me-2"></i>Buat Laporan Sekarang
            </a>
            <a href="{{ route('publik.index') }}" class="btn btn-outline-light btn-lg rounded-3 px-5">
                <i class="bi bi-list-ul me-2"></i>Lihat Laporan
            </a>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="bg-dark bg-opacity-75 py-4">
    <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
            <div class="bg-primary bg-opacity-75 rounded-2 d-flex align-items-center justify-content-center"
                 style="width:28px;height:28px;">
                <i class="bi bi-building-fill text-white" style="font-size:13px"></i>
            </div>
            <span class="text-white fw-bold">Sarpras Sekolah</span>
        </div>
        <small class="text-white-50">© {{ date('Y') }} Sistem Informasi Pengaduan Sarana & Prasarana Sekolah.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
