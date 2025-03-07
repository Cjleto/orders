<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Events\OrderStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated|OrderStatusChanged $event): void
    {
        // TODO: Send notification to user
        info('Notification sent to user for order '.$event->order->id);

    }
}
