<?php

namespace App\Http\Controllers;

use App\Models\Lab;

class ControllerLab extends Controller
{
    // =========================
    // MENAMPILKAN DATA LAB
    // =========================

    public function index()
    {
        $lab = Lab::paginate(10); 


        return view('data-lab', compact('lab'));
    }


    // =========================
    // HAPUS DATA LAB
    // =========================

    public function destroy($id)
    {
        $lab = Lab::findOrFail($id);

        // Hapus data lab
        $lab->delete();

        return redirect()
            ->route('data.lab')
            ->with('success', 'Data lab berhasil dihapus.');
    }
}