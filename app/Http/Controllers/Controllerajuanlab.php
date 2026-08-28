<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class Controllerajuanlab extends Controller
{
    // =========================
    // DAFTAR AJUAN LAB ADMIN
    // =========================

    public function index()
    {
        // Ambil semua pengajuan yang masih menunggu
        $peminjamans = Peminjaman::with([
            'user',
            'lab',
            'pelajaran'
        ])
        ->where('status', 'menunggu')
        ->latest()
        ->paginate(4); 

        // Kirim data ke halaman daftar-ajuan
        return view(
            'daftar-ajuan',
            compact('peminjamans')
        );
    }
}