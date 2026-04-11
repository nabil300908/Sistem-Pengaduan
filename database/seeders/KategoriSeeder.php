<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;
class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run()
{
    $kategoris = ['Fasilitas', 'Kebersihan', 'Keamanan'];
    foreach ($kategoris as $k) {
        Kategori::create(['nama_kategori' => $k]);
    }
}
}