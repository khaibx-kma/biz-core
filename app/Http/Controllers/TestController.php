<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function test(){

//        $passwords = PasswordReset::where('user_id', 2)->get();
//        $passwords2 = DB::table('password_resets')->where('user_id', 2)->get();
//
//        PasswordReset::chunk(3, function ($passs){
//           dd($passs);
//        });
//
//        dd(2,$passwords, $passwords2);

//        $products = DB::connection('mysql_beshop')->table('product_4_web')
//            ->orderBy('id', 'DESC')
//            ->offset(2)
//            ->limit(5)
//            ->chunk(2, function ($products){
//                $products = $products->toArray();
//                array_map(function ($prduct), $products)
//                dd(123,$products->toArray());
//            });
//        dd($products);
//        return 'controller for test code';

        // export + download
        $data = [['a' =>'abc','b' => 'xyz']];
//        return Excel::download(new ProductExport($data, ['col11', 'col22']),'product.csv');
        Excel::store(new ProductExport($data, ['col11', 'col22']),'public/product2.csv');

        $zipName = storage_path('myArchive.zip');
        if(file_exists($zipName)){
            unlink($zipName);
        }
        $zip = new ZipArchive;

        if($zip->open($zipName, ZipArchive::CREATE) === true){
//            $files = File::files(storage_path());
            $zip->addFile(storage_path('app/public/product.csv'), 'product.csv');
            $zip->addFile(storage_path('app/public/product2.csv'), 'product23.csv');
            $zip->close();
        }
        return response()->download($zipName);
    }
}
