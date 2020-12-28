<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


class UserControllerAPI extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $role = Auth::user()->role;
        $nama_lengkap = Auth::user()->nama_lengkap;
        // dd($user);
        return response()->json(compact('token', 'role', 'nama_lengkap'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'nama_lengkap' => $request->get('nama_lengkap'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'email' => 'required',
            'password' => 'required',
            'foto_profil' => 'mimes:jpg,jpeg,png',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $User = User::find($id);

        if (!$User) {
            return $this->sendResponse('gagal', 'profil gagal diubah', NULL, 404);
        }

        $client = new Client;

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

        $User->nama_lengkap = $request->nama_lengkap;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->foto_profil = $gambar;
        $User->no_telepon = $request->no_telepon;
        $User->alamat = $request->alamat;

        try {
            $User->save();
            
            $User = User::all()->where('id', $id);
            return $this->sendResponse('berhasil', 'profil berhasil diubah', $User, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'profil gagal diubah', $th->getMessage(), 500);
        }
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
}