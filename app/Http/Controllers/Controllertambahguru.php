<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controllertambahguru extends Controller
{
   public function index()
{
    return view('login/tambah-guru');
}
}
