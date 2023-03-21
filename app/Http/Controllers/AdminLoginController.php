<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;


class AdminLoginController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();

        if ($user) {
            return redirect('admin/home');
        }

        return view('admin.authentication.login', []);
    }

    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($login)) {
            $user = Auth::guard('admin')->user();

            Session::put('user', $user);
            $user = Session::get('user');

             Alert::success('Đăng nhập thành công');

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
