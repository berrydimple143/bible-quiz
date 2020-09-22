<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\CheckUsedPhoto::class,
        Commands\DeactivateExpired::class,
        Commands\DeactivatePost::class,
        Commands\DeleteQuizFile::class,
    ];
    
    protected function schedule(Schedule $schedule) {
        $schedule->command('used:photo')->daily();
        $schedule->command('deactivate:expired')->daily();
        $schedule->command('deactivate:post')->daily();
        $schedule->command('delele:quiz')->daily();
    }
    
    protected function commands() {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
