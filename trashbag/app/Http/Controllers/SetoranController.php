<?php

namespace App\Http\Controllers;

use App\Setoran;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function index(){
        $setoran = Setoran::with('user', 'penanggungJawab', 'jenis')->get();
        return view('setoran.index', ['menu'=>'setoran', 'setoran'=> $setoran]);
    }
}
