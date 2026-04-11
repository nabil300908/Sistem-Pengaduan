<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Kategori;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total          = Laporan::count();
        $menunggu       = Laporan::where('status', 'menunggu')->count();
        $diproses       = Laporan::where('status', 'diproses')->count();
        $selesai        = Laporan::where('status', 'selesai')->count();
        $laporanTerbaru = Laporan::with(['user', 'kategori'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('total', 'menunggu', 'diproses', 'selesai', 'laporanTerbaru'));
    }

    public function index(Request $request)
    {
        $query = Laporan::with(['user', 'kategori']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter per bulan
        if ($request->bulan) {
            $parts = explode('-', $request->bulan);
            $query->whereYear('created_at', $parts[0])
                  ->whereMonth('created_at', $parts[1]);
        }

        $laporans  = $query->latest()->paginate(10);
        $kategoris = Kategori::all();

        return view('admin.laporan.index', compact('laporans', 'kategoris'));
    }

    public function show($id)
    {
        $laporan = Laporan::with(['user', 'kategori'])->findOrFail($id);
        return view('admin.laporan.show', compact('laporan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:menunggu,diproses,selesai']);

        Laporan::findOrFail($id)->update(['status' => $request->status]);

        $label = match($request->status) {
            'menunggu' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai'  => 'Selesai',
        };

        return back()->with('success', "Status laporan berhasil diubah menjadi \"$label\".");
    }
}