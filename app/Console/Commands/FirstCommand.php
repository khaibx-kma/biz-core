<?php

namespace App\Console\Commands;

use App\Jobs\FirstJob;
use Illuminate\Console\Command;

class FirstCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'first:command {text?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'My first command !.... hehe';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $text = $this->argument('text');
        print('running first command....'.$text);

        $arrText = ['Queue', 'name---', '!!!'];
//        dispatch(new FirstJob($arrText));
//        FirstJob::dispatch($arrText)->delay(3);
        FirstJob::dispatch($arrText)->onQueue('queue_for_first_job');
    }
}
