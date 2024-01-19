<?php

use App\Http\Controllers\Api\AuthenticationApiController;
use App\Http\Controllers\Api\PermintaanApiController;
use App\Http\Controllers\Api\PresensiApiController;
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

Route::post('/login', [AuthenticationApiController::class, 'login']);
Route::post('/logout', [AuthenticationApiController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/handle-presensi', [PresensiApiController::class, 'handlePresensi']);
    Route::post('/handle-permintaan', [PermintaanApiController::class, 'handlePermintaan']);
});
