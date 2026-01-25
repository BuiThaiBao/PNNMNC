<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function checkRegister(Request $request)
    {
        return "Register successfully";
    }
    public function checkLogin(Request $request)
    {
        if ($request->input('username') == 'baobt' && $request->input('mssv') == '0001567') {
            return "Login successfully";
        } else {
            return "Login failed";
        }
    }
}
