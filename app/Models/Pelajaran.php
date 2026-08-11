<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pelajaran extends Model
{
    protected $table = 'pelajaran';

    protected $fillable = [
        'nama_pelajaran',
    ];

    public function guru()
    {
        return $this->belongsToMany(
            User::class,
            'guru_pelajaran',
            'pelajaran_id',
            'user_id'
        );
    }
}