<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // =========================================================
    // ADMIN MELIHAT SEMUA PENGAJUAN PEMINJAMAN
    // =========================================================
    public function index(Request $request)
    {
        // Hanya admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat melihat pengajuan peminjaman'
            ], 403);
        }

        $peminjaman = Peminjaman::with([
            'user',
            'lab',
            'pelajaran'
        ])
        ->latest()
        ->get();

        return response()->json([
            'success' => true,
            'data' => $peminjaman
        ]);
    }


    // =========================================================
    // ADMIN MENYETUJUI PEMINJAMAN
    // =========================================================
    public function approve(Request $request, $id)
    {
        // Hanya admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menyetujui peminjaman'
            ], 403);
        }

        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan'
            ], 404);
        }

        // Hanya yang masih menunggu
        if ($peminjaman->status !== 'menunggu') {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman sudah diproses'
            ], 400);
        }

        $peminjaman->update([
            'status' => 'disetujui'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil disetujui',
            'data' => $peminjaman->load([
                'user',
                'lab',
                'pelajaran'
            ])
        ]);
    }


    // =========================================================
    // ADMIN MENOLAK PEMINJAMAN
    // =========================================================
    public function reject(Request $request, $id)
    {
        // Hanya admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menolak peminjaman'
            ], 403);
        }

        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan'
            ], 404);
        }

        // Hanya yang masih menunggu
        if ($peminjaman->status !== 'menunggu') {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman sudah diproses'
            ], 400);
        }

        // Alasan wajib
        $request->validate([
            'alasan_penolakan' => 'required|string|min:3',
        ]);

        $peminjaman->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil ditolak',
            'data' => $peminjaman->load([
                'user',
                'lab',
                'pelajaran'
            ])
        ]);
    }


    // =========================================================
    // GURU MELIHAT STATUS PENGAJUAN MILIKNYA
    // =========================================================
    public function myPeminjaman(Request $request)
    {
        // Hanya guru
        if ($request->user()->role !== 'guru') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya guru yang dapat melihat status pengajuan'
            ], 403);
        }

        $peminjaman = Peminjaman::with([
            'lab',
            'pelajaran'
        ])
        ->where('user_id', $request->user()->id)
        ->latest()
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Status pengajuan berhasil diambil',
            'data' => $peminjaman
        ]);
    }


    // =========================================================
    // GURU MEMBATALKAN PENGAJUAN PEMINJAMAN
    // =========================================================
    public function cancel(Request $request, $id)
    {
        // Hanya guru
        if ($request->user()->role !== 'guru') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya guru yang dapat membatalkan pengajuan'
            ], 403);
        }

        // Cari pengajuan milik guru yang sedang login
        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        // Jika tidak ditemukan
        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman tidak ditemukan'
            ], 404);
        }

        // Hanya status menunggu yang boleh dibatalkan
        if ($peminjaman->status !== 'menunggu') {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan yang sudah diproses tidak dapat dibatalkan'
            ], 400);
        }

        // Ubah status menjadi dibatalkan
        $peminjaman->update([
            'status' => 'dibatalkan'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil dibatalkan',
            'data' => $peminjaman->load([
                'user',
                'lab',
                'pelajaran'
            ])
        ], 200);
    }
}