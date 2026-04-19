<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Jobs\AccessLog;
use App\Jobs\DatabaseLog;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        // nếu đã đăng nhập rồi thì chuyển hướng về trang board
        if(Auth::check()){
            //da login
            return redirect('/dashboard');
        }
        // chưa login thì trả về view login
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $param = $request->all();

        $credentials = [
            "email" => $param['email'],
            "password" => $param['password']
        ];
        if(Auth::attempt($credentials)){
            //login thanh cong
            return redirect('/dashboard');
            
        }
        //login that bai
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
