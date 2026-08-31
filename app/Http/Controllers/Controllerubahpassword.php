<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

<<<<<<< HEAD
class ControllerubahPassword extends Controller
=======
class Controllerpassword extends Controller
>>>>>>> e60043872e9ece3c06c6ff61a813b9ce33ddec95
{
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
        Auth::logout();

        return redirect()->route('login')->with('success', 'Password berhasil diubah, silakan login ulang.');
    }
}
