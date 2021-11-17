<?php

namespace App\Events;

use App\Models\Kudo;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KudoSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $user;
    public $message;
    public $sender;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Kudo $kudo)
    {
        $this->user = $user;
        $this->message = $kudo->description;
        $this->sender = $kudo->sender;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("kudo.sent.{$this->user->id}");
    }
}
