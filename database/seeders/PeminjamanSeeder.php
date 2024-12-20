<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Peminjaman;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeminjamanSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Peminjaman::create([
            'user_id' => '9dc0b676-c615-414d-a303-15ea13a48b75',
            'isbn' => '1234567890123',
            'tanggal_peminjaman' => Carbon::now()->subDays(8)->format('Y-m-d')
        ]);
        Peminjaman::create([
            'user_id' => '9dc0b676-c615-414d-a303-15ea13a48b75',
            'tanggal_peminjaman' => Carbon::now()->subDays(7)->format('Y-m-d'),
            'isbn' => '97930312568'
        ]);
        Peminjaman::create([
            'user_id' => '9dc0b676-c615-414d-a303-15ea13a48b75',
            'isbn' => '78149122',
            'tanggal_peminjaman' => Carbon::now()->format('Y-m-d'),
            'status' => 'dikembalikan',
            'tanggal_pengembalian' => '1945-08-17'
        ]);
        Peminjaman::create([
            'user_id' => '9dc0b676-c615-414d-a303-15ea13a48b75',
            'isbn' => '793256238',
            'tanggal_peminjaman' => Carbon::now()->format('Y-m-d')
        ]);
    }
}