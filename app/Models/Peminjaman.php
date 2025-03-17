<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model {
    use HasFactory;
    
    protected $table = 'peminjaman';
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'isbn',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status'
    ];
}