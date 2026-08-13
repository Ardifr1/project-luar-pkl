<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ControllerLogin extends Controller
{
    // =========================
    // HALAMAN PILIHAN LOGIN
    // =========================
    public function index()
    {
        return view('Login/login');
    }


    // =========================
    // HALAMAN LOGIN ADMIN
    // =========================
    public function admin()
    {
        return view('login-admin');
    }


    // =========================
    // HALAMAN LOGIN GURU
    // =========================
    public function guru()
    {
        return view('login-guru');
    }


    // =========================
    // PROSES LOGIN ADMIN
    // =========================
    public function loginAdmin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username harus diisi.',
                'password.required' => 'Password harus diisi.',
            ]
        );

        // Cari user yang username-nya sesuai
        // DAN harus memiliki role admin
        $user = User::where('username', $request->username)
            ->where('role', 'admin')
            ->first();

        // Username tidak ditemukan
        if (!$user) {
            return back()
                ->withErrors([
                    'username' => 'Username admin salah.'
                ])
                ->withInput();
        }

        // Password salah
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors([
                    'password' => 'Password salah.'
                ])
                ->withInput();
        }

        // Login berhasil
        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
        ]);

        return redirect()->route('dashboard');
    }


    // =========================
    // PROSES LOGIN GURU
    // =========================
    public function loginGuru(Request $request)
    {
        $request->validate(
            [
                'nip' => 'required',
                'password' => 'required',
            ],
            [
                'nip.required' => 'NIP harus diisi.',
                'password.required' => 'Password harus diisi.',
            ]
        );

        // Cari user berdasarkan NIP
        // DAN harus memiliki role guru
        $user = User::where('nip', $request->nip)
            ->where('role', 'guru')
            ->first();

        // NIP tidak ditemukan
        if (!$user) {
            return back()
                ->withErrors([
                    'nip' => 'NIP guru salah.'
                ])
                ->withInput();
        }

        // Password salah
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors([
                    'password' => 'Password salah.'
                ])
                ->withInput();
        }

        // Login berhasil
        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
        ]);

        return redirect()->route('dashboard');
    }
}