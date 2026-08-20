<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;

class Controllereditdatalab extends Controller
{
    // =========================
    // HALAMAN EDIT DATA LAB
    // =========================

    public function index($id)
    {
        $lab = Lab::findOrFail($id);

        return view('edit-datalab', compact('lab'));
    }


    // =========================
    // UPDATE DATA LAB
    // =========================

    public function update(Request $request, $id)
    {
        $lab = Lab::findOrFail($id);

        $request->validate([
            'nama_lab' => 'required|string|max:255',

            'kapasitas_murid' => 'required|integer|min:1',

            'status' => 'required|in:tersedia,tidak_tersedia,sedang_maintenance',
        ]);


        // =========================
        // UPDATE DATA
        // =========================

        $lab->nama_lab = $request->nama_lab;

        $lab->kapasitas_murid = $request->kapasitas_murid;

        $lab->status = $request->status;

        $lab->save();


        // =========================
        // KEMBALI KE DATA LAB
        // =========================

        return redirect()
            ->route('data.lab')
            ->with(
                'success',
                'Data lab berhasil diperbarui.'
            );
    }
}