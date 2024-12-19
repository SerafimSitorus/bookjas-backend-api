<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Buku;
use Database\Seeders\BukuSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Http\UploadedFile;
use Database\Seeders\SearchSeeder;
use Illuminate\Support\Facades\Log;
use Database\Seeders\KategoriSeeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BukuTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function testCreateSuccess()
    // {
    //     // Storage::fake('sampul');
    //     // $sampul = UploadedFile::fake()->image('sampul.jpg');
    //     // dd($sampul);
    //     $this->seed([UserSeeder::class, KategoriSeeder::class]);
    //     $this->post(
    //         '/api/books',
    //         [
    //             'isbn' => '1234567890123',
    //             'sampul' => 'https://example.com/sampul.jpg',
    //             'judul' => 'tes',
    //             'kategori' => 'tes',
    //             'penulis' => 'tes',
    //             'penerbit' => 'tes',
    //             'deskripsi' => 'tes',
    //             'tahun_terbit' => '2023',
    //             'jumlah_tersedia' => 10
    //         ],
    //         [
    //             'Authorization' => '124'
    //         ]
    //     )->assertStatus(201)
    //         ->assertJson([
    //             'data' => [
    //                 'isbn' => '1234567890123',
    //                 'sampul' => 'https://example.com/sampul.jpg',
    //                 'judul' => 'tes',
    //                 'kategori' => 'tes',
    //                 'penulis' => 'tes',
    //                 'penerbit' => 'tes',
    //                 'deskripsi' => 'tes',
    //                 'tahun_terbit' => '2023',
    //                 'jumlah_tersedia' => 10
    //             ]
    //         ]);
    //     // Storage::disk('sampul')->assertExists($sampul->hashName());
        
    // }
    public function testCreateFailed()
    {
        $this->seed([UserSeeder::class, KategoriSeeder::class]);
        $this->post(
            '/api/books',
            [
                'isbn' => '',
                'sampul' => 'https://example.com/sampul.jpg',
                'judul' => '',
                'kategori' => 'tes',
                'penulis' => 'tes',
                'penerbit' => 'tes',
                'deskripsi' => 'tes',
                'tahun_terbit' => '2023',
                'jumlah_tersedia' => 10
            ],
            [
                'Authorization' => '124'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'isbn' => [
                        'The isbn field is required.'
                    ],
                    'judul' => [
                        'The judul field is required.'
                    ]
                ]
            ]);
    }
    public function testCreateUnauthorized()
    {
        $this->seed([UserSeeder::class, KategoriSeeder::class]);
        $this->post(
            '/api/books',
            [
                'isbn' => '1234567890123',
                'sampul' => 'https://example.com/sampul.jpg',
                'judul' => 'tes',
                'kategori' => 'tes',
                'penulis' => 'tes',
                'penerbit' => 'tes',
                'deskripsi' => 'tes',
                'tahun_terbit' => '2023',
                'jumlah_tersedia' => 10
            ],
            [
                'Authorization' => '123'
            ]
        )->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'Unauthorized'
                    ]
                ]
            ]);
    }

    public function testGetSuccess()
    {
        $this->seed([UserSeeder::class, KategoriSeeder::class, BukuSeeder::class]);
        $buku = Buku::query()->limit(1)->first();

        $this->get('/api/books/' . $buku->isbn, [
            'Authorization' => '123'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'isbn' => '1234567890123',
                    'sampul' => 'https://example.com/sampul.jpg',
                    'judul' => 'tes',
                    'kategori' => 'horror10',
                    'penulis' => 'tes',
                    'penerbit' => 'tes',
                    'deskripsi' => 'tes',
                    'tahun_terbit' => '2023',
                    'jumlah_tersedia' => 10
                ]
            ]);
    }
    public function testGetNotFound()
    {
        $this->seed([UserSeeder::class, KategoriSeeder::class, BukuSeeder::class]);
        $buku = Buku::query()->limit(1)->first();

        $this->get('/api/books/' . ($buku->isbn + 5), [
            'Authorization' => '124'
        ])->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'Buku not found'
                    ]
                ]
            ]);
    }

    public function testSearchByJudul()
    {
        $this->seed([UserSeeder::class, SearchSeeder::class]);

        $response = $this->get('/api/books?search=judul1', [
            'Authorization' => '123'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));
    }
    public function testSearchByPenulis()
    {
        $this->seed([UserSeeder::class, SearchSeeder::class]);

        $response = $this->get('/api/books?search=penulis4', [
            'Authorization' => '123'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));
    }
    public function testSearchByIsbn()
    {
        $this->seed([UserSeeder::class, SearchSeeder::class]);

        $response = $this->get('/api/books?search=1234567890127', [
            'Authorization' => '123'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));
    }
    public function testSearchNotFound()
    {
        $this->seed([UserSeeder::class, SearchSeeder::class]);

        $response = $this->get('/api/books?search=alamak', [
            'Authorization' => '123'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));
    }

    // public function testUpdateSuccess()
    // {
    //     $this->seed([UserSeeder::class, KategoriSeeder::class, BukuSeeder::class]);
    //     $buku = Buku::query()->limit(1)->first();

    //     $this->put('/api/books/' . $buku->isbn, [
    //             'sampul' => 'https://example.com/sampul.jpg',
    //             'judul' => 'tes ubah',
    //             'kategori' => 'tes',
    //             'penulis' => 'tes ubah',
    //             'penerbit' => 'tes ubah',
    //             'deskripsi' => 'tes ubah',
    //             'tahun_terbit' => '2023',
    //             'jumlah_tersedia' => 10
    //     ], [
    //         'Authorization' => '124'    
    //     ]
    //     )->assertStatus(200)
    //         ->assertJson([
    //             'data' => [
    //                 'sampul' => 'https://example.com/sampul.jpg',
    //                 'judul' => 'tes ubah',
    //                 'kategori' => 'tes',
    //                 'penulis' => 'tes ubah',
    //                 'penerbit' => 'tes ubah',
    //                 'deskripsi' => 'tes ubah',
    //                 'tahun_terbit' => '2023',
    //                 'jumlah_tersedia' => 10
    //             ]
    //         ]);
    // }

    // public function testUpdateValidationError()
    // {
    //     $this->seed([UserSeeder::class, KategoriSeeder::class, BukuSeeder::class]);
    //     $buku = Buku::query()->limit(1)->first();

    //     $this->put('/api/books/' . $buku->isbn, [
    //             'sampul' => 'https://example.com/sampul.jpg',
    //             'judul' => '',
    //             'kategori' => 'tes',
    //             'penulis' => 'tes ubah',
    //             'penerbit' => 'tes ubah',
    //             'deskripsi' => 'tes ubah',
    //             'tahun_terbit' => '2023',
    //             'jumlah_tersedia' => 10
    //     ], [
    //         'Authorization' => '124'    
    //     ]
    //     )->assertStatus(400)
    //         ->assertJson([
    //             'errors' => [
    //                 'judul' => [
    //                     'The judul field is required.'
    //                 ]
    //             ]
    //         ]);
    // }

    public function testDeleteSuccess()
    {
        $this->seed([UserSeeder::class, KategoriSeeder::class, BukuSeeder::class]);
        $buku = Buku::query()->limit(1)->first();

        $this->delete('/api/books/' . $buku->isbn, [

        ],[
            'Authorization' => '124'    
        ]
        )->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);

    }
    public function testDeleteNotFound()
    {
        $this->seed([UserSeeder::class, KategoriSeeder::class, BukuSeeder::class]);
        $buku = Buku::query()->limit(1)->first();

        $this->delete('/api/books/' . ($buku->isbn + 5), [

        ],[
            'Authorization' => '124'    
        ]
        )->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'Buku not found'
                    ]
                ]
            ]);
    }

    public function testGetListByKategoriSuccess()
    {
        $this->seed([UserSeeder::class, SearchSeeder::class]);
        $response = $this->get('/api/books/kategori/tes3', [
            'Authorization' => '123'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));
    }
}
