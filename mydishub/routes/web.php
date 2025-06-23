<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\LaporanController;

// ==========================
// Halaman Utama
// ==========================
Route::get('/', function () {
    return view('layout.main');
});

// ==========================
// Login Fallback (untuk redirect logout)
// ==========================
Route::get('/login', function () {
    return redirect('/loginnew');
});

// ==========================
// Halaman Register Custom
// ==========================
Route::get('/registernew', function () {
    return view('auth.registernew');
})->name('registernew');

// ==========================
// Group untuk User Login & Terverifikasi
// ==========================
Route::middleware(['auth', 'verified'])->group(function () {

    // ======== Untuk Role PEMILIK (b) ========
    Route::middleware('role:b')->group(function () {
        Route::resource('pemilik', PemilikController::class);
        Route::resource('kapal', KapalController::class);
        Route::resource('riwayat', RiwayatController::class);

        Route::get('/riwayat/cetak/{id}', [RiwayatController::class, 'cetakPDF'])->name('riwayat.cetak');
    });

    // ======== Shared: Admin & Pemilik akses surat ========
    Route::resource('surat', SuratController::class);
    Route::get('/surat/proses/{id}', [SuratController::class, 'proses'])->name('surat.proses');
    Route::get('/surat/tolak/{id}', [SuratController::class, 'tolak'])->name('surat.tolak');

    // ======== Untuk Role ADMIN (a) ========
    Route::middleware('role:a')->group(function () {
        Route::resource('laporan', LaporanController::class);
        Route::get('/proses', [SuratController::class, 'prosesList'])->name('surat.prosesList');
    });

    // ======== Umum (untuk semua user login) ========
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// Route Auth (Login, Logout, Register)
// ==========================
require __DIR__.'/auth.php';
