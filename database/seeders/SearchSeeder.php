<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        for ($i = 1; $i <= 5; $i++) {
            Buku::create([
                'isbn' => '123456789023'. $i,
                'sampul' => 'https://example.com/sampul.jpg',
                'judul' => 'judul1'. $i,    
                'kategori' => 'tes3',    
                'penulis' => 'penulis'. $i,
                'penerbit' => 'tes'. $i,
                'deskripsi' => 'tes'. $i,
                'tahun_terbit' => '202'. $i,
                'jumlah_tersedia' => $i
            ]);
        }

        for ($i = 1; $i <= 4; $i++) {
            User::create([
                'id' => '9dc0b676-c615-414d-a303-15ea13a48b7' . $i,
                'nama' => 'Serafim Sitorus' . $i,
                'password' => Hash::make('serafim123'),
                'email' => 'edgar'. $i .'@gmail.com',
                'token' => '123'
            ]);
            User::create([
                'id' => '9dc0b676-c615-414d-a303-15ea13a48b6' . $i,
                'nama' => 'Rifqi Jabrah' . $i,
                'password' => Hash::make('rifqi123'),
                'email' => 'rifqi'. $i .'@gmail.com',
                'token' => '124'
            ]);
        }

        for ($i = 1; $i <= 4; $i++) {
            Peminjaman::create([
                'user_id' => '9dc0b676-c615-414d-a303-15ea13a48b7'. $i,
                'isbn' => '123456789023'. $i,
                'tanggal_peminjaman' => Carbon::now()->format('Y-m-d')
            ]);
        }
    }
}
