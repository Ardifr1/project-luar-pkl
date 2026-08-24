<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ControllerLogin extends Controller
{
    // =========================
    // HALAMAN LOGIN
    // =========================

    public function index()
    {
        return view('Login/login');
    }


    // =========================
    // PROSES LOGIN
    // ADMIN = USERNAME
    // GURU  = NIP
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

        // Cari user berdasarkan username ATAU NIP
        $user = User::where('username', $request->login)
            ->orWhere('nip', $request->login)
            ->first();

        // Jika username / NIP tidak ditemukan
        if (!$user) {
            return back()
                ->withErrors([
                    'login' => 'NIP / Username tidak ditemukan.'
                ])
                ->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors([
                    'password' => 'Password salah.'
                ])
                ->withInput();
        }

        // =========================
        // LOGIN AUTH LARAVEL
        // =========================

        Auth::login($user);

        // Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // =========================
        // SIMPAN SESSION TAMBAHAN
        // =========================

        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
        ]);

        // =========================
        // ARAHKAN BERDASARKAN ROLE
        // =========================

        // Jika Admin
        if ($user->role === 'admin') {
            return redirect()->route('dashboardadmin');
        }

        // Jika Guru
        if ($user->role === 'guru') {
            return redirect()->route('dashboard');
        }

        // Jika role tidak dikenali
        Auth::logout();

        return back()
            ->withErrors([
                'login' => 'Role pengguna tidak dikenali.'
            ])
            ->withInput();
    }


    // =========================
    // HALAMAN LOGIN ADMIN LAMA
    // =========================

    public function admin()
    {
        return view('login-admin');
    }


    // =========================
    // HALAMAN LOGIN GURU LAMA
    // =========================

    public function guru()
    {
        return view('login-guru');
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

        // Cari admin berdasarkan username
        $user = User::where('username', $request->username)
            ->where('role', 'admin')
            ->first();

        // Username admin salah
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

        // =========================
        // LOGIN AUTH LARAVEL
        // =========================

        Auth::login($user);

        // Regenerasi session
        $request->session()->regenerate();

        // =========================
        // SIMPAN SESSION TAMBAHAN
        // =========================

        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
        ]);

        // Masuk dashboard admin
        return redirect()->route('dashboardadmin');
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

        // Cari guru berdasarkan NIP
        $user = User::where('nip', $request->nip)
            ->where('role', 'guru')
            ->first();

        // NIP guru salah
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

        // =========================
        // LOGIN AUTH LARAVEL
        // =========================

        Auth::login($user);

        // Regenerasi session
        $request->session()->regenerate();

        // =========================
        // SIMPAN SESSION TAMBAHAN
        // =========================

        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
        ]);

        // Masuk dashboard guru
        return redirect()->route('dashboard');
    }


    // =========================
    // LOGOUT
    // =========================

    public function logout(Request $request)
    {
        // Logout dari authentication Laravel
        Auth::logout();

        // Hapus seluruh session
        $request->session()->invalidate();

        // Buat CSRF token baru
        $request->session()->regenerateToken();

        // Kembali ke halaman login
        return redirect()->route('login');
    }
}