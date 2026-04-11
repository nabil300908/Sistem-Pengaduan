<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama biar nggak dobel
        Kategori::truncate();

        $kategoris = ['Fasilitas', 'Kebersihan', 'Keamanan'];

        foreach ($kategoris as $k) {
            Kategori::create([
                'nama_kategori' => $k
            ]);
        }
    }
}