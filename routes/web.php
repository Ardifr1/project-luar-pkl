<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\ControllerAjukanPeminjaman;
use App\Http\Controllers\ControllerGuru;
use App\Http\Controllers\ControllerDashboardAdmin;

use App\Http\Controllers\ControllerProfil;
use App\Http\Controllers\ProfiladminController;

use App\Http\Controllers\ControllerPassword;

use App\Http\Controllers\ControllerDataGuru;
use App\Http\Controllers\ControllerLab;
use App\Http\Controllers\Controllertambahguru;
use App\Http\Controllers\Controllereditdataguru;
use App\Http\Controllers\Controllertambahdatalab;
use App\Http\Controllers\Controllereditdatalab;
use App\Http\Controllers\Controllertambahmapel;
use App\Http\Controllers\Controllerdatamapel;
use App\Http\Controllers\Controllereditmapel;
use App\Http\Controllers\Controllerajuanlab;
use App\Http\Controllers\Controllerdetailajuan;

// =========================
// WELCOME
// =========================

Route::get('/', function () {
    return view('welcome');
});


// =========================
// LOGIN
// =========================

// Halaman login
Route::get('/login', [ControllerLogin::class, 'index'])
    ->name('login');

// Proses login
Route::post('/login', [ControllerLogin::class, 'login'])
    ->name('login.submit');


// =========================
// LOGIN ADMIN
// =========================

// Halaman login admin
Route::get('/login/admin', [ControllerLogin::class, 'admin'])
    ->name('login.admin');

// Proses login admin
Route::post('/login/admin', [ControllerLogin::class, 'loginAdmin'])
    ->name('login.admin.submit');


// =========================
// LOGIN GURU
// =========================

// Halaman login guru
Route::get('/login/guru', [ControllerLogin::class, 'guru'])
    ->name('login.guru');

// Proses login guru
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
// DATA GURU (ADMIN)
// =========================

// Menampilkan data guru
Route::get('/data-guru', [ControllerDataGuru::class, 'index'])
    ->name('data.guru');


// =========================
// TAMBAH GURU
// =========================

// Menampilkan halaman tambah guru
Route::get('/tambah-guru', [Controllertambahguru::class, 'index'])
    ->name('tambah.guru');

// Menyimpan data guru
Route::post('/tambah-guru', [Controllertambahguru::class, 'store'])
    ->name('tambah.guru.store');

// =========================
// EDIT GURU
// =========================

// Menampilkan halaman edit guru
Route::get('/editdataguru/{id}', [Controllereditdataguru::class, 'index'])
    ->name('edit.guru');

// Menyimpan perubahan data guru
Route::put('/editdataguru/{id}', [Controllereditdataguru::class, 'update'])
    ->name('update.guru');


// =========================
// HAPUS GURU
// =========================

// Menghapus data guru
Route::delete('/data-guru/{id}', [ControllerDataGuru::class, 'destroy'])
    ->name('data.guru.destroy');


// =========================
// DATA LAB (ADMIN)
// =========================

// Menampilkan data lab
Route::get('/data-lab', [ControllerLab::class, 'index'])
    ->name('data.lab');


// =========================
// TAMBAH LAB
// =========================

// Menampilkan halaman tambah lab
Route::get('/tambah-datalab', [Controllertambahdatalab::class, 'index'])
    ->name('tambah.datalab');

// Menyimpan data lab
Route::post('/tambah-datalab', [Controllertambahdatalab::class, 'store'])
    ->name('tambah.datalab.store');


// =========================
// EDIT LAB
// =========================

// Menampilkan halaman edit lab
Route::get('/edit-datalab/{id}', [Controllereditdatalab::class, 'index'])
    ->name('edit.datalab');

// Menyimpan perubahan data lab
Route::put('/edit-datalab/{id}', [Controllereditdatalab::class, 'update'])
    ->name('update.datalab');


// =========================
// HAPUS LAB
// =========================

// Menghapus data lab
Route::delete('/data-lab/{id}', [ControllerLab::class, 'destroy'])
    ->name('hapus.datalab');


// =========================
// TAMBAH MAPEL
// =========================
Route::get('/tambah-mapel',[Controllertambahmapel::class,'index']);

// =========================
// DATA MAPEL
// =========================
Route::get('/datamapel',[Controllerdatamapel::class,'index']);

// =========================
// EDIT MAPEL
// =========================
Route::get('edit-datamapel',[Controllereditmapel::class,'index']);

// =========================
// DAFTAR AJUAN LAB ADMIN
// =========================
Route::get('daftar-ajuan',[Controllerajuanlab::class,'index']);

// =========================
// DETAIL AJUAN LAB ADMIN
// =========================
Route::get('detail-ajuan',[Controllerdetailajuan::class,'index']);

// =========================
// PEMINJAMAN LAB
// =========================

// Halaman ajukan peminjaman
Route::get('/ajukan-peminjaman', [ControllerAjukanPeminjaman::class, 'index'])
    ->name('ajukanpeminjaman');

// Proses ajukan peminjaman
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


// =========================
// PROFIL
// =========================

// Profil guru
Route::get('/profil-guru', [ControllerProfil::class, 'guru'])
    ->name('profil.guru');

// Profil admin
Route::get('/profil-admin', [ProfiladminController::class, 'admin'])
    ->name('profil.admin');


// =========================
// UBAH PASSWORD
// =========================

// Halaman ubah password
Route::get('/ubah-password', [ControllerPassword::class, 'edit'])
    ->name('ubah.password');

// Proses ubah password
Route::post('/ubah-password', [ControllerPassword::class, 'update'])
    ->name('ubah.password.update');


// =========================
// LOGOUT
// =========================

Route::post('/logout', [ControllerLogin::class, 'logout'])
    ->name('logout');