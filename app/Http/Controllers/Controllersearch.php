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

    // Cari lab
    $lab = Lab::where('nama_lab','like',"%{$query}%")->get();

    // Cari mapel
    $mapel = Pelajaran::where('nama_pelajaran','like',"%{$query}%")->get();

    // Cari peminjaman + relasi terkait
    $peminjaman = Peminjaman::with(['lab','user','pelajaran'])
        ->where('keterangan','like',"%{$query}%")
        ->orWhereHas('lab', function($q) use ($query) {
            $q->where('nama_lab','like',"%{$query}%");
        })
        ->orWhereHas('user', function($q) use ($query) {
            $q->where('name','like',"%{$query}%");
        })
        ->orWhereHas('pelajaran', function($q) use ($query) {
            $q->where('nama_pelajaran','like',"%{$query}%");
        })
        ->get();

    return view('search-result', compact('query','lab','mapel','peminjaman'));
}

}
