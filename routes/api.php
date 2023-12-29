<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\PermintaanController;
use App\Http\Controllers\Api\PresensiController;
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

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/handle-presensi', [PresensiController::class, 'handlePresensi']);
    Route::post('/handle-permintaan', [PermintaanController::class, 'handlePermintaan']);
});
