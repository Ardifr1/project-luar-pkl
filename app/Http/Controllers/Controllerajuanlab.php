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
        /*
        | Ambil user_id yang disembunyikan setelah admin
        | menyetujui salah satu ajuan miliknya.
        |
        | Ini hanya berasal dari session.
        | Tidak mengubah database.
        */

        $hiddenUserIds = session('hidden_ajuan_user_ids', []);


        // =========================
        // QUERY DAFTAR AJUAN
        // =========================

        $peminjamans = Peminjaman::with([
            'user',
            'lab',
            'pelajaran'
        ])

        // Hanya ajuan yang masih menunggu
        ->where('status', 'menunggu')


        /*
        | Jika ada user yang sudah disetujui,
        | semua ajuan menunggu milik user tersebut
        | tidak ditampilkan.
        */

        ->when(!empty($hiddenUserIds), function ($query) use ($hiddenUserIds) {
            $query->whereNotIn('user_id', $hiddenUserIds);
        })


        // =========================
        // CEK TANGGAL & JAM
        // =========================

        ->where(function ($query) {

            // Tanggal masih setelah hari ini
            $query->whereDate(
                'tanggal',
                '>',
                Carbon::today()
            )

            // ATAU tanggal hari ini
            // tetapi jam selesai belum lewat
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


        // =========================
        // KIRIM KE VIEW
        // =========================

        return view(
            'daftar-ajuan',
            compact('peminjamans')
        );
    }
}