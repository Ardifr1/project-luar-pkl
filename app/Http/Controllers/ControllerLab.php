<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;

class ControllerLab extends Controller
{
    // =========================
    // MENAMPILKAN DATA LAB + SEARCH
    // =========================
    public function index(Request $request)
    {
        $search = $request->input('q'); // ambil kata kunci dari input

        $lab = Lab::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama_lab', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString(); // supaya pagination tetap membawa parameter pencarian

        return view('data-lab', compact('lab', 'search'));
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
