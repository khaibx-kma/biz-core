<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    private string $successMessage;

    public function __construct(){
        $this->successMessage = "Let's check your email!";
    }

    public function show(){
        return view('default.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        $email = $request->input('email');
        $user = User::where('email', $request->input('email'))->first()->toArray();

        $token = \Str::random(64);
        DB::table('password_resets')->insert([
            'user_id' => $user['id'],
            'token' => $token,
            'expired_at' => Carbon::now()->subMinutes(5),
            'created_at' => Carbon::now(),
        ]);

        $link = route('reset-password.view', ['token' => $token, 'email' => $email]);
        \Mail::send('default.auth.forgot-password-email', ['actionLink' => $link, 'email' => $email, 'appName' => env('APP_NAME')], function($message) use($email){
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $message->to($email, 'Your mail')->subject('Reset Password');
        });

        return redirect()->back()->with('success', $this->successMessage);
    }
}
