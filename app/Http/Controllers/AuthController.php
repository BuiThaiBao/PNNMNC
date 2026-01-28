<?php

namespace App\Http\Controllers;

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
}
