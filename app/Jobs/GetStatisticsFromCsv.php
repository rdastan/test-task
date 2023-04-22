<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetStatisticsFromCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = fopen(asset('books.csv'), "r");
        $books = [];

        if ($file) {
            while ($data = fgetcsv($file, 1000, ";")) {
                if(!$data[0]) {
                    continue;
                }

                list($book, $date, $sales) = $data;

                if (array_key_exists($book, $books)) {
                    $books[$book] += $sales;
                } else {
                    $books[$book] = $sales;
                }
            }

            fclose($file);
        }

        dispatch(new WriteStatisticsToCsv($books));
    }
}
