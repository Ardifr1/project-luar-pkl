<?php

use Illuminate\Support\Facades\Route;

// =========================
// CONTROLLERS API
// =========================

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MockApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LabController;
use App\Http\Controllers\Api\PeminjamanController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\MapelController;

// Controller Web yang memiliki method storeApi
use App\Http\Controllers\ControllerAjukanPeminjaman;


// =========================================================
// LOGIN
// =========================================================

// Login API
// POST /api/login
Route::post('/login', [LoginController::class, 'login']);


// =========================================================
// MOCK API
// =========================================================

// POST /api/mock
Route::post('/mock', [MockApiController::class, 'index']);


// =========================================================
// API YANG MEMBUTUHKAN LOGIN
// =========================================================

Route::middleware('auth:sanctum')->group(function () {


    // =====================================================
    // GURU
    // =====================================================

    // GET /api/guru
    Route::get('/guru', [
        UserController::class,
        'index'
    ]);

    // GET /api/guru/{id}
    Route::get('/guru/{id}', [
        UserController::class,
        'show'
    ]);

    // POST /api/guru
    Route::post('/guru', [
        UserController::class,
        'store'
    ]);

    // PUT /api/guru/{id}
    Route::put('/guru/{id}', [
        UserController::class,
        'update'
    ]);

    // DELETE /api/guru/{id}
    Route::delete('/guru/{id}', [
        UserController::class,
        'destroy'
    ]);


    // =====================================================
    // LAB
    // =====================================================

    // POST /api/lab
    Route::post('/lab', [
        LabController::class,
        'store'
    ]);

    // GET /api/lab/{id}
    Route::get('/lab/{id}', [
        LabController::class,
        'show'
    ]);

    // PUT /api/lab/{id}
    Route::put('/lab/{id}', [
        LabController::class,
        'update'
    ]);

    // DELETE /api/lab/{id}
    Route::delete('/lab/{id}', [
        LabController::class,
        'destroy'
    ]);


    // =====================================================
    // PEMINJAMAN LAB
    // =====================================================

    // -----------------------------------------------------
    // GURU MENGAJUKAN PEMINJAMAN
    // POST /api/peminjaman
    // -----------------------------------------------------

    Route::post('/peminjaman', [
        ControllerAjukanPeminjaman::class,
        'storeApi'
    ]);


    // -----------------------------------------------------
    // ADMIN MELIHAT SEMUA PENGAJUAN
    // GET /api/peminjaman
    // -----------------------------------------------------

    Route::get('/peminjaman', [
        PeminjamanController::class,
        'index'
    ]);


    // -----------------------------------------------------
    // GURU MELIHAT PENGAJUANNYA SENDIRI
    // GET /api/peminjaman/guru
    // -----------------------------------------------------

    Route::get('/peminjaman/guru', [
        PeminjamanController::class,
        'myPeminjaman'
    ]);


    // -----------------------------------------------------
    // ADMIN MENYETUJUI PEMINJAMAN
    // PUT /api/peminjaman/{id}/approve
    // -----------------------------------------------------

    Route::put('/peminjaman/{id}/approve', [
        PeminjamanController::class,
        'approve'
    ]);


    // -----------------------------------------------------
    // ADMIN MENOLAK PEMINJAMAN
    // PUT /api/peminjaman/{id}/reject
    // -----------------------------------------------------

    Route::put('/peminjaman/{id}/reject', [
        PeminjamanController::class,
        'reject'
    ]);


    // -----------------------------------------------------
    // GURU MEMBATALKAN PENGAJUAN
    // DELETE /api/peminjaman/{id}/cancel
    // -----------------------------------------------------

    Route::delete('/peminjaman/{id}/cancel', [
        PeminjamanController::class,
        'cancel'
    ]);


    // =====================================================
    // MAPEL
    // =====================================================

    // GET /api/mapel
    Route::get('/mapel', [
        MapelController::class,
        'index'
    ]);

    // POST /api/mapel
    Route::post('/mapel', [
        MapelController::class,
        'store'
    ]);

    // PUT /api/mapel/{id}
    Route::put('/mapel/{id}', [
        MapelController::class,
        'update'
    ]);

    // DELETE /api/mapel/{id}
    Route::delete('/mapel/{id}', [
        MapelController::class,
        'destroy'
    ]);


    // =====================================================
    // JADWAL LAB
    // =====================================================

    // GET /api/jadwal
    Route::get('/jadwal', [
        JadwalController::class,
        'index'
    ]);

});