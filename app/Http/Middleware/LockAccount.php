<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LockAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::User();
        if (isset($user)) {

            if ($user->active == 1) {
                return $next($request);
            } else {

                Auth::logout();
                Session::flush();

                Alert::error('Tài khoản của bạn đã bị vô hiệu hóa');

                return redirect()->back();
            }
        } else {
            return $next($request);
        }
    }
}
