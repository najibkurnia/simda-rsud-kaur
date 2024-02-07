<?php

use App\Http\Controllers\Web\AuthenticationWebController;
use App\Http\Controllers\Web\PegawaiWebController;
use App\Http\Controllers\Web\PelanggaranWebController;
use App\Http\Controllers\Web\PengaturanController;
use App\Http\Controllers\Web\PermintaanWebController;
use App\Http\Controllers\Web\PresensiWebController;
use App\Models\Presensi;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticationWebController::class, 'showLogin'])->name('login');
Route::post('/handle-login', [AuthenticationWebController::class, 'handleLogin'])->name('handle-login');
Route::post('/handle-logout', [AuthenticationWebController::class, 'handleLogout'])->name('handle-logout');

Route::middleware('auth')->group(function () {
    // general routes
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
    Route::get('/pengaturan', [PengaturanController::class, 'showPengaturan'])->name('pengaturan');

    // crud data routes
    Route::post('/create-pegawai', [PegawaiWebController::class, 'handleCreatePegawai'])->name('create-pegawai');
    Route::put('/update-pegawai/{user_id}', [PegawaiWebController::class, 'handleUpdatePegawai'])->name('update-pegawai');
    Route::delete('/delete-pegawai/{user_id}', [PegawaiWebController::class, 'handleDeletePegawai'])->name('delete-pegawai');

    Route::post('/create-rule', [PengaturanController::class, 'handleCreateRule'])->name('create-rule');
    Route::delete('/delete-rule/{rule_id}', [PengaturanController::class, 'handleDeleteRule'])->name('delete-rule');
    Route::put('/use-rule/{rule_id}', [PengaturanController::class, 'handleUseRule'])->name('use-rule');

    Route::post('/create-jaringan', [PengaturanController::class, 'handleCreateJaringan'])->name('create-jaringan');
    Route::delete('/delete-jaringan/{jaringan_id}', [PengaturanController::class, 'handleDeleteJaringan'])->name('delete-jaringan');

    Route::put('/accepted/{permintaan_id}', [PermintaanWebController::class, 'handleAccepted'])->name('accepted');
    Route::put('/rejected/{permintaan_id}', [PermintaanWebController::class, 'handleRejected'])->name('rejected');
    Route::put('/upload-attachment/{permintaan_id}', [PermintaanWebController::class, 'handleUploadAttachment'])->name('upload-attachment');

    // export data routes
    Route::post('/export-pdf-pegawai', [PegawaiWebController::class, 'handleExportPdf'])->name('export-pdf-pegawai');
    Route::post('/export-pdf-rekap-pegawai/{tanggal_riwayat}', [PresensiWebController::class, 'handleExportPdfRekapPegawai'])->name('export-pdf-rekap-pegawai');
    Route::post('/export-pdf-rekap-bulanan', [PresensiWebController::class, 'handleExportPdfRekapBulanan'])->name('export-pdf-rekap-bulanan');
    Route::post('/export-pdf-permintaan', [PermintaanWebController::class, 'handleExportPdfPermintaan'])->name('export-pdf-permintaan');
    Route::post('/export-pdf-dinas', [PermintaanWebController::class, 'handleExportPdfDinas'])->name('export-pdf-dinas');
    Route::post('/export-pdf-izin', [PermintaanWebController::class, 'handleExportPdfIzin'])->name('export-pdf-izin');
    Route::post('/export-pdf-cuti', [PermintaanWebController::class, 'handleExportPdfCuti'])->name('export-pdf-cuti');
    Route::post('/export-pdf-pelanggaran', [PelanggaranWebController::class, 'handleExportPdfPelanggaran'])->name('export-pdf-pelanggaran');

    // find data routes
    Route::prefix('/cari')->group(function () {
        Route::get('/pegawai', [PegawaiWebController::class, 'searchPegawai'])->name('cari-pegawai');
        Route::get('/rekap-riwayat', [PresensiWebController::class, 'searchPreviousRecap'])->name('cari-rekap-riwayat');
        Route::get('/rekap-riwayat-pegawai/{tanggal_riwayat}', [PresensiWebController::class, 'searchRekapRiwayatPegawai'])->name('cari-rekap-riwayat-pegawai');
        Route::get('/rekap-bulanan-pegawai', [PresensiWebController::class, 'searchPegawaiRekapPresensi'])->name('cari-rekap-bulanan-pegawai');
        Route::get('/permintaan', [PermintaanWebController::class, 'searchPermintaan'])->name('cari-permintaan');
        Route::get('/dinas', [PermintaanWebController::class, 'searchDinas'])->name('cari-dinas');
        Route::get('/izin', [PermintaanWebController::class, 'searchIzin'])->name('cari-izin');
        Route::get('/cuti', [PermintaanWebController::class, 'searchCuti'])->name('cari-cuti');
        Route::get('/pelanggaran', [PelanggaranWebController::class, 'searchPelanggaran'])->name('cari-pelanggaran');
    });
});
