<?php

namespace Tests\Feature;

use App\Models\Kategori;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function testListSuccess() {
        $this->seed([UserSeeder::class, KategoriSeeder::class]);
        $this->get('/api/kategori')
            ->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);
    }

    public function testgetSuccess() {
        $this->seed([UserSeeder::class, KategoriSeeder::class]);
        $kategoris = Kategori::query()->limit(1)->first();
        $this->get('/api/kategori' . $kategoris->kategori, 
        [
            'Authorization' => 'luthfi123'
        ])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'kategori' => 'Horror0'
                ]
            ]);
    }

    public function testcreateSuccess() {
        $this->seed([UserSeeder::class, KategoriSeeder::class]);
        $this->post('/api/kategori', 
        [
            'kategori' => 'Petualangan'
        ],
        [
            'Authorization' => 'luthfi123'
        ])
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'kategori' => 'Petualangan'
                ]
            ]);
    }

    public function testUpdateSuccess() {
        $this->seed([UserSeeder::class, KategoriSeeder::class]);
        $oldkategoris = Kategori::query()->limit(1)->first();
        $this->put('/api/kategori' . $oldkategoris->kategori,
        [
            'kategori' => 'Petualangan'
        ],
        [
            'Authorization' => 'luthfi123'
        ])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'kategori' => 'Petualangan'
                ]
            ]);
        
        $newkategoris = Kategori::query()->limit(1)->first();

        self::assertNotEquals($oldkategoris->kategori, $newkategoris->kategori);
    }

    public function testDeleteSuccess() {
        $this->seed([UserSeeder::class, KategoriSeeder::class]);
        $oldkategoris = Kategori::query()->limit(1)->first();
        $this->delete('/api/kategori' . $oldkategoris->kategori,
        [
            'kategori' => 'Petualangan'
        ],
        [
            'Authorization' => 'luthfi123'
        ])
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Data deleted successfully'
            ]);
    }
}
