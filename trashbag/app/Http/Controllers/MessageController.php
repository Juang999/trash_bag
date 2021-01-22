<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Pusher\Pusher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index()
    {
        $my_id = Auth::id();
        
        $from = User::select('users.id', 'users.nama_lengkap', 'users.foto_profil')->distinct()
        ->join('messages', 'users.id', '=', 'messages.to')
        ->where('users.id', '!=', $my_id)
        ->where('messages.from', '=', $my_id)->get()->toArray();

        
        $to = User::select('users.id', 'users.nama_lengkap', 'users.foto_profil')->distinct()
        ->join('messages', 'users.id', '=', 'messages.from')
        ->where('users.id', '!=', $my_id)
        ->where('messages.to', '=', $my_id)->get()->toArray();
        
        // dd($to);

        $data = array_unique(array_merge($from, $to), SORT_REGULAR);
        $message = array_values($data);

        return $this->sendResponse('berhasil', 'semua kontak berhasil diambil', $message, 200);
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->get();

        return $this->sendResponse('berhasil', 'pesan berhasil diterima', $messages, 200);
    }

    public function sendMessage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'pesan gagal divalidasi', $validator->errors(), 500);
        }

        $from = Auth::id();
        $to = $id;
        $messages = $request->message;

        $message = Message::create([
            'from' => $from,
            'to' => $to,
            'message' => $messages,
            'is_read' => 0,
        ]);

        try {
            $message->save();

        } catch (\Throwable $th) {
            
            return $th->getMessage();
        }

        $options = array(
            'cluster' => 'mt1',
            'useTLS' => true
          );
          
        $pusher = new Pusher(
            '0cc37a33022ed847be85',
            '5b91007a427f8b2f872a',
            '1139935',
            $options
         );
        
          $pusher->trigger('my-channel', 'my-event', $message);

          return $this->sendResponse('success', 'pesan berhasil dikirim', $message, 200);
    }

    public function take()
    {
        $my_id = Auth::user()->id;

        
    }
}
