<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// ===== Auth =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== App (perlu login) =====
Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Kartu Keluarga
    Route::prefix('kartu-keluarga')->name('kk.')->group(function () {
        Route::get('/', [KartuKeluargaController::class, 'index'])->name('index');
        Route::get('/create', [KartuKeluargaController::class, 'create'])->name('create');
        Route::post('/', [KartuKeluargaController::class, 'store'])->name('store');
        Route::get('/{kk}/edit', [KartuKeluargaController::class, 'edit'])->name('edit');
        Route::put('/{kk}', [KartuKeluargaController::class, 'update'])->name('update');
        Route::get('/{kk}', [KartuKeluargaController::class, 'show'])->name('show');
        Route::delete('/{kk}', [KartuKeluargaController::class, 'destroy'])->name('destroy');
    });

    // Data Warga
    Route::prefix('warga')->name('warga.')->group(function () {
        Route::get('/', [WargaController::class, 'index'])->name('index');
        Route::get('/export', [WargaController::class, 'export'])->name('export');
        Route::get('/create', [WargaController::class, 'create'])->name('create');
        Route::post('/', [WargaController::class, 'store'])->name('store');
        Route::get('/{warga}/edit', [WargaController::class, 'edit'])->name('edit');
        Route::put('/{warga}', [WargaController::class, 'update'])->name('update');
        Route::get('/{warga}', [WargaController::class, 'show'])->name('show');
        Route::delete('/{warga}', [WargaController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Surat
    Route::prefix('surat')->name('surat.')->group(function () {
        Route::get('/', [SuratController::class, 'index'])->name('index');
        Route::get('/create', [SuratController::class, 'create'])->name('create');
        Route::post('/', [SuratController::class, 'store'])->name('store');
        Route::get('/{surat}/edit', [SuratController::class, 'edit'])->name('edit');
        Route::put('/{surat}', [SuratController::class, 'update'])->name('update');
        Route::delete('/{surat}', [SuratController::class, 'destroy'])->name('destroy');
        Route::get('/{surat}/cetak', [SuratController::class, 'cetak'])->name('cetak');
    });

    // Iuran Warga
    Route::prefix('iuran')->name('iuran.')->group(function () {
        Route::get('/', [IuranController::class, 'index'])->name('index');
        Route::get('/export', [IuranController::class, 'export'])->name('export');
        Route::get('/create', [IuranController::class, 'create'])->name('create');
        Route::post('/', [IuranController::class, 'store'])->name('store');
        Route::get('/{iuran}/edit', [IuranController::class, 'edit'])->name('edit');
        Route::put('/{iuran}', [IuranController::class, 'update'])->name('update');
        Route::delete('/{iuran}', [IuranController::class, 'destroy'])->name('destroy');
    });
});
