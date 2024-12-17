<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(ApiAuthMiddleware::class)->group(function () {
    Route::get('/users', [UserController::class, 'get']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::patch('/updatePassword', [UserController::class, 'updatePassword']);
    Route::patch('/updateProfile', [UserController::class, 'updateProfile']);
    Route::patch('/updateProfilePicture', [UserController::class, 'updateProfilePicture']);
    Route::get('/getProfilePicture', [UserController::class, 'getProfilePicture']);
    
    Route::get('/kategori{kategori}', [KategoriController::class, 'get']);
    Route::post('/kategori', [KategoriController::class, 'create']);
    Route::put('/kategori{kategori}', [KategoriController::class, 'update']);
    Route::delete('/kategori{kategori}', [KategoriController::class, 'delete']);
    
});

