<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BukuTabungan extends Model
{
    protected $fillable = [];

    public function User(){
        return $this->belongsTo('App\User');
    }
}
