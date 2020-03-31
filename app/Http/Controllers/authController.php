<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;

class authController extends Controller
{

    
    public function login()
    {
        return view("auth.login");
    }
    public function logout()
    {
        Auth::logout();
        return view("auth.login");
    }
    public function processa(Request $request)
    {
        $user = User::where("username","=",$request->username)->first();
        //dd($user);
        if($user)
        {
          //  dd($user);
            if(Hash::check($request->password,$user->password)){
                Auth::login($user);
                return redirect()->route("home");
            };
        } 
        return redirect()->route("login");
    }


}
