<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::create([
            'id' => '9dc0b676-c615-414d-a303-15ea13a48b75',
            'nama' => 'Serafim Sitorus',
            'password' => Hash::make('password'),
            'email' => 'edgar@gmail.com',
            'token' => '123'
        ]);
        User::create([
            'nama' => 'Rifqi',
            'password' => Hash::make('password'),
            'email' => 'rifqi@gmail.com',
            'status' => 'Admin',
            'token' => '124'
        ]);
        User::create([
            'nama' => 'Muhammad Luthfi',
            'password' => Hash::make('password'),
            'email' => 'luthfim904@gmail.com',
            'status' => 'User',
            'token' => '1'
        ]);
    }
}