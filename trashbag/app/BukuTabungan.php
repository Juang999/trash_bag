<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BukuTabungan extends Model
{
    protected $fillable = ['user_id', 'jenis_id', 'keterangan', 'berat', 'debit', 'kredit', 'saldo'];

    public function User(){
        return $this->belongsTo('App\User');
    }
}
