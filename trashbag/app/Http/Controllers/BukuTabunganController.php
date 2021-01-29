<?php

namespace App\Http\Controllers;

use App\User;
use App\BukuTabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuTabunganController extends Controller
{
    public function saldo()
    {
        $my_id = Auth::user()->id;

        $saldo = BukuTabungan::select('saldo', 'created_at')->where('user_id', $my_id)->where('saldo', '!=', 0)->get();

        // dd($saldo);

        return $this->sendResponse('berhasi', 'history saldo berhasil ditampilkan', $saldo, 200);
    }
}
