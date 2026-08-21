<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controllerajuanlab extends Controller
{
    public function index() {
        return view ('daftar-ajuan');
    }
}
