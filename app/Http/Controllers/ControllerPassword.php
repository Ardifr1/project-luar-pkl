<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ControllerPassword extends Controller
{
    // =========================
    // HALAMAN UBAH PASSWORD
    // =========================
    public function edit()
    {
        // Pastikan user sudah login
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        return view('ubah-password');
    }


    // =========================
    // PROSES UBAH PASSWORD
    // =========================
    public function update(Request $request)
    {
        // Pastikan user sudah login
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        // Validasi
        $request->validate(
            [
                'password_lama' => 'required',
                'password_baru' => 'required|min:6',
                'password_baru_confirmation' => 'required|same:password_baru',
            ],
            [
                'password_lama.required' => 'Password lama harus diisi.',
                'password_baru.required' => 'Password baru harus diisi.',
                'password_baru.min' => 'Password baru minimal 6 karakter.',
                'password_baru_confirmation.required' => 'Ulangi password baru harus diisi.',
                'password_baru_confirmation.same' => 'Ulangi password baru tidak sama.',
            ]
        );

        // Ambil user yang sedang login
        $user = User::find(session('user_id'));

        // Jika user tidak ditemukan
        if (!$user) {
            session()->flush();

            return redirect()->route('login');
        }

        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()
                ->withErrors([
                    'password_lama' => 'Password lama salah.'
                ]);
        }

        // Simpan password baru
        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with(
            'success',
            'Password berhasil diubah.'
        );
    }
}