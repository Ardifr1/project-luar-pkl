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

        if (auth()->user()->role === 'admin') {
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

            // Peminjaman milik guru login
            $peminjaman = Peminjaman::where('user_id', auth()->id())
                ->where('keterangan', 'like', "%{$query}%")
                ->get(['id', 'keterangan']);
            foreach ($peminjaman as $p) {
                $results[] = [
                    'name' => "Peminjaman: " . $p->keterangan,
                    'url'  => route('peminjaman.edit', $p->id)
                ];
            }

            // Status Pengajuan milik guru login
            $status = Peminjaman::where('user_id', auth()->id())
                ->where('status', 'like', "%{$query}%")
                ->get(['id', 'status']);
            foreach ($status as $s) {
                $results[] = [
                    'name' => "Status: " . $s->status,
                    'url'  => route('statusajukan') // halaman status
                ];
            }

            // Laporan Penolakan milik guru login
            $laporan = Peminjaman::where('user_id', auth()->id())
                ->where('status', 'tolak') // asumsi status 'tolak' = laporan penolakan
                ->where('keterangan', 'like', "%{$query}%")
                ->get(['id', 'keterangan']);
            foreach ($laporan as $l) {
                $results[] = [
                    'name' => "Laporan: " . $l->keterangan,
                    'url'  => route('laporan.guru') // halaman laporan guru
                ];
            }
        }

        return response()->json($results);
    }
}
