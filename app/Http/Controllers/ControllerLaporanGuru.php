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
        // =========================
        // VALIDASI RENTANG TANGGAL
        // =========================

        if (
            $request->filled('tanggal_mulai') &&
            $request->filled('tanggal_selesai') &&
            $request->tanggal_mulai > $request->tanggal_selesai
        ) {
            return redirect()
                ->route('laporan.guru')
                ->withInput()
                ->with('error', 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai.');
        }


        // =========================
        // QUERY DATA
        // =========================

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

                // Cari berdasarkan nama pelajaran
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
            ->paginate(10)
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