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
        // ==========================================
        // CEK INPUT KOSONG
        // ==========================================

        // Username/NIP dan password sama-sama kosong
        if (
            !$request->filled('username') &&
            !$request->filled('nip') &&
            !$request->filled('password')
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Username/NIP harus diisi dan password harus diisi'
            ], 422);
        }


        // ==========================================
        // CEK USERNAME / NIP
        // ==========================================

        // Username/NIP kosong tetapi password diisi
        if (
            !$request->filled('username') &&
            !$request->filled('nip')
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Username/NIP harus diisi'
            ], 422);
        }


        // ==========================================
        // CEK PASSWORD
        // ==========================================

        // Username/NIP diisi tetapi password kosong
        if (!$request->filled('password')) {
            return response()->json([
                'success' => false,
                'message' => 'Password harus diisi'
            ], 422);
        }


        // ==========================================
        // LOGIN ADMIN
        // ==========================================

        if ($request->filled('username')) {

            $user = User::where('username', $request->username)
                ->where('role', 'admin')
                ->first();


        // ==========================================
        // LOGIN GURU
        // ==========================================

        } elseif ($request->filled('nip')) {

            $user = User::where('nip', $request->nip)
                ->where('role', 'guru')
                ->first();

        }


        // ==========================================
        // CEK USERNAME / NIP
        // ==========================================

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Username/NIP salah'
            ], 401);
        }


        // ==========================================
        // CEK PASSWORD
        // ==========================================

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah'
            ], 401);
        }


        // ==========================================
        // MEMBUAT TOKEN
        // ==========================================

        $token = $user->createToken('auth_token')->plainTextToken;


        // ==========================================
        // LOGIN BERHASIL
        // ==========================================

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
        ], 200);
    }
}