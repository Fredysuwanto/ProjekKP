<?php
use App\Http\Controllers\KapalController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.main');
});
