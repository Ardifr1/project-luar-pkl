<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
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
}