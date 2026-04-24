<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SiswaController extends Controller
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $laporans      = Laporan::with('kategori')->latest()->paginate(10);
        $totalSemua    = Laporan::count();
        $totalMenunggu = Laporan::where('status', 'menunggu')->count();
        $totalDiproses = Laporan::where('status', 'diproses')->count();
        $totalSelesai  = Laporan::where('status', 'selesai')->count();

        return view('siswa.dashboard', compact(
            'laporans',
            'totalSemua',
            'totalMenunggu',
            'totalDiproses',
            'totalSelesai'
        ));
    }

    public function create()
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $sudahLapor = Laporan::where('user_id', session('user_id'))
            ->whereDate('created_at', today())
            ->exists();

        if ($sudahLapor) {
            return redirect()->route('publik.index')
                ->with('error', 'Kamu sudah membuat laporan hari ini. Maksimal 1 laporan per hari.');
        }

        $kategoris = Kategori::all();
        return view('siswa.laporan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $sudahLapor = Laporan::where('user_id', session('user_id'))
            ->whereDate('created_at', today())
            ->exists();

        if ($sudahLapor) {
            return redirect()->route('publik.index')
                ->with('error', 'Kamu sudah membuat laporan hari ini. Maksimal 1 laporan per hari.');
        }

        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string|max:200',
            'lokasi'      => 'required|string|max:255',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan', 'public');
        }

        $laporan = Laporan::create([
            'nama_pelapor' => session('user_name'),
            'user_id'      => session('user_id'),
            'kategori_id'  => $request->kategori_id,
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'lokasi'       => $request->lokasi,
            'foto'         => $fotoPath,
            'status'       => 'menunggu',
        ]);

        try {
    Mail::raw(
        "Ada laporan baru masuk.\n\n" .
        "Nama Pelapor : " . session('user_name') . "\n" .
        "Judul        : " . $request->judul . "\n" .
        "Lokasi       : " . $request->lokasi . "\n" .
        "Deskripsi    : " . $request->deskripsi . "\n" .
        "Status       : Menunggu",
        function ($msg) {
            $msg->to(config('mail.admin_email'))
                ->subject('Notifikasi Laporan Baru');
        }
    );
} catch (\Exception $e) {
    Log::error('Email gagal: ' . $e->getMessage());
}

        return redirect()->route('publik.index')
            ->with('success', 'Laporan berhasil dikirim! Terima kasih.')
            ->with('new_laporan_id', $laporan->id);
    }

    public function show($id)
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $laporan = Laporan::with('kategori')->findOrFail($id);
        return view('siswa.laporan.show', compact('laporan'));
    }

    public function edit($id)
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $laporan   = Laporan::findOrFail($id);
        $kategoris = Kategori::all();
        return view('siswa.laporan.edit', compact('laporan', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string|max:200',
            'lokasi'      => 'required|string|max:255',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $fotoPath = $laporan->foto;
        if ($request->hasFile('foto')) {
            if ($laporan->foto) {
                Storage::disk('public')->delete($laporan->foto);
            }
            $fotoPath = $request->file('foto')->store('laporan', 'public');
        }

        $laporan->update([
            'kategori_id' => $request->kategori_id,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'lokasi'      => $request->lokasi,
            'foto'        => $fotoPath,
        ]);

        return redirect()->route('publik.show', $id)
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $laporan = Laporan::findOrFail($id);
        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }
        $laporan->delete();

        return redirect()->route('publik.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}