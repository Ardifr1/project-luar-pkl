<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // dan kosongkan alasan penolakan
        $peminjaman->update([
            'status' => 'disetujui',
            'alasan_penolakan' => null,
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

    public function tolak(Request $request, $id)
    {
        // Validasi alasan penolakan
        $request->validate([
            'alasan_penolakan' => 'required|string|max:1000',
        ], [
            'alasan_penolakan.required' =>
                'Alasan tidak menyetujui wajib diisi.',
        ]);


        // Ambil data peminjaman
        $peminjaman = Peminjaman::findOrFail($id);


        // Ubah status dan simpan alasan
        $peminjaman->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);


        return redirect()
            ->route('daftar.ajuan')
            ->with(
                'success',
                'Pengajuan peminjaman berhasil ditolak.'
            );
    }
}