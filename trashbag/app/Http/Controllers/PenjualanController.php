<?php

namespace App\Http\Controllers;

use App\User;
use App\Keuangan;
use App\JenisSampah;
use App\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index(){
        $penjualan = Penjualan::with('user', 'jenis')->get();
        // dd($penjualan);
        return view('penjualan.index', ['menu'=> 'penjualan', 'penjualan' => $penjualan]);
    }
}
