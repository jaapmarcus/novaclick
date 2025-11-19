<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Laravel\Cashier\Console\Commands\CashierRun;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(CashierRun::class)
    ->hourly() // run as often as you like (daily, monthly, every minute, ...)
    ->withoutOverlapping(); // make sure to include this
