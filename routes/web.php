<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\ControllerAjukanPeminjaman;
use App\Http\Controllers\ControllerGuru;
use App\Http\Controllers\ControllerDashboardAdmin;

use App\Http\Controllers\ControllerProfil;

use App\Http\Controllers\ControllerPassword; 

Route::get('/', function () {
    return view('welcome');
});


// =========================
// LOGIN
// =========================

// Halaman pilihan: Admin atau Guru
Route::get('/login', [ControllerLogin::class, 'index'])
    ->name('login');

Route::post('/login', [ControllerLogin::class, 'login'])
    ->name('login.submit');

// =========================
// LOGIN ADMIN
// =========================

// Menampilkan halaman login admin
Route::get('/login/admin', [ControllerLogin::class, 'admin'])
    ->name('login.admin');

// Memproses login admin
Route::post('/login/admin', [ControllerLogin::class, 'loginAdmin'])
    ->name('login.admin.submit');


// =========================
// LOGIN GURU
// =========================

// Menampilkan halaman login guru
Route::get('/login/guru', [ControllerLogin::class, 'guru'])
    ->name('login.guru');

// Memproses login guru
Route::post('/login/guru', [ControllerLogin::class, 'loginGuru'])
    ->name('login.guru.submit');


// =========================
// DASHBOARD
// =========================

Route::get('/dashboard', [ControllerDashboard::class, 'index'])
    ->name('dashboard');
    
Route::get('/dashboardadmin', [ControllerDashboardAdmin::class, 'index'])
    ->name('dashboardadmin');



// =========================
// PEMINJAMAN LAB
// =========================

Route::get('/ajukan-peminjaman', [ControllerAjukanPeminjaman::class, 'index'])
    ->name('ajukanpeminjaman');

Route::post('/ajukan-peminjaman', [ControllerAjukanPeminjaman::class, 'store'])
    ->name('ajukanpeminjaman.store');


// =========================
// GURU
// =========================

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



Route::get('/profil-guru', [ControllerProfil::class, 'guru'])
    ->name('profil.guru');

// =========================
// UBAH PASSWORD
// =========================

Route::get('/ubah-password', [ControllerPassword::class, 'edit'])
    ->name('ubah.password');

Route::post('/ubah-password', [ControllerPassword::class, 'update'])
    ->name('ubah.password.update');

    // =========================
    // LOGOUT   
    // =========================

Route::get('/logout', [ControllerLogin::class, 'logout'])
    ->name('logout');

