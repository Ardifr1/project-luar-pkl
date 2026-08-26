<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controllerjadwaldipinjam extends Controller
{
    public function index () {
        return view ('jadwallab-dipinjam');
    }
}
