<?php

namespace App\Providers;

use App\Providers\ObraActualizadaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActualizarObraListener
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
     * @param  ObraActualizadaEvent  $event
     * @return void
     */
    public function handle(ObraActualizadaEvent $event)
    {
        //
    }
}
