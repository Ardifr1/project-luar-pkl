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

    Route::post('/guru', [UserController::class, 'store']);

    Route::post('/lab', [LabController::class, 'store']);

    Route::get('/lab', [LabController::class, 'index']);

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

