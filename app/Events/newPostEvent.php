<?php

namespace App\Events;

use App\Sellers_details_tabs;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class newPostEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sellersPost;

    public function __construct(Sellers_details_tabs $sellersPost)
    {
        $this->sellersPost   = $sellersPost;
    }

}
