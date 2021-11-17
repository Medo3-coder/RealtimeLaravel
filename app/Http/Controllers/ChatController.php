<?php

namespace App\Http\Controllers;

use App\Events\GreetingSent;
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
              broadcast( new GreetingSent($user , "{$request->user()->name} greeted you"));  // receiver
              broadcast( new GreetingSent($request->user() , "you greeted {$user->name}"));   // sender
                        // receiver       //sender
      return "Greeting {$user->name} from {$request->user()->name}";
    }
}
