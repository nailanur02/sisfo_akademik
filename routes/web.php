<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
Auth::routes();
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;

use Illuminate\Support\Facades\Route;

// Route Halaman Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// TODO: Buatlah Route Resource untuk Master Data Kelas
Route::resource('kelas', KelasController::class)->except('show');

// TODO: Buatlah Route Resource untuk Master Data Siswa
Route::resource('siswa', SiswaController::class);

// TODO: Buatlah Route Resource untuk Master Data Guru
Route::resource('guru', GuruController::class)->except('show');

// TODO: Buatlah Route Resource untuk Master Data Mata Pelajaran (Mapel)
Route::resource('mapel', MapelController::class)->except('show');

// TODO: Buatlah Route Resource untuk Data Nilai Akademik
Route::resource ('nilai', NilaiController::class)->except('show');


