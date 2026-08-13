<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MockApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LabController;
use App\Http\Controllers\Api\PeminjamanController;
use App\Http\Controllers\ControllerAjukanPeminjaman;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/mock', [MockApiController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    
    // Menambahkan guru
    Route::post('/guru', [UserController::class, 'store']);
    // Mengedit guru 
    Route::put('/guru/{id}', [UserController::class, 'update']);
    // Menghapus guru
    Route::delete('/guru/{id}', [UserController::class, 'destroy']);

    Route::post('/lab', [LabController::class, 'store']);

    Route::get('/lab', [LabController::class, 'index']);

    // Melihat detail lab
Route::get('/lab/{id}', [LabController::class, 'show']);

// Mengedit lab
Route::put('/lab/{id}', [LabController::class, 'update']);

// Menghapus lab
Route::delete('/lab/{id}', [LabController::class, 'destroy']);

    Route::post('/peminjaman', [
    ControllerAjukanPeminjaman::class,
    'storeApi'
]);

    Route::get('/peminjaman', [PeminjamanController::class, 'index']);

    Route::put('/peminjaman/{id}/approve', [
        PeminjamanController::class,
        'approve'
    ]);

    Route::put('/peminjaman/{id}/reject', [
        PeminjamanController::class,
        'reject'
    ]);

    Route::get('/peminjaman/guru', [
        PeminjamanController::class,
        'myPeminjaman'
    ]);

});

