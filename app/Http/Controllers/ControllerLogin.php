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
    // PROSES LOGIN NIP / USERNAME
    // =========================
    public function login(Request $request)
    {
        $request->validate(
            [
                'login' => 'required',
                'password' => 'required',
            ],
            [
                'login.required' => 'NIP / Username harus diisi.',
                'password.required' => 'Password harus diisi.',
            ]
        );

        // Cari berdasarkan username ATAU NIP
        $user = User::where('username', $request->login)
            ->orWhere('nip', $request->login)
            ->first();

        // NIP / Username tidak ditemukan
        if (!$user) {
            return back()
                ->withErrors([
                    'login' => 'NIP / Username tidak ditemukan.'
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

        // Simpan data user ke session
        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
        ]);

        // Login berhasil
        return redirect()->route('dashboard');
    }


    // =========================
    // PROSES LOGIN ADMIN LAMA
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

        $user = User::where('username', $request->username)
            ->where('role', 'admin')
            ->first();

        if (!$user) {
            return back()
                ->withErrors([
                    'username' => 'Username admin salah.'
                ])
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors([
                    'password' => 'Password salah.'
                ])
                ->withInput();
        }

        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
        ]);

        return redirect()->route('dashboard');
    }


    // =========================
    // PROSES LOGIN GURU LAMA
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

        $user = User::where('nip', $request->nip)
            ->where('role', 'guru')
            ->first();

        if (!$user) {
            return back()
                ->withErrors([
                    'nip' => 'NIP guru salah.'
                ])
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors([
                    'password' => 'Password salah.'
                ])
                ->withInput();
        }

        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
        ]);

        return redirect()->route('dashboard');
    }
}