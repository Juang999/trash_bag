<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisSampah extends Model
{
    protected $table = 'jenissampah';
    protected $fillable = ['jenis_sampah', 'harga'];

    public function penjualan(){
        return $this->hasMany('App\Penjualan');
    }

    public function setoran(){
        return $this->hasMany('App\Setoran');
    }

    public function buku_tabungan(){
        return $this->hasMany('App\BukuTabungan');
    }
}
