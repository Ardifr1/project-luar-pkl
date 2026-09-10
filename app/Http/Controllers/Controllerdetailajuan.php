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

        /*
        | Guard status: hanya pengajuan yang masih 'menunggu'
        | yang boleh diproses. Mencegah admin menimpa status
        | yang sudah 'ditolak' / 'dibatalkan' / 'disetujui'
        | (misalnya lewat double-submit atau POST langsung).
        */

        if ($peminjaman->status !== 'menunggu') {
            return redirect()
                ->route('detail.ajuan', ['id' => $peminjaman->id])
                ->with(
                    'error',
                    'Pengajuan sudah diproses sebelumnya.'
                );
        }

        /*
        | Cek ulang bentrok jadwal saat persetujuan.
        | Dua pengajuan 'menunggu' yang beriraman bisa sama-sama
        | mencapai halaman ini; tanpa pengecekan ini keduanya
        | bisa disetujui (double booking).
        */

        $labSedangDipakai = Peminjaman::where('lab_id', $peminjaman->lab_id)
            ->where('status', 'disetujui')
            ->where('id', '!=', $peminjaman->id)
            ->where('tanggal', $peminjaman->tanggal)
            ->where('jam_mulai', '<', $peminjaman->jam_selesai)
            ->where('jam_selesai', '>', $peminjaman->jam_mulai)
            ->exists();

        if ($labSedangDipakai) {
            return redirect()
                ->route('detail.ajuan', ['id' => $peminjaman->id])
                ->with(
                    'error',
                    'Lab tersebut sudah disetujui untuk digunakan pada tanggal dan jam yang beriraman.'
                );
        }

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


        /*
        | Guard status: hanya pengajuan yang masih 'menunggu'
        | yang boleh ditolak (sama seperti setujui).
        */

        if ($peminjaman->status !== 'menunggu') {
            return redirect()
                ->route('detail.ajuan', ['id' => $peminjaman->id])
                ->with(
                    'error',
                    'Pengajuan sudah diproses sebelumnya.'
                );
        }


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