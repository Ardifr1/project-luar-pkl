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
use App\Http\Controllers\Controllersearch;
use App\Http\Controllers\SearchController;

// =========================
// WELCOME
// =========================

Route::get('/', function () {
    return redirect('/login'); 
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
    ->middleware('auth')
    ->name('dashboard');

Route::get('/dashboardadmin', [ControllerDashboardAdmin::class, 'index'])
    ->middleware('auth')
    ->name('dashboardadmin');


// =========================
// DATA GURU (ADMIN)
// =========================

// Menampilkan data guru
Route::get('/data-guru', [ControllerDataGuru::class, 'index'])
->middleware('auth')
    ->name('data.guru');


// =========================
// TAMBAH GURU
// =========================

// Menampilkan halaman tambah guru
Route::get('/tambah-guru', [Controllertambahguru::class, 'index'])
->middleware('auth')
    ->name('tambah.guru');

// Menyimpan data guru
Route::post('/tambah-guru', [Controllertambahguru::class, 'store'])
->middleware('auth')
    ->name('tambah.guru.store');

// =========================
// EDIT GURU
// =========================

// Menampilkan halaman edit guru
Route::get('/editdataguru/{id}', [Controllereditdataguru::class, 'index'])
->middleware('auth')
    ->name('edit.guru');

// Menyimpan perubahan data guru
Route::put('/editdataguru/{id}', [Controllereditdataguru::class, 'update'])
->middleware('auth')
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
    ->middleware('auth')
->name('data.lab');


// =========================
// TAMBAH LAB
// =========================

// Menampilkan halaman tambah lab
Route::get('/tambah-datalab', [Controllertambahdatalab::class, 'index'])
    ->middleware('auth')
->name('tambah.datalab');

// Menyimpan data lab
Route::post('/tambah-datalab', [Controllertambahdatalab::class, 'store'])
->middleware('auth')
    ->name('tambah.datalab.store');


// =========================
// EDIT LAB
// =========================

// Menampilkan halaman edit lab
Route::get('/edit-datalab/{id}', [Controllereditdatalab::class, 'index'])
->middleware('auth')
    ->name('edit.datalab');

// Menyimpan perubahan data lab
Route::put('/edit-datalab/{id}', [Controllereditdatalab::class, 'update'])
->middleware('auth')
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
->middleware('auth')
    ->name('tambah.mapel');

Route::post('/tambah-datamapel', [Controllertambahmapel::class, 'store'])
->middleware('auth')
    ->name('simpan.mapel');

// =========================
// DATA MAPEL
// =========================
Route::get('/datamapel',[Controllerdatamapel::class,'index'])
->middleware('auth')
        ->name('data.mapel');

// =========================
// EDIT MAPEL
// =========================
Route::get('/edit-datamapel/{id}', [Controllereditmapel::class, 'index'])
->middleware('auth')
    ->name('edit.mapel');

Route::put('/edit-datamapel/{id}', [Controllereditmapel::class, 'update'])
->middleware('auth')
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
->middleware('auth')
    ->name('daftar.ajuan');


// =========================
// DETAIL AJUAN LAB ADMIN
// =========================

Route::get('/detail-ajuan/{id}', [Controllerdetailajuan::class, 'index'])
->middleware('auth')
    ->name('detail.ajuan');

// =========================
// STATUS AJUKAN
// =========================

Route::get('/statusajukan-lab', [Controllerstatusajukan::class, 'index'])
->middleware('auth')
    ->name('statusajukan');

Route::delete('/statusajukan-lab/{id}/batalkan', [Controllerstatusajukan::class, 'batalkan'])
->middleware('auth')
    ->name('statusajukan.batalkan');

// =========================
// SETUJUI AJUAN
// =========================

Route::post('/detail-ajuan/{id}/setujui', [Controllerdetailajuan::class, 'setujui'])
->middleware('auth')
    ->name('ajuan.setujui');


// =========================
// TOLAK AJUAN
// =========================

Route::post('/detail-ajuan/{id}/tolak', [Controllerdetailajuan::class, 'tolak'])
->middleware('auth')
    ->name('ajuan.tolak');
// =========================
// PEMINJAMAN LAB
// =========================

// Halaman ajukan peminjaman berdasarkan ID lab
Route::get('/ajukan-peminjaman/{id}', [ControllerAjukanPeminjaman::class, 'index'])
->middleware('auth')
    ->name('ajukan.peminjaman');

// Proses ajukan peminjaman
Route::post('/ajukan-peminjaman', [ControllerAjukanPeminjaman::class, 'store'])
->middleware('auth')
    ->name('ajukanpeminjaman.store');

// Halaman pilihan lab
Route::get('/pilihanlab', [Controllerpilihanlab::class, 'index'])
->middleware('auth')
    ->name('ajukanpilihanlab');

// =========================
// JADWAL LAB DIPINJAM
// =========================
Route::get('jadwallab-dipinjam',[Controllerjadwaldipinjam::class, 'index'])
    ->middleware('auth')
    ->name('jadwal.lab');
Route::get('/jadwal-lab', [Controllerjadwaldipinjam::class, 'index'])
->middleware('auth')
->name('jadwal.lab');


// =========================
// GURU
// =========================

Route::get('/guru', [ControllerGuru::class, 'index'])
    ->middleware('auth')
->name('guru.index');

Route::get('/guru/create', [ControllerGuru::class, 'create'])
->middleware('auth')
    ->name('guru.create');

Route::post('/guru', [ControllerGuru::class, 'store'])
->middleware('auth')
    ->name('guru.store');

Route::get('/guru/{id}', [ControllerGuru::class, 'show'])
->middleware('auth')
    ->name('guru.show');

Route::delete('/guru/{id}', [ControllerGuru::class, 'destroy'])
->middleware('auth')
    ->name('guru.destroy');


// =========================
// LAPORAN
// =========================
Route::get('/Laporan-Admin', [ControllerLaporanAdmin::class, 'index'])
->middleware('auth')
    ->name('laporan.admin');
Route::get('/Laporan-Guru', [ControllerLaporanGuru::class, 'index'])
->middleware('auth')
    ->name('laporan.guru');



// =========================
// PROFIL
// =========================

// Profil guru
Route::get('/profil-guru', [ControllerProfil::class, 'guru'])
->middleware('auth')
    ->name('profil.guru');

// Profil admin
Route::get('/profil-admin', [ProfiladminController::class, 'admin'])
->middleware('auth')
    ->name('profil.admin');


// =========================
// UBAH PASSWORD
// =========================

// Halaman ubah password
Route::get('/ubah-password', [ControllerPassword::class, 'edit'])
->middleware('auth')
    ->name('ubah.password');

// Proses ubah password
Route::post('/ubah-password', [ControllerPassword::class, 'update'])
->middleware('auth')
    ->name('ubah.password.update');

Route::get('ubahpasswordguru',[Controllerubahpassword::class, 'index'])
->middleware('auth')
    ->name('ubah.password.guru');

// =========================
// LOGOUT
// =========================

Route::post('/logout', [ControllerLogin::class, 'logout'])
->middleware('auth')
    ->name('logout');

// =========================
// SEARCH 
// =========================
Route::get('/search', [Controllersearch::class, 'index'])->name('search.global');
Route::get('/search-autocomplete', [SearchController::class, 'autocomplete'])->name('search.autocomplete');

Route::get('/search-autocomplete-guru', [SearchController::class, 'autocompleteGuru'])->name('search.autocomplete.guru');


// =========================
// EDIT DATA LANGSUNG DARI SEARCH
// =========================

// Guru
Route::get('/data-guru/{id}/edit', [Controllereditdataguru::class, 'index'])->name('guru.edit');
Route::put('/data-guru/{id}', [Controllereditdataguru::class, 'update'])->name('guru.update');

// Lab
Route::get('/data-lab/{id}/edit', [Controllereditdatalab::class, 'index'])->name('lab.edit');
Route::put('/data-lab/{id}', [Controllereditdatalab::class, 'update'])->name('lab.update');

// Mapel
Route::get('/datamapel/{id}/edit', [Controllereditmapel::class, 'index'])->name('mapel.edit');
Route::put('/datamapel/{id}', [Controllereditmapel::class, 'update'])->name('mapel.update');

// Peminjaman
Route::get('/daftar-ajuan/{id}/edit', [Controllerdetailajuan::class, 'index'])->name('peminjaman.edit');
Route::put('/daftar-ajuan/{id}', [Controllerdetailajuan::class, 'update'])->name('peminjaman.update');
