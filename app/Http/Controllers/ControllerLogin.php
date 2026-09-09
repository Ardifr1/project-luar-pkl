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
        return view('Login/login');
    }


    // =========================
    // CEK APAKAH USER SUDAH LOGIN
    // DI DEVICE LAIN
    // =========================

    private function sudahLoginDiDeviceLain($userId, Request $request)
    {
        $sessionLifetime = config('session.lifetime', 120);

        $batasWaktu = now()->subMinutes($sessionLifetime);

        /*
        |--------------------------------------------------------------------------
        | HAPUS SESSION LAMA YANG SUDAH EXPIRED
        |--------------------------------------------------------------------------
        |
        | Ini penting supaya session lama yang sudah tidak aktif
        | tidak membuat akun terus dianggap sedang digunakan.
        |
        */

        DB::table('sessions')
            ->where('user_id', $userId)
            ->where('last_activity', '<', $batasWaktu->timestamp)
            ->delete();


        /*
        |--------------------------------------------------------------------------
        | CEK SESSION AKTIF DI DEVICE LAIN
        |--------------------------------------------------------------------------
        |
        | Session ID milik request sekarang dikecualikan.
        |
        */

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


        // =========================
        // CARI ADMIN
        // =========================

        $user = User::where('username', $request->username)
            ->where('role', 'admin')
            ->first();


        // =========================
        // USERNAME SALAH
        // =========================

        if (!$user) {
            return back()
                ->withErrors([
                    'username' => 'Username admin salah.'
                ])
                ->withInput();
        }


        // =========================
        // PASSWORD SALAH
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
                    'username' => 'Akun ini sedang digunakan di perangkat lain. Silakan logout terlebih dahulu dari perangkat tersebut.'
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
        // DASHBOARD ADMIN
        // =========================

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


        // =========================
        // CARI GURU
        // =========================

        $user = User::where('nip', $request->nip)
            ->where('role', 'guru')
            ->first();


        // =========================
        // NIP SALAH
        // =========================

        if (!$user) {
            return back()
                ->withErrors([
                    'nip' => 'NIP guru salah.'
                ])
                ->withInput();
        }


        // =========================
        // PASSWORD SALAH
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
                    'nip' => 'Akun ini sedang digunakan di perangkat lain. Silakan logout terlebih dahulu dari perangkat tersebut.'
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
        // DASHBOARD GURU
        // =========================

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