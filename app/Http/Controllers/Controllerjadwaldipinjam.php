<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class Controllerjadwaldipinjam extends Controller
{
    public function index(Request $request)
    {
        // Query dasar: ambil peminjaman yang sudah disetujui
        $query = Peminjaman::with(['lab','user','pelajaran'])
            ->where('status', 'disetujui');

        // Jika ada filter tanggal dari form
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
        } elseif ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        } elseif ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }

        // Maksimal 5 data setiap halaman, urutkan terbaru
        $peminjaman = $query->latest('tanggal')->paginate(5);

        // Siapa yang sedang login
        $user = Auth::user();

        return view('jadwallab-dipinjam', compact('peminjaman','user'));
    }
}
