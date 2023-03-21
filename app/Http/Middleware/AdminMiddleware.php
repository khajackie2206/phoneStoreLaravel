<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        //   if(Auth::check()){
        //       if(Auth::user()->role==1) {
        //           return $next($request);
        //       }
        //       else {
        //           return redirect('/admin/login')->with('message', 'Access denied!!!');
        //       }
        //   } else {
        //     return redirect('/home')->with('message', 'Login to access website!!!');
        //   }
        // return $next($request);
        if (Auth::guard('admin')->check()) {
            return $next($request);
        } else {
           return redirect('/admin/login')->with('message', 'Access denied!!!');
        }
    }
}
