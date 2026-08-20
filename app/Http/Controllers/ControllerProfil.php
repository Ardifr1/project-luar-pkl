<?php

namespace App\Http\Controllers;

use App\Models\User;

class ControllerProfil extends Controller
{
    public function guru()
    {
        $guru = User::find(session('user_id'));

        return view('profil-guru', compact('guru'));
    }
}