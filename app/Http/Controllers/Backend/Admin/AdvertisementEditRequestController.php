<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\AdvertisementEditRequest;
use App\Models\Mail;

class AdvertisementEditRequestController extends Controller
{
    //======================================================================
    //========================= index  function ============================
    //==========================Created By: Lujain Samdi====================
    public function index(Route $route)
    {
        try {
            $advertisement_edit_requests = AdvertisementEditRequest::get();
            return view('admin.advertisement_edit_requests.index', compact('advertisement_edit_requests'));
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
            return view('errors.support_tickets', compact(
                'th',
                'function_name',
                'end_error_ticket'
            ));
        }
    }


    //======================================================================
    //========================= accept  function ===========================
    //==========================Created By: Lujain Samdi====================

    public function accept(Route $route, $id)
    {
        try {
            $edit_request = AdvertisementEditRequest::find($id);
            if ($edit_request) {
                if ($edit_request->status == 'Pending') {
                    DB::transaction(function () use ($edit_request) {
                        $edit_request->update([
                            'status' => 2,
                        ]);

                        Mail::create([
                            'sender_id' => auth()->user()->id,
                            'receiver_id' => $edit_request->user_id,
                            'sender_type' => 1,
                            'receiver_type' => 2,
                            'advertisement_id' => $edit_request->advertisement_id,
                            'details' => 'تم قبول طلبك لتعديل الاعلان',
                            'email_type' => 3,
                        ]);
                    });
                    DB::transaction(function () use ($edit_request) {
                        Advertisement::where('id', $edit_request->advertisement_id)->update([
                            'edit_balance' => 1,
                        ]);
                    });
                }

                return redirect()->route('super_admin.advertisement_edit_request-index')->with('success', '  تمت الموافقه على  طلب التعديل ..');
            } else {
                return redirect()->back()->with('danger', ' طلب التعديل غير موجود ..');
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
            return view('errors.support_tickets', compact(
                'th',
                'function_name',
                'end_error_ticket'
            ));
        }
    }
    //======================================================================
    //========================= reject  function ===========================
    //==========================Created By: Lujain Samdi====================

    public function reject(Route $route, $id)
    {
        try {
            $edit_request = AdvertisementEditRequest::find($id);
            if ($edit_request) {
                if ($edit_request->status == 'Pending') {
                    DB::transaction(function () use ($edit_request) {
                        $edit_request->update([
                            'status' => 3,
                        ]);

                        Mail::create([
                            'sender_id' => auth()->user()->id,
                            'receiver_id' => $edit_request->user_id,
                            'sender_type' => 1,
                            'receiver_type' => 2,
                            'advertisement_id' => $edit_request->advertisement_id,
                            'details' => 'تم رفض طلبك لتعديل الاعلان',
                            'email_type' => 4,
                        ]);
                    });
                }

                return redirect()->route('super_admin.advertisement_edit_request-index')->with('success', '  تمت الموافقه على  طلب التعديل ..');
            } else {
                return redirect()->back()->with('danger', ' طلب التعديل غير موجود ..');
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
            return view('errors.support_tickets', compact(
                'th',
                'function_name',
                'end_error_ticket'
            ));
        }
    }
}
