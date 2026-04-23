<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Laporan - Sarpras Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark shadow-sm sticky-top bg-primary bg-opacity-75">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('publik.index') }}">
            <div class="bg-white rounded-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
                <i class="bi bi-building-fill text-primary" style="font-size:16px"></i>
            </div>
            Sarpras Sekolah
        </a>
        <a href="{{ route('publik.index') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">

            <div class="mb-4">
                <h3 class="fw-bold mb-1">Buat Laporan</h3>
                <p class="text-muted mb-0">Lengkapi informasi di bawah untuk melaporkan kerusakan fasilitas sekolah.</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('publik.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- NAMA OTOMATIS --}}
<div class="mb-4">
    <label class="form-label fw-semibold small text-uppercase text-muted">Nama Pelapor</label>
    <div class="input-group input-group-lg">
        <span class="input-group-text border-end-0 bg-white">
            <i class="bi bi-person-check text-primary"></i>
        </span>
        <input type="text" class="form-control border-start-0 ps-0 bg-light"
               value="{{ session('user_name') }}" disabled>
    </div>
    <div class="form-text">Nama diambil otomatis dari akun kamu.</div>
</div>
                        {{-- KATEGORI + LOKASI --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Kategori</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text border-end-0 bg-white">
                                        <i class="bi bi-tag text-primary"></i>
                                    </span>
                                    <select name="kategori_id"
                                            class="form-select border-start-0 ps-0 @error('kategori_id') is-invalid @enderror" required>
                                        <option value="">Pilih kategori</option>
                                        @foreach($kategoris as $k)
                                            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-uppercase text-muted">Lokasi</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text border-end-0 bg-white">
                                        <i class="bi bi-geo-alt text-primary"></i>
                                    </span>
                                    <input type="text" name="lokasi"
                                           class="form-control border-start-0 ps-0 @error('lokasi') is-invalid @enderror"
                                           placeholder="Contoh: Kelas 12 RPL"
                                           value="{{ old('lokasi') }}" required>
                                    @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- JUDUL --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-uppercase text-muted">Judul Laporan</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text border-end-0 bg-white">
                                    <i class="bi bi-card-heading text-primary"></i>
                                </span>
                                <input type="text" name="judul"
                                       class="form-control border-start-0 ps-0 @error('judul') is-invalid @enderror"
                                       placeholder="Contoh: AC Kelas 12 Tidak Dingin"
                                       value="{{ old('judul') }}" required>
                                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-uppercase text-muted">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" maxlength="200"
                                      class="form-control form-control-lg rounded-3 @error('deskripsi') is-invalid @enderror"
                                      placeholder="Jelaskan kerusakan secara detail..." required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="d-flex justify-content-end mt-1">
                                <small><span id="char-count">0</span>/200 karakter</small>
                            </div>
                        </div>

                        {{-- FOTO --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-uppercase text-muted">
                                Foto <span class="text-muted fw-normal text-capitalize">(Opsional)</span>
                            </label>
                            <input type="file" name="foto" id="foto"
                                   class="form-control form-control-lg rounded-3 @error('foto') is-invalid @enderror"
                                   accept="image/*" onchange="previewFoto(this)">
                            @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="form-text">JPG, PNG, GIF — Maks 2MB</div>
                            <div id="preview-container" class="mt-3 d-none">
                                <img id="preview-img" src="" class="img-fluid rounded-3 w-100" style="max-height:220px;object-fit:cover;">
                                <p class="text-success small mt-2 mb-0">
                                    <i class="bi bi-check-circle-fill me-1"></i>Foto siap diunggah
                                </p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-3">
                            <a href="{{ route('publik.index') }}" class="btn btn-light btn-lg rounded-3 border px-4">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary bg-opacity-75 btn-lg rounded-3 fw-bold flex-grow-1">
                                <i class="bi bi-send-fill me-2"></i>Kirim Laporan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function previewFoto(input) {
    const container = document.getElementById('preview-container');
    const img = document.getElementById('preview-img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            container.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

const textarea = document.getElementById('deskripsi');
const charCount = document.getElementById('char-count');
function updateCount() {
    const len = textarea.value.length;
    charCount.textContent = len;
    charCount.style.color = len >= 180 ? '#dc3545' : len >= 140 ? '#fd7e14' : '#6c757d';
}
textarea.addEventListener('input', updateCount);
updateCount();
</script>
</body>
</html>