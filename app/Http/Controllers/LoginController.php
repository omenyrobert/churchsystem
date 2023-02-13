<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!is_null($user) && Hash::check($request->password, $user->password)){
            auth()->attempt(['email' => $request->email, 'password' => $request->password]);
            return redirect()->route('dashboard');
        } else{
            // return view('dashboard',compact('user'));

            return $user;

        }
    }
    public function logout()
    {
      auth()->logout();
      return view('index');
    } 
}
