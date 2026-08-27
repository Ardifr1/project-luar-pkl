<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lab;
use App\Models\Pelajaran;
use App\Models\Peminjaman;

class Controllersearch extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        // Cari di tabel guru
        $guru = User::where('role','guru')
            ->where('name','like',"%{$query}%")
            ->get();

        // Cari di tabel lab
        $lab = Lab::where('nama_lab','like',"%{$query}%")->get();

        // Cari di tabel mapel
        $mapel = Pelajaran::where('nama_pelajaran','like',"%{$query}%")->get();

        // Cari di tabel peminjaman
        $peminjaman = Peminjaman::with(['lab','user','pelajaran'])
            ->where('keterangan','like',"%{$query}%")
            ->get();

        return view('search-result', compact('query','guru','lab','mapel','peminjaman'));
    }
}
