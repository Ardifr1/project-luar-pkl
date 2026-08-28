<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelajaran;

class MapelController extends Controller
{
    // =========================
    // TAMPIL DATA MAPEL
    // =========================
    public function index(Request $request)
    {
        // Cek role dari user yang memiliki token
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Akses hanya untuk admin'
            ], 403);
        }

        $pelajaran = Pelajaran::paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Data pelajaran berhasil ditampilkan',
            'data' => $pelajaran
        ], 200);
    }


    // =========================
    // TAMBAH DATA MAPEL
    // =========================
    public function store(Request $request)
    {
        // Cek role dari user yang memiliki token
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Akses hanya untuk admin'
            ], 403);
        }

        $request->validate([
            'nama_pelajaran' => 'required|string|max:255',
        ]);

        $pelajaran = Pelajaran::create([
            'nama_pelajaran' => $request->nama_pelajaran,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pelajaran berhasil ditambahkan',
            'data' => $pelajaran
        ], 201);
    }


    // =========================
    // EDIT DATA MAPEL
    // =========================
    public function update(Request $request, $id)
    {
        // Cek role dari user yang memiliki token
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Akses hanya untuk admin'
            ], 403);
        }

        $request->validate([
            'nama_pelajaran' => 'required|string|max:255',
        ]);

        $pelajaran = Pelajaran::find($id);

        if (!$pelajaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelajaran tidak ditemukan'
            ], 404);
        }

        $pelajaran->update([
            'nama_pelajaran' => $request->nama_pelajaran,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pelajaran berhasil diperbarui',
            'data' => $pelajaran
        ], 200);
    }


    // =========================
    // HAPUS DATA MAPEL
    // =========================
    public function destroy(Request $request, $id)
    {
        // Cek role dari user yang memiliki token
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Akses hanya untuk admin'
            ], 403);
        }

        $pelajaran = Pelajaran::find($id);

        if (!$pelajaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelajaran tidak ditemukan'
            ], 404);
        }

        $pelajaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pelajaran berhasil dihapus'
        ], 200);
    }
}