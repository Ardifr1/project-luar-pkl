<?php

namespace App\Http\Controllers;

use App\Models\User;

class ControllerLab extends Controller
{
    // Menampilkan data guru
    public function index()
    {
        $guru = User::where('role', 'guru')->get();

        return view('data-guru', compact('guru'));
    }
}