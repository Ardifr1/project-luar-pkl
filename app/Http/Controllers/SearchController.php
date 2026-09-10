<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lab;
use App\Models\Pelajaran;
use App\Models\Peminjaman;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $query = $request->input('q');
        $results = [];

        $user = $request->user();

        /*
        |---------------------------------------------------------
        | PENGAMAN: USER HARUS LOGIN
        |---------------------------------------------------------
        |
        | Route ini dilindungi middleware 'auth'. Pengaman ini
        | hanya lapisan kedua agar tidak pernah terjadi error
        | "Attempt to read property on null" jika user null.
        |
        */

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu.'
            ], 401);
        }

        if ($user->role === 'admin') {
            // =========================
            // ADMIN: bisa cari semua data
            // =========================

            // Guru
            $guru = User::where('role', 'guru')
                ->where('name', 'like', "%{$query}%")
                ->get(['id', 'name']);
            foreach ($guru as $g) {
                $results[] = [
                    'name' => "Guru: " . $g->name,
                    'url'  => route('edit.guru', $g->id)
                ];
            }

            // Lab
            $lab = Lab::where('nama_lab', 'like', "%{$query}%")->get(['id', 'nama_lab']);
            foreach ($lab as $l) {
                $results[] = [
                    'name' => "Lab: " . $l->nama_lab,
                    'url'  => route('edit.datalab', $l->id)
                ];
            }

            // Mapel
            $mapel = Pelajaran::where('nama_pelajaran', 'like', "%{$query}%")->get(['id', 'nama_pelajaran']);
            foreach ($mapel as $m) {
                $results[] = [
                    'name' => "Mapel: " . $m->nama_pelajaran,
                    'url'  => route('edit.mapel', $m->id)
                ];
            }

            // Semua Peminjaman
            $peminjaman = Peminjaman::where('keterangan', 'like', "%{$query}%")->get(['id', 'keterangan']);
            foreach ($peminjaman as $p) {
                $results[] = [
                    'name' => "Peminjaman: " . $p->keterangan,
                    'url'  => route('peminjaman.edit', $p->id)
                ];
            }

        } else {
            // =========================
            // GURU: hanya data miliknya
            // =========================

            $results = $this->hasilPencarianGuru($user->id, $query);
        }

        return response()->json($results);
    }

    // =========================
    // AUTOCOMPLETE KHUSUS GURU
    // =========================

    /*
    |---------------------------------------------------------
    | SEARCH AUTOCOMPLETE GURU
    |---------------------------------------------------------
    |
    | Route: GET /search-autocomplete-guru (name: search.autocomplete.guru)
    |
    | Sebelumnya method ini TIDAK ADA sehingga route menghasilkan
    | error 500. Logika pencariannya sama dengan cabang "guru"
    | pada autocomplete(): hasil dibatasi hanya pada data milik
    | guru yang sedang login (user_id = auth id).
    |
    */

    public function autocompleteGuru(Request $request)
    {
        $query = $request->input('q');

        $user = $request->user();

        // Pengaman lapis kedua (route sudah dilindungi middleware 'auth').
        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu.'
            ], 401);
        }

        return response()->json(
            $this->hasilPencarianGuru($user->id, $query)
        );
    }

    // =========================
    // LOGIKA PENCARIAN GURU
    // (dipakai autocomplete & autocompleteGuru)
    // =========================

    private function hasilPencarianGuru($userId, $query): array
    {
        $results = [];

        // Peminjaman milik guru login
        // (URL diarahkan ke halaman milik guru sendiri, bukan halaman admin
        //  yang dilindungi middleware 'admin' agar tidak menghasilkan 403)
        $peminjaman = Peminjaman::where('user_id', $userId)
            ->where('keterangan', 'like', "%{$query}%")
            ->get(['id', 'keterangan']);
        foreach ($peminjaman as $p) {
            $results[] = [
                'name' => "Peminjaman: " . $p->keterangan,
                'url'  => route('statusajukan')
            ];
        }

        // Status Pengajuan milik guru login
        $status = Peminjaman::where('user_id', $userId)
            ->where('status', 'like', "%{$query}%")
            ->get(['id', 'status']);
        foreach ($status as $s) {
            $results[] = [
                'name' => "Status: " . $s->status,
                'url'  => route('statusajukan') // halaman status
            ];
        }

        // Laporan Penolakan milik guru login
        // (nilai status di DB adalah 'ditolak' sesuai migration)
        $laporan = Peminjaman::where('user_id', $userId)
            ->where('status', 'ditolak')
            ->where('alasan_penolakan', 'like', "%{$query}%")
            ->get(['id', 'keterangan', 'alasan_penolakan']);
        foreach ($laporan as $l) {
            $results[] = [
                'name' => "Laporan: " . ($l->alasan_penolakan ?? $l->keterangan),
                'url'  => route('laporan.guru') // halaman laporan guru
            ];
        }

        return $results;
    }
}
