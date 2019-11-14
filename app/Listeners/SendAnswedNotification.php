<?php

namespace Nimbus\Providers;

use Nimbus\Providers\answerdEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAnswedNotification
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
     * @param  answerdEvent  $event
     * @return void
     */
    public function handle(answerdEvent $event)
    {
        return $event->name;
    }
}
