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
            'nama_pelajaran' => 'required|string|max:255|unique:pelajaran,nama_pelajaran',
        ], [
            'nama_pelajaran.unique' => 'Pelajaran tersebut sudah ada. Silakan masukkan pelajaran lain.',
        ]);

        Pelajaran::create([
            'nama_pelajaran' => $request->nama_pelajaran,
        ]);

        return redirect()->route('data.mapel');
    }
}