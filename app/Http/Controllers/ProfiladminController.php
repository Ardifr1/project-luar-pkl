<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfiladminController extends Controller
{
public function admin()
{
    $admin = User::find(session('user_id'));

    return view('profil-admin', compact('admin'));
}
}
