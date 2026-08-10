<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = [
        'user_id',
        'pelajaran_id',
        'keterangan',
        'tanggal_peminjaman',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }
}