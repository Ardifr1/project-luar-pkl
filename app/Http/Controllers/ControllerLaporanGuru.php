<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class ControllerLaporanGuru extends Controller
{
    // =========================
    // LAPORAN GURU
    // =========================

    public function index(Request $request)
    {
        $query = Peminjaman::with([
            'user',
            'lab',
            'pelajaran'
        ])
        ->whereIn('status', ['ditolak', 'dibatalkan'])
        ->where('user_id', auth()->id());


        // =========================
        // SEARCH
        // =========================

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Cari berdasarkan nama lab
                $q->whereHas('lab', function ($lab) use ($search) {

                    $lab->where(
                        'nama_lab',
                        'like',
                        '%' . $search . '%'
                    );

                })

                // Cari berdasarkan nama guru
                ->orWhereHas('user', function ($user) use ($search) {

                    $user->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );

                })

                // Cari berdasarkan pelajaran
                ->orWhereHas('pelajaran', function ($pelajaran) use ($search) {

                    $pelajaran->where(
                        'nama',
                        'like',
                        '%' . $search . '%'
                    );

                })

                // Cari berdasarkan alasan penolakan
                ->orWhere(
                    'alasan_penolakan',
                    'like',
                    '%' . $search . '%'
                );

            });
        }


        // =========================
        // FILTER TANGGAL MULAI
        // =========================

        if ($request->filled('tanggal_mulai')) {

            $query->whereDate(
                'tanggal',
                '>=',
                $request->tanggal_mulai
            );

        }


        // =========================
        // FILTER TANGGAL SELESAI
        // =========================

        if ($request->filled('tanggal_selesai')) {

            $query->whereDate(
                'tanggal',
                '<=',
                $request->tanggal_selesai
            );

        }


        // =========================
        // URUTKAN DATA
        // =========================

        $query->latest('tanggal');


        // =========================
        // PAGINATION
        // MAKSIMAL 10 DATA
        // =========================

        $penolakan = $query
            ->paginate(6)
            ->withQueryString();


        // =========================
        // KIRIM KE BLADE
        // =========================

        return view(
            'laporan-guru',
            compact('penolakan')
        );
    }
}