<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;

class Controllerajuanlab extends Controller
{
    // =========================
    // DAFTAR AJUAN LAB ADMIN
    // =========================

    public function index()
    {
        // Ambil pengajuan yang:
        // 1. Status masih menunggu
        // 2. Belum melewati tanggal dan jam selesai

        $peminjamans = Peminjaman::with([
            'user',
            'lab',
            'pelajaran'
        ])
        ->where('status', 'menunggu')

        ->where(function ($query) {

            // Jika tanggal peminjaman masih setelah hari ini
            $query->whereDate(
                'tanggal',
                '>',
                Carbon::today()
            )

            // ATAU tanggalnya hari ini tetapi
            // jam selesai belum lewat
            ->orWhere(function ($q) {

                $q->whereDate(
                    'tanggal',
                    '=',
                    Carbon::today()
                )
                ->whereTime(
                    'jam_selesai',
                    '>=',
                    Carbon::now()->format('H:i:s')
                );

            });

        })

        ->latest()
        ->paginate(4);

        // Kirim data ke halaman daftar-ajuan
        return view(
            'daftar-ajuan',
            compact('peminjamans')
        );
    }
}