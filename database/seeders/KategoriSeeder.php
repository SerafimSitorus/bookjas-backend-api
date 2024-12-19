<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 20; $i++) { 
            Kategori::create([
                'kategori' => 'Horror' . $i
            ]);
        }
        Kategori::create([
            'kategori' => 'tes'
        ]);

        Kategori::create([
            'kategori' => 'Buku Pelajaran'
        ]);

        Kategori::create([
            'kategori' => 'Novel'
        ]);

        Kategori::create([
            'kategori' => 'Motivasi'
        ]);

        Kategori::create([
            'kategori' => 'Bebas'
        ]);
    }
}
