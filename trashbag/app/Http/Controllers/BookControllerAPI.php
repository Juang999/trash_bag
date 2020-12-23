<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BookControllerAPI extends Controller
{
    public function book() {
        $data = "Data All Book";
        return response()->json($data, 200);
    }

    public function bookAuth() {
        $data = "Welcome " . Auth::user()->nama_lengkap;
        return response()->json($data, 200);
    }
}