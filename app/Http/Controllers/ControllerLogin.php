<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControllerLogin extends Controller
{
    // =========================
    // HALAMAN LOGIN
    // =========================

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | GUEST GUARD
        |--------------------------------------------------------------------------
        |
        | User yang SUDAH login tidak boleh melihat form login lagi.
        | Jika dia membuka /login, langsung arahkan ke dashboard-nya.
        |
        */

        if ($redirect = $this->redirectJikaSudahLogin()) {
            return $redirect;
        }

        return view('Login/login');
    }


    // =========================
    // REDIRECT SESUAI ROLE
    // UNTUK USER YANG SUDAH LOGIN
    // =========================

    private function redirectJikaSudahLogin()
    {
        if (!Auth::check()) {
            return null;
        }

        $user = Auth::user();

        // ADMIN
        if ($user->role === 'admin') {
            return redirect()->route('dashboardadmin');
        }

        // GURU
        if ($user->role === 'guru') {
            return redirect()->route('dashboard');
        }

        /*
        | Role tidak dikenali: paksa logout agar session tidak menggantung,
        | lalu tampilkan form login seperti biasa.
        */

        Auth::logout();

        return null;
    }


    // =========================
    // CEK APAKAH USER SUDAH LOGIN
    // DI DEVICE LAIN
    // =========================

    private function sudahLoginDiDeviceLain($userId, Request $request)
    {
        $sessionLifetime = config('session.lifetime', 120);

        $batasWaktu = now()->subMinutes($sessionLifetime);


        // =========================
        // HAPUS SESSION LAMA
        // YANG SUDAH EXPIRED
        // =========================

        DB::table('sessions')
            ->where('user_id', $userId)
            ->where('last_activity', '<', $batasWaktu->timestamp)
            ->delete();


        // =========================
        // CEK SESSION AKTIF
        // DI DEVICE LAIN
        // =========================

        return DB::table('sessions')
            ->where('user_id', $userId)
            ->where('id', '!=', $request->session()->getId())
            ->where('last_activity', '>=', $batasWaktu->timestamp)
            ->exists();
    }


    // =========================
    // PROSES LOGIN
    // ADMIN = USERNAME
    // GURU  = NIP
    // =========================

    public function login(Request $request)
    {
        /*
        | Sudah login? Jangan proses login lagi.
        */

        if ($redirect = $this->redirectJikaSudahLogin()) {
            return $redirect;
        }


        // =========================
        // VALIDASI
        // =========================

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


        // =========================
        // CARI USER
        // USERNAME ATAU NIP
        // =========================

        $user = User::where('username', $request->login)
            ->orWhere('nip', $request->login)
            ->first();


        // =========================
        // USER TIDAK DITEMUKAN
        // =========================

        if (!$user) {
            return back()
                ->withErrors([
                    'login' => 'NIP / Username tidak ditemukan.'
                ])
                ->withInput();
        }


        // =========================
        // CEK PASSWORD
        // =========================

        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors([
                    'password' => 'Password salah.'
                ])
                ->withInput();
        }


        // =========================
        // CEK LOGIN DI DEVICE LAIN
        // =========================

        if ($this->sudahLoginDiDeviceLain($user->id, $request)) {
            return back()
                ->withErrors([
                    'login' => 'Akun ini sedang digunakan di perangkat lain. Silakan logout terlebih dahulu dari perangkat tersebut.'
                ])
                ->withInput();
        }


        // =========================
        // LOGIN AUTH LARAVEL
        // =========================

        Auth::login($user);


        // =========================
        // REGENERASI SESSION
        // =========================

        $request->session()->regenerate();


        // =========================
        // BUAT TOKEN SANCTUM
        // =========================

        $token = $user->createToken('auth_token')->plainTextToken;


        // =========================
        // SIMPAN SESSION
        // =========================

        session([
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_name' => $user->name,
            'api_token' => $token,
        ]);


        // =========================
        // ARAHKAN BERDASARKAN ROLE
        // =========================

        // ADMIN
        if ($user->role === 'admin') {
            return redirect()->route('dashboardadmin');
        }


        // GURU
        if ($user->role === 'guru') {
            return redirect()->route('dashboard');
        }


        // =========================
        // ROLE TIDAK DIKENALI
        // =========================

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()
            ->withErrors([
                'login' => 'Role pengguna tidak dikenali.'
            ])
            ->withInput();
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

