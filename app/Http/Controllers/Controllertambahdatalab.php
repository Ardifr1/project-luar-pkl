<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;

class Controllertambahdatalab extends Controller
{
    // =========================
    // HALAMAN TAMBAH DATA LAB
    // =========================

    public function index()
    {
        return view('tambah-datalab');
    }


    // =========================
    // SIMPAN DATA LAB
    // =========================

    public function store(Request $request)
    {
        $request->validate([
            'nama_lab' => 'required|string|max:255|unique:lab,nama_lab',

            'kapasitas_murid' => 'required|integer|min:1',

            'status' => 'required|in:tersedia,tidak_tersedia,sedang_maintenance',
        ], [
            'nama_lab.unique' => 'Nama lab tersebut sudah ada. Silakan masukkan nama lab lain.',
        ]);


        // =========================
        // SIMPAN DATA
        // =========================

        Lab::create([
            'nama_lab' => $request->nama_lab,

            'kapasitas_murid' => $request->kapasitas_murid,

            'status' => $request->status,
        ]);


        // =========================
        // KEMBALI KE DATA LAB
        // =========================

        return redirect()
            ->route('data.lab')
            ->with(
                'success',
                'Data lab berhasil ditambahkan.'
            );
    }
}