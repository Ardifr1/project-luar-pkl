<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajaran;
use App\Models\Peminjaman;

class ControllerAjukanPeminjaman extends Controller
{
    public function index()
    {
        $pelajarans = Pelajaran::all();

        return view('ajukan-peminjaman', compact('pelajarans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelajaran_id' => 'required',
            'keterangan' => 'required',
            'tanggal_peminjaman' => 'required|date',
        ]);

        Peminjaman::create([
            'user_id' => auth()->id(),
            'pelajaran_id' => $request->pelajaran_id,
            'keterangan' => $request->keterangan,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'status' => 'menunggu',
        ]);

        return redirect('/ajukan-peminjaman')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }
}