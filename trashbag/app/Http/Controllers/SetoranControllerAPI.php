<?php

namespace App\Http\Controllers;

use App\User;
use App\Setoran;
use App\JenisSampah;
use App\BukuTabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SetoranControllerAPI extends Controller
{
    public function store(Setoran $setoran, BukuTabungan $BukuTabungan, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'berat' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'data gagal ditambahkan', $validator->errors(), 404);
        }
        
        $harga = JenisSampah::select('harga')->where('id', $request->jenis_sampah)->first();

        $debit = $request->berat * $harga->harga;

        $id = Auth::user()->id;

        $setoran->user_id = $request->id;
        $setoran->jenis_id = $request->jenis_sampah;
        $setoran->pj = $id;
        $setoran->keterangan = $request->keterangan;
        $setoran->berat = $request->berat;
        $setoran->debit = $debit;

        $saldoS = BukuTabungan::select('saldo')->where('user_id', $request->id)->latest()->first();

        $saldo = $saldoS->saldo + $debit;

        $BukuTabungan->user_id = $request->id;
        $BukuTabungan->keterangan = $request->keterangan;
        $BukuTabungan->jenis_id = $request->jenis;
        $BukuTabungan->debit = $debit;
        $BukuTabungan->saldo = $saldo;

        try {
            $setoran->save();
            $BukuTabungan->save();

            $setoran = Setoran::where('id', $setoran->id)->with('user', 'jenis')->first();
            return $this->sendResponse('berhasil', 'setoran berhasil diinput', $setoran, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'setoran gagal diinput', $th->getMessage(), 500);
        }
    }

    public function jemput(Request $request, Setoran $setoran, BukuTabungan $BukuTabungan)
    {
        $id = Auth::user()->id;

        $setoran->user_id = $id;
        $setoran->jenis_id = $request->jenis_sampah;
        
        $BukuTabungan->user_id = $id;
        $BukuTabungan->jenis_id = $request->jenis_sampah;

        try {
            $setoran->save();
            $BukuTabungan->save();

            $jemput = Setoran::where('user_id', $setoran->user_id)->with('user', 'jenis')->latest()->first();
            return $this->sendResponse('berhasil', 'data penjemputan berhasil diambil', $jemput, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'data gagal diambil', $th->getMessage(), 404);
        }
    }

    public function index()
    {
        try {
            $index = Setoran::  where('pj', NULL)->with('user', 'jenis')->get();
            
            return $this->sendResponse('berhasil', 'data berhasil ditampilkan', $index, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'data gagal ditambahkan', $th->getMessage(), 500);
        }
    }

    public function jemputUpdate($id)
    {
        $id_pj = Auth::user()->id;

        $setoran = Setoran::find($id);

        if (!$setoran) {
            return $this->sendResponse('gagal', 'data tidak ada', NULL, 404);
        }

        $BukuTabungan = BukuTabungan::where('user_id', $setoran->user_id)->latest()->first();

        $setoran->pj = $id_pj;
        $BukuTabungan->keterangan = $setoran->keterangan;

        try {
            $setoran->save();
            $BukuTabungan->save();

            $setoran = Setoran::find($id);
            return $this->sendResponse('berhasil', 'data berhasil diupdate', $setoran, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'data gagal diupdate', $th->getMessage(), 500);
        }
    }

    public function jemputHarga(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'berat' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('error', 'data gagal divalidasi', NULL, 404);
        }

        $setoran = Setoran::find($id);

        if (!$setoran) {
            return $this->sendResponse('gagal', 'data tidak ditemukan', NULL, 404);
        }

        $harga = JenisSampah::select('harga')->where('id', $setoran->jenis_id)->first();

        $BukuTabungan = BukuTabungan::where('user_id', $setoran->user_id)->latest()->first();

        $debit = ($request->berat * $harga->harga) - (($request->berat * $harga->harga) * 20 / 100);

        $saldo = $BukuTabungan->saldo + $debit;

        $setoran->debit = $debit;

        $BukuTabungan->berat = $request->berat;
        $BukuTabungan->debit = $debit;
        $BukuTabungan->saldo = $saldo;

        try {
            $setoran->save();
            $BukuTabungan->save();

            $setoran = Setoran::where('id', $id)->with('user', 'jenis')->first();
            return $this->sendResponse('sukses', 'penjemputan sukses', $setoran, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'penjemputan gagal', NULL, 404);
        }
    }
}