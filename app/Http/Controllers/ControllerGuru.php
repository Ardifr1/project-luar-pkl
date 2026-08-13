<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ControllerGuru extends Controller
{
    // Menampilkan daftar guru
    public function index()
    {
        $guru = User::where('role', 'guru')->get();

        return view('guru', compact('guru'));
    }

    // Menampilkan form tambah guru
    public function create()
    {
        return view('guru.create');
    }

    // Menyimpan akun guru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'nip' => 'required|string|unique:user,nip',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        return redirect()
            ->route('guru.index')
            ->with('success', 'Akun guru berhasil dibuat');
    }

    // Menampilkan data guru
    public function show($id)
    {
        $guru = User::where('role', 'guru')
            ->findOrFail($id);

        return view('guru.show', compact('guru'));
    }

    // Menampilkan form edit guru
    public function edit($id)
    {
        $guru = User::where('role', 'guru')
            ->findOrFail($id);

        return view('guru.edit', compact('guru'));
    }

    // Memperbarui data guru
    public function update(Request $request, $id)
    {
        $guru = User::where('role', 'guru')
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'nip' => 'required|string',
        ]);

        $guru->name = $request->name;
        $guru->nip = $request->nip;

        // Password hanya diubah jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6',
            ]);

            $guru->password = Hash::make($request->password);
        }

        $guru->save();

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil diperbarui');
    }

    // Menghapus akun guru
    public function destroy($id)
    {
        $guru = User::where('role', 'guru')
            ->findOrFail($id);

        $guru->delete();

        return redirect()
            ->route('guru.index')
            ->with('success', 'Akun guru berhasil dihapus');
    }
}