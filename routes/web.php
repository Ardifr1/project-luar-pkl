<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\ControllerAjukanPeminjaman;
use App\Http\Controllers\ControllerGuru;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', [ControllerLogin::class, 'index'])->name('login');
Route::post('/login', [ControllerLogin::class, 'login']);

Route::get('/dashboard', [ControllerDashboard::class, 'index'])->name('dashboard');

Route::get('/ajukan-peminjaman', [ControllerAjukanPeminjaman::class, 'index'])
    ->name('ajukanpeminjaman');
Route::post('/ajukan-peminjaman', [ControllerAjukanPeminjaman::class, 'store'])
    ->name('ajukanpeminjaman.store');

Route::get('/guru', [ControllerGuru::class, 'index'])
    ->name('guru.index');

Route::get('/guru/create', [ControllerGuru::class, 'create'])
    ->name('guru.create');

Route::post('/guru', [ControllerGuru::class, 'store'])
    ->name('guru.store');

Route::get('/guru/{id}', [ControllerGuru::class, 'show'])
    ->name('guru.show');

Route::delete('/guru/{id}', [ControllerGuru::class, 'destroy'])
    ->name('guru.destroy');