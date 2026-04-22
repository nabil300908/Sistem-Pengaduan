<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use Illuminate\Http\Request;

class SaranController extends Controller
{
    // Publik kirim saran
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'isi_saran' => 'required|string|max:500',
        ]);

        Saran::create([
            'nama'     => $request->nama,
            'isi_saran' => $request->isi_saran,
        ]);

        return redirect()->route('welcome')->with('success_saran', 'Saran berhasil dikirim! Terima kasih.');
    }

    // Admin lihat semua saran
    public function index()
    {
        $sarans = Saran::latest()->paginate(10);
        return view('admin.saran.index', compact('sarans'));
    }

    // Admin balas saran
    public function balas(Request $request, $id)
    {
        $request->validate([
            'balasan' => 'required|string|max:500',
        ]);

        Saran::findOrFail($id)->update(['balasan' => $request->balasan]);

        return back()->with('success', 'Balasan berhasil disimpan.');
    }

    // Admin hapus saran
    public function destroy($id)
    {
        Saran::findOrFail($id)->delete();
        return back()->with('success', 'Saran berhasil dihapus.');
    }
}