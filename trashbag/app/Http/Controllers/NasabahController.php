<?php

namespace App\Http\Controllers;

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
        $nasabah = User::find($id);
        return view('nasabah.detail', ['menu'=>'nasabah', 'nasabah'=>$nasabah]);
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

        User::create([
            'nama_lengkap' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'foto_profil' => $gambar,
            'role' => 1
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

    public function imageUpload($data){

        $client = new Client();

        $file = base64_encode(file_get_contents($data));
        $response = $client->request('POST', 'https://freeimage.host/api/1/upload',[
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $file,
                'format' => 'json'
            ]
        ]);
        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        return $data->image->display_url;

    }

    public function destroy($id){
        User::destroy($id);
        return redirect('nasabah')->with('status', 'Data berhasil dihapus');
    }

}
