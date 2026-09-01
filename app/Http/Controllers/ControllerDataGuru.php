<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ControllerDataGuru extends Controller
{
    // =========================
    // MENAMPILKAN DATA GURU + SEARCH
    // =========================
    public function index(Request $request)
    {
        $search = $request->input('q'); // ambil kata kunci dari input

        $guru = User::query()
            ->where('role', 'guru') // hanya ambil user dengan role guru
            ->with('pelajaran')     // relasi pelajaran tetap di-load
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('nip', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString(); // supaya pagination tetap membawa parameter pencarian

        return view('data-guru', compact('guru', 'search'));
    }

    // =========================
    // HAPUS DATA GURU
    // =========================
    public function destroy($id)
    {
        $guru = User::where('role', 'guru')
            ->findOrFail($id);

        // Hapus hubungan guru dengan pelajaran
        $guru->pelajaran()->detach();

        // Hapus data guru
        $guru->delete();

        return redirect()
            ->route('data.guru')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}
