<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Login, logout, register: harus terbuka untuk umum
Auth::routes();


Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Master data
    Route::middleware('role:admin')->group(function(){
        Route::resource('kelas', KelasController::class)->except(['index','show']);
        Route::resource('siswa', SiswaController::class)->except(['index', 'show']);
        Route::resource('guru', GuruController::class)->except(['index', 'show']);
        Route::resource('mapel', MapelController::class)->except(['index', 'show']);
    });
    
    Route::resource('kelas', KelasController::class)->only('index');
    Route::resource('siswa', SiswaController::class)->only(['index', 'show']);
    Route::resource('guru', GuruController::class)->only('index');
    Route::resource('mapel', MapelController::class)->only('index');

    Route::resource('nilai', NilaiController::class)->except('show');
});