<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['keterangan', 'berat', 'debit', 'jenis_id'];

    public function jenis(){
        return $this->belongsTo('App\JenisSampah');
    }
}
