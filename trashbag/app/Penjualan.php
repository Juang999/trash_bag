<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['pj', 'keterangan', 'berat', 'debit', 'jenis_id'];

    public function jenis(){
        return $this->belongsTo('App\JenisSampah');
    }

    public function user(){
        return $this->belongsTo('App\User', 'pj');
    }
}
