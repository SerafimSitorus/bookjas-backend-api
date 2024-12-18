<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            Kategori::create([
                'kategori' => 'tes'. $i,
            ]);
        }
        for ($i = 1; $i <= 9; $i++) {
            Buku::create([
                'isbn' => '123456789012'. $i,
                'sampul' => 'https://example.com/sampul.jpg',
                'judul' => 'judul'. $i,    
                'kategori' => 'tes'. $i,    
                'penulis' => 'penulis'. $i,
                'penerbit' => 'tes'. $i,
                'deskripsi' => 'tes'. $i,
                'tahun_terbit' => '202'. $i,
                'jumlah_tersedia' => $i
            ]);
        }
    }
}
