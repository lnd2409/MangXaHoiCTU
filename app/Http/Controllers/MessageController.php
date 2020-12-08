<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        if ($messages = Redis::get('messages.all')) {
            return json_decode($messages);
        }
        $messages = App\Models\Message::with('student')->get();
        Redis::set('messages.all', $messages);
 
        return view('welcome');
    }
 
    public function store()
    {
        $user = Auth::user();
        $message = App\Models\Message::create(['message'=> request()->get('message'), 'stu_id' => $user->stu_id]);
        broadcast(new MessagePosted($message, $user))->toOthers();
 
        return $message;
    }
}
