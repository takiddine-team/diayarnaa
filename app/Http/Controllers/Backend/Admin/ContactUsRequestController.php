<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Models\ContactUsRequest;
use App\Http\Controllers\Controller;

class ContactUsRequestController extends Controller
{
    //================================================================
    //==================== Index Function Section ====================
    //====================Created by: Lujain Samdi=================
    //================================================================


    public function index(Route $route)
    {
        try {
            $contactUsRequests = ContactUsRequest::all();
            return view('admin.contact_us_request.index', compact('contactUsRequests'));
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
            $contactUsRequest = ContactUsRequest::find($id);
            if ($contactUsRequest) {
                return view('admin.contact_us_request.show', compact('contactUsRequest'));
            } else {
                return redirect()->route('super_admin.contact_us_request-index')->with('danger', 'Contact Us Request Not Found');
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
            $contactUsRequests = ContactUsRequest::find($id);
            if ($contactUsRequests) {
                $contactUsRequests->delete();
                return redirect()->back()->with('success', 'Contact Us Request Deleted Successfully');
            }
            return redirect()->back()->with('danger', 'Contact Us Request Not Found');
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
