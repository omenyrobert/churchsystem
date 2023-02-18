<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

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
                'created_at' => \Carbon\Carbon::now()
            ]);

            $details = (object) [
                'token' => $token,
                'email' => $request->email
            ];

            Mail::to($request->email)
                ->send(
                    new \App\Mail\SendResetPasswordEmail($details)
                );
            return view('email')->with(['message' => 'Check your mail']);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function submitResetPasswordForm()
    {
        try {

            $validator = Validator::make(request()->all(), [
                'password' => 'required|confirmed'
            ]);

            if ($validator->fails()) {
                return view('password')->with(['message' => $validator->errors()->all()]);
            }

            $updatePassword = DB::table('password_resets')
                ->where([
                    'email' => request()->email,
                    'token' => request()->token
                ])
                ->first();

            if (!$updatePassword) {
                return view('password')->with(['message' => 'Invalid Token']);
            }

            User::where('email', request()->email)
                ->update(['password' => Hash::make(request()->password)]);

            DB::table('password_resets')->where(['email' => request()->email])->delete();

            return view('index');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function display_form($email, $token)
    {
        return view('password')->with(['email' => $email, 'token' => $token]);
    }
}