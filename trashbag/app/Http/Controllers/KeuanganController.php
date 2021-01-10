<?php

namespace App\Http\Controllers;

use App\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index(){
        $keuangan = Keuangan::all();
        return view('keuangan.index',['menu'=>'keuangan', 'keuangan'=>$keuangan]);
    }
}
