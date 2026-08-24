<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Lab;

class ControllerAjukanPeminjaman extends Controller
{
    // =========================
    // HALAMAN AJUKAN PEMINJAMAN
    // =========================

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


        // =========================
        // AMBIL MATA PELAJARAN GURU
        // =========================

        $pelajarans = $user->pelajaran;


        // =========================
        // AMBIL SEMUA LAB
        // =========================

        $labs = Lab::all();


        // =========================
        // AMBIL LAB YANG DIPILIH
        // =========================

        $labDipilih = Lab::findOrFail($id);


        // =========================
        // TAMPILKAN HALAMAN
        // =========================

        return view(
            'ajukanpeminjaman',
            compact(
                'pelajarans',
                'labs',
                'labDipilih'
            )
        );
    }


    // =========================
    // PENGAJUAN MELALUI WEB
    // =========================

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


        // =========================
        // VALIDASI DATA
        // =========================

        $request->validate([

            'lab_id' => 'required|exists:lab,id',

            'pelajaran_id' => 'required|exists:pelajaran,id',

            'keterangan' => 'required|string',

            'tanggal_peminjaman' => 'required|date',

            'jam_mulai' => 'required|date_format:H:i',

            'jam_selesai' =>
                'required|date_format:H:i|after:jam_mulai',

        ]);


        // =========================
        // CEK KEPEMILIKAN PELAJARAN
        // =========================

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


        // =========================
        // CEK LAB
        // =========================

        $lab = Lab::find($request->lab_id);


        if (!$lab) {

            return back()
                ->withErrors([
                    'lab_id' => 'Lab tidak ditemukan.'
                ])
                ->withInput();

        }


        // =========================
        // CEK LAB MAINTENANCE
        // =========================

        if ($lab->status === 'sedang_maintenance') {

            return back()
                ->withErrors([
                    'lab_id' =>
                        'Lab sedang dalam maintenance dan tidak dapat diajukan.'
                ])
                ->withInput();

        }


        // =========================
        // CEK LAB SEDANG DIPAKAI
        // =========================

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


        // =========================
        // SIMPAN PEMINJAMAN
        // =========================

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


        // =========================
        // KEMBALI KE DASHBOARD
        // =========================

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
        // =========================
        // CEK USER
        // =========================

        if (!$request->user()) {

            return response()->json([
                'success' => false,
                'message' => 'User belum login.'
            ], 401);

        }


        // =========================
        // CEK ROLE
        // =========================

        if ($request->user()->role !== 'guru') {

            return response()->json([
                'success' => false,
                'message' =>
                    'Hanya guru yang dapat mengajukan peminjaman'
            ], 403);

        }


        // =========================
        // VALIDASI DATA
        // =========================

        $request->validate([

            'lab_id' =>
                'required|exists:lab,id',

            'pelajaran_id' =>
                'required|exists:pelajaran,id',

            'keterangan' =>
                'nullable|string',

            'tanggal' =>
                'required|date',

            'jam_mulai' =>
                'required|date_format:H:i',

            'jam_selesai' =>
                'required|date_format:H:i|after:jam_mulai',

        ]);


        // =========================
        // CEK KEPEMILIKAN PELAJARAN
        // =========================

        $guruMemilikiPelajaran = $request
            ->user()
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


        // =========================
        // CEK LAB
        // =========================

        $lab = Lab::find($request->lab_id);


        if (!$lab) {

            return response()->json([

                'success' => false,

                'message' => 'Lab tidak ditemukan.'

            ], 404);

        }


        // =========================
        // CEK MAINTENANCE
        // =========================

        if ($lab->status === 'sedang_maintenance') {

            return response()->json([

                'success' => false,

                'message' =>
                    'Lab sedang dalam maintenance dan tidak dapat diajukan.'

            ], 422);

        }


        // =========================
        // CEK LAB SEDANG DIPAKAI
        // =========================

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


        // =========================
        // SIMPAN PEMINJAMAN
        // =========================

        $peminjaman = Peminjaman::create([

            'user_id' =>
                $request->user()->id,

            'lab_id' =>
                $request->lab_id,

            'pelajaran_id' =>
                $request->pelajaran_id,

            'keterangan' =>
                $request->keterangan,

            'tanggal' =>
                $request->tanggal,

            'jam_mulai' =>
                $request->jam_mulai,

            'jam_selesai' =>
                $request->jam_selesai,

            'status' =>
                'menunggu',

        ]);


        // =========================
        // RESPONSE API
        // =========================

        return response()->json([

            'success' => true,

            'message' =>
                'Pengajuan peminjaman berhasil dikirim',

            'data' =>
                $peminjaman->load([
                    'user',
                    'lab',
                    'pelajaran'
                ])

        ], 201);
    }
}