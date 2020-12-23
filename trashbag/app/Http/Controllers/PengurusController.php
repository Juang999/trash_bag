<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index(){
        return view('pengurus.index', ['menu'=> 'pengurus']);
    }
}
