<?php

namespace App\Listeners;

use App\Events\UpdateOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUpdateOrderNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdateOrder  $event
     * @return void
     */
    public function handle(UpdateOrder $event)
    {
        //
    }
}
