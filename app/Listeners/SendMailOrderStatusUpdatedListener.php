<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\OrderStatusUpdated;
use App\Mail\OrderStatusUpdatedMail;

use Mail;

class SendMailOrderStatusUpdatedListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(OrderStatusUpdated $event)
    {
        Mail::to($event->order->user->email)->send(new OrderStatusUpdatedMail($event->order));
    }
}
