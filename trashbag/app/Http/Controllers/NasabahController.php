<?php

namespace App\Http\Controllers;

use App\BukuTabungan;
use App\Setoran;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class NasabahController extends Controller
{
    public function index(){
        $nasabah = User::where('role', 1)->get();
        return view('nasabah.index', ['menu'=>'nasabah', 'nasabah'=>$nasabah]);
    }

    public function show($id){
        $nasabah = User::where('id',$id)->with('BukuTabungan', 'BukuTabungan.jenis')->first();
        return view('nasabah.detail', ['menu'=>'nasabah', 'nasabah'=>$nasabah]);
    }

    public function bukuTabungan($id){
        $buku = BukuTabungan::where('user_id', $id)->with('jenis')->get();
        $saldo = BukuTabungan::select('user_id', 'saldo')->where('user_id', $id)->latest()->first();
        return view('nasabah.buku', ['menu'=> 'nasabah', 'buku'=>$buku, 'saldo'=>$saldo]);
    }


    public function create(){
        return view('nasabah.create', ['menu'=>'nasabah']);
    }

    public function store(Request $request){

        $client = new Client();

        Validator::make($request->all(),[
            'nama' => 'required|string',
            'no_telepon' => 'required|digits_between:10,13',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'alamat' => 'required',
            'foto_profil' => 'required|image'
            
        ])->validate();

        $gambar = $this->imageUpload($request->foto_profil);

        // dd($request->role);

        $user = User::create([
            'nama_lengkap' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'foto_profil' => $gambar,
            'role' => 1
        ]);

        BukuTabungan::create([
            'user_id' => $user->id
        ]);

        return redirect('/nasabah')->with('status', 'Data berhasil ditambahkan');
        
    }

    public function edit($id){
        $nasabah = User::find($id);
        return view('nasabah.edit', ['menu'=>'nasabah', 'nasabah'=>$nasabah]);
    }

    public function update(Request $request, $id){

        if($request->password != null){
            Validator::make($request->all(),[
                'nama' => 'required|string',
                'no_telepon' => 'required|digits_between:10,13',
                'email' => 'required|email',
                'password' => 'confirmed|min:8',
                'alamat' => 'required',
                'foto_profil' => 'image'
            ])->validate();
        }else{
            Validator::make($request->all(),[
                'nama' => 'required|string',
                'no_telepon' => 'required|digits_between:10,13',
                'email' => 'required|email',    
                'alamat' => 'required',
                'foto_profil' => 'image'
            ])->validate(); 
        }

        $data = User::find($id);
        $gambar = $data->foto_profil;
        $password = $data->password;

        if($request->foto_profil != null){
            $gambar = $this->imageUpload($request->foto_profil);
        }
        if($request->password != null){
            $password = Hash::make($request->password);
        }

        $data->update([
            'nama_lengkap' => $request->nama,
            'email' => $request->email,
            'password' => $password,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'foto_profil' => $gambar,
        ]);

        return redirect('nasabah')->with('status', 'Data berhasil diubah');

    }

    public function penarikan(Request $request, $id){
        $saldo = BukuTabungan::select('saldo')->where('user_id', $id)->latest()->first();
        $validator = Validator::make($request->all(),[
            'nominal' => 'required'
        ]);

        if($validator->fails()){
            return redirect('nasabah/buku/'.$id)->with('status', $validator->errors()->first());
        }elseif ($request->nominal > $saldo->saldo) {
            return redirect('nasabah/buku/'.$id)->with('status', 'Nilai Nominal tidak boleh lebih besar dari saldo');
        }

        BukuTabungan::create([
            'user_id'=> $id,
            'kredit' => $request->nominal,
            'saldo' => $saldo->saldo - $request->nominal
        ]);

        return redirect('nasabah/buku/'.$id)->with('status', 'Berhasil melakukan penarikan');
    }


    public function destroy($id){
        BukuTabungan::where('user_id', $id)->delete();
        Setoran::where('user_id', $id)->delete();
        User::destroy($id);
        return redirect('nasabah')->with('status', 'Data berhasil dihapus');
    }

}
