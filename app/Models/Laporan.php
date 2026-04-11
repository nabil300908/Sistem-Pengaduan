<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Laporan extends Model
{
    //
   protected $fillable = [
    'nama_pelapor',
    'user_id',
    'kategori_id',
    'judul',
    'deskripsi',
    'lokasi',
    'foto',
    'status',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
