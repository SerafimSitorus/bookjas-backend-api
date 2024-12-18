<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function testRegisteredSuccess() 
    {
        $this->post('/api/register', [
            'nama' => 'Serafim Sitorus',
            'email' => 'serafim@gamil.com',
            'password' => 'serafim123',
            'password_confirmation' => 'serafim123'
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    'nama' => 'Serafim Sitorus',
                    'email' => 'serafim@gamil.com'
                ]
                ]);    
    }

    public function testRegisteredPasswordConfirmFailed() 
    {
        $this->post('/api/register', [
            'nama' => 'Serafim Sitorus',
            'email' => 'serafim@gamil.com',
            'password' => 'serafim123',
            'password_confirmation' => 'rifqi123'
        ])->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'password' => [
                        "The password field confirmation does not match."
                    ]
                ]
                ]);    
    }

    public function testRegisteredFailedEmail() 
    {
        $this->seed([UserSeeder::class]);
        $this->post('/api/register', [
            'nama' => 'Serafim Sitorus',
            'email' => 'edgar@gmail.com', 
            'password' => 'serafim123',
            'password_confirmation' => 'serafim123'
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'email' => [
                      'The email has already been taken.'  
                    ]
                ]
                ]);    
    }

    // public function testRegisteredFailedNamaAlreadyRegistered() 
    // {
    //     $this->seed([UserSeeder::class]);
    //     $this->post('/api/register', [
    //         'nama' => 'Serafim Sitorus',
    //         'email' => 'serafim@gmail.com',
    //         'password' => 'serafim123',
    //         'password_confirmation' => 'serafim123'
    //     ])->assertStatus(400)
    //         ->assertJson([
    //             "errors" => [
    //                 'nama' => [
    //                    'nama Serafim Sitorus already registered.'
    //                 ]
    //             ]
    //             ]);    
    // }

    public function testLoginSuccess() {
        $this->seed([UserSeeder::class]);
        $this->post('/api/login', [ 
            'email' => 'edgar@gmail.com',
            'password' => 'serafim123'
        ])->assertStatus(200)
            ->assertJson([
                "data" => [
                    'nama' => 'Serafim Sitorus',
                    'email' => 'edgar@gmail.com'
                ]
            ]);
        
        $user = User::where('email', 'edgar@gmail.com')->first();
        self::assertNotNull($user->token);
    }

    public function testLoginFailed() {
        $this->seed([UserSeeder::class]);
        $this->post('/api/login', [ 
            'email' => 'rifqi@gmail.com',
            'password' => 'serafim123'
        ])->assertStatus(401)
            ->assertJson([
                "errors" => [
                    'message' => [
                        'email or password wrong'
                    ]
                ]
            ]);
    }

    public function testGetSuccess() {
        $this->seed([UserSeeder::class]);
        $this->get('/api/users', [ 
            'Authorization' => '123'
        ])->assertStatus(200)
            ->assertJson([
                "data" => [
                    'nama' => 'Serafim Sitorus',
                    'email' => 'edgar@gmail.com'
                ]
        ]);
    }

    public function testGetFailed() {
        $this->seed([UserSeeder::class]);
        $this->get('/api/users')->assertStatus(401)
            ->assertJson([
                "errors" => [
                    'message' => [
                        'Unauthorized'
                    ]
                ]
        ]);
    }

    public function testLogoutSuccess() {
        $this->seed([UserSeeder::class]);
        $this->post(uri : '/api/logout', headers:[
            'Authorization' => 'luthfi123'
        ])->assertStatus(200)
            ->assertJson([
                "data" => true 
                ]);
    }

    public function testLogoutFailed() {
        $this->seed([UserSeeder::class]);
        $this->post(uri : '/api/logout', headers:[
            'Authorization' => 'rifqi123'
        ])->assertStatus(401)
            ->assertJson([
                "errors" => [
                    'message' => [
                        'Unauthorized'
                    ]
                ] 
                ]);
    }

    public function testUpdatePasswordSuccess() {
        $this->seed([UserSeeder::class]);
        $oldUser = User::where('nama', 'Serafim Sitorus')->first();
        $this->patch('/api/updatePassword',
        [
            'current_password' => 'serafim123',
            'password' => 'edgars123',
            'password_confirmation' => 'edgars123'
        ],
        [
            'Authorization' => 'luthfi123'
        ]
        )->assertStatus(200)
            ->assertJson([
                "data" => true
            ]);

        $newUser = User::where('nama', 'Serafim Sitorus')->first();
        self::assertNotEquals($oldUser->password, $newUser->password);
    }

    public function testUpdatePasswordFailedWrongPassword() {
        $this->seed([UserSeeder::class]);
        $this->patch('/api/updatePassword',
        [
            'current_password' => 'serafim125',
            'password' => 'edgars123',
            'password_confirmation' => 'edgars123'
        ],
        [
            'Authorization' => 'luthfi123'
        ]
        )->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'message' => [
                        'Password lama tidak cocok'
                    ]
                ]
            ]);
    }

    public function testUpdateProfileSuccess() {
        $this->seed([UserSeeder::class]);
        $oldUser = User::where('nama', 'Serafim Sitorus')->first();
        $this->patch('/api/updateProfile',
        [
            'nama' => 'Rifqi Jabrah',
            'email' => 'jabrah@gmail.com'
        ],
        [
            'Authorization' => 'luthfi123'
        ]
        )->assertStatus(200)
            ->assertJson([
                "data" => [
                    'nama' => 'Rifqi Jabrah',
                    'email' => 'jabrah@gmail.com'
                ]
            ]);

        $newUser = User::where('nama', 'Rifqi Jabrah')->first();
        self::assertNotEquals($oldUser->nama, $newUser->nama);
        self::assertNotEquals($oldUser->email, $newUser->email);
    }
}
