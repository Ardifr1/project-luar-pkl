<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajaran;

class Controllertambahmapel extends Controller
{
    public function index()
    {
        return view('tambah-mapel');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelajaran' => 'required|string|max:255',
        ]);

        Pelajaran::create([
            'nama_pelajaran' => $request->nama_pelajaran,
        ]);

        return redirect()->route('data.mapel');
    }
}