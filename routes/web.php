<?php

use App\Http\Controllers\Controllerstatusajukan;
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
use App\Http\Controllers\Controllerpilihanlab;
use App\Http\Controllers\ControllerLaporanAdmin;
use App\Http\Controllers\ControllerLaporanGuru;
use App\Http\Controllers\Controllerjadwaldipinjam;
use App\Http\Controllers\Controllerubahpassword;

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
Route::get('/tambah-datamapel', [Controllertambahmapel::class, 'index'])
    ->name('tambah.mapel');

Route::post('/tambah-datamapel', [Controllertambahmapel::class, 'store'])
    ->name('simpan.mapel');

// =========================
// DATA MAPEL
// =========================
Route::get('/datamapel',[Controllerdatamapel::class,'index'])
        ->name('data.mapel');

// =========================
// EDIT MAPEL
// =========================
Route::get('/edit-datamapel/{id}', [Controllereditmapel::class, 'index'])
    ->name('edit.mapel');

Route::put('/edit-datamapel/{id}', [Controllereditmapel::class, 'update'])
    ->name('update.mapel');
// =========================
// HAPUS MAPEL
// =========================
Route::delete('/hapus-mapel/{id}', [Controllerdatamapel::class, 'destroy'])
    ->name('hapus.mapel');

// =========================
// DAFTAR AJUAN LAB ADMIN
// =========================

Route::get('/daftar-ajuan', [Controllerajuanlab::class, 'index'])
    ->name('daftar.ajuan');


// =========================
// DETAIL AJUAN LAB ADMIN
// =========================

Route::get('/detail-ajuan/{id}', [Controllerdetailajuan::class, 'index'])
    ->name('detail.ajuan');

// =========================
// STATUS AJUKAN
// =========================

Route::get('/statusajukan-lab', [Controllerstatusajukan::class, 'index'])
    ->name('statusajukan');

Route::delete('/statusajukan-lab/{id}/batalkan', [Controllerstatusajukan::class, 'batalkan'])
    ->name('statusajukan.batalkan');

// =========================
// SETUJUI AJUAN
// =========================

Route::post('/detail-ajuan/{id}/setujui', [Controllerdetailajuan::class, 'setujui'])
    ->name('ajuan.setujui');


// =========================
// TOLAK AJUAN
// =========================

Route::post('/detail-ajuan/{id}/tolak', [Controllerdetailajuan::class, 'tolak'])
    ->name('ajuan.tolak');
// =========================
// PEMINJAMAN LAB
// =========================

// Halaman ajukan peminjaman berdasarkan ID lab
Route::get('/ajukan-peminjaman/{id}', [ControllerAjukanPeminjaman::class, 'index'])
    ->name('ajukan.peminjaman');

// Proses ajukan peminjaman
Route::post('/ajukan-peminjaman', [ControllerAjukanPeminjaman::class, 'store'])
    ->name('ajukanpeminjaman.store');

// Halaman pilihan lab
Route::get('/pilihanlab', [Controllerpilihanlab::class, 'index'])
    ->name('ajukanpilihanlab');

// =========================
// JADWAL LAB DIPINJAM
// =========================
Route::get('jadwallab-dipinjam',[Controllerjadwaldipinjam::class, 'index']);

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
// LAPORAN
// =========================
Route::get('/Laporan-Admin', [ControllerLaporanAdmin::class, 'index'])
    ->name('laporan.admin');
Route::get('/Laporan-Guru', [ControllerLaporanGuru::class, 'index'])
    ->name('laporan.guru');



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

Route::get('ubahpasswordguru',[Controllerubahpassword::class, 'index']);

// =========================
// LOGOUT
// =========================

Route::post('/logout', [ControllerLogin::class, 'logout'])
    ->name('logout');