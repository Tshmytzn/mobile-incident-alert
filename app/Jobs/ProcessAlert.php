<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\AlertService;
use App\Events\GetAlertEvent;

class ProcessAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $alertService = new AlertService();
        $alerts = $alertService->getPendingAlerts();
        event(new GetAlertEvent($alerts));
    }
}
