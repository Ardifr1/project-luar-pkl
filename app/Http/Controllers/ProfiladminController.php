<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfiladminController extends Controller
{
    public function admin()
    {
        /*
        |----------------------------------------------------------------------
        | IDENTITAS DIAMBIL DARI AUTH LARAVEL
        |----------------------------------------------------------------------
        |
        | Sebelumnya: User::find(session('user_id'))
        |
        | session('user_id') adalah state duplikat di luar sistem auth.
        | Jika nilainya null/kadaluarsa, User::find() mengembalikan null
        | dan view profil error "attempt to read property on null" (500),
        | yang terasa seperti user dilempar keluar dari aplikasi.
        |
        | Auth::user() adalah sumber tunggal yang otomatis null bersama
        | session-nya (route ini sudah dilindungi middleware auth + admin).
        |
        */

        $admin = Auth::user() ?? User::find(Auth::id());

        return view('profil-admin', compact('admin'));
    }
}
