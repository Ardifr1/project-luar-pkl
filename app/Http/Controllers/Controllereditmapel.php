<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajaran;

class Controllereditmapel extends Controller
{
    public function index($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);

        return view('edit-datamapel', compact('pelajaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelajaran' => 'required|string|max:255',
        ]);

        $pelajaran = Pelajaran::findOrFail($id);

        $pelajaran->update([
            'nama_pelajaran' => $request->nama_pelajaran,
        ]);

        return redirect()->route('data.mapel');
    }
}