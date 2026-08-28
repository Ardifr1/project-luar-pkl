<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;

class Controllerdatamapel extends Controller
{
    public function index()
    {
        $pelajaran = Pelajaran::paginate(10);

        return view('datamapel', compact('pelajaran'));
    }

    public function destroy($id)
    {
        $pelajaran = Pelajaran::findOrFail($id);

        $pelajaran->delete();

        return redirect()->route('data.mapel');
    }
}