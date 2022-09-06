<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ValidateUserLogin;

class LoginController extends Controller
{
     public function index()
    {
        return view('auth.login-register', [
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
            $user=Session::get('user');
            return redirect('/');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('index');
    }
}
