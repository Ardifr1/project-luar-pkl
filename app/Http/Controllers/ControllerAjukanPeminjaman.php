<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Lab;

class ControllerAjukanPeminjaman extends Controller
{
    public function index(Request $request)
    {
        // Ambil mata pelajaran yang dimiliki guru yang sedang login
        $pelajarans = auth()->user()->pelajaran;

        // Ambil semua lab
        $labs = Lab::all();

        // Lab yang dipilih dari halaman pilihan lab
        $labDipilih = null;

        if ($request->lab_id) {
            $labDipilih = Lab::findOrFail($request->lab_id);
        }

        return view('ajukanpeminjaman', compact(
            'pelajarans',
            'labs',
            'labDipilih'
        ));
    }


    // =========================
    // PENGAJUAN MELALUI WEB
    // =========================

    public function store(Request $request)
    {
        $request->validate([
            'lab_id' => 'required|exists:lab,id',
            'pelajaran_id' => 'required|exists:pelajaran,id',
            'keterangan' => 'required|string',
            'tanggal_peminjaman' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);


        // Pastikan pelajaran memang dimiliki oleh guru yang login
        $guruMemilikiPelajaran = auth()->user()
            ->pelajaran()
            ->where('pelajaran.id', $request->pelajaran_id)
            ->exists();


        if (!$guruMemilikiPelajaran) {

            return back()
                ->withErrors([
                    'pelajaran_id' => 'Pelajaran tersebut bukan pelajaran Anda.'
                ])
                ->withInput();

        }


        // Simpan peminjaman
        Peminjaman::create([

            'user_id' => auth()->id(),

            'lab_id' => $request->lab_id,

            'pelajaran_id' => $request->pelajaran_id,

            'keterangan' => $request->keterangan,

            'tanggal' => $request->tanggal_peminjaman,

            'jam_mulai' => $request->jam_mulai,

            'jam_selesai' => $request->jam_selesai,

            'status' => 'menunggu',

        ]);


        // Setelah berhasil kembali ke dashboard
        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Pengajuan peminjaman berhasil dikirim.'
            );
    }


    // =========================
    // PENGAJUAN MELALUI API
    // =========================

    public function storeApi(Request $request)
    {
        // Hanya guru yang boleh mengajukan
        if ($request->user()->role !== 'guru') {

            return response()->json([
                'success' => false,
                'message' => 'Hanya guru yang dapat mengajukan peminjaman'
            ], 403);

        }


        // Validasi data
        $request->validate([
            'lab_id' => 'required|exists:lab,id',
            'pelajaran_id' => 'required|exists:pelajaran,id',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);


        // Pastikan pelajaran memang dimiliki guru yang login
        $guruMemilikiPelajaran = $request->user()
            ->pelajaran()
            ->where('pelajaran.id', $request->pelajaran_id)
            ->exists();


        if (!$guruMemilikiPelajaran) {

            return response()->json([
                'success' => false,
                'message' => 'Pelajaran tersebut bukan pelajaran Anda'
            ], 403);

        }


        // Simpan peminjaman
        $peminjaman = Peminjaman::create([

            'user_id' => $request->user()->id,

            'lab_id' => $request->lab_id,

            'pelajaran_id' => $request->pelajaran_id,

            'keterangan' => $request->keterangan,

            'tanggal' => $request->tanggal,

            'jam_mulai' => $request->jam_mulai,

            'jam_selesai' => $request->jam_selesai,

            'status' => 'menunggu',

        ]);


        return response()->json([

            'success' => true,

            'message' => 'Pengajuan peminjaman berhasil dikirim',

            'data' => $peminjaman->load([
                'user',
                'lab',
                'pelajaran'
            ])

        ], 201);
    }
}