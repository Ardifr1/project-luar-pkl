<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\ControllerAjukanPeminjaman;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [ControllerLogin::class, 'index'])-> name('login');
Route::post('/login', [ControllerLogin::class, 'login']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/ajukan-peminjaman', [ControllerAjukanPeminjaman::class, 'index'])->name('ajukanpeminjaman');