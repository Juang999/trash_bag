<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengurusController extends Controller
{
    public function index(){
        $pengurus = User::where('role', 2)->orWhere('role', 3)->get();
        return view('pengurus.index', ['menu'=> 'pengurus', 'pengurus'=>$pengurus]);
    }

    public function create(){
        return view('pengurus.create', ['menu'=> 'pengurus']);

    }

    public function store(Request $request){

        Validator::make($request->all(),[
            'nama' => 'required|string',
            'no_telepon' => 'required|digits_between:10,13',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'alamat' => 'required',
            'level' => 'requried'
        ])->validate();
        
    }
}
