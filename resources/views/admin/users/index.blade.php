@extends('layouts.app')
@section('title', 'Manajemen User')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-people-fill me-2 text-primary"></i>Manajemen User</h4>
        <p class="text-muted mb-0">Kelola akun siswa yang terdaftar di sistem.</p>
    </div>
    <div class="badge bg-primary rounded-pill px-3 py-2 fs-6">
        Total: {{ $users->count() }} User
    </div>
</div>

<div class="card rounded-4 shadow-sm border-0">
    <div class="card-body p-0">
        @if($users->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-people fs-1 d-block mb-2"></i>
                Belum ada user terdaftar.
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Total Laporan</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $i => $user)
                <tr>
                    <td class="ps-4 text-muted">{{ $i + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0
                                {{ $user->role === 'admin' ? 'bg-warning' : 'bg-primary' }}"
                                 style="width:36px;height:36px">
                                <i class="bi bi-person-fill text-white small"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">{{ $user->name }}</div>
                                @if($user->id == session('user_id'))
                                    <small class="text-muted">(Anda)</small>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="text-muted">
                        <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                    </td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="badge bg-warning text-dark rounded-pill">
                                <i class="bi bi-shield-fill me-1"></i>Admin
                            </span>
                        @else
                            <span class="badge bg-primary rounded-pill">
                                <i class="bi bi-person-fill me-1"></i>Siswa
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-secondary rounded-pill">
                            <i class="bi bi-clipboard me-1"></i>{{ $user->laporans_count }} Laporan
                        </span>
                    </td>
                    <td class="text-muted">
                        <i class="bi bi-calendar3 me-1"></i>{{ $user->created_at->format('d M Y') }}
                    </td>
                    <td>
                        @if($user->role !== 'admin')
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->name }}? Semua laporan miliknya juga akan terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-3">
                                <i class="bi bi-trash me-1"></i>Hapus
                            </button>
                        </form>
                        @else
                        <span class="text-muted small">
                            <i class="bi bi-lock me-1"></i>Tidak bisa dihapus
                        </span>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection