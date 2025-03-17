<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $primaryKey = 'kategori';
    public $incrementing = false; // Karena primary key bukan auto-increment
    protected $keyType = 'string';

    protected $fillable = [
        'kategori'
    ];
}
