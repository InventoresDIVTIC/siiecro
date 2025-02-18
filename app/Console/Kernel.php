<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $this->tareasProgramadas($schedule);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected function tareasProgramadas(Schedule $schedule){

        if (env("APP_DEBUG") || true) {        
            $schedule->call('App\Http\Controllers\RespaldosController@realizarTransferenciaClouds')->everyMinute();
            $schedule->call('App\Http\Controllers\RespaldosController@eliminarArchivosDeDriveMayor30Dias')->everyMinute();
        } else{
            $schedule->call('App\Http\Controllers\RespaldosController@realizarTransferenciaClouds')->daily();
            $schedule->call('App\Http\Controllers\RespaldosController@eliminarArchivosDeDriveMayor30Dias')->daily();
        }
    }
}
