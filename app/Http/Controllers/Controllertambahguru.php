<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelajaran;
use Illuminate\Support\Facades\Hash;

class Controllertambahguru extends Controller
{
    // =========================
    // HALAMAN TAMBAH GURU
    // =========================

    public function index()
    {
        $pelajaran = Pelajaran::all();

        return view('tambah-guru', compact('pelajaran'));
    }


    // =========================
    // SIMPAN DATA GURU
    // =========================

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user,name',

            'nip' => 'required|string|max:255|unique:user,nip',

            'username' => 'nullable|string|max:255|unique:user,username',

            'password' => 'required|string|min:6',

            'pelajaran' => 'required|array|min:1',

            'pelajaran.*' => 'exists:pelajaran,id',
        ]);


        // Membuat data guru
        $guru = User::create([
            'name' => $request->name,

            'username' => $request->username,

            'nip' => $request->nip,

            'password' => Hash::make($request->password),

            'role' => 'guru',
        ]);


        // Hubungkan dengan pelajaran
        if ($request->has('pelajaran')) {

            $guru->pelajaran()->attach(
                $request->pelajaran
            );

        }


        return redirect()
            ->route('data.guru')
            ->with(
                'success',
                'Data guru berhasil ditambahkan.'
            );
    }
}