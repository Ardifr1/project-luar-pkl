<?php

namespace App\Http\Controllers;


class ControllerDashboard extends Controller
{
    public function index()
    {    
        return view('dashboard');
    }
}
