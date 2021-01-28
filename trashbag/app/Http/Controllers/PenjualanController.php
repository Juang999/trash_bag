<?php

namespace App\Http\Controllers;

use App\Keuangan;
use App\Setoran;
use App\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class PenjualanController extends Controller
{
    public function index(){
        $penjualan = Penjualan::with('user', 'jenis')->get();
        $jumlah = Penjualan::select(DB::raw('sum(berat) as jumlah'))->first();
        $setoran = Setoran::select(DB::raw('sum(berat) as jumlah'))->first();
        $keuangan = Keuangan::select('saldo')->latest('updated_at')->first();
        // dd($penjualan);
        return view('penjualan.index', 
        [
            'menu'=> 'penjualan', 
            'penjualan' => $penjualan,
            'jumlah' => $jumlah,
            'setoran' => $setoran,
            'keuangan' => $keuangan
        ]);
    }
}
