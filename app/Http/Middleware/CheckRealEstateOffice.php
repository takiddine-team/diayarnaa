<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRealEstateOffice
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
            if (Auth::guard('user')->user()->user_type != 'Real Estate Office' ||  Auth::guard('user')->user()->status == 'Pending' || Auth::guard('user')->user()->status == 'Inactive' || Auth::guard('user')->user()->status == 'Reject') {
                return redirect()->route('welcome')->with('danger', '   لا يوجد لديك صلاحية للدخول الى الصفحه المطلوبة   ');
            }
        }

        if ((  Auth::guard('user')->user()->expire_date < now())) {
            return redirect()->route('welcome')->with('danger', '   انتهت صلاحية حسابك يرجى مراجعه الاداره  ');

        }

        

        return $next($request);
    }
}



