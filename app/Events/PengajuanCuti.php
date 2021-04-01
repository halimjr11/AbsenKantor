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

class PengajuanCuti implements ShouldBroadcast
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
        $this->message  = "{$username} Mengajukan Cuti Kerja! ";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
     public function broadcastOn()
     {
         return ['pengajuancuti.'.$this->level];
     }
   
     public function broadcastAs()
     {
         return 'pengajuan';
     }
}
