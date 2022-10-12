<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ValidateRegistration;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function create(ValidateRegistration $request)
    {
        $input = $request->all();
        $password = Hash::make(request('pass'));

        $user = User::create(
            [
                'name' => $input['full_name'],
                'email' => $input['gmail'],
                'phone' => $input['phone'],
                'password' => $password,
                'avatar' => '/images/user.png',
                'role' => 0,
                'active' => 1
            ]
        );

        Session::put('user', $user);

        Alert::success('Thành công', 'Đăng ký tài khoản thành công');
        return redirect('/');
    }
}
