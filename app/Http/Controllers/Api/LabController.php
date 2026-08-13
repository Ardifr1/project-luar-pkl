<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    // ==========================================
    // ADMIN MENAMBAHKAN LAB
    // ==========================================
    public function store(Request $request)
    {
        // Hanya admin yang boleh menambahkan lab
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menambahkan lab'
            ], 403);
        }

        $request->validate([
            'nama' => 'required|string',
            'kapasitas_murid' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,tidak_tersedia,sedang_maintenance',
        ]);

        $lab = Lab::create([
            'nama_lab' => $request->nama,
            'kapasitas_murid' => $request->kapasitas_murid,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lab berhasil ditambahkan',
            'data' => $lab
        ], 201);
    }


    // ==========================================
    // GURU MELIHAT DAFTAR LAB
    // ==========================================
    public function index(Request $request)
    {
        // Hanya guru yang boleh melihat status lab
        if ($request->user()->role !== 'guru') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya guru yang dapat melihat status lab'
            ], 403);
        }

        $labs = Lab::select(
            'id',
            'nama_lab',
            'kapasitas_murid',
            'status'
        )->get();

        return response()->json([
            'success' => true,
            'data' => $labs
        ]);
    }


    // ==========================================
    // MELIHAT DETAIL SATU LAB
    // ==========================================
    public function show(Request $request, $id)
    {
        // Hanya admin dan guru yang boleh melihat detail lab
        if (!in_array($request->user()->role, ['admin', 'guru'])) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses'
            ], 403);
        }

        $lab = Lab::find($id);

        if (!$lab) {
            return response()->json([
                'success' => false,
                'message' => 'Lab tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $lab
        ]);
    }


    // ==========================================
    // ADMIN MENGUBAH DATA LAB
    // ==========================================
    public function update(Request $request, $id)
    {
        // Hanya admin yang boleh mengubah lab
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengubah lab'
            ], 403);
        }

        $lab = Lab::find($id);

        if (!$lab) {
            return response()->json([
                'success' => false,
                'message' => 'Lab tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'required|string',
            'kapasitas_murid' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,tidak_tersedia,sedang_maintenance',
        ]);

        $lab->update([
            'nama_lab' => $request->nama,
            'kapasitas_murid' => $request->kapasitas_murid,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lab berhasil diperbarui',
            'data' => $lab
        ]);
    }


    // ==========================================
    // ADMIN MENGHAPUS LAB
    // ==========================================
    public function destroy(Request $request, $id)
    {
        // Hanya admin yang boleh menghapus lab
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus lab'
            ], 403);
        }

        $lab = Lab::find($id);

        if (!$lab) {
            return response()->json([
                'success' => false,
                'message' => 'Lab tidak ditemukan'
            ], 404);
        }

        $lab->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lab berhasil dihapus'
        ]);
    }
}