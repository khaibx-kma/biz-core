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

        $products = DB::connection('mysql_beshop')->table('product_4_web')->limit(5)->get();
        dd($products);
        return 'controller for test code';
    }
}
