<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile(){
        return view('users.profile', ['menu'=>'home']);
    }

    public function getUbah($id){
        $user = User::find($id);
        echo $user;
    }

    public function editFoto(Request $request, $id){

        $client = new Client();

        $file = base64_encode(file_get_contents($request->foto_profil));
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
        $gambar = $data->image->display_url;
        
        User::where('id', Auth::user()->id)->update([
            'foto_profil' => $gambar
        ]);
        
        return redirect('/user/profile')->with('status', 'Data berhasil diubah');
    }

    public function update(Request $request, $id){

        User::where('id', $id)->update([
            'nama_lengkap' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat
        ]);
        
        return redirect('/user/profile')->with('status', 'Data berhasil diubah');

    }

    public function resetPassword(Request $request, $id){
        $data = User::find($id);
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'password'=> 'required|confirmed|min:8'
        ]);
        if(!Hash::check($request->oldPassword, $data->password)){
            return redirect('/user/profile')->with('status', 'Password lama yang anda inputkan salah');
        }
        if($validator->fails()) {
            return redirect('/user/profile')->with('status', $validator->errors()->first());
        }

        $data->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect('/user/profile')->with('status', "Password berhasil diubah");
    }


}
