<?php

namespace App\Http\Controllers;

use App\JenisSampah;

use Illuminate\Http\Request;

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
}
