<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\JobRequest;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;

class JobRequestController extends Controller
{
    //================================================================
    //==================== Index Function Section ====================
    //====================Created by: Lujain Samdi=================
    //================================================================


    public function index(Route $route)
    {
        try {
            $job_requests = JobRequest::all();
            return view('admin.job_requests.index', compact('job_requests'));
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


    //================================================================
    //==================== Show Function Section ====================
    //====================Created by: Lujain Samdi=================
    //================================================================

    public function show(Route $route, $id)
    {
        try {
            $job_request = JobRequest::find($id);
            if ($job_request) {
                return view('admin.job_requests.show', compact('job_request'));
            } else {
                return redirect()->route('super_admin.job_requests-index')->with('danger', 'الطلب غير موجود');
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

    //================================================================
    //==================== Delete Function Section ====================
    //====================Created by: Lujain Samdi=================
    //================================================================

    public function destroy($id, Route $route)
    {
        try {
            $job_request = JobRequest::find($id);
            if ($job_request) {
                $job_request->delete();
                return redirect()->back()->with('success', 'تم حذف الطلب بنجاح');
            }
            return redirect()->back()->with('danger', ' الطلب غير موجود');
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
