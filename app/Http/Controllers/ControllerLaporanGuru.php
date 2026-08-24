<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class ControllerLaporanGuru extends Controller
{
     public function index()
    {
        $penolakan = Peminjaman::with([
            'user',
            'lab',
            'pelajaran'
        ])
        ->where('status', 'ditolak')
        ->latest()
        ->paginate(10);

        return view(
            'Laporan-Guru',
            compact('penolakan')
        );
    }
}
