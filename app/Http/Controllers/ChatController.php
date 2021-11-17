<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChat()
    {
        return view('chat.show');
    }

    public function messageRecived(Request $request)
    {
        $rules = [
            'message' => 'required',
        ];

        $request->validate($rules);

        broadcast(new MessageSent($request->user() , $request->message));

        return response()->json('message broadcast');


    }


    public function greetRecived(Request $request,User $user)
    {
        // $myuser =  User::findOrFail($user);

                     // receiver          //sender
      return "Greeting {$user->name} from {$request->user()->name}";
    }
}
