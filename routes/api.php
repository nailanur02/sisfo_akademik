<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\MapelController;
use App\Http\Controllers\Api\NilaiController;
use App\Http\Controllers\Api\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Prefix "api." supaya nama route tidak bentrok dengan route web (siswa.index, dll)
Route::name('api.')->group(function () {

    // Terbuka untuk umum (dibatasi 5x per menit)
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

    // Wajib bawa token
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', fn (Request $request) => $request->user());
        Route::post('/logout', [AuthController::class, 'logout']);

        // Lihat data: semua user yang login
        Route::apiResource('kelas', KelasController::class)->only(['index', 'show']);
        Route::apiResource('siswa', SiswaController::class)->only(['index', 'show']);
        Route::apiResource('guru', GuruController::class)->only(['index', 'show']);
        Route::apiResource('mapel', MapelController::class)->only(['index', 'show']);

        // Tambah / ubah / hapus: admin saja
        Route::middleware('role:admin')->group(function () {
            Route::apiResource('kelas', KelasController::class)->except(['index', 'show']);
            Route::apiResource('siswa', SiswaController::class)->except(['index', 'show']);
            Route::apiResource('guru', GuruController::class)->except(['index', 'show']);
            Route::apiResource('mapel', MapelController::class)->except(['index', 'show']);
        });

        // Nilai: admin dan guru
        Route::middleware('role:admin,guru')->group(function () {
            Route::apiResource('nilai', NilaiController::class);
        });
    });
});