<?php

use App\Http\Controllers\BukuController;
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

Route::middleware('api:User,Admin')->group(function () {
    Route::get('/users', [UserController::class, 'get']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/books/{isbn}', [BukuController::class, 'get']);
    Route::get('/books', [BukuController::class, 'search']);
});

Route::middleware('api:Admin')->group(function () {
    Route::post('/books', [BukuController::class, 'create']);
    Route::put('/books/{isbn}', [BukuController::class, 'update']);
    Route::delete('/books/{isbn}', [BukuController::class, 'delete']);
});

