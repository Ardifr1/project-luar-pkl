<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;

class Controllerdatamapel extends Controller
{
    public function index()
    {
        $pelajaran = Pelajaran::all();

        return view('datamapel', compact('pelajaran'));
    }

    public function destroy($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);

        $pelajaran->delete();

        return redirect()->route('data.mapel');
    }
}