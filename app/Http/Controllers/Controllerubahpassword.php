<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ControllerubahPassword extends Controller
{
    // =========================
    // HALAMAN UBAH PASSWORD
    // (ALIAS UNTUK ROUTE ubah.password.guru)
    // =========================

    /*
    | Route GET /ubahpasswordguru (name: ubah.password.guru)
    | sebelumnya memanggil method index() yang TIDAK ADA sehingga
    | menghasilkan error 500. Method ini hanya alias dari edit():
    | menampilkan view 'ubahpassword' yang sama (form sudah benar
    | submit ke route ubah.password.update milik class ini).
    |
    | Perilaku edit() TIDAK diubah sama sekali.
    */
    public function index()
    {
        return $this->edit();
    }

    // =========================
    // HALAMAN UBAH PASSWORD
    // =========================
    public function edit()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('ubahpassword');
    }

    // =========================
    // PROSES UBAH PASSWORD
    // =========================
    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Validasi input
        $request->validate(
            [
                'password_lama' => 'required',
                'password_baru' => 'required|min:8|confirmed',
            ],
            [
                'password_lama.required' => 'Password lama harus diisi.',
                'password_baru.required' => 'Password baru harus diisi.',
                'password_baru.min' => 'Password baru minimal 8 karakter.',
                'password_baru.confirmed' => 'Konfirmasi password baru tidak sama.',
            ]
        );

        $user = Auth::user(); // ambil user login

        // cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah.']);
        }

        // simpan password baru
        $user->password = Hash::make($request->password_baru);
        $user->save();

        // logout otomatis agar login ulang
        // invalidate() menghapus baris session di tabel sessions,
        // sehingga fitur 1 akun 1 device langsung melepaskan akun
        // dan session lama tidak bisa dipakai lagi.
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Password berhasil diubah, silakan login ulang.');
    }
}
