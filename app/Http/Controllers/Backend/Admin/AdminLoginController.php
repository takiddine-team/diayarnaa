<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    public function showLoginForm()
    {
        if (Auth::guard('super_admin')->check()) {
            return redirect()->intended(route('super_admin.dashboard'));
        }elseif(Auth::guard('user')->check()){
            return redirect()->intended(route('welcome'));

        }
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        if (Auth::guard('super_admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('super_admin.dashboard'));
        }
        // if unsuccessful
        $errors = [
            'username' => 'username or password is incorrect',
        ];
        return redirect()->back()->withInput($request->only('username', 'remember'))->withErrors($errors);
    }
}
