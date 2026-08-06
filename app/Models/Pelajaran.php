<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    protected $table = 'pelajaran';
    protected $fillable = [
        'nama_pelajaran',
    ];

    public function gurus()
    {
        return $this->belongsToMany(Guru::class, 'guru_pelajaran');
    }
}