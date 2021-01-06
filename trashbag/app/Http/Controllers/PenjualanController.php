<?php

namespace App\Http\Controllers;

use App\User;
use App\Keuangan;
use App\Penjualan;
use App\JenisSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
<<<<<<< HEAD
    public function store(Request $request, Penjualan $penjualan, Keuangan $keuangan)
    {
        $validator = Validator::make($request->all(), [
            'berat' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $pj = Auth::user()->id;

        $debit1 = JenisSampah::where('id', $request->jenis)->first();

        $debit = $debit1->harga * $request->berat;

        $saldo1 = Keuangan::latest()->first();

        $saldo = $saldo1->saldo + $debit;

        $penjualan->pj = $pj;
        $penjualan->jenis_id = $request->jenis;
        $penjualan->keterangan = $request->keterangan;
        $penjualan->berat = $request->berat;
        $penjualan->debit = $debit;

        $keuangan->keterangan = $request->keterangan;
        $keuangan->debit = $debit;
        $keuangan->saldo = $saldo;

        try {
            $penjualan->save();
            $keuangan->save();

            $penjualan = Penjualan::where('pj', $pj)->latest()->first();
            return $this->sendResponse('sukses', 'penjualan ke pengepul sukses', $penjualan, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'data gagal diinputkan', $th->getMessage(), 500);
        }


    } 
=======
    public function index(){
        return view('penjualan.index', ['menu'=> 'penjualan']);
    }
>>>>>>> eead71f2bf3104e8534a61f5aa03b0c59d0c5782
}
