<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AdminLoginController extends Controller
{
    public function index()
    {
         $user = Auth::User();
         if($user) {
             return redirect('admin/home');
         }

        return view('admin.authentication.login', [
        ]);
    }

    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 1,
        ];
        if (Auth::attempt($login)) {
            $user = Auth::User();
            Session::put('user', $user);
            $user=Session::get('user');
            return redirect('admin/home');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
