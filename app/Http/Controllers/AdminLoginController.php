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
        $user = Session::get('user');

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

            if ($user->active == 0) {
                Session::flush();
                Alert::error('Tài khoản đã bị vô hiệu hóa!');
               return redirect()->back()->with('status', 'Tài khoản đã bị vô hiệu hóa');

            }

            if ($user->role == 1) {
                Alert::success('Đăng nhập thành công');
                return redirect('/admin/home');
            } else {
                Alert::success('Đăng nhập thành công');
                return redirect('/admin/dashboard-staff');
            }
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
