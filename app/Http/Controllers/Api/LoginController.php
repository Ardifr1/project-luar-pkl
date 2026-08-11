<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'password' => 'required',
        ]);

        // =========================
        // LOGIN ADMIN
        // =========================
        if ($request->filled('username')) {

            $request->validate([
                'username' => 'required|string',
            ]);

            $user = User::where('username', $request->username)
                ->where('role', 'admin')
                ->first();

        // =========================
        // LOGIN GURU
        // =========================
        } elseif ($request->filled('nip')) {

            $request->validate([
                'nip' => 'required|string',
            ]);

            $user = User::where('nip', $request->nip)
                ->where('role', 'guru')
                ->first();

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Masukkan username untuk admin atau NIP untuk guru'
            ], 422);
        }

        // Cek akun
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Username/NIP atau password salah'
            ], 401);
        }

        // Membuat token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'nip' => $user->nip,
                'role' => $user->role,
                'token' => $token,
            ]
        ]);
    }
}