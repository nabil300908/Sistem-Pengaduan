<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sarpras Sekolah')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-light">

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm d-print-none bg-primary bg-opacity-75">
    <div class="container-fluid px-3">

        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-5" href="#">
            <div class="bg-white rounded-2 d-flex align-items-center justify-content-center"
                 style="width:32px;height:32px;">
                <i class="bi bi-building-fill text-primary" style="font-size:16px"></i>
            </div>
            <span>Sarpras Sekolah</span>
        </a>

        {{-- Kanan navbar di HP: notif + hamburger --}}
        <div class="d-flex align-items-center gap-2 ms-auto d-lg-none">

            @if(session('user_role') === 'admin')
            @php $notifCount = \App\Models\Laporan::where('status', 'menunggu')->count(); @endphp
            <div class="dropdown">
                <button class="btn btn-sm position-relative rounded-3"
                        style="background:rgba(255,255,255,0.15);border:none"
                        type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-bell-fill text-white fs-5"></i>
                    @if($notifCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size:10px">{{ $notifCount }}</span>
                    @endif
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow rounded-4 border-0 p-2" style="min-width:280px">
                    <li class="px-2 py-1 mb-1">
                        <div class="fw-bold small text-muted"><i class="bi bi-bell me-1"></i>Notifikasi</div>
                    </li>
                    <li><hr class="dropdown-divider my-1"></li>
                    @if($notifCount > 0)
                        @foreach(\App\Models\Laporan::where('status','menunggu')->latest()->take(5)->get() as $notif)
                        <li>
                            <a href="{{ route('admin.laporan.show', $notif->id) }}" class="dropdown-item rounded-3 py-2 px-3">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="rounded-circle bg-danger d-flex align-items-center justify-content-center flex-shrink-0 mt-1"
                                         style="width:32px;height:32px">
                                        <i class="bi bi-hourglass-split text-white small"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold small">{{ $notif->judul }}</div>
                                        <div class="text-muted" style="font-size:11px">
                                            <i class="bi bi-person me-1"></i>{{ $notif->nama_pelapor ?? $notif->user->name ?? 'Anonim' }}
                                            · {{ $notif->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                        @if($notifCount > 5)
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <a href="{{ route('admin.laporan.index', ['status' => 'menunggu']) }}"
                               class="dropdown-item rounded-3 text-center text-primary small fw-semibold py-2">
                                Lihat semua {{ $notifCount }} laporan menunggu
                            </a>
                        </li>
                        @endif
                    @else
                        <li>
                            <div class="text-center py-3 text-muted small">
                                <i class="bi bi-check-circle-fill text-success d-block fs-4 mb-1"></i>
                                Tidak ada laporan menunggu
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            @endif

            <button class="navbar-toggler border-0" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        {{-- Collapse menu --}}
        <div class="collapse navbar-collapse" id="navbarMenu">
            <div class="ms-auto d-flex align-items-center gap-2 py-3 py-lg-0">

                {{-- Notif hanya laptop --}}
                @if(session('user_role') === 'admin')
                @php $notifCount = \App\Models\Laporan::where('status', 'menunggu')->count(); @endphp
                <div class="dropdown d-none d-lg-block">
                    <button class="btn btn-sm position-relative rounded-3"
                            style="background:rgba(255,255,255,0.15);border:none"
                            type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell-fill text-white fs-5"></i>
                        @if($notifCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                              style="font-size:10px">{{ $notifCount }}</span>
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow rounded-4 border-0 p-2" style="min-width:300px">
                        <li class="px-2 py-1 mb-1">
                            <div class="fw-bold small text-muted"><i class="bi bi-bell me-1"></i>Notifikasi</div>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        @if($notifCount > 0)
                            @foreach(\App\Models\Laporan::where('status','menunggu')->latest()->take(5)->get() as $notif)
                            <li>
                                <a href="{{ route('admin.laporan.show', $notif->id) }}" class="dropdown-item rounded-3 py-2 px-3">
                                    <div class="d-flex align-items-start gap-2">
                                        <div class="rounded-circle bg-danger d-flex align-items-center justify-content-center flex-shrink-0 mt-1"
                                             style="width:32px;height:32px">
                                            <i class="bi bi-hourglass-split text-white small"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold small">{{ $notif->judul }}</div>
                                            <div class="text-muted" style="font-size:11px">
                                                <i class="bi bi-person me-1"></i>{{ $notif->nama_pelapor ?? $notif->user->name ?? 'Anonim' }}
                                                · {{ $notif->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            @if($notifCount > 5)
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <a href="{{ route('admin.laporan.index', ['status' => 'menunggu']) }}"
                                   class="dropdown-item rounded-3 text-center text-primary small fw-semibold py-2">
                                    Lihat semua {{ $notifCount }} laporan menunggu
                                </a>
                            </li>
                            @endif
                        @else
                            <li>
                                <div class="text-center py-3 text-muted small">
                                    <i class="bi bi-check-circle-fill text-success d-block fs-4 mb-1"></i>
                                    Tidak ada laporan menunggu
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
                @endif

                <div class="vr bg-white opacity-25 mx-1 d-none d-lg-block" style="height:28px"></div>

                <span class="badge rounded-pill px-3 py-2
                    {{ session('user_role') === 'admin' ? 'bg-warning text-dark' : 'bg-success' }}">
                    <i class="bi bi-{{ session('user_role') === 'admin' ? 'shield-fill' : 'person-fill' }} me-1"></i>
                    {{ ucfirst(session('user_role')) }}
                </span>

                <div class="vr bg-white opacity-25 mx-1 d-none d-lg-block" style="height:28px"></div>

                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width:34px;height:34px;">
                        <i class="bi bi-person-fill text-white"></i>
                    </div>
                    <div>
                        <div class="text-white fw-semibold small lh-1">{{ session('user_name') }}</div>
                        <div class="text-white-50" style="font-size:11px">
                            {{ session('user_role') === 'admin' ? 'Administrator' : 'Siswa' }}
                        </div>
                    </div>
                </div>

                <div class="vr bg-white opacity-25 mx-1 d-none d-lg-block" style="height:28px"></div>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-light d-flex align-items-center gap-1 rounded-3">
                        <i class="bi bi-box-arrow-right text-danger"></i>
                        <span class="text-dark small fw-semibold">Logout</span>
                    </button>
                </form>

            </div>
        </div>

    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR --}}
        <div class="col-md-2 px-0 bg-white border-end min-vh-100 py-3 d-none d-md-block d-print-none">

            {{-- User Card --}}
            <div class="mx-3 mb-3 p-3 rounded-3 bg-light text-center">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-2"
                     style="width:42px;height:42px;">
                    <i class="bi bi-person-fill text-white fs-5"></i>
                </div>
                <div class="fw-semibold small text-truncate">{{ session('user_name') }}</div>
                <span class="badge rounded-pill mt-1
                    {{ session('user_role') === 'admin' ? 'bg-warning text-dark' : 'bg-primary' }}"
                    style="font-size:10px">
                    {{ ucfirst(session('user_role')) }}
                </span>
            </div>

            <hr class="mx-3 my-2">

            @if(session('user_role') === 'siswa')
            <p class="text-uppercase text-muted mx-3 mb-1" style="font-size:10px;letter-spacing:1px">Menu</p>
            <ul class="nav flex-column px-2">
                <li class="nav-item mb-1">
                    <a class="nav-link d-flex align-items-center gap-2 rounded-3 px-3 py-2
                        {{ request()->routeIs('siswa.dashboard') ? 'bg-primary text-white' : 'text-secondary' }}"
                       href="{{ route('siswa.dashboard') }}">
                        <i class="bi bi-house-door-fill"></i>
                        <span class="small fw-semibold">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link d-flex align-items-center gap-2 rounded-3 px-3 py-2
                        {{ request()->routeIs('siswa.laporan.create') ? 'bg-primary text-white' : 'text-secondary' }}"
                       href="{{ route('siswa.laporan.create') }}">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span class="small fw-semibold">Buat Laporan</span>
                    </a>
                </li>
            </ul>
            @else
            <p class="text-uppercase text-muted mx-3 mb-1" style="font-size:10px;letter-spacing:1px">Menu</p>
            <ul class="nav flex-column px-2">
                <li class="nav-item mb-1">
                    <a class="nav-link d-flex align-items-center gap-2 rounded-3 px-3 py-2
                        {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'text-secondary' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span class="small fw-semibold">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link d-flex align-items-center gap-2 rounded-3 px-3 py-2
                        {{ request()->routeIs('admin.laporan.*') ? 'bg-primary text-white' : 'text-secondary' }}"
                       href="{{ route('admin.laporan.index') }}">
                        <i class="bi bi-clipboard-data-fill"></i>
                        <span class="small fw-semibold">Semua Laporan</span>
                    </a>
                </li>
            </ul>
            @endif

        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-md-10 col-12 py-4 px-3 pb-5 pb-md-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 d-print-none">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 d-print-none">
                    <i class="bi bi-exclamation-circle-fill fs-5"></i>
                    <span>{{ session('error') }}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>

    </div>
</div>

{{-- BOTTOM NAV (khusus HP) --}}
<div class="d-md-none fixed-bottom bg-white border-top shadow-sm d-print-none">
    <div class="d-flex justify-content-around py-2">
        @if(session('user_role') === 'siswa')
            <a href="{{ route('siswa.dashboard') }}"
               class="d-flex flex-column align-items-center text-decoration-none gap-1
               {{ request()->routeIs('siswa.dashboard') ? 'text-primary' : 'text-secondary' }}">
                <i class="bi bi-house-door-fill fs-5"></i>
                <span style="font-size:10px">Dashboard</span>
            </a>
            <a href="{{ route('siswa.laporan.create') }}"
               class="d-flex flex-column align-items-center text-decoration-none gap-1
               {{ request()->routeIs('siswa.laporan.create') ? 'text-primary' : 'text-secondary' }}">
                <i class="bi bi-plus-circle-fill fs-5"></i>
                <span style="font-size:10px">Buat Laporan</span>
            </a>
        @else
            <a href="{{ route('admin.dashboard') }}"
               class="d-flex flex-column align-items-center text-decoration-none gap-1
               {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-secondary' }}">
                <i class="bi bi-speedometer2 fs-5"></i>
                <span style="font-size:10px">Dashboard</span>
            </a>
            <a href="{{ route('admin.laporan.index') }}"
               class="d-flex flex-column align-items-center text-decoration-none gap-1
               {{ request()->routeIs('admin.laporan.*') ? 'text-primary' : 'text-secondary' }}">
                <i class="bi bi-clipboard-data-fill fs-5"></i>
                <span style="font-size:10px">Laporan</span>
            </a>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>