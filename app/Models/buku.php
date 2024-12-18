<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';
    protected $primaryKey = 'isbn';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'isbn',
        'sampul',
        'judul',
        'kategori',
        'penulis',
        'penerbit',
        'deskripsi',
        'tahun_terbit',
        'jumlah_tersedia'
    ];
}
