<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Pelajaran;
use Illuminate\Http\Request;

class ControllerAjukanPeminjaman extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        $pelajarans = Pelajaran::all();

        return view('ajukanpeminjaman', compact('gurus', 'pelajarans'));
    }
    public function create()
    {
        $gurus = Guru::all();
        $pelajarans = Pelajaran::all();

        return view('ajukanpeminjaman', compact('gurus', 'pelajarans'));
    }

    public function store(Request $request)
    {
        $request->validate([
    'guru_id' => 'required|exists:gurus,id',
    'pelajaran_id' => 'required|exists:pelajarans,id',
    'tanggal_peminjaman' => 'required|date',
]);

        $guru = Guru::findOrFail($request->guru_id);

        $guru->pelajarans()->sync($request->pelajaran_id);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}