<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Traits\SharedTrait;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PremiumMembershipPage;
use App\Http\Requests\Backend\PremiumMembershipPage\UpdatePremiumMembershipPageFormRequest;

class PremiumMembershipPageController extends Controller
{

    use SharedTrait, UploadImageTrait;


    // ================================================================
    // ======================== index Function ========================
    // ==================== Created By : Lujain Al-Smadi ==============
    // ================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $premium_membership_page = PremiumMembershipPage::first();
            return view('admin.premium_membership_pages.index', compact('premium_membership_page'));
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
    // ======================== Edit Function =========================
    // ==================== Created By : Lujain Al-Smadi ==============
    // ================================================================
    public function edit($id, Route $route)
    {
        try {
            $premium_membership_page = PremiumMembershipPage::find($id);
            if ($premium_membership_page) {
                return view('admin.premium_membership_pages.edit', compact('premium_membership_page'));
            } else {
                return redirect()->route('super_admin.premium_membership_pages-index')->with('danger', 'البيانات غير موجودة');
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
    // ======================= Update Function ========================
    // ==================== Created By : Lujain Al-Smadi ==============
    // ================================================================
    public function update($id, UpdatePremiumMembershipPageFormRequest $request, Route $route)
    {
        try {


            $premium_membership_page = PremiumMembershipPage::find($id);
            if ($premium_membership_page) {
                // General Updated Data :
                $update_data = [
                    'description_en' => $request->description_en,
                    'description_ar' => $request->description_ar,
                 
                ];
                if (isset($request->image)) {

                    $file_name = $this->saveFile($request->image, 'storage/premium_membership_page/');
                    $update_data['image'] = $file_name;
                }


                DB::transaction(function () use ($update_data, $id) {
                    DB::table('premium_membership_pages')->where('id', $id)->update($update_data);
                });
                return redirect()->route('super_admin.premium_membership_pages-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.premium_membership_pages-index')->with('danger', 'This record does not exist in the records');
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
}
