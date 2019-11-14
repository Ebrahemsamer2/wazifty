<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\User;

class EmployeeContact
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $company_id;

    public function __construct(User $user, $company_id)
    {
        $this->user = $user;
        $this->company_id = $company_id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
