<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Lab;

class ControllerAjukanPeminjaman extends Controller
{
    // =========================================================
    // HALAMAN AJUKAN PEMINJAMAN
    // =========================================================

    public function index($id)
    {
        // Pastikan guru sudah login
        $user = auth()->user();

        if (!$user) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Silahkan login terlebih dahulu.'
                ]);
        }

        // Ambil mata pelajaran milik guru
        $pelajarans = $user->pelajaran;

        // Ambil semua lab
        $labs = Lab::all();

        // Ambil lab yang dipilih
        $labDipilih = Lab::findOrFail($id);

        return view(
            'ajukanpeminjaman',
            compact(
                'pelajarans',
                'labs',
                'labDipilih'
            )
        );
    }


    // =========================================================
    // PENGAJUAN MELALUI WEB
    // =========================================================

    public function store(Request $request)
    {
        // Pastikan user sudah login
        $user = auth()->user();

        if (!$user) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Silahkan login terlebih dahulu.'
                ]);
        }

        // Validasi
        $request->validate([
            'lab_id' => 'required|exists:lab,id',
            'pelajaran_id' => 'required|exists:pelajaran,id',
            'keterangan' => 'required|string',
            'tanggal_peminjaman' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Cek apakah pelajaran milik guru
        $guruMemilikiPelajaran = $user
            ->pelajaran()
            ->where('pelajaran.id', $request->pelajaran_id)
            ->exists();

        if (!$guruMemilikiPelajaran) {
            return back()
                ->withErrors([
                    'pelajaran_id' =>
                        'Pelajaran tersebut bukan pelajaran Anda.'
                ])
                ->withInput();
        }

        // Cek lab
        $lab = Lab::find($request->lab_id);

        if (!$lab) {
            return back()
                ->withErrors([
                    'lab_id' => 'Lab tidak ditemukan.'
                ])
                ->withInput();
        }

        // Cek maintenance
        if ($lab->status === 'sedang_maintenance') {
            return back()
                ->withErrors([
                    'lab_id' =>
                        'Lab sedang dalam maintenance dan tidak dapat diajukan.'
                ])
                ->withInput();
        }

        // Cek bentrok jadwal
        $labSedangDipakai = Peminjaman::where(
            'lab_id',
            $request->lab_id
        )
            ->where('status', 'disetujui')
            ->where('tanggal', $request->tanggal_peminjaman)
            ->where(function ($query) use ($request) {

                $query
                    ->where(
                        'jam_mulai',
                        '<',
                        $request->jam_selesai
                    )
                    ->where(
                        'jam_selesai',
                        '>',
                        $request->jam_mulai
                    );
            })
            ->exists();

        if ($labSedangDipakai) {
            return back()
                ->withErrors([
                    'lab_id' =>
                        'Lab tersebut sedang digunakan pada tanggal dan jam yang dipilih.'
                ])
                ->withInput();
        }

        // Simpan peminjaman
        Peminjaman::create([
            'user_id' => $user->id,
            'lab_id' => $request->lab_id,
            'pelajaran_id' => $request->pelajaran_id,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal_peminjaman,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Pengajuan peminjaman berhasil dikirim.'
            );
    }


    // =========================================================
    // PENGAJUAN MELALUI API
    // POST /api/peminjaman
    // =========================================================

    public function storeApi(Request $request)
    {
        // Pastikan user sudah login
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User belum login.'
            ], 401);
        }

        // Hanya guru
        if ($user->role !== 'guru') {
            return response()->json([
                'success' => false,
                'message' =>
                    'Hanya guru yang dapat mengajukan peminjaman'
            ], 403);
        }

        // Validasi data API
        $request->validate([
            'lab_id' => 'required|exists:lab,id',
            'pelajaran_id' => 'required|exists:pelajaran,id',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Cek kepemilikan pelajaran
        $guruMemilikiPelajaran = $user
            ->pelajaran()
            ->where(
                'pelajaran.id',
                $request->pelajaran_id
            )
            ->exists();

        if (!$guruMemilikiPelajaran) {
            return response()->json([
                'success' => false,
                'message' =>
                    'Pelajaran tersebut bukan pelajaran Anda'
            ], 403);
        }

        // Cek lab
        $lab = Lab::find($request->lab_id);

        if (!$lab) {
            return response()->json([
                'success' => false,
                'message' => 'Lab tidak ditemukan.'
            ], 404);
        }

        // Cek maintenance
        if ($lab->status === 'sedang_maintenance') {
            return response()->json([
                'success' => false,
                'message' =>
                    'Lab sedang dalam maintenance dan tidak dapat diajukan.'
            ], 422);
        }

        // Cek bentrok jadwal
        $labSedangDipakai = Peminjaman::where(
            'lab_id',
            $request->lab_id
        )
            ->where('status', 'disetujui')
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request) {

                $query
                    ->where(
                        'jam_mulai',
                        '<',
                        $request->jam_selesai
                    )
                    ->where(
                        'jam_selesai',
                        '>',
                        $request->jam_mulai
                    );
            })
            ->exists();

        if ($labSedangDipakai) {
            return response()->json([
                'success' => false,
                'message' =>
                    'Lab tersebut sedang digunakan pada tanggal dan jam yang dipilih.'
            ], 422);
        }

        // Simpan peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'lab_id' => $request->lab_id,
            'pelajaran_id' => $request->pelajaran_id,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 'menunggu',
        ]);

        // Response API
        return response()->json([
            'success' => true,
            'message' =>
                'Pengajuan peminjaman berhasil dikirim',
            'data' => $peminjaman->load([
                'user',
                'lab',
                'pelajaran'
            ])
        ], 201);
    }
}