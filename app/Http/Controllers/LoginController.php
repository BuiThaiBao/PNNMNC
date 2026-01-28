<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function login()
    {
        return view('login');
    }

    public function inputAge()
    {
        return view('inputAge');
    }
    public function checkAge(Request $request)
    {
        session()->put('age', $request->input('age'));
        return redirect()->route('product');
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
