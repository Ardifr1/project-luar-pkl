<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfiladminController extends Controller
{
    //
     // Menampilkan profil admin
    public function admin()
    {
        return view('profiladmin');
    }
}
