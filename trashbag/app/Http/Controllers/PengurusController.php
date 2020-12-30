<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class PengurusController extends Controller
{
    public function index(){
        $pengurus = User::where('role', '!=', 1)->Where('role', '!=', 5)->get();
        // dd($pengurus);
        return view('pengurus.index', ['menu'=> 'pengurus', 'pengurus'=>$pengurus]);
    }

    public function show($id){
        $pengurus = User::find($id);
        return view('pengurus.detail', ['menu' => 'pengurus', 'pengurus'=>$pengurus]);
    }

    public function create(){
        return view('pengurus.create', ['menu'=> 'pengurus']);

    }

    public function store(Request $request){

        $client = new Client();

        Validator::make($request->all(),[
            'nama' => 'required|string',
            'no_telepon' => 'required|digits_between:10,13',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'alamat' => 'required',
            'level' => 'requried',
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
            'role' => $request->role
        ]);

        return redirect('/pengurus')->with('status', 'Data berhasil ditambahkan');
        
    }

    public function edit($id){
        $pengurus = User::find($id);
        return view('pengurus.edit', ['menu'=> 'pengurus', 'pengurus'=>$pengurus]);
    }

    public function update(Request $request, $id){

        if($request->password != null){
            Validator::make($request->all(),[
                'nama' => 'required|string',
                'no_telepon' => 'required|digits_between:10,13',
                'email' => 'required|email',
                'password' => 'confirmed|min:8',
                'alamat' => 'required',
                'level' => 'requried',
                'foto_profil' => 'image'
            ])->validate();
        }else{
            Validator::make($request->all(),[
                'nama' => 'required|string',
                'no_telepon' => 'required|digits_between:10,13',
                'email' => 'required|email',
                'alamat' => 'required',
                'level' => 'requried',
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
            'role' => $request->role
        ]);

        return redirect('pengurus')->with('status', 'Data berhasil diubah');

    }

    public function destroy($id){
        User::destroy($id);

        return redirect('pengurus')->with('status', 'Data berhasil dihapus');
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

}
