<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlacedOrder implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $notify;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($notify)
  {
    $this->notify = $notify;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\Channel|array
   */
  public function broadcastOn()
  {
    // return new Channel('order-tracker');
    return [
      'rider-tracker-' . $this->notify->rider_id,
      'merchant-tracker' . $this->notify->merchant_id
    ];
  }
}
