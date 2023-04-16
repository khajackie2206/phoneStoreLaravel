<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ValidateUserLogin;
use RealRashid\SweetAlert\Facades\Alert;
use Laravel\Socialite\Facades\Socialite;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            //  auth()->login($existingUser, true);
            if ($existingUser->active == 0) {
                Alert::error('Lỗi', 'Tài khoản đã bị vô hiệu hóa!');
                return redirect()->to('login');
            }
            Session::put('user', $existingUser);
            Alert::success('Thành công', 'Đăng nhập thành công');
            return redirect('/');
        } else {
            $newUser = new User();
            $newUser->provider_name = 'google';
            $newUser->provider_id = $user->getId();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->active = true;
            $newUser->avatar = $user->getAvatar();
            $newUser->save();

            Session::put('user', $newUser);
            Alert::success('Thành công', 'Đăng nhập thành công');
            return redirect('/');
        }

        return redirect($this->redirectPath());
    }

    public function index(Request $request)
    {

        // get all brands
        $brands = Brand::where('active', 1)->where('delete_at', null)->get();
        //get all categories
        $categories = ProductCategory::where('active', 1)->get();

        if ($request->input('url')) {
            return view('auth.login', [
                'title' => 'Đăng nhập',
                'url' => $request->input('url'),
                'brands' => $brands,
                'categories' => $categories,
            ]);
        }
        return view('auth.login', [
            'title' => 'Đăng nhập',
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }

    public function registerPage()
    {

        // get all brands
        $brands = Brand::where('active', 1)->where('delete_at', null)->get();
        //get all categories
        $categories = ProductCategory::where('active', 1)->get();

        return view('auth.register', [
            'title' => 'Đăng Ký',
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }

    public function postLogin(ValidateUserLogin $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            $user = Auth::User();

            if (!$user->is_email_verified) {
                Alert::error('Cần kích hoạt tài khoản trước khi đăng nhập!');
                return redirect()->back();
            }

            if ($user->active == 0) {
                Alert::error('Tài khoản đã bị vô hiệu hóa!');
                return redirect()->back();
            }

            Session::put('user', $user);
            $user = Session::get('user');
            if ($request->url) {
                Alert::success('Thành công', 'Đăng nhập thành công');
                return redirect($request->url);
            }

            Alert::success('Thành công', 'Đăng nhập thành công');
            return redirect('/');
        } else {
            Alert::error('Tên đăng nhập hoặc mật khẩu không chính xác!');
            return redirect()->back();
        }
    }

    public function getLogout()
    {
        Auth::logout();

        Session::forget('user');
        Session::flush();
        return redirect()->route('index');
    }
}
