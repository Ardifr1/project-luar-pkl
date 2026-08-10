<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class MockApiController extends Controller
{
    public function index()
    {
        return response()->json([
        'status' => true,
        'message' => 'Mock API berhasil diakses',
        ]);
    }
}