<?php

namespace App\Http\Controllers;

use App\Models\Lab;

class Controllerpilihanlab extends Controller
{
    public function index()
    {
        $labs = Lab::with([
            'peminjaman.user',
            'peminjaman.pelajaran'
        ])->get();

        return view('pilihanlab', compact('labs'));
    }
}