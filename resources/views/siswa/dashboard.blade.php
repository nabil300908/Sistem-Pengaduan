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

    <nav class="navbar navbar-dark sticky-top shadow-sm bg-primary bg-opacity-75">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('welcome') }}">
                <div class="bg-white rounded-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
                    <i class="bi bi-building-fill text-primary" style="font-size:16px"></i>
                </div>
                Sarpras Sekolah
            </a>
            <a href="{{ route('publik.create') }}" class="btn btn-warning bg-opacity-75 btn-sm fw-bold rounded-3 px-3">
                <i class="bi bi-plus-circle-fill me-1"></i>Buat Laporan
            </a>
        </div>
    </nav>

    {{-- HERO --}}
    <div class="bg-primary bg-opacity-75">
        <div class="container py-4">
            <h4 class="fw-bold text-white mb-1">
                <i class="bi bi-clipboard2-data-fill me-2"></i>Dashboard Pengaduan
            </h4>
            <p class="text-white-50 mb-4 small">Pantau dan kelola laporan sarana & prasarana sekolah</p>
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="rounded-4 p-3 text-white bg-white bg-opacity-10">
                        <i class="bi bi-card-list fs-4 d-block mb-1"></i>
                        <div class="fs-3 fw-bold lh-1 mb-1">{{ $totalSemua }}</div>
                        <small class="text-white-50">Total Laporan</small>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="rounded-4 p-3 text-white bg-white bg-opacity-10">
                        <i class="bi bi-hourglass-split fs-4 d-block mb-1"></i>
                        <div class="fs-3 fw-bold lh-1 mb-1">{{ $totalMenunggu }}</div>
                        <small class="text-white-50">Menunggu</small>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="rounded-4 p-3 text-white bg-white bg-opacity-10">
                        <i class="bi bi-gear-fill fs-4 d-block mb-1"></i>
                        <div class="fs-3 fw-bold lh-1 mb-1">{{ $totalDiproses }}</div>
                        <small class="text-white-50">Diproses</small>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="rounded-4 p-3 text-white bg-white bg-opacity-10">
                        <i class="bi bi-check-circle-fill fs-4 d-block mb-1"></i>
                        <div class="fs-3 fw-bold lh-1 mb-1">{{ $totalSelesai }}</div>
                        <small class="text-white-50">Selesai</small>
                    </div>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60" class="d-block">
            <path fill="#f8f9fa" fill-opacity="1" d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z"></path>
        </svg>
    </div>

    <div class="container pb-5">

        @if(session('success'))
        <div class="alert alert-success border-0 rounded-3 shadow-sm d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-check-circle-fill fs-5 text-success"></i>
            <span class="fw-semibold">{{ session('success') }}</span>
        </div>
        @endif

        @if(session('new_laporan_id'))
        <div id="new-laporan-data" data-id="{{ session('new_laporan_id') }}"></div>
        @endif

        {{-- LAPORAN SAYA --}}
        <div class="mb-5">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="fw-bold mb-0"><i class="bi bi-person-fill text-primary me-2"></i>Laporan Saya</h5>
                    <small class="text-muted">Hanya kamu yang bisa mengedit dan menghapus laporan ini</small>
                </div>
                <a href="{{ route('publik.create') }}" class="btn btn-primary bg-opacity-75 btn-sm rounded-3 px-3 fw-semibold">
                    <i class="bi bi-plus-lg me-1"></i>Buat Laporan
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                @if($laporans->isEmpty())
                <div id="empty-my" class="text-center py-5 text-muted">
                    <i class="bi bi-inbox display-6 d-block mb-3 text-primary opacity-50"></i>
                    <p class="fw-semibold mb-1">Belum ada laporan</p>
                    <small>Kamu belum membuat laporan apapun dari perangkat ini.</small>
                    <div class="mt-3">
                        <a href="{{ route('publik.create') }}" class="btn btn-primary bg-opacity-75 btn-sm rounded-3 px-4">
                            <i class="bi bi-plus-circle me-1"></i>Buat Laporan Sekarang
                        </a>
                    </div>
                </div>
                @else
                <div id="empty-my" class="text-center py-5 text-muted d-none">
                    <i class="bi bi-inbox display-6 d-block mb-3 text-primary opacity-50"></i>
                    <p class="fw-semibold mb-1">Belum ada laporan</p>
                    <small>Kamu belum membuat laporan apapun dari perangkat ini.</small>
                    <div class="mt-3">
                        <a href="{{ route('publik.create') }}" class="btn btn-primary bg-opacity-75 btn-sm rounded-3 px-4">
                            <i class="bi bi-plus-circle me-1"></i>Buat Laporan Sekarang
                        </a>
                    </div>
                </div>
                <div class="table-responsive" id="my-list">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th class="ps-4 py-3">Judul Laporan</th>
                                <th>Pelapor</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Lapor</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporans as $lap)
                            <tr class="my-laporan-card d-none" data-id="{{ $lap->id }}" data-status="{{ $lap->status }}">
                                <td class="ps-4">
                                    <span class="fw-semibold">{{ $lap->judul }}</span>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($lap->deskripsi, 50) }}</small>
                                </td>
                                <td>
                                    <small><i class="bi bi-person me-1 text-muted"></i>{{ $lap->nama_pelapor }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2">
                                        {{ $lap->kategori->nama_kategori }}
                                    </span>
                                </td>
                                <td><small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $lap->lokasi }}</small></td>
                                <td><small class="text-muted">{{ $lap->created_at->format('d M Y') }}</small></td>
                                <td>
                                    @if($lap->status == 'menunggu')
                                    <span class="badge bg-danger bg-opacity-75 rounded-pill px-2">Menunggu</span>
                                    @elseif($lap->status == 'diproses')
                                    <span class="badge bg-warning bg-opacity-75 text-dark rounded-pill px-2">Diproses</span>
                                    @else
                                    <span class="badge bg-success bg-opacity-75 rounded-pill px-2">Selesai</span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('publik.show', $lap->id) }}"
                                           class="btn btn-primary bg-opacity-75 btn-sm rounded-3"
                                           title="Lihat detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        @if($lap->status !== 'selesai')
                                        <a href="{{ route('publik.edit', $lap->id) }}"
                                           class="btn btn-warning bg-opacity-75 btn-sm rounded-3"
                                           title="Edit laporan">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('publik.destroy', $lap->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus laporan ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger bg-opacity-75 btn-sm rounded-3"
                                                    title="Hapus laporan">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

        {{-- DIVIDER --}}
        <div class="d-flex align-items-center gap-3 mb-4">
            <hr class="flex-grow-1">
            <span class="text-muted small fw-semibold px-2">
                <i class="bi bi-people-fill me-1"></i>LAPORAN PENGGUNA LAIN
            </span>
            <hr class="flex-grow-1">
        </div>

        {{-- LAPORAN LAINNYA --}}
        <div>
            <div class="mb-3">
                <h5 class="fw-bold mb-0"><i class="bi bi-people-fill text-secondary me-2"></i>Laporan Pengguna Lain</h5>
                <small class="text-muted">Kamu hanya bisa melihat laporan orang lain</small>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                @if($laporans->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-clipboard-x display-6 d-block mb-3 text-primary opacity-50"></i>
                    <p class="fw-semibold mb-1">Belum ada laporan</p>
                    <small>Belum ada laporan masuk dari pengguna lain.</small>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="other-list">
                        <thead class="table-secondary">
                            <tr>
                                <th class="ps-4 py-3">Judul Laporan</th>
                                <th>Pelapor</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Lapor</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporans as $lap)
                            <tr class="other-laporan-card" data-id="{{ $lap->id }}">
                                <td class="ps-4">
                                    <span class="fw-semibold">{{ $lap->judul }}</span>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($lap->deskripsi, 50) }}</small>
                                </td>
                                <td><small><i class="bi bi-person me-1 text-muted"></i>{{ $lap->nama_pelapor }}</small></td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2">
                                        {{ $lap->kategori->nama_kategori }}
                                    </span>
                                </td>
                                <td><small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $lap->lokasi }}</small></td>
                                <td><small class="text-muted">{{ $lap->created_at->format('d M Y') }}</small></td>
                                <td>
                                    @if($lap->status == 'menunggu')
                                    <span class="badge bg-danger bg-opacity-75 rounded-pill px-2">Menunggu</span>
                                    @elseif($lap->status == 'diproses')
                                    <span class="badge bg-warning bg-opacity-75 text-dark rounded-pill px-2">Diproses</span>
                                    @else
                                    <span class="badge bg-success bg-opacity-75 rounded-pill px-2">Selesai</span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <a href="{{ route('publik.show', $lap->id) }}"
                                       class="btn btn-primary bg-opacity-75 btn-sm rounded-3">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="mt-4">{{ $laporans->links() }}</div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const newData = document.getElementById('new-laporan-data');
        if (newData) {
            const newId = parseInt(newData.dataset.id);
            const stored = JSON.parse(localStorage.getItem('my_laporans') || '[]');
            if (!stored.includes(newId)) {
                stored.push(newId);
                localStorage.setItem('my_laporans', JSON.stringify(stored));
            }
        }

        const myLaporans = JSON.parse(localStorage.getItem('my_laporans') || '[]');
        let myCount = 0;

        document.querySelectorAll('.my-laporan-card').forEach(function(card) {
            const id = parseInt(card.dataset.id);
            if (myLaporans.includes(id)) {
                card.classList.remove('d-none');
                myCount++;
            }
        });

        document.querySelectorAll('.other-laporan-card').forEach(function(card) {
            const id = parseInt(card.dataset.id);
            if (myLaporans.includes(id)) {
                card.classList.add('d-none');
            }
        });

        if (myCount === 0) {
            document.getElementById('empty-my').classList.remove('d-none');
            const myList = document.getElementById('my-list');
            if (myList) myList.classList.add('d-none');
        }
    </script>
</body>
</html>