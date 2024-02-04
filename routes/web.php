<?php

use App\Http\Controllers\Web\AuthenticationWebController;
use App\Http\Controllers\Web\PegawaiWebController;
use App\Http\Controllers\Web\PelanggaranWebController;
use App\Http\Controllers\Web\PermintaanWebController;
use App\Http\Controllers\Web\PresensiWebController;
use App\Models\Presensi;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticationWebController::class, 'showLogin'])->name('login');
Route::post('/handle-login', [AuthenticationWebController::class, 'handleLogin'])->name('handle-login');
Route::post('/handle-logout', [AuthenticationWebController::class, 'handleLogout'])->name('handle-logout');

Route::middleware('auth')->group(function () {
    Route::get('/presensi', [PresensiWebController::class, 'showPresensi'])->name('presensi');
    Route::get('/detail-presensi/{tanggal_riwayat}', [PresensiWebController::class, 'showDetailPresensi'])->name('detail-presensi');
    Route::get('/rincian-presensi/{user_id}/{tanggal_riwayat}', [PresensiWebController::class, 'showRincianPresensi'])->name('rincian-presensi');
    Route::get('/rincian-permintaan/{user_id}/{tanggal_riwayat}', [PresensiWebController::class, 'showRincianPermintaan'])->name('rincian-permintaan');
    Route::get('/rekap-presensi', [PresensiWebController::class, 'showRekapPresensi'])->name('rekap-presensi');
    Route::get('/data-permintaan', [PermintaanWebController::class, 'showPermintaan'])->name('data-permintaan');
    Route::get('/data-izin', [PermintaanWebController::class, 'showDataIzin'])->name('data-izin');
    Route::get('/data-dinas', [PermintaanWebController::class, 'showDataDinas'])->name('data-dinas');
    Route::get('/data-cuti', [PermintaanWebController::class, 'showDataCuti'])->name('data-cuti');
    Route::get('/data-pelanggaran', [PelanggaranWebController::class, 'showPelanggaran'])->name('data-pelanggaran');
    Route::get('/data-pegawai', [PegawaiWebController::class, 'showPegawai'])->name('data-pegawai');

    Route::post('/create-pegawai', [PegawaiWebController::class, 'handleCreatePegawai'])->name('create-pegawai');
    Route::put('/update-pegawai/{user_id}', [PegawaiWebController::class, 'handleUpdatePegawai'])->name('update-pegawai');
    Route::delete('/delete-pegawai/{user_id}', [PegawaiWebController::class, 'handleDeletePegawai'])->name('delete-pegawai');
    Route::post('/export-pdf-pegawai', [PegawaiWebController::class, 'handleExportPdf'])->name('export-pdf-pegawai');
    Route::post('/export-pdf-rekap-pegawai/{tanggal_riwayat}', [PresensiWebController::class, 'handleExportPdfRekapPegawai'])->name('export-pdf-rekap-pegawai');

    Route::prefix('/cari')->group(function () {
        Route::get('/pegawai', [PegawaiWebController::class, 'searchPegawai'])->name('cari-pegawai');
        Route::get('/rekap-riwayat', [PresensiWebController::class, 'searchPreviousRecap'])->name('cari-rekap-riwayat');
        Route::get('/rekap-riwayat-pegawai/{tanggal_riwayat}', [PresensiWebController::class, 'searchRekapRiwayatPegawai'])->name('cari-rekap-riwayat-pegawai');
    });
});
