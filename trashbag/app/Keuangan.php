<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $fillable = ['keterangan', 'debit', 'kredit', 'saldo'];
}
