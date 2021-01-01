<?php

namespace App\Http\Controllers;

use App\JenisSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisSampahController extends Controller
{
    public function index(){
        $jenisSampah = JenisSampah::all();
        return view('jenis.index',['menu'=>'jenis', 'jenisSampah' => $jenisSampah]);
    }

    public function create(){
        return view('jenis.create', ['menu' => 'jenis']);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'jenis_sampah' => 'required|string',
            'harga' => 'required'
        ]);
        if($validator->fails()) {
            return redirect('jenis')->with('status', $validator->errors()->first());
        }

        JenisSampah::create([
            'jenis_sampah' => $request->jenis_sampah,
            'harga' => $request->harga
        ]);

        return redirect('jenis')->with('status', 'Data berhasil ditambahkan');
    }

    public function getEdit($id){
        $user = JenisSampah::find($id);
        echo $user;
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'jenis_sampah' => 'required|string',
            'harga' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('jenis')->with('status', $validator->errors()->first());
        }

        JenisSampah::where('id', $id)->update([
            'jenis_sampah' => $request->jenis_sampah,
            'harga' => $request->harga
        ]);

        return redirect('jenis')->with('status', 'Data berhasil diubah');
    }

    public function destroy($id){
        JenisSampah::destroy($id);
        return redirect('jenis')->with('status', 'Data berhasil dihapus');
    }
}
