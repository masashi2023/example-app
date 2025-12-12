<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule::command('app:sample-command')->cron('14 9 * * *')->emailOutputTo('info@example.com');

// メールカウントのスケジュール
Schedule::command('mail:send-draily-tweet-count-mail')->everyMinute();
