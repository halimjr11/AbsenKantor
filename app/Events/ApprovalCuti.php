<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ApprovalCuti implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $username;
    public $message;
    public $level;
    
    public function __construct($username, $level)
    {
        $this->level = $level;
        $this->username = $username;
        $this->message  = "{$username} Memberikan Keputusan Cuti Kerja! ";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
     public function broadcastOn()
     {
         return ['approvalcuti.'.$this->level];
     }
   
     public function broadcastAs()
     {
         return 'approval';
     }
}
