<?php

namespace App\Console;

use App\Models\Commission;
use App\Models\Marketer;
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
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
           $marketers = Marketer::all();
            foreach ($marketers as $marketer)
                Commission::create(['marketer_id' =>$marketer->id]);
        })->monthlyOn(1, '00:01');
    }
}
