<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajaran;

class Controllerdatamapel extends Controller
{
    // =========================
    // MENAMPILKAN DATA MAPEL + SEARCH
    // =========================
    public function index(Request $request)
    {
        $search = $request->input('q'); // ambil kata kunci dari input

        $pelajaran = Pelajaran::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama_pelajaran', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString(); // supaya pagination tetap membawa parameter pencarian

        return view('datamapel', compact('pelajaran', 'search'));
    }

    // =========================
    // HAPUS DATA MAPEL
    // =========================
    public function destroy($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);

        $pelajaran->delete();

        return redirect()
            ->route('data.mapel')
            ->with('success', 'Data mapel berhasil dihapus.');
    }
}
