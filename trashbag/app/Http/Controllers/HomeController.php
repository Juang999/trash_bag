<?php

namespace App\Http\Controllers;

use App\User;
use App\Setoran;
use App\Penjualan;
use App\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nasabah = User::select(DB::raw('count(id) as jumlah'))->where('role', 1)->first();
        $setoran = Setoran::select(DB::raw('sum(berat) as jumlah'))->first();
        $penjualan = Penjualan::select(DB::raw('sum(berat) as jumlah'))->first();
        $keuangan = Keuangan::select('saldo')->latest('updated_at')->first();
        // dd($keuangan);
        return view('dashboard.index', [
            'menu'=>'home', 
            'nasabah'=>$nasabah,
            'setoran'=>$setoran,
            'penjualan'=>$penjualan,
            'keuangan'=>$keuangan
            ]);
    }
}
