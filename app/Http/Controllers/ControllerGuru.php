<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ControllerGuru extends Controller
{
     public function index()
    {
        $guru = User::where('role', 'guru')->get();

        return view('index', compact('guru'));
    }
}
