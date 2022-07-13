<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function show(){
        return view('default.auth.reset-password')->with(['token' => \request()->token, 'email' => \request()->email]);
    }

    public function resetPassword(){
        \request()->validate([
            'token' => 'required|exists:password_resets,token',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $passwordReset = DB::table('password_resets')->where('token', \request()->token)->first();

        if(Carbon::now()->timestamp < Carbon::createFromFormat('Y-m-d H:i:s', $passwordReset->expired_at)->timestamp){
            return back()->withErrors(['token' => 'Expired token']);
        }

        DB::table('users')->where('id',  $passwordReset->user_id)->update([
            'password' => \Hash::make(\request()->password),
            'updated_at' => Carbon::now()
        ]);
        return redirect()->route('login');
    }
}
