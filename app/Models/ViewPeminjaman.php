<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'view_peminjaman';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'isbn',
        'sampul',
        'judul',
        'penulis',
        'peminjam',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status'
    ];
}
