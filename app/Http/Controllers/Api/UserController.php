<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Hanya admin yang boleh membuat akun guru
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat membuat akun guru'
            ], 403);
        }

        // Validasi
        $request->validate([
            'name' => 'required|string',
            'nip' => 'required|string|unique:user,nip',
            'pelajaran' => 'required|string',
            'password' => 'required|min:6',
        ]);

        // Buat akun guru
        $guru = User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        // Pisahkan nama pelajaran berdasarkan koma
        $namaPelajaran = array_map(
            'trim',
            explode(',', $request->pelajaran)
        );

        // Cari ID pelajaran berdasarkan nama
        $pelajaranIds = Pelajaran::whereIn(
            'nama_pelajaran',
            $namaPelajaran
        )->pluck('id');

        // Hubungkan guru dengan pelajaran
        $guru->pelajaran()->sync($pelajaranIds);

        return response()->json([
            'success' => true,
            'message' => 'Akun guru berhasil dibuat',
            'data' => [
                'id' => $guru->id,
                'name' => $guru->name,
                'nip' => $guru->nip,
                'role' => $guru->role,
                'pelajaran' => $guru->pelajaran,
            ]
        ], 201);
    }
}