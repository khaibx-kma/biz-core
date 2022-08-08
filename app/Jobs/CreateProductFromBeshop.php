<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateProductFromBeshop implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $products;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('-- Start CreateProductFromBeshop');
        try{
            $groupCodelist = array_map(function ($product){
                return $product->group_code;
            }, $this->products);
            $groupCodelist = array_unique($groupCodelist);
            $existProduct = Product::whereIn('ref_code', $groupCodelist)->pluck('ref_code')->toArray();
            Log::debug('CreateProductFromBeshop - '.json_encode($groupCodelist).' - '.json_encode($existProduct));
            $data = [];
            $added = [];
            foreach ($this->products as $product){
                if(!in_array($product->group_code, $existProduct) && !in_array($product->group_code, $added)){
                    $data[] = [
                        'product_code' => 'SP'.$product->group_code,
                        'ref_code' => $product->group_code,
                        'name' => $product->web_product_name,
                        'created_by' => 'system',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                        ];
                    $added[] = $product->group_code;
                }
            }
            Log::debug('CreateProductFromBeshop - '.json_encode($added));
            Product::insert($data);
        }catch (\Exception $e){
            Log::error('CreateProductFromBeshop - '.$e->getMessage());
        }
        Log::info('-- End CreateProductFromBeshop');
    }
}
