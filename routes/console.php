<?php

use Illuminate\Console\Scheduling\Schedule;
use App\Jobs\ProcessAlert;

app()->resolving(Schedule::class, function (Schedule $schedule) {
    $schedule->call(function () {
        for ($i = 0; $i < 6; $i++) { // Dispatch 6 times per minute
            ProcessAlert::dispatch()->delay($i * 10); // Run every 10 seconds
        }
    })->everyMinute();
});
