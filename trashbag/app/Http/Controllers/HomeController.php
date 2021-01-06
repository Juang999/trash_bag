<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nasabah = User::select(DB::raw('count(id) as jumlah'))->where('role', 1)->first();
        return view('dashboard.index', ['menu'=>'home', 'nasabah'=>$nasabah]);
    }
}
