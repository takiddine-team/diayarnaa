<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\SendResetEmail;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPassword extends Controller
{
    // ================================================================
    // ================= forgetPassword Function ======================
    // ================== Created by: Lujain Smadi ================
    // ================================================================
    public function forgotPassword(Route $route)
    {
        try {
            return view('frontend.forgotPassword');
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ================================================================
    // ======================== validation Function ===================
    // =================== Created by: Lujain Smadi ===================
    // ===================Modified By Ahmad Obeidat====================
    public function validation(Route $route, $token)
    {
        try {
            $tokenData = DB::table('password_resets')->where('token', $token)->first();
            if ( $tokenData) {
                $email= $tokenData->email;
                return view('frontend.validationForm', compact('token','email'));
            } else {
                return redirect()->route('welcome')->with('danger',@trans('front.LinkHasExpired'));
            }


        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }
    // ================================================================
    // ============== validatePasswordRequest Function ================
    // =================== Created by: Lujain Smadi ===================
    //===================Updated  By:ahmad Obeidat ====================
    // ================================================================
    public function validatePasswordRequest(Request $request, Route $route)
    {
        try {
            $user = User::where('email', '=', $request->email)->first();
            if (!$user) {

                // return redirect()->back()->with('danger', 'المستخدم غير موجود');
                return redirect()->back()->with('danger', @trans('front.user_not_found'));
            }

            //Create Password Reset Token
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]);
            //Get the token just created above
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->first();

            Mail::to($request->email)->send(new SendResetEmail($tokenData));

            return redirect()->back()->with('success', @trans('front.PasswordRecoveryEmail'));
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }


    // ================================================================
    // ==================== resetNewPassword Function =================
    // ================== Created by: Lujain Smadi ================
    // ================================================================
    public function resetNewPassword(Request $request, Route $route)
    {
        try {

            $this->validate($request, [
                'email' => 'required',
                'password' => 'required|min:8|confirmed',
                'token' => 'required'
            ]);
            // return $request;
            $password = $request->password;
            // Validate the token
            $tokenData = DB::table('password_resets')
                ->where('token', $request->token)->first();
            // Redirect the user back to the password reset request form if the token is invalid
            if (!$tokenData)  return redirect()->back()->with('danger', 'User does not exist');

            $user = User::where('email', $tokenData->email)->first();
            // Redirect the user back if the email is invalid
            if (!$user)  return redirect()->back()->with('danger', 'Your email is not valid');
            //Hash and update the new password
            $user->password = Hash::make($password);
            $user->update(); //or $user->save();

            Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password]);

            //Delete the token
            DB::table('password_resets')->where('email', $user->email)
                ->delete();

            return redirect()->route('welcome')->with('success', @trans("front.passwordUpdatedSuccessfully"));
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
            $check_old_errors = new SupportTicket();
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }
}
