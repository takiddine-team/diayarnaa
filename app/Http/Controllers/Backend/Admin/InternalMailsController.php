<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Mail;
use App\Models\User;
use App\Traits\SharedTrait;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\InternalMail\StoreMailFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Backend\InternalMailsFormRequest;

class InternalMailsController extends Controller
{
    use SharedTrait, UploadImageTrait;




    //======================================================================
    //===========================outgoing function=============================
    //==========================Created By: Lujain Samdi====================
    //==========================Created At: 2021-11-08=======================

    public function outgoing(Route $route)
    {
        try {
            return view('admin.internal_mails.outgoing');
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

    // ========================================================================
    // ====================== showOutgoing Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function showOutgoing($id, Route $route)
    {
        try {
            $mail = Mail::find($id);
            if ($mail) {
                if ($mail->deleter_type != null) {
                    if ($mail->deleter_type == 'Both') {
                        return redirect()->route('super_admin.internal_mails-outgoing')->with('danger', 'هذه الرسالة غير موجودة');
                    }
                    if (Auth::guard('super_admin')->user()->id == $mail->sender_id && $mail->sender_type == 'Admin') {
                        if ($mail->deleter_type == 'Sender') {
                            return redirect()->route('super_admin.internal_mails-outgoing')->with('danger', 'هذه الرسالة غير موجودة');
                        }
                    }
                    if (Auth::guard('super_admin')->user()->id == $mail->receiver_id && $mail->receiver_type == 'Admin') {
                        if ($mail->deleter_type == 'Receiver') {
                            return redirect()->route('super_admin.internal_mails-outgoing')->with('danger', 'هذه الرسالة غير موجودة');
                        }
                    }
                    return view('admin.internal_mails.showOutgoing', compact('mail'));
                } else {

                    return view('admin.internal_mails.showOutgoing', compact('mail'));
                }
            } else {
                return redirect()->route('super_admin.internal_mails-outgoing')->with('danger', 'هذه الرسالة غير موجودة');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }





    //======================================================================
    //===========================inbox function=============================
    //==========================Created By: Lujain Samdi====================
    //==========================Created At: 2021-11-08=======================

    public function inbox(Route $route)
    {
        try {
            return view('admin.internal_mails.inbox');
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

    // ========================================================================
    // ====================== showInbox Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function showInbox($id, Route $route)
    {
        try {
            $mail = Mail::find($id);
            if ($mail) {
                if ($mail->deleter_type != null) {
                    if ($mail->deleter_type == 'Both') {
                        return redirect()->route('super_admin.internal_mails-inbox')->with('danger', 'هذه الرسالة غير موجودة');
                    }
                    if (Auth::guard('super_admin')->user()->id == $mail->sender_id && $mail->sender_type == 'Admin') {
                        if ($mail->deleter_type == 'Sender') {
                            return redirect()->route('super_admin.internal_mails-inbox')->with('danger', 'هذه الرسالة غير موجودة');
                        }
                    }
                    if (Auth::guard('super_admin')->user()->id == $mail->receiver_id && $mail->receiver_type == 'Admin') {
                        if ($mail->deleter_type == 'Receiver') {
                            return redirect()->route('super_admin.internal_mails-inbox')->with('danger', 'هذه الرسالة غير موجودة');
                        }
                    }
                    return view('admin.internal_mails.showInbox', compact('mail'));
                } else {

                    return view('admin.internal_mails.showInbox', compact('mail'));
                }
            } else {
                return redirect()->route('super_admin.internal_mails-inbox')->with('danger', 'هذه الرسالة غير موجودة');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ===================================================================================================================
    // ============================================== sendEmail function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    public function sendEmail(Route $route)
    {

        try {

            return view('admin.internal_mails.sendEmail');
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

    // ===================================================================================================================
    // ============================================== sendEmailRequest function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    // ================================================================================================
    public function sendEmailRequest(StoreMailFormRequest $request, Route $route)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $input_request = [
                    'sender_id' => Auth::guard('super_admin')->user()->id,
                    'receiver_id' => $user->id,
                    'sender_type' => 1,
                    'receiver_type' => 2,
                    'details' => $request->details,
                    'email_type' => 1,
                ];

                if (isset($request->file)) {
                    $file_name = $this->saveFile($request->file, 'storage/mails/files/');
                    $input_request['file'] = $file_name;
                    $file = $file_name;
                } else {
                    $input_request['file'] = null;
                    $file = null;
                }

                DB::transaction(function () use ($input_request) {
                    Mail::create($input_request);
                });
                return redirect()->route('super_admin.internal_mails-outgoing')->with('success', 'تم ارسال الرسالة بنجاح');
            } else {
                return redirect()->route('super_admin.internal_mails-sendEmail')->with('danger', 'البريد الالكتروني غير موجود');
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
    // ========================================================================
    // ====================== destroy Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function destroy($id, Route $route)
    {
        try {

            $mail = Mail::find($id);

            if ($mail) {
                if ($mail->deleter_type == null) {
                    if (Auth::guard('super_admin')->user()->id == $mail->sender_id && $mail->sender_type == 'Admin') {
                        $mail->update([
                            'deleter_type' => 1,

                        ]);
                    } else if (Auth::guard('super_admin')->user()->id == $mail->receiver_id && $mail->receiver_type == 'Admin') {
                        $mail->update([
                            'deleter_type' => 2,

                        ]);
                    }
                } else {
                    DB::transaction(function () use ($mail) {
                        $mail->update([
                            'deleter_type' => 3,

                        ]);
                        $mail->delete();
                    });
                }
                return redirect()->back()->with('success', 'تم حذف البريد بنجاح');
            } else {

                return redirect()->back()->with('danger', ' لم يتم العثور على البريد');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
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
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }
}
