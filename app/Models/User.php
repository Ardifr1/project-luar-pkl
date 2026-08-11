<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Pelajaran;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'name',
        'username',
        'nip',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

        public function pelajaran()
    {
        return $this->belongsToMany(
            Pelajaran::class,
            'guru_pelajaran',
            'user_id',
            'pelajaran_id'
        );
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'user_id');
    }
}