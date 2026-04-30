<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::post('/pegawai', [PegawaiController::class, 'store']);
    Route::get('/pegawai/{id}', [PegawaiController::class, 'show']);
    Route::post('/pegawai/{id}', [PegawaiController::class, 'update']);
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy']);
    Route::get('/pegawai/search/{keyword}', [PegawaiController::class, 'search']);
    Route::get('/pegawai/filter/unit/{unitId}', [PegawaiController::class, 'filterByUnit']);
    Route::get('/pegawai/pdf/print', [PegawaiController::class, 'generatePdf']);

    Route::get('/master-data', [PegawaiController::class, 'masterData']);
});

