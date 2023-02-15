<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function send_mail(Request $request)
    {
        try {


            $last_password_request = DB::table('password_resets')->where('email', $request->email)->first();

            if ($last_password_request) {
                DB::table('password_resets')->where('email', $request->email)->delete();
            }

            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::to($request->email)
                ->send(
                    new \App\Mail\SendResetPasswordEmail()
                );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}