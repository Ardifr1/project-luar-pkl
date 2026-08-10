<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Cek apakah yang sedang login adalah admin
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat membuat akun guru'
            ], 403);
        }

        // Validasi data
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:user,username',
            'password' => 'required|min:6',
        ]);

        // Membuat akun guru
        $guru = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Akun guru berhasil dibuat',
            'data' => [
                'id' => $guru->id,
                'name' => $guru->name,
                'username' => $guru->username,
                'role' => $guru->role,
            ]
        ], 201);
    }
}