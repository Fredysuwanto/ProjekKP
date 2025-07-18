<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PerpanjangsuratController;

// ==========================
// Halaman Utama (HARUS login)
// ==========================
Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified']);

// ==========================
// Login Fallback
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
// Dashboard (untuk semua user login)
// ==========================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ==========================
// Group untuk User Login & Terverifikasi
// ==========================
Route::middleware(['auth', 'verified'])->group(function () {

    // ======== Untuk Role PEMILIK (b) ========
    Route::middleware('role:b')->group(function () {
        Route::resource('pemilik', PemilikController::class);
        Route::resource('kapal', KapalController::class);
        Route::get('/kapal/{kapal}/detail', [KapalController::class, 'show'])->name('kapal.show');
        Route::resource('riwayat', RiwayatController::class);
        Route::get('/riwayat/detail/{id}', [RiwayatController::class, 'show'])->name('riwayat.detail');
        Route::get('/riwayat/detail2/{id}', [RiwayatController::class, 'show2'])->name('riwayat.detail2');
    });

    // ======== Dapat Diakses Admin & Pemilik: Unduh PDF Surat ========
    Route::get('/riwayat/cetak/{id}', [RiwayatController::class, 'cetakPDF'])->name('riwayat.cetak');
    Route::get('/riwayat/cetak2/{id}', [RiwayatController::class, 'cetakPDF2'])->name('riwayat.cetak2');

    // ======== Shared: Admin & Pemilik akses surat ========
    Route::resource('surat', SuratController::class);
    Route::get('/surat/proses/{id}', [SuratController::class, 'proses'])->name('surat.proses');
    Route::get('/surat/tolak/{id}', [SuratController::class, 'tolak'])->name('surat.tolak');
    Route::get('/kapal/proses/{kapal}', [KapalController::class, 'proses'])->name('kapal.proses');
    Route::get('/kapal/tolak/{kapal}', [KapalController::class, 'tolak'])->name('kapal.tolak');
Route::get('/proses', [KapalController::class, 'proses'])->name('kapal.proses');


    Route::resource('perpanjangsurat', PerpanjangsuratController::class);
    Route::get('/perpanjangsurat/proses2/{id}', [PerpanjangsuratController::class, 'proses2'])->name('perpanjangsurat.proses2');
    Route::get('/perpanjangsurat/tolak/{id}', [PerpanjangsuratController::class, 'tolak'])->name('perpanjangsurat.tolak');

    // ======== Halaman Tentang Kami ========
    Route::get('/tentang/profil', fn() => view('pages.profil'))->name('tentang.profil');
    Route::get('/tentang/visi-misi', fn() => view('pages.visi_misi'))->name('tentang.visi');
    Route::get('/tentang/kontak', fn() => view('pages.kontak'))->name('tentang.kontak');

    // ======== Umum (untuk semua user login) ========
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ======== Untuk Role ADMIN (a) ========
Route::middleware(['auth', 'verified', 'role:a'])->group(function () {
    Route::resource('laporan', LaporanController::class);
    Route::get('/proses', [KapalController::class, 'prosesList'])->name('surat.prosesList');
    Route::get('/proses2', [PerpanjangsuratController::class, 'prosesList'])->name('perpanjangsurat.prosesList');

    // ✅ Tambahan khusus untuk pemrosesan kapal dari laporan
    Route::get('/laporan/proses/{kapal}', [LaporanController::class, 'proses'])->name('laporan.proses');
    Route::get('/laporan/tolak/{kapal}', [LaporanController::class, 'tolak'])->name('laporan.tolak');
});

// ==========================
// Route Auth
// ==========================
require __DIR__.'/auth.php';
// require __DIR__.'/profile.php';
