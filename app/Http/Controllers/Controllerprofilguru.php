<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Controllerprofilguru extends Controller
{
     public function index()
    {    
        return view('profilguru');
        return redirect()->route('profilguru');
    }
}
