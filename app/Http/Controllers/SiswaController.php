<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class SiswaController extends Controller
{
    public function index()
    {
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
        $kategoris = [
            (object)['id' => 1, 'nama_kategori' => 'Fasilitas'],
            (object)['id' => 2, 'nama_kategori' => 'Kebersihan'],
            (object)['id' => 3, 'nama_kategori' => 'Keamanan'],
        ];

        return view('siswa.laporan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'kategori_id'  => 'required|in:1,2,3',
            'judul'        => 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'lokasi'       => 'required|string|max:255',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan', 'public');
        }

        $laporan = Laporan::create([
            'nama_pelapor' => $request->nama_pelapor,
            'user_id'      => null,
            'kategori_id'  => $request->kategori_id,
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'lokasi'       => $request->lokasi,
            'foto'         => $fotoPath,
            'status'       => 'menunggu',
        ]);

        Mail::raw(
            "Ada laporan baru masuk.\n\n" .
            "Nama Pelapor : " . $request->nama_pelapor . "\n" .
            "Judul        : " . $request->judul . "\n" .
            "Lokasi       : " . $request->lokasi . "\n" .
            "Deskripsi    : " . $request->deskripsi . "\n" .
            "Status       : Menunggu",
            function ($msg) {
                $msg->to('fadlan.nabil848@smk.belajar.id')
                    ->subject('Notifikasi Laporan Baru');
            }
        );

        return redirect()->route('publik.index')
            ->with('success', 'Laporan berhasil dikirim! Terima kasih.')
            ->with('new_laporan_id', $laporan->id);
    }

    public function show($id)
    {
        $laporan = Laporan::with('kategori')->findOrFail($id);
        return view('siswa.laporan.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);

        $kategoris = [
            (object)['id' => 1, 'nama_kategori' => 'Fasilitas'],
            (object)['id' => 2, 'nama_kategori' => 'Kebersihan'],
            (object)['id' => 3, 'nama_kategori' => 'Keamanan'],
        ];

        return view('siswa.laporan.edit', compact('laporan', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'kategori_id'  => 'required|in:1,2,3',
            'judul'        => 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'lokasi'       => 'required|string|max:255',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $fotoPath = $laporan->foto;

        if ($request->hasFile('foto')) {
            if ($laporan->foto) {
                Storage::disk('public')->delete($laporan->foto);
            }

            $fotoPath = $request->file('foto')->store('laporan', 'public');
        }

        $laporan->update([
            'nama_pelapor' => $request->nama_pelapor,
            'kategori_id'  => $request->kategori_id,
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'lokasi'       => $request->lokasi,
            'foto'         => $fotoPath,
        ]);

        return redirect()->route('publik.show', $id)
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }

        $laporan->delete();

        return redirect()->route('publik.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
