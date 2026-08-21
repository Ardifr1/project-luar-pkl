<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $table = 'lab';

    protected $fillable = [
        'nama_lab',
        'kapasitas_murid',
        'status',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'lab_id');
    }
}