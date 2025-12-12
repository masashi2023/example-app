<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sample-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'サンプルコマンド';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        echo 'このコマンドはサンプルです';
        return 0;
    }
}
