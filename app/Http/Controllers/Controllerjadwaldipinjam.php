<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;

class Controllerjadwaldipinjam extends Controller
{
    public function index()
    {
        // Ambil peminjaman yang sudah disetujui
        // Maksimal 5 data setiap halaman
        $peminjaman = Peminjaman::with([
            'lab',
            'user',
            'pelajaran'
        ])
        ->where('status', 'disetujui')
        ->latest('tanggal')
        ->paginate(5);

        // Siapa yang sedang login
        $user = Auth::user();

        return view(
            'jadwallab-dipinjam',
            compact('peminjaman', 'user')
        );
    }
}