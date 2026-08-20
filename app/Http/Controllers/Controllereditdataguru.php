<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelajaran;
use Illuminate\Support\Facades\Hash;

class Controllereditdataguru extends Controller
{
    // =========================
    // HALAMAN EDIT GURU
    // =========================

    public function index($id)
    {
        $guru = User::where('role', 'guru')
            ->with('pelajaran')
            ->findOrFail($id);

        $pelajaran = Pelajaran::all();

        return view(
            'edit-dataguru',
            compact('guru', 'pelajaran')
        );
    }


    // =========================
    // UPDATE DATA GURU
    // =========================

    public function update(Request $request, $id)
    {
        $guru = User::where('role', 'guru')
            ->findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255',

            'nip' => 'required|string|max:255|unique:user,nip,' . $id,

            'username' => 'nullable|string|max:255|unique:user,username,' . $id,

            'password' => 'nullable|string|min:6',

            'pelajaran' => 'nullable|array',

            'pelajaran.*' => 'exists:pelajaran,id',
        ]);


        // =========================
        // UPDATE DATA DASAR
        // =========================

        $guru->name = $request->name;

        $guru->nip = $request->nip;

        $guru->username = $request->username;


        // Password hanya diubah jika diisi
        if ($request->filled('password')) {

            $guru->password = Hash::make(
                $request->password
            );

        }


        $guru->save();


        // =========================
        // UPDATE PELAJARAN
        // =========================

        $guru->pelajaran()->sync(
            $request->pelajaran ?? []
        );


        return redirect()
            ->route('data.guru')
            ->with(
                'success',
                'Data guru berhasil diperbarui.'
            );
    }
}