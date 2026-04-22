@extends('layouts.app')
@section('title', 'Saran & Masukan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-chat-left-text-fill me-2 text-primary"></i>Saran & Masukan</h4>
        <p class="text-muted mb-0">Daftar saran dari pengguna sistem.</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success border-0 rounded-3 d-flex align-items-center gap-2 mb-4">
    <i class="bi bi-check-circle-fill text-success"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

<div class="d-flex flex-column gap-3">
    @forelse($sarans as $saran)
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            {{-- INFO PENGIRIM --}}
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="rounded-circle bg-primary bg-opacity-75 d-flex align-items-center justify-content-center flex-shrink-0"
                     style="width:36px;height:36px;">
                    <i class="bi bi-person-fill text-white"></i>
                </div>
                <div>
                    <div class="fw-bold">{{ $saran->nama }}</div>
                    <small class="text-muted">{{ $saran->created_at->format('d M Y, H:i') }}</small>
                </div>
                {{-- TOMBOL HAPUS --}}
                <form action="{{ route('admin.saran.destroy', $saran->id) }}" method="POST"
                      class="ms-auto" onsubmit="return confirm('Hapus saran ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger bg-opacity-75 btn-sm rounded-3">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </div>

            {{-- ISI SARAN --}}
            <div class="p-3 rounded-3 mb-3" style="background:#f8f9fa;">
                <p class="mb-0">{{ $saran->isi_saran }}</p>
            </div>

            {{-- BALASAN --}}
            @if($saran->balasan)
            <div class="p-3 rounded-3 mb-3 bg-primary bg-opacity-10">
                <small class="fw-bold text-primary d-block mb-1">
                    <i class="bi bi-reply-fill me-1"></i>Balasan Admin
                </small>
                <p class="mb-0 small">{{ $saran->balasan }}</p>
            </div>
            @endif

            {{-- FORM BALAS --}}
            <form action="{{ route('admin.saran.balas', $saran->id) }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="balasan"
                           class="form-control rounded-start-3"
                           placeholder="{{ $saran->balasan ? 'Ubah balasan...' : 'Tulis balasan...' }}"
                           value="{{ $saran->balasan }}" required>
                    <button class="btn btn-primary bg-opacity-75 rounded-end-3 px-3" type="submit">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
    @empty
    <div class="card border-0 shadow-sm rounded-4 text-center py-5 text-muted">
        <div class="card-body">
            <i class="bi bi-chat-left display-6 d-block mb-3 text-primary opacity-50"></i>
            <p class="fw-semibold mb-1">Belum ada saran</p>
            <small>Belum ada saran masuk dari pengguna.</small>
        </div>
    </div>
    @endforelse
</div>

<div class="mt-4">{{ $sarans->links() }}</div>

@endsection