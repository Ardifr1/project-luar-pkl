<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // ==========================================
    // ADMIN MELIHAT DAFTAR GURU
    // ==========================================
    public function index(Request $request)
    {
        // Hanya admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat melihat daftar guru'
            ], 403);
        }

        $guru = User::where('role', 'guru')
            ->with('pelajaran')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $guru
        ]);
    }


    // ==========================================
    // ADMIN MELIHAT DETAIL GURU
    // ==========================================
    public function show(Request $request, $id)
    {
        // Hanya admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat melihat data guru'
            ], 403);
        }

        $guru = User::where('role', 'guru')
            ->with('pelajaran')
            ->find($id);

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Guru tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $guru
        ]);
    }


    // ==========================================
    // ADMIN MENAMBAHKAN GURU
    // ==========================================
    public function store(Request $request)
    {
        // Hanya admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat membuat akun guru'
            ], 403);
        }

        $request->validate([
            'name' => 'required|string',
            'nip' => 'required|string|unique:user,nip',
            'pelajaran' => 'required|array|min:1',
            'pelajaran.*' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $guru = User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        $namaPelajaran = array_map(
            'trim',
            $request->pelajaran
        );

        $pelajaranIds = Pelajaran::whereIn(
            'nama_pelajaran',
            $namaPelajaran
        )->pluck('id');

        $guru->pelajaran()->sync($pelajaranIds);

        $guru->load('pelajaran');

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


    // ==========================================
    // ADMIN MENGEDIT GURU
    // ==========================================
    public function update(Request $request, $id)
    {
        // Hanya admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengedit data guru'
            ], 403);
        }

        $guru = User::where('role', 'guru')
            ->find($id);

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Guru tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string',
            'nip' => [
                'required',
                'string',
                Rule::unique('user', 'nip')->ignore($guru->id),
            ],
            'pelajaran' => 'required|array|min:1',
            'pelajaran.*' => 'required|string',
            'password' => 'nullable|min:6',
        ]);

        $guru->name = $request->name;
        $guru->nip = $request->nip;

        // Password hanya diganti kalau dikirim
        if ($request->filled('password')) {
            $guru->password = Hash::make($request->password);
        }

        $guru->save();

        // Update pelajaran
        $namaPelajaran = array_map(
            'trim',
            $request->pelajaran
        );

        $pelajaranIds = Pelajaran::whereIn(
            'nama_pelajaran',
            $namaPelajaran
        )->pluck('id');

        $guru->pelajaran()->sync($pelajaranIds);

        $guru->load('pelajaran');

        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil diperbarui',
            'data' => [
                'id' => $guru->id,
                'name' => $guru->name,
                'nip' => $guru->nip,
                'role' => $guru->role,
                'pelajaran' => $guru->pelajaran,
            ]
        ]);
    }


    // ==========================================
    // ADMIN MENGHAPUS GURU
    // ==========================================
    public function destroy(Request $request, $id)
    {
        // Hanya admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus akun guru'
            ], 403);
        }

        $guru = User::where('role', 'guru')
            ->find($id);

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Guru tidak ditemukan'
            ], 404);
        }

        $guru->delete();

        return response()->json([
            'success' => true,
            'message' => 'Akun guru berhasil dihapus'
        ]);
    }
}