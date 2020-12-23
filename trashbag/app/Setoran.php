<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $fillable = ['user_id', 'jenis_id', 'keterangan', 'berat', 'debit'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function jenis(){
        return $this->belongsTo('App\JenisSampah');
    }
}
