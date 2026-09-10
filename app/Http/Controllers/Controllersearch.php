<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lab;
use App\Models\Pelajaran;
use App\Models\Peminjaman;

class Controllersearch extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Default: hasil kosong sampai ada kata kunci.
        // Tanpa ini, LIKE '%%' akan mengembalikan seluruh isi tabel.
        $lab = collect();
        $mapel = collect();
        $peminjaman = collect();

        if ($query !== null && trim($query) !== '') {

            $keyword = '%' . $query . '%';

            // Cari lab (data referensi: juga dapat dilihat guru di pilihan lab)
            $lab = Lab::where('nama_lab', 'like', $keyword)->get();

            // Cari mapel (data referensi)
            $mapel = Pelajaran::where('nama_pelajaran', 'like', $keyword)->get();

            /*
            | Cari peminjaman.
            |
            | 1. Guru hanya melihat peminjaman miliknya sendiri
            |    (filter user_id diterapkan SEBELUM kondisi OR),
            |    sedangkan admin melihat semua.
            |
            | 2. Semua kondisi pencarian (OR) dibungkus dalam satu
            |    where(fn) agar tidak "merembet" keluar filter utama.
            */

            $peminjaman = Peminjaman::with(['lab', 'user', 'pelajaran'])

                ->when($user->role === 'guru', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })

                ->where(function ($q) use ($keyword) {

                    $q->where('keterangan', 'like', $keyword)

                        ->orWhereHas('lab', function ($lab) use ($keyword) {
                            $lab->where('nama_lab', 'like', $keyword);
                        })

                        ->orWhereHas('user', function ($pemilik) use ($keyword) {
                            $pemilik->where('name', 'like', $keyword);
                        })

                        ->orWhereHas('pelajaran', function ($pelajaran) use ($keyword) {
                            $pelajaran->where('nama_pelajaran', 'like', $keyword);
                        });

                })

                ->latest()
                ->get();

        }

        return view('search-result', compact('query', 'lab', 'mapel', 'peminjaman'));
    }
}
