<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\LaporanController;

// Halaman utama (public atau setelah login)
Route::get('/', function () {
    return view('layout.main'); // halaman utama website
});

// Route ke register custom
Route::get('/registernew', function () {
    return view('auth.registernew');
})->name('registernew');

// Grup route hanya untuk user yang login
Route::middleware(['auth', 'verified'])->group(function () {

    // CRUD: Pemilik, Kapal, Surat, Riwayat, Laporan
    Route::resource('pemilik', PemilikController::class);
    Route::resource('kapal', KapalController::class);
    Route::resource('surat', SuratController::class);
    Route::resource('riwayat', RiwayatController::class);
    Route::resource('laporan', LaporanController::class);
    Route::get('/proses', [SuratController::class, 'prosesList'])->name('surat.proses');

    // Custom route
    Route::get('/riwayat/cetak/{id}', [RiwayatController::class, 'cetakPDF'])->name('riwayat.cetak');
    Route::get('/surat/proses/{id}', [SuratController::class, 'proses'])->name('surat.proses');
    Route::get('/surat/tolak/{id}', [SuratController::class, 'tolak'])->name('surat.tolak');

    // Profile routes dari Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Breeze (login, register, dll)
require __DIR__.'/auth.php';
