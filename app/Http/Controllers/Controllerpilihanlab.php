<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Carbon\Carbon;

class Controllerpilihanlab extends Controller
{
    public function index()
    {
        // Waktu Indonesia Barat
        $sekarang = Carbon::now('Asia/Jakarta');

        /*
         * Ambil semua lab.
         *
         * Sekaligus ambil peminjaman yang:
         * - status = disetujui
         * - tanggal = hari ini
         * - jam mulai sudah lewat
         * - jam selesai belum lewat
         */
        $labs = Lab::with([
            'peminjaman' => function ($query) use ($sekarang) {

                $query
                    ->with([
                        'user',
                        'pelajaran'
                    ])
                    ->where('status', 'disetujui')
                    ->whereDate(
                        'tanggal',
                        $sekarang->toDateString()
                    )
                    ->whereTime(
                        'jam_mulai',
                        '<=',
                        $sekarang->format('H:i:s')
                    )
                    ->whereTime(
                        'jam_selesai',
                        '>',
                        $sekarang->format('H:i:s')
                    );
            }
        ])->paginate(3);

        return view(
            'ajukanpilihanlab',
            compact('labs')
        );
    }
}