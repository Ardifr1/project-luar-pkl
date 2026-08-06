<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ControllerLogin extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Perform login logic here (e.g., check credentials, authenticate user)

        // For demonstration purposes, let's assume the login is successful
        return redirect()->route('dashboard');
    }
}
