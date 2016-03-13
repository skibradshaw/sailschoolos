<?php

namespace App\Listeners;

use App\Events\ScheduleResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClassRegistrationListener
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
     * @param  ScheduleResponse  $event
     * @return void
     */
    public function handle(ScheduleResponse $event)
    {
        //
    }
}
