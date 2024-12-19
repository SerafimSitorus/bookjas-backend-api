<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/kategori', [KategoriController::class, 'list']);

Route::middleware('api:User,Admin')->group(function () {
    Route::get('/users', [UserController::class, 'get']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::patch('/update-password', [UserController::class, 'updatePassword']);
    Route::patch('/updateProfile', [UserController::class, 'updateProfile']);
    Route::patch('/updateProfilePicture', [UserController::class, 'updateProfilePicture']);
    Route::get('/getProfilePicture', [UserController::class, 'getProfilePicture']);
    
    Route::get('/kategori{kategori}', [KategoriController::class, 'get']);
    Route::post('/kategori', [KategoriController::class, 'create']);
    Route::put('/kategori{kategori}', [KategoriController::class, 'update']);
    Route::delete('/kategori{kategori}', [KategoriController::class, 'delete']);
    
    Route::get('/books/{isbn}', [BukuController::class, 'get']);
    Route::get('/books', [BukuController::class, 'search']);
    Route::get('/books/kategori/{kategori}', [BukuController::class, 'getListByKategori']);

    Route::post('/peminjaman', [PeminjamanController::class, 'create']);
    Route::put('/peminjaman/user/{user_id}/isbn/{isbn}', [PeminjamanController::class, 'kembalikan']);
    Route::get('/peminjaman/user/{user_id}', [PeminjamanController::class, 'getByUser']);
    Route::get('/peminjaman', [PeminjamanController::class, 'search']);
    Route::get('/peminjaman/pinjamuser', [PeminjamanController::class, 'searchUser']);
    Route::get('/peminjaman/pinjambuku', [PeminjamanController::class, 'searchBuku']);
});

Route::middleware('api:Admin')->group(function () {
    Route::post('/books', [BukuController::class, 'create']);
    Route::put('/books/{isbn}', [BukuController::class, 'update']);
    Route::delete('/books/{isbn}', [BukuController::class, 'delete']);
});

