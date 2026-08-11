<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'lab_id',
        'pelajaran_id',
        'keterangan',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
        'alasan_penolakan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }
}