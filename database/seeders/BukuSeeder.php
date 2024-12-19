<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::create([
            'isbn' => '1234567890123',
            'sampul' => 'https://example.com/sampul.jpg',
            'judul' => 'tes',    
            'kategori' => 'horror10',    
            'penulis' => 'tes',
            'penerbit' => 'tes',
            'deskripsi' => 'tes',
            'tahun_terbit' => '2023',
            'jumlah_tersedia' => 10
        ]);
        Buku::create([
            'isbn' => '1234567890124',
            'sampul' => 'https://example.com/sampul.jpg',
            'judul' => 'tes',    
            'kategori' => 'horror10',    
            'penulis' => 'tes',
            'penerbit' => 'tes',
            'deskripsi' => 'tes',
            'tahun_terbit' => '2023',
            'jumlah_tersedia' => 10
        ]);
        Buku::create([
            'isbn' => '1234567890125',
            'sampul' => 'https://example.com/sampul.jpg',
            'judul' => 'tes',    
            'kategori' => 'horror10',    
            'penulis' => 'tes',
            'penerbit' => 'tes',
            'deskripsi' => 'tes',
            'tahun_terbit' => '2023',
            'jumlah_tersedia' => 10
        ]);
    }
}
