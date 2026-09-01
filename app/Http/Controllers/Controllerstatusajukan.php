<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class Controllerstatusajukan extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN STATUS PENGAJUAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL PENGAJUAN YANG BELUM SELESAI
        |--------------------------------------------------------------------------
        |
        | Pengajuan akan tetap muncul jika:
        |
        | 1. Tanggal peminjaman masih setelah hari ini
        |
        | ATAU
        |
        | 2. Tanggal peminjaman hari ini dan jam selesai
        |    belum terlewati
        |
        | Data yang sudah lewat TIDAK dihapus dari database.
        | Hanya tidak ditampilkan di halaman.
        |
        */

        $pengajuan = Peminjaman::with([
            'user',
            'lab',
            'pelajaran'
        ])
        ->where('user_id', $user->id)

        ->where(function ($query) {

            // Tanggal peminjaman masih di masa depan
            $query->whereDate(
                'tanggal',
                '>',
                Carbon::today()
            )

            // ATAU tanggal hari ini,
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

        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view(
            'statusajukan-lab',
            compact('pengajuan')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | BATALKAN PENGAJUAN
    |--------------------------------------------------------------------------
    */

    public function batalkan(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu.'
            ], 401);
        }

        /*
        |--------------------------------------------------------------------------
        | CARI PENGAJUAN MILIK USER YANG LOGIN
        |--------------------------------------------------------------------------
        */

        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan.'
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | HANYA STATUS MENUNGGU YANG BOLEH DIBATALKAN
        |--------------------------------------------------------------------------
        */

        if ($peminjaman->status !== 'menunggu') {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan yang sudah diproses tidak dapat dibatalkan.'
            ], 400);
        }


        /*
        |--------------------------------------------------------------------------
        | UBAH STATUS MENJADI DIBATALKAN
        |--------------------------------------------------------------------------
        */

        $peminjaman->update([
            'status' => 'dibatalkan'
        ]);


        /*
        |--------------------------------------------------------------------------
        | RESPONSE HTTP 200
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil dibatalkan.',
            'data' => $peminjaman
        ], 200);
    }
}