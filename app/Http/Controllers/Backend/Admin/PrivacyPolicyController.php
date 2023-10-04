<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PrivacyPolicy\StorePrivacyPolicyFormRequest;
use App\Http\Requests\Backend\PrivacyPolicy\UpdatePrivacyPolicyFormRequest;

class PrivacyPolicyController extends Controller
{
    // ===================================================================================================================
    // ============================================== index function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    // ================================================================================================ 
    public function index(Route $route)
    {
        try {
            $policies = PrivacyPolicy::all();
            return view('admin.privacies_policies.index', compact('policies'));
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
    // ============================================== create function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    // ================================================================================================
    public function create(Route $route)
    {
        try {
            return view('admin.privacies_policies.create');
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
    // ============================================== store function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    // ================================================================================================
    public function store(StorePrivacyPolicyFormRequest $request, Route $route)
    {

        try {
            $request_data = [
                'privacy_title_ar' => $request->privacy_title_ar,
                'privacy_title_en' => $request->privacy_title_en,
                'privacy_description_ar' => $request->privacy_description_ar,
                'privacy_description_en' => $request->privacy_description_en,
                'status' => $request->status,
            ];
            DB::transaction(function () use ($request_data) {
                PrivacyPolicy::create($request_data);
            });
            return redirect()->route('super_admin.privacy_policy-index')->with('success', 'Terms & Conditions created successfully');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    // ===================================================================================================================
    // ============================================== edit function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================

    public function edit($id, Route $route)
    {

        try {
            $policy = PrivacyPolicy::find($id);
            if ($policy) {
                return view('admin.privacies_policies.edit', compact('policy'));
            } else {
                return redirect()->route('super_admin.privacy_policy-index')->with('danger', 'الشروط والأحكام غير موجودة');
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

    // ===================================================================================================================
    // ============================================== update function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    // ================================================================================================
    public function update(UpdatePrivacyPolicyFormRequest $request, $id, Route $route)
    {

        try {
            $policy = PrivacyPolicy::find($id);
            if ($policy) {
                $update_data = [
                    'privacy_title_ar' => $request->privacy_title_ar,
                    'privacy_title_en' => $request->privacy_title_en,
                    'privacy_description_ar' => $request->privacy_description_ar,
                    'privacy_description_en' => $request->privacy_description_en,
                    'status' => $request->status,
                ];
                DB::transaction(function () use ($update_data, $policy) {
                    $policy->update($update_data);
                });
                return redirect()->route('super_admin.privacy_policy-index')->with('success', 'Terms & Conditions updated successfully');
            } else {
                return redirect()->route('super_admin.privacy_policy-index')->with('danger', 'Terms & Conditions not found');
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
    // ======================== Soft Delete Function ==========================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function softDelete($id, Route $route)
    {
        try {
            $policy = PrivacyPolicy::find($id);
            if ($policy) {
                DB::transaction(function () use ($policy) {
                    $policy->delete();
                });
                return redirect()->route('super_admin.privacy_policy-index')->with('success', 'The Deletion process has been successful');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
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
    // ====================== Show Soft Delete Function =======================
    // ==================== Created By : Lujain Al-Smadi ======================
    // ========================================================================
    public function showSoftDelete(Request $request, Route $route)
    {
        try {
            $policies = new PrivacyPolicy();
            $policies = $policies->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.privacies_policies.trashed', compact('policies'));
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
    // ==================== Soft Delete Restore Function ======================
    // ==================== Created By : Lujain Al-Smadi ======================
    // ========================================================================
    public function softDeleteRestore($id, Route $route)
    {
        try {
            $policy = PrivacyPolicy::onlyTrashed()->find($id);
            if ($policy) {
                DB::transaction(function () use ($policy) {
                    $policy->restore();
                });
                return redirect()->route('super_admin.privacy_policy-showSoftDelete')->with('success', 'Restore Completed Successfully');
            } else {
                return redirect()->back()->with('danger', 'This section does not exist in the records');
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
    // ================== Active/Inactive Single ======================
    // ==================== Created By : Lujain Al-Smadi ==============
    // ================================================================
    public function activeInactiveSingle($id, Route $route)
    {
        try {
            $policy = PrivacyPolicy::find($id);
            if ($policy) {
                if (
                    $policy->status == 'Active'
                ) {
                    $policy->status = 2;  // 2 => Inactive
                } elseif ($policy->status == 'Inactive') {
                    $policy->status = 1;  // 1 => Active
                }
                $policy->save();
                return redirect()->back()->with('success', 'The process has successfully');
            } else {
                return redirect()->back()->with('danger', 'This record is not in the records');
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
