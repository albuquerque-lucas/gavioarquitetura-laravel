<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public
        $clientName,
        $clientEmail,
        $clientSubject,
        $clientMessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($clientName, $clientEmail, $clientSubject, $clientMessage)
    {
        $this->clientName = $clientName;
        $this->clientEmail = $clientEmail;
        $this->clientSubject = $clientSubject;
        $this->clientMessage = $clientMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
