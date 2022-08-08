<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FirstJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $arrText;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($arrText)
    {
        $this->arrText = $arrText;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        print('Running first job...');
        print_r($this->arrText);
        print('... end first job!');
    }
}
