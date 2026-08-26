<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class Controllerstatusajukan extends Controller
{
    public function index()
    {
        $pengajuan = Peminjaman::with(['lab', 'pelajaran', 'user'])
            ->where('user_id', auth()->id())
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->latest('created_at')
            ->paginate(5);

        return view('statusajukan-lab', compact('pengajuan'));
    }


    public function batalkan($id)
    {
        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Hanya pengajuan yang masih menunggu yang boleh dibatalkan
        if ($peminjaman->status !== 'menunggu') {

            return redirect()
                ->route('statusajukan')
                ->with(
                    'error',
                    'Pengajuan yang sudah disetujui tidak dapat dibatalkan.'
                );

        }

        // Ubah status menjadi dibatalkan
        $peminjaman->update([
            'status' => 'dibatalkan'
        ]);

        return redirect()
            ->route('statusajukan')
            ->with(
                'success',
                'Pengajuan berhasil dibatalkan.'
            );
    }
}