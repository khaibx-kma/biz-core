<?php

namespace App\Console\Commands;

use App\Jobs\CreateProductFromBeshop;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CloneBeshopProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:clone_beshop {limit=100} {offset=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = $this->argument('limit');
        $offset = $this->argument('offset');
        $products = DB::connection('mysql_beshop')->table('product_4_web')
            ->orderBy('id', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get()->toArray();

        foreach (array_chunk($products, 10) as $index => $chunk){
            print ("Dispatch $index \n");
            CreateProductFromBeshop::dispatch($chunk)->onQueue('queue_create_product_from_beshop');
        }

        print ('Clone success !');
    }
}
