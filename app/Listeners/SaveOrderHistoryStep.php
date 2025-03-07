<?php

namespace App\Listeners;

use App\Events\OrderStatusChanged;
use Auth;

class SaveOrderHistoryStep
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
    public function handle(OrderStatusChanged $event): void
    {
        $event->order->historySteps()->create([
            'status' => $event->order->status,
            'user_id' => Auth::id(),
        ]);
    }
}
