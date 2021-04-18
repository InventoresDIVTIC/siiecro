<?php

namespace App\Listeners;

use App\Events\ObraActualizadaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Clases\Cadenas;

class ActualizarObra
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
        $obra   =   $event->obra;

        if ($obra->isDirty("nombre")) {
            $obra->generaSeo();
        }
    }
}
