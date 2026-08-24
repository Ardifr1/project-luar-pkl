<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class Controllerdetailajuan extends Controller
{
    // =========================
    // DETAIL AJUAN
    // =========================

    public function index($id)
    {
        // Ambil data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::with([
            'user',
            'lab',
            'pelajaran'
        ])->findOrFail($id);

        return view(
            'detail-ajuan',
            compact('peminjaman')
        );
    }


    // =========================
    // SETUJUI AJUAN
    // =========================

    public function setujui($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Ubah status menjadi disetujui
        $peminjaman->update([
            'status' => 'disetujui',
        ]);

        return redirect()
            ->route('daftar.ajuan')
            ->with(
                'success',
                'Pengajuan peminjaman berhasil disetujui.'
            );
    }


    // =========================
    // TOLAK AJUAN
    // =========================

    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Ubah status menjadi ditolak
        $peminjaman->update([
            'status' => 'ditolak',
        ]);

        return redirect()
            ->route('daftar.ajuan')
            ->with(
                'success',
                'Pengajuan peminjaman berhasil ditolak.'
            );
    }
}