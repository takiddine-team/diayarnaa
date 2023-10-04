<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Models\PremiumMembership;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PremiumMembership\StorePremiumMembershipRequestForm;
use App\Http\Requests\Backend\PremiumMembership\UpdatePremiumMembershipRequestForm;

class PremiumMembershipController extends Controller
{

    // ========================================================================
    // ====================== index Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function index(Route $route)
    {
        try {
            $memberships = PremiumMembership::get();
            return view('admin.premium_memberships.index', compact('memberships'));
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

    // ========================================================================
    // ====================== create Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function create(Route $route)
    {
        try {
            return view('admin.premium_memberships.create');
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

    // ========================================================================
    // ====================== store Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function store(StorePremiumMembershipRequestForm $request, Route $route)
    {
        try {
            $request_data = [
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'price' => $request->price,
                'number_days_ad' => $request->number_days_ad,
                'number_days_membership' => $request->number_days_membership,
                'number_of_ads' => $request->number_of_ads,
                'status' => $request->status,
                'featured_type' => $request->featured_type,
                'unlimited_status' => $request->unlimited_status,
                'user_type' => $request->user_type,
            ];
            DB::transaction(function () use ($request_data) {
                PremiumMembership::create($request_data);
            });
            return redirect()->route('super_admin.premiumMemberships-index')->with('success', 'PremiumMembership Added Successfully');
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

    // ========================================================================
    // ====================== show Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function show($id, Route $route)
    {
        try {
            $membership = PremiumMembership::find($id);
            if ($membership) {
                return view('admin.premium_memberships.show', compact('membership'));
            } else {
                return redirect()->route('super_admin.premiumMemberships-index')->with('error', 'PremiumMembership Not Found');
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

    // ========================================================================
    // ====================== edit Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function edit($id, Route $route)
    {
        try {
            $membership = PremiumMembership::find($id);

            if ($membership) {
                return view('admin.premium_memberships.edit', compact('membership'));
            } else {
                return redirect()->route('super_admin.premiumMemberships-index')->with('danger', 'العضوية غير موجودة');
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
    // ========================================================================
    // ====================== update Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function update(UpdatePremiumMembershipRequestForm $request, $id, Route $route)
    {
        try {

            $membership = PremiumMembership::find($id);
            if ($membership) {
                $update_data = [
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'description_en' => $request->description_en,
                    'description_ar' => $request->description_ar,
                    'price' => $request->price,
                    'number_days_ad' => $request->number_days_ad,
                    'number_days_membership' => $request->number_days_membership,
                    'number_of_ads' => $request->number_of_ads,
                    'status' => $request->status,
                    'featured_type' => $request->featured_type,
                    'unlimited_status' => $request->unlimited_status,
                    'user_type' => $request->user_type,
                ];
                DB::transaction(function () use ($update_data, $membership) {
                    $membership->update($update_data);
                });
                return redirect()->route('super_admin.premiumMemberships-index')->with('success', 'PremiumMembership Updated Successfully');
            }
            return redirect()->route('super_admin.premiumMemberships-index')->with('danger', 'PremiumMembership Not Found');
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


    // ========================================================================
    // ======================== Soft Delete Function ==========================
    
    // ========================================================================
    public function softDelete($id, Route $route)
    {
        try {
            $feature = PremiumMembership::find($id);
            if ($feature) {
                DB::transaction(function () use ($feature) {
                    $feature->delete();
                });
                return redirect()->route('super_admin.premiumMemberships-index')->with('success', 'PremiumMembership Deleted Successfully');
            }
            return redirect()->route('super_admin.premiumMemberships-index')->with('danger', 'PremiumMembership Not Found');
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

    // ========================================================================
    // ====================== Show Soft Delete Function =======================
    
    // ========================================================================
    public function showSoftDelete(Request $request, Route $route)
    {
        try {
            $memberships = PremiumMembership::onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.premium_memberships.trashed', compact('memberships'));
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

    // ========================================================================
    // ==================== Soft Delete Restore Function ======================
    
    // ========================================================================
    public function softDeleteRestore($id, Route $route)
    {
        try {
            $membership = PremiumMembership::onlyTrashed()->find($id);
            if ($membership) {
                DB::transaction(function () use ($membership) {
                    $membership->restore();
                });
                return redirect()->route('super_admin.premiumMemberships-index')->with('success', 'PremiumMembership Restored Successfully');
            }
            return redirect()->route('super_admin.premiumMemberships-index')->with('danger', 'PremiumMembership Not Found');
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

    // ================================================================
    // ================== Active/Inactive Single ======================
    // ================================================================
    public function activeInactiveSingle($id, Route $route)
    {
        try {
            $membership = PremiumMembership::find($id);
            if ($membership) {
                if ($membership->status == 'Active') {
                    $membership->status = 2;
                } elseif ($membership->status == 'Inactive') {
                    $membership->status = 1;
                }
                $membership->save();
                return redirect()->route('super_admin.premiumMemberships-index')->with('success', 'PremiumMembership Status Changed Successfully');
            }
            return redirect()->route('super_admin.premiumMemberships-index')->with('danger', 'PremiumMembership Not Found');
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

    // ================================================================ 
    // ================== Active All Single ======================
    // ================================================================ 
    public function activeAll(Route $route) 
    {
        try { 
            DB::table('premium_memberships')->update(['status' =>  1]);
            return redirect()->route('super_admin.premiumMemberships-index')->with('success', 'PremiumMembership Status Changed Successfully'); 
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
    // ================================================================
    // ================== Inactive All Single ======================
    // ================================================================
    public function inactiveAll(Route $route) 
    {  
        try { 
            DB::table('premium_memberships')->update(['status' => 2]); 
            return redirect()->route('super_admin.premiumMemberships-index')->with('success', 'PremiumMembership Status Changed Successfully'); 
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
