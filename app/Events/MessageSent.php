<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user ;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user , $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
       // Log::debug("{$this->user->name} : {$this->message} ");
        return new presenceChannel('chat');

        /*presence channel:

        When using certain applications, it is usually expected that the current user is able to see all other users currently using the service alongside them.
         For instance, Dropbox Paper shows all the users that are currently viewing a document.
        This is very useful and it helps stop users feeling like they are alone on your application.
        */
    }
}
