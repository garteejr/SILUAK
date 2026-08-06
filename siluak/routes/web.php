<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| AUTH (login dan logout admin)
|--------------------------------------------------------------------------
*/
Route::prefix('login')->group(function () {
    Route::get('/admin', [LoginController::class, 'showAdmin'])->name('login.admin');
    Route::post('/admin', [LoginController::class, 'processAdmin'])->name('login.post.admin');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| UMPEG
|--------------------------------------------------------------------------
*/
Route::get('/', [PortalController::class, 'index'])->name('welcome');

Route::prefix('umpeg')->name('umpeg.')->group(function () {
    // laporan
    Route::get('/laporan/bmd', [LaporanController::class, 'bmd'])->name('laporan.bmd');
    Route::post('/laporan/bmd/store', [LaporanController::class, 'storeBMD'])->name('laporan.bmd.store');

    Route::get('/laporan/kerusakan_alat', [LaporanController::class, 'kerusakan_alat'])->name('laporan.kerusakan_alat');
    Route::post('/laporan/kerusakan_alat/store', [LaporanController::class, 'storeKerusakanAlat'])->name('laporan.kerusakan_alat.store');

    Route::get('/laporan/kerusakan_gedung', [LaporanController::class, 'kerusakan_gedung'])->name('laporan.kerusakan_gedung');
    Route::post('/laporan/kerusakan_gedung/store', [LaporanController::class, 'storeKerusakanGedung'])->name('laporan.kerusakan_gedung.store');

    Route::get('/laporan/pinjam_kendaraan', [LaporanController::class, 'pinjam_kendaraan'])->name('laporan.pinjam_kendaraan');
    Route::post('/laporan/pinjam_kendaraan/store', [LaporanController::class, 'storePinjamKendaraan'])->name('laporan.pinjam_kendaraan.store');
    Route::get('/laporan/pinjam_kendaraan/download/{id}', [LaporanController::class, 'downloadTemplate'])->name('pinjam_kendaraan.download');
    Route::post('/laporan/pinjam_kendaraan/upload/{id}', [LaporanController::class, 'uploadSuratKendaraan'])->name('pinjam_kendaraan.upload');

    Route::get('/laporan/pinjam_ruangan', [LaporanController::class, 'pinjam_ruangan'])->name('laporan.pinjam_ruangan');
    Route::post('/laporan/pinjam_ruangan/store', [LaporanController::class, 'storePinjamRuangan'])->name('laporan.pinjam_ruangan.store');

    Route::get('/laporan/atk', [LaporanController::class, 'atk'])->name('laporan.atk');
    Route::post('/laporan/atk/store', [LaporanController::class, 'storeAtk'])->name('laporan.atk.store');
});

// layanan
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::post('/layanan/store/{jenis}', [LayananController::class, 'store'])->name('layanan.store');
Route::get('/layanan/detail/{id}', [LayananController::class, 'show'])->name('layanan.show');

/*
|--------------------------------------------------------------------------
| ADMIN UMPEG (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/manajemen-stok', [AdminController::class, 'stok_index'])->name('admin.manajemen');

    Route::post('/admin/update-status/{type}/{id}', [AdminController::class, 'updateStatus'])
        ->name('admin.update_status');

    // BMD
    Route::prefix('bmd')->group(function () {
        Route::get('/', [AdminController::class, 'bmd'])->name('admin.bmd');
        Route::name('admin.bmd.')->group(function() {
            Route::get('/detail/{id}', [AdminController::class, 'bmd_detail'])->name('detail');
            Route::post('/update/{id}', [AdminController::class, 'bmd_update_status'])->name('update');
            Route::post('/export-excel', [AdminController::class, 'exportBmdExcel'])->name('export.excel');
            Route::get('/export-item/{id}', [AdminController::class, 'exportBmdPdfItem'])->name('export.item');
        });
    });

    // MANAJEMEN STOK
    Route::prefix('manajemen')->name('admin.manajemen.')->group(function () {
        Route::get('/stok', [AdminController::class, 'stok_index'])->name('index'); 
        Route::get('/detail/{id}', [AdminController::class, 'stok_detail'])->name('detail');
        Route::get('/create', [AdminController::class, 'stok_add'])->name('create');
        Route::post('/store', [AdminController::class, 'stok_store'])->name('store');
        Route::post('/update/{id}', [AdminController::class, 'stok_update'])->name('update');
        Route::delete('/destroy/{id}', [AdminController::class, 'stok_destroy'])->name('destroy');
        Route::post('/export-excel', [AdminController::class, 'exportManajemenExcel'])->name('export.excel');
    });

    // LAPORAN
    Route::prefix('laporan')->name('admin.laporan.')->group(function () {
        // PERALATAN
        Route::prefix('peralatan')->group(function() {
            Route::get('/', [AdminController::class, 'peralatan'])->name('peralatan');
            Route::name('peralatan.')->group(function() {
                Route::post('/store', [AdminController::class, 'peralatan_store'])->name('store');
                Route::get('/detail/{id}', [AdminController::class, 'peralatan_detail'])->name('detail');
                Route::post('/update/{id}', [AdminController::class, 'peralatan_update'])->name('update');
                Route::post('/export-excel', [AdminController::class, 'exportPeralatanExcel'])->name('export.excel');
                Route::get('/export-item/{id}', [AdminController::class, 'exportPeralatanPdfItem'])->name('export.item');
            });
        });
        // GEDUNG
        Route::prefix('gedung')->group(function() {
            Route::get('/', [AdminController::class, 'gedung'])->name('gedung');
            Route::name('gedung.')->group(function() {
                Route::post('/store', [AdminController::class, 'gedung_store'])->name('store');   
                Route::get('/detail/{id}', [AdminController::class, 'gedung_detail'])->name('detail');
                Route::post('/update/{id}', [AdminController::class, 'gedung_update'])->name('update');
                Route::post('/export-excel', [AdminController::class, 'exportGedungExcel'])->name('export.excel');
                Route::get('/export-item/{id}', [AdminController::class, 'exportGedungPdfItem'])->name('export.item');
            });
        });
    });

    // PEMINJAMAN
    Route::prefix('peminjaman')->name('admin.peminjaman.')->group(function () {
        // KENDARAAN
        Route::get('/kendaraan', [AdminController::class, 'kendaraan'])->name('kendaraan');
        Route::get('/kendaraan/detail/{id}', [AdminController::class, 'kendaraan_detail'])->name('kendaraan_detail');
        Route::get('/kendaraan/export-kendaraan', [AdminController::class, 'exportKendaraanExcel'])->name('kendaraan.export.excel');
        // RUANGAN
        Route::get('/ruang', [AdminController::class, 'ruang'])->name('ruang');
        Route::get('/ruang/detail/{id}', [AdminController::class, 'ruang_detail'])->name('ruang_detail');
        Route::get('/ruang/export-ruang', [AdminController::class, 'exportRuanganExcel'])->name('ruang.export.excel');
    });

    // ATK
    Route::prefix('atk')->group(function () {
        Route::get('/', [AdminController::class, 'atk'])->name('admin.atk.atk');         
        Route::get('/detail', [AdminController::class, 'atk_detail'])->name('admin.atk.detail');
        Route::post('/atk/export-excel', [AdminController::class, 'exportAtkExcel'])->name('admin.atk.export.excel');
    });

    // Route untuk manajemen menu layanan baru di admin 
    Route::get('/admin/layanan/index', [AdminController::class, 'layanan_index'])->name('admin.layanan.index');
    Route::get('/admin/layanan/add', [AdminController::class, 'layanan_add'])->name('admin.layanan.create');
    Route::post('/admin/layanan/store', [AdminController::class, 'layanan_store'])->name('admin.layanan.store');
    Route::post('/admin/layanan/toggle/{id}', [AdminController::class, 'layanan_toggle'])->name('admin.layanan.toggle');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
