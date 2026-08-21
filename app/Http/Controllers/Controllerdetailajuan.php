<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controllerdetailajuan extends Controller
{
    public function index() {
        return view ('detail-ajuan');
    }
}
