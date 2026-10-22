<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Terbuka untuk umum (dibatasi 5x per menit)
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

// Wajib bawa token
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', fn (Request $request) => $request->user());
    Route::post('/logout', [AuthController::class, 'logout']);
});
