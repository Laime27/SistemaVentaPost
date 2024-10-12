<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Login Success',
                'user' => Auth::user()
            ]);

        } else {
            return response()->json([
                'message' => 'Login Failed',
            ]);
        }



    }


}
