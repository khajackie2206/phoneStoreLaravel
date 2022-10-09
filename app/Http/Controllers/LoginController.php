<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ValidateUserLogin;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('url')) {
            return view('auth.login-register', [
                'title' => 'Đăng nhập - Đăng ký',
                'url' => $request->input('url'),
            ]);
        }
        return view('auth.login-register', [
            'title' => 'Đăng nhập - Đăng ký',
        ]);
    }

    public function postLogin(ValidateUserLogin $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 0,
        ];

        if (Auth::attempt($login)) {
            $user = Auth::User();
            Session::put('user', $user);
            $user = Session::get('user');
            if($request->url) {
                return redirect($request->url);
            }

            return redirect('/');
        } else {
            return redirect()
                ->back()
                ->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('index');
    }
}
