<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |----------------------------------------------------------------------
        | CEK AUTHENTICATION
        |----------------------------------------------------------------------
        |
        | auth()->check() saja bisa berupa true dari session lama yang
        | stale, sedangkan Auth::id() / user() bisa null pada kondisi
        | tersebut. Kita cek keduanya secara eksplisit:
        |
        | - Auth::check()      : adanya flag login di session
        | - Auth::id()         : identifier user yang bisa di-resolve
        | - Auth::user()       : objek user yang benar-benar ada di DB
        |
        | Jika salah satu tidak terpenuhi, user dianggap belum login.
        | Ini mencegah fatal error/null dereference saat role diperiksa,
        | dan tetap mengarahkan user ke /login tanpa loop.
        */

        if (! Auth::check() || Auth::id() === null || Auth::user() === null) {
            return redirect()->route('login');
        }

        /*
        |----------------------------------------------------------------------
        | CEK ROLE ADMIN
        |----------------------------------------------------------------------
        |
        | Role user harus 'admin'. Jika bukan (misal guru), akses ditolak
        | dengan 403 — TANPA redirect ke /login, agar tidak terjadi loop.
        */

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
