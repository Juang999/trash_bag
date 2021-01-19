<?php

namespace App\Http\Controllers;

use App\User;
use App\BukuTabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TabunganControllerAPI extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $history = BukuTabungan::where('user_id', $user_id)->with('Jenis')->get();

        if (!$history) {
            return $this->sendResponse('gagal', 'history nasabah tidak ada', NULL, 500);
        }

        return $this->sendResponse('berhasil', 'data ditemukan', $history, 200);
    }

    public function show()
    {
        $user_id = Auth::user()->id;

        $saldo1 = BukuTabungan::where('user_id', $user_id)->latest()->first();

        $saldo = $saldo1->saldo;

        try {
            return $this->sendResponse('berhasil', 'saldo nasabah berhasil diambil', $saldo, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'saldo nasabah tidak ada', $th->getMessage(), 404);
        }
    }

}
