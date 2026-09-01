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

        // Guru
        $guru = User::where('role', 'guru')
            ->where('name', 'like', "%{$query}%")
            ->get(['id', 'name']);
        foreach ($guru as $g) {
            $results[] = [
                'name' => "Guru: " . $g->name,
                'url' => route('guru.edit', $g->id)
            ];
        }

        // Lab
        $lab = Lab::where('nama_lab', 'like', "%{$query}%")->get(['id', 'nama_lab']);
        foreach ($lab as $l) {
            $results[] = [
                'name' => "Lab: " . $l->nama_lab,
                'url' => route('lab.edit', $l->id)
            ];
        }

        // Mapel
        $mapel = Pelajaran::where('nama_pelajaran', 'like', "%{$query}%")->get(['id', 'nama_pelajaran']);
        foreach ($mapel as $m) {
            $results[] = [
                'name' => "Mapel: " . $m->nama_pelajaran,
                'url' => route('mapel.edit', $m->id)
            ];
        }

        // Peminjaman
        $peminjaman = Peminjaman::where('keterangan', 'like', "%{$query}%")->get(['id', 'keterangan']);
        foreach ($peminjaman as $p) {
            $results[] = [
                'name' => "Peminjaman: " . $p->keterangan,
                'url' => route('peminjaman.edit', $p->id)
            ];
        }

        return response()->json($results);
    }
}
