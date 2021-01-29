<?php

namespace App\Http\Controllers;

use App\JenisSampah;
use App\BukuTabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JenisSampahControllerAPI extends Controller
{
    public function index()
    {
        $JenisSampah = JenisSampah::all('id','jenis_sampah');

        if (!$JenisSampah) {
            return $this->sendResponse('gagal', 'nama sampah tidak ditemukan', NULL, 404);
        }

        return $this->sendResponse('berhasil', 'nama sampah berhasil diambil', $JenisSampah, 200);
    }

    public function jenis()
    {
        $my_id = Auth::user()->id;

        $jenis = BukuTabungan::select('id','jenis_id', 'berat', 'saldo')->where('user_id', $my_id)->where('saldo', '!=', 0)->with('jenis')->get();
        

        return $this->sendResponse('berhasil', 'history sampah berhasil diambil', $jenis, 200);

        
    }
}
