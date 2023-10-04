<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Opinion;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;

class OpinionController extends Controller
{
    //======================================================================
    //===========================Index function=============================
    //==========================Created By: Lujain Samdi====================
    //==========================Created At: 2021-12-22=======================

    public function index(Route $route)
    {
        try {
            $opinions = Opinion::get();
            return view('admin.opinions.index', compact('opinions'));
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

    //======================================================================
    //===========================show function=============================
    //==========================Created By: Lujain Samdi====================
    //==========================Created At: 2021-12-22=======================
    public function show($id, Route $route)
    {
        try {
            $opinion = Opinion::find($id);
            return view('admin.opinions.show', compact('opinion'));
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
            $opinion = Opinion::find($id);
            if ($opinion) {
                $opinion->delete();
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
    // ================================================================
    // ================== Active/Inactive Single ======================
    // ==================== Created By : Lujain Al-Smadi ==============
    // ================================================================
    public function activeInactiveSingle($id, Route $route)
    {
        try {
            $opinion = Opinion::find($id);
            if ($opinion) {
                if ($opinion->status == 'Active') {
                    $opinion->status = 2;
                } elseif ($opinion->status == 'Inactive') {
                    $opinion->status = 1;  // 1 => Active
                }
                $opinion->save();
                return redirect()->back()->with('success', 'تمت العملية بنجاح');
            } else {
                return redirect()->back()->with('danger', 'هذا العنصر غير موجود');
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
