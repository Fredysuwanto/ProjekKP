<?php

use App\Http\Controllers\KapalController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});
Route::resource('pemilik',PemilikController::class);
Route::resource('kapal',KapalController::class);
Route::resource('surat', SuratController::class);
Route::resource('riwayat', RiwayatController::class);


Route::post('/logout', function () {
    // logika logout manual
    Auth::logout();
    return redirect('/');
})->name('logout');
