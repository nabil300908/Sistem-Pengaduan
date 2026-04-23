<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Sarpras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-primary bg-opacity-75">
<div class="d-flex align-items-center py-4 py-lg-0" style="min-height:100vh">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

                <div class="text-center mb-4">
                    <div class="bg-white rounded-3 d-inline-flex align-items-center justify-content-center mb-3"
                         style="width:56px;height:56px">
                        <i class="bi bi-building-fill text-primary fs-3"></i>
                    </div>
                    <h5 class="text-white fw-bold mb-1">Sarpras Sekolah</h5>
                    <small class="text-white-50">Sistem Pengaduan Sarana & Prasarana</small>
                </div>

                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-1 text-center">Buat Akun</h5>
                        <p class="text-muted text-center mb-4 small">Daftar untuk mulai membuat laporan</p>

                        @if(session('error'))
                        <div class="alert alert-danger rounded-3 d-flex align-items-center gap-2 py-2">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            {{ session('error') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger rounded-3 py-2">
                            @foreach ($errors->all() as $error)
                                <div class="small"><i class="bi bi-exclamation-circle me-1"></i>{{ $error }}</div>
                            @endforeach
                        </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-person me-1 text-primary"></i>Nama Lengkap
                                </label>
                                <input type="text" name="name"
                                       class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                       placeholder="Nama lengkap kamu"
                                       value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-envelope me-1 text-primary"></i>Email
                                </label>
                                <input type="email" name="email"
                                       class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                       placeholder="email@gmail.com"
                                       value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-lock me-1 text-primary"></i>Password
                                </label>
                                <input type="password" name="password"
                                       class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror"
                                       placeholder="Minimal 6 karakter" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-lock-fill me-1 text-primary"></i>Konfirmasi Password
                                </label>
                                <input type="password" name="password_confirmation"
                                       class="form-control form-control-lg rounded-3"
                                       placeholder="Ulangi password" required>
                            </div>
                            <button type="submit" class="btn btn-primary bg-opacity-75 btn-lg w-100 rounded-3 fw-semibold">
                                <i class="bi bi-person-plus-fill me-2"></i>Daftar
                            </button>
                        </form>

                        <hr class="my-3">
                        <p class="text-center mb-2 small">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-primary fw-semibold">Login di sini</a>
                        </p>
                        <p class="text-center mb-0 small">
                            <a href="{{ route('welcome') }}" class="text-muted text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>