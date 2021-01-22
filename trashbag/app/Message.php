<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['from', 'to', 'message', 'is_read'];

    public function from()
    {
        return $this->belongsTo('App\User');
    }

    public function to()
    {
        return $this->belongsTo('App\User');
    }
}
