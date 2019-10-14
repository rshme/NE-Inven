<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function getLogin()
    {
    	return view('auth.login');
    }

    public function postLogin(AuthRequest $request)
    {
    	$credentials = [
    		'username'=>$request->username,
    		'password'=>$request->password
    	];

    	if (Auth::attempt($credentials)) {
    		return response()->json(['msg'=>'Berhasil Login', 'user'=>Auth::user()->petugas]);
    	}
    	else{

            $username = User::where('username', $request->username)->first();
            $password = User::where('password', $request->password)->first();

            if(!$username) {
                return response()->json(['msg'=>'Username Tidak Cocok'], 401);
            }
            else if (!$password) {
                return response()->json(['msg'=>'Password Tidak Cocok'], 401);
            }
    }
}

    public function logout()
    {
        Auth::logout();

        return redirect()->route('landing');
    }
}
