<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ValidateRegistration;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\UserVerify;

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
                'active' => 1,
            ]
        );

        $token = Str::random(64);


     Mail::send('mail.email-verification', ['token' => $token], function ($message) use ($request) {
       $message->to($request->gmail);
       $message->subject('Kích hoạt tài khoản');
     });

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        Alert::success('Đăng ký tài khoản thành công, vui lòng kiểm tra email để kích hoạt tài khoản');
        return redirect('/');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Email của bạn chưa được xác thực!';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->active = 1;
                $verifyUser->user->save();
                $message = "Tài khoản của bạn đã được xác thực. Bạn có thể đăng nhập";
            } else {
                $message = "Tài khoản của bạn đã được xác thực. Bạn có thể đăng nhập";
            }
        }

        Alert::success($message);
        return redirect()->route('user-login');
    }
}
