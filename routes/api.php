<?php

use App\Http\Controllers\Api\AuthenticationApiController;
use App\Http\Controllers\Api\DataCollectionController;
use App\Http\Controllers\Api\PermintaanApiController;
use App\Http\Controllers\Api\PresensiApiController;
use App\Http\Controllers\Web\PengaturanController;
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
    Route::get('/riwayat-presensi/{user_id}', [DataCollectionController::class, 'getRiwayatPresensi']);
    Route::get('/riwayat-permintaan/{user_id}', [DataCollectionController::class, 'getRiwayatPermintaan']);
    Route::post('/handle-presensi-masuk', [PresensiApiController::class, 'handlePresensiMasuk']);
    Route::post('/handle-presensi-pulang/{user_id}', [PresensiApiController::class, 'handlePresensiPulang']);
    Route::post('/handle-permintaan', [PermintaanApiController::class, 'handlePermintaan']);
    Route::post('/change-password', [PengaturanController::class, 'handleChangePassword']);
});
