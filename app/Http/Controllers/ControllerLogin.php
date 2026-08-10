<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;

class ControllerLogin extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi jika kosong
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

        // Cari username
        $user = Login::where('username', $request->username)->first();

        // Jika username tidak ditemukan
        if (!$user) {
            return back()
                ->withErrors([
                    'username' => 'Username salah.'
                ])
                ->withInput();
        }

        // Jika password salah
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors([
                    'password' => 'Password salah.'
                ])
                ->withInput();
        }

        // Login berhasil
        return redirect()->route('dashboard');
    }
}