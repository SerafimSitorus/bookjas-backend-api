<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Buku;
use App\Models\User;
use Database\Seeders\BukuSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SearchSeeder;
use Illuminate\Support\Facades\Log;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\PeminjamanSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeminjamanTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateSuccess()
    {
        $this->seed([UserSeeder::class, KategoriSeeder::class, BukuSeeder::class]);
        $tanggal = Carbon::now()->format('Y-m-d');
        $this->post(
            '/api/peminjaman',
            [
                'user_id' => '9dc0b676-c615-414d-a303-15ea13a48b75',
                'isbn' => '1234567890123',
                'tanggal_peminjaman' => $tanggal
            ],
            [
                'Authorization' => '124'
            ]
        )->assertStatus(201)
            ->assertJson([
                'data' => [
                    'user_id' => '9dc0b676-c615-414d-a303-15ea13a48b75',
                    'isbn' => '1234567890123',
                    'tanggal_peminjaman' => $tanggal
                ]
            ]);
    }

    public function testKembalikanSuccess()
    {
        $this->seed([UserSeeder::class, KategoriSeeder::class, BukuSeeder::class, PeminjamanSeeder::class]);
        $tanggal = Carbon::now()->format('Y-m-d');
        $buku = Buku::query()->limit(1)->first();
        $user = User::query()->limit(1)->first();

        $this->put(
            '/api/peminjaman/user/' . $user->id . '/isbn/' . $buku->isbn,
            [
                'tanggal_pengembalian' => $tanggal,
                'status' => 'dikembalikan'
            ],
            [
                'Authorization' => '124'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    'tanggal_pengembalian' => $tanggal,
                    'status' => 'dikembalikan'
                ]
            ]);
    }

    public function testGetByUserSuccess()
    {
        $this->seed([UserSeeder::class, KategoriSeeder::class, BukuSeeder::class, PeminjamanSeeder::class]);
        $user = User::query()->limit(1)->first();
        $response =  $this->get('/api/peminjaman/user/' . $user->id,
        [
            'Authorization' => '123'
        ])->assertStatus(200);
        Log::info(json_encode($response, JSON_PRETTY_PRINT));
    }

    public function testSearchByPeminjam()
    {
        $this->seed([SearchSeeder::class]);

        $response = $this->get('/api/peminjaman?search=serafim sitorus3', [
            'Authorization' => '123'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));
    }

    public function testSearchByJudul()
    {
        $this->seed([SearchSeeder::class]);

        $response = $this->get('/api/peminjaman?search=judul1', [
            'Authorization' => '124'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));
    }

    public function testSearchUser(){
        $this->seed([SearchSeeder::class]);

        $response = $this->get('/api/peminjaman/pinjamuser?search=rus', [
            'Authorization' => '124'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));
    }

    public function testSearchBuku(){
        $this->seed([SearchSeeder::class]);

        $response = $this->get('/api/peminjaman/pinjambuku?search=ul1', [
            'Authorization' => '124'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));
    }
}
