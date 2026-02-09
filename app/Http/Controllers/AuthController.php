<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn()
    {
        return view('register');
    }
    public function checkSignIn(Request $request)
    {
        $data = $request->all();
        if ($data['username'] != "baobt" || $data['mssv'] != "0001567") {
            return "Đăng ký thất bại";
        }
        if ($data['password'] != $data['repass']) {
            return "Đăng ký thất bại";
        }
        return "Đăng ký thành công";
    }

    public function showLoginForm()
    {
        return view('login');
    }
    public function checkLogin(Request $request)
    {
        $account = $request->only('email', 'password');
        if (Auth::attempt($account)) {
            return redirect('/admin');
        } else {
            return back()->withErrors([
                'login' => 'Email or password incorrect',
            ]);
        }
    }
    public function logout()
    {

    }
}
