<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController as Login;
use App\Http\Controllers\Auth\ForgotPasswordController as ForgotPassword;
use App\Http\Controllers\Auth\ResetPasswordController as ResetPassword;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/register', function () {
    return view('default.auth.register');
});


Route::middleware('guest')->group(function (){
    Route::get('/login', [Login::class, 'show'])->name('login.view');
    Route::post('/login', [Login::class, 'authenticate'])->name('login');
    Route::get('/forgot-password', [ForgotPassword::class, 'show'])->name('forgot-password.view');
    Route::post('/forgot-password', [ForgotPassword::class, 'sendResetLinkEmail'])->name('forgot-password');
    Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password.view');
    Route::post('/reset-password', [ResetPassword::class, 'resetPassword'])->name('reset-password');

});

Route::middleware('auth')->group(function (){
    Route::post('/logout', [Login::class, 'logout'])->name('logout');
    Route::get('/', function (){
        return view('default.dashboard.index');
    })->name('dashboard.view');
});

