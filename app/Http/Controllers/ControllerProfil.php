<?php

namespace App\Http\Controllers;



class ControllerProfil extends Controller
{
    // Menampilkan profil guru
    public function guru()
    {
        return view('profil-guru');
    }
}