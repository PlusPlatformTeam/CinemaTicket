<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function login(Request $request){

        return view('user.login', [
            
        ]);
    }


    public function register(Request $request){

        return view('user.register', [
            
        ]);
    }


    public function register_verification(Request $request){

        return view('user.register_verification', [
            
        ]);
    }


}
