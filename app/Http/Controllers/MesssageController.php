<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class MesssageController extends Controller
{
    public function index()
    {
        if ($msg = Redis::get('messages.all')) {
            # code...
            return json_decode($msg);
        }
        $msg = App\Model\Message::with('user')->get();
        Redis::set('message.all',$msg);
        return view('welcome');
    }

    public function store()
    {
        // $user = 
    }
}
