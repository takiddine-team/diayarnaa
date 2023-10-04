<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRealEstateSeeker
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
        if (Auth::guard('user')->check()) {
            
            if (Auth::guard('user')->user()->user_type != 'Real Estate Seeker' ||   Auth::guard('user')->user()->status == 'Inactive') {
                return redirect()->route('welcome')->with('danger', '   لا يوجد لديك صلاحية للدخول الى الصفحه المطلوبة   ');
            }
        }
        return $next($request);
    }
}
