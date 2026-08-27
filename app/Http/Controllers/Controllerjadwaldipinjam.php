<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;

class Controllerjadwaldipinjam extends Controller
{
    public function index()
    {
        // Ambil semua peminjaman beserta relasi lab, user, dan pelajaran
        $peminjaman = Peminjaman::with(['lab','user','pelajaran'])
            ->where('status', 'disetujui') // hanya tampilkan yang sudah disetujui
            ->get();

        $user = Auth::user(); // siapa yang login

        return view('jadwallab-dipinjam', compact('peminjaman','user'));
    }
}

