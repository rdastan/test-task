<?php

namespace App\Console\Commands;

use App\Jobs\GetStatisticsFromCsv;
use Illuminate\Console\Command;

class ParseBookStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-book-statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new GetStatisticsFromCsv());
    }
}
