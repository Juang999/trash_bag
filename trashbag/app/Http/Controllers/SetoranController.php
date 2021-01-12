<?php

namespace App\Http\Controllers;

use App\Setoran;
use App\JenisSampah;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function index(){
        $setoran = Setoran::with('user', 'penanggungJawab', 'jenis')->get();
        $jumlah = JenisSampah::select('jenis_sampah', DB::raw('sum(setorans.berat) as jumlah'))->leftJoin('setorans', 'jenissampah.id', '=', 'setorans.jenis_id')->groupby('jenis_sampah')->orderby('jenissampah.id')->get();
        // dd($jumlah);
        return view('setoran.index', ['menu'=>'setoran', 'setoran'=> $setoran, 'jumlah'=>$jumlah]);
    }
}
