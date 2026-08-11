<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Melihat semua pengajuan peminjaman
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
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $peminjaman
        ]);
    }


    // Admin menyetujui peminjaman
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

        // Hanya peminjaman yang masih menunggu yang bisa diproses
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
            'data' => $peminjaman
        ]);
    }


    // Admin menolak peminjaman
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

        // Hanya peminjaman yang masih menunggu yang bisa diproses
        if ($peminjaman->status !== 'menunggu') {
            return response()->json([
                'success' => false,
                'message' => 'Peminjaman sudah diproses'
            ], 400);
        }

        // Alasan wajib diisi
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
            'data' => $peminjaman
        ]);
    }
}