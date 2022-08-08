<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return 'controller for test code';
    }
}
