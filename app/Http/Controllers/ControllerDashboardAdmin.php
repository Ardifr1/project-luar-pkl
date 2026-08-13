<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerDashboardAdmin extends Controller
{
      public function index()
    {    
        return view('dashboardadmin');
        return redirect()->route('dashboardadmin');
    }
}
