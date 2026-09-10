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
        | Guard status:
        | Hanya pengajuan yang masih 'menunggu'
        | yang boleh diproses.
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


        // =========================
        // SETUJUI AJUAN
        // =========================

        $peminjaman->update([
            'status' => 'disetujui',
            'alasan_penolakan' => null,
        ]);


        /*
        | ================================================================
        | SEMBUNYIKAN AJUAN LAIN DARI USER YANG SAMA
        | ================================================================
        |
        | Ajuan lain milik user yang sama tetap berstatus 'menunggu'
        | di database.
        |
        | Kita hanya menyimpan user_id ke session admin agar ajuan
        | tersebut tidak ditampilkan lagi di Daftar Ajuan.
        |
        | Tidak ada data database yang dihapus atau diubah.
        |
        */

        $hiddenUserIds = session('hidden_ajuan_user_ids', []);

        if (!in_array($peminjaman->user_id, $hiddenUserIds)) {
            $hiddenUserIds[] = $peminjaman->user_id;
        }

        session([
            'hidden_ajuan_user_ids' => $hiddenUserIds
        ]);


        // =========================
        // KEMBALI KE DAFTAR AJUAN
        // =========================

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
        | Guard status:
        | Hanya pengajuan yang masih 'menunggu'
        | yang boleh ditolak.
        */

        if ($peminjaman->status !== 'menunggu') {
            return redirect()
                ->route('detail.ajuan', ['id' => $peminjaman->id])
                ->with(
                    'error',
                    'Pengajuan sudah diproses sebelumnya.'
                );
        }


        // =========================
        // TOLAK AJUAN
        // =========================

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