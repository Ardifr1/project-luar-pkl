<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        // Cek apakah user adalah guru
        if ($request->user()->role !== 'guru') {
            return response()->json([
                'success' => false,
                'message' => 'Akses hanya untuk guru'
            ], 403);
        }

        // Ambil jadwal peminjaman yang sudah disetujui
        $jadwal = Peminjaman::with([
            'lab',
            'user',
            'pelajaran'
        ])
        ->where('status', 'disetujui')
        ->latest('tanggal')
        ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Jadwal peminjaman berhasil ditampilkan',
            'data' => $jadwal
        ], 200);
    }
}