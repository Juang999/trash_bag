<?php

namespace App\Http\Controllers;

use App\User;
use App\Setoran;
use App\JenisSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SetoranController extends Controller
{
    public function store(Setoran $setoran, Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'berat' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'data gagal ditambahkan', $validator->errors(), 404);
        }
        
        $harga = JenisSampah::select('harga')->where('id', $request->jenis_sampah)->first();
        
        $debit = $request->berat . $harga;

        $setoran->user_id = $request->id;
        $setoran->jenis_id = $request->jenis_sampah;
        $setoran->pj = $id;
        $setoran->keterangan = $request->keterangan;
        $setoran->berat = $request->berat;
        $setoran->debit = $debit;

        try {
            $setoran->save();

            $setoran = Setoran::all()->where('pj', $id);
            return $this->sendResponse('berhasil', 'setoran berhasil diinput', $setoran, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'setoran gagal diinput', $th->getMessage(), 500);
        }
    }
}