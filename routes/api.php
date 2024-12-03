<?php

use App\Http\Controllers\API\PembayaranController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/user')->group(function () {
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.jwt');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth.jwt');
    Route::get('/current-user', [AuthController::class, 'me'])->middleware('auth.jwt');
});

Route::middleware(['auth.jwt'])->prefix('/payments')->group(function () {
    Route::get('/history', [PembayaranController::class, 'getTransactionHistory']);
    Route::put('/verify/{id}', [PembayaranController::class, 'verifyPayment']);
});