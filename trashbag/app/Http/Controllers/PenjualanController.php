<?php

namespace App\Http\Controllers;

use App\User;
use App\Keuangan;
use App\JenisSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index(){
        return view('penjualan.index', ['menu'=> 'penjualan']);
    }
}
