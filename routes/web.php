<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('rumah-sakit', RumahSakitController::class);
    Route::resource('pasien', PasienController::class);

    Route::get('/pasien/filter/{id}', [PasienController::class, 'filterByRumahSakit']);
    Route::delete('/pasien/{id}', [PasienController::class, 'destroy']);
});
