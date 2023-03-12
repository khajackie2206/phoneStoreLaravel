<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ForgetPasswordController extends Controller
{
     /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('user.forget-password',['title' => 'Quên mật khẩu']);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);

          $token = Str::random(64);

          DB::table('password_resets')->insert([
              'email' => $request->email,
              'token' => $token,
              'created_at' => Carbon::now()
            ]);

          Mail::send('mail.forget-password', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Phục hồi mật khẩu');
          });


        //   Alert::success('Chúng tôi đã gởi mã phục hồi vào email của bạn');
          return back()->with('message', 'Chúng tôi đã gởi mã khôi phục vào email!');;
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) {
         return view('user.reset-password', ['token' => $token, 'title' => 'Phục hồi mật khẩu']);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
         $validate =  $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

          if(!$updatePassword){
             Alert::error('Mã phục hồi đã hết hiệu lực');

             return redirect()->back();
          }

          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

           Alert::success('Cập nhật mật khẩu thành công');

          return redirect('/login');
      }
}
