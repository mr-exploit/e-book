<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'foto_buku',
        'kategori_id',
        'img_buku',
        'file_buku',
        'pengarang',
        'tahun_terbit',
        'penerbit',
        'jumlah_halaman',
        'sinopsis'
    ];


    public function kategori()
    {
        return $this->belongsTo(kategori_buku::class, 'kategori_id', 'id');
    }

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class, 'buku_id', 'id');
    }
}
