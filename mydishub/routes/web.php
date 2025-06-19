<?php

use App\Http\Controllers\KapalController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
Route::get('/', function () {
    return view('layout.main');
});
Route::resource('pemilik',PemilikController::class);
Route::resource('kapal',KapalController::class);
Route::resource('surat', SuratController::class);
Route::resource('riwayat', RiwayatController::class);
Route::resource('laporan', LaporanController::class);

Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
Route::get('/riwayat/cetak/{id}', [RiwayatController::class, 'cetakPDF'])->name('riwayat.cetak');

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/surat/proses/{id}', [SuratController::class, 'proses'])->name('surat.proses');
Route::get('/surat/tolak/{id}', [SuratController::class, 'tolak'])->name('surat.tolak');
Route::post('/logout', function () {


    // logika logout manual
    Auth::logout();
    return redirect('/');
})->name('logout');
