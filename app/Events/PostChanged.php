<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $broadcastQueue  = 'web-socket';
    public $what;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($what)
    {
        $this->what = $what;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('post-changed');
    }
}
