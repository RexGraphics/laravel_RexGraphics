<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RumahSakitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    if(Auth::check()){
        return redirect('rumah-sakit');
    }else{
        return redirect('login');

    }
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('rumah-sakit', RumahSakitController::class);
    Route::resource('pasien', PasienController::class)->except('show');

    Route::get('/pasien/filter', [PasienController::class, 'filter'])->name('pasien.filter');
});
