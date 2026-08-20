<?php

namespace App\Http\Controllers;

use App\Models\User;

class ControllerDataGuru extends Controller
{
    // =========================
    // MENAMPILKAN DATA GURU
    // =========================

    public function index()
    {
        $guru = User::where('role', 'guru')
            ->with('pelajaran')
            ->get();

        return view('data-guru', compact('guru'));
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