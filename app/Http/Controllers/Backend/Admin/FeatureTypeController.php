<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\FeatureType\StoreFeatureTypeFormRequest;
use App\Http\Requests\Backend\FeatureType\UpdateFeatureTypeFormRequest;
use App\Models\FeatureType;
use Illuminate\Support\Facades\DB;

class FeatureTypeController extends Controller
{
    // ========================================================================
    // ====================== index Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function index(Route $route)
    {
        try {
            $feature_types = FeatureType::all();
            return view('admin.feature_types.index', compact('feature_types'));
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
            return view('admin.feature_types.create');
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
    public function store(StoreFeatureTypeFormRequest $request, Route $route)
    {
        try {
            $request_data = [
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'status' => $request->status,
            ];
            DB::transaction(function () use ($request_data) {
                FeatureType::create($request_data);
            });
            return redirect()->route('super_admin.feature_types-index')->with('success', 'Feature Added Successfully');
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
    public function show($id)
    {
        //
    }

    // ========================================================================
    // ====================== edit Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function edit($id, Route $route)
    {
        try {
            $feature_type = FeatureType::find($id);
            if ($feature_type) {
                return view('admin.feature_types.edit', compact('feature_type'));
            } else {
                return redirect()->route('super_admin.feature_types-index')->with('danger', 'الميزة غير موجودة');
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
    public function update(UpdateFeatureTypeFormRequest $request, $id, Route $route)
    {
        try {

            $feature_type = FeatureType::find($id);
            if ($feature_type) {
                $update_data = [
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'status' => $request->status,
                ];
                DB::transaction(function () use ($update_data, $feature_type) {
                    $feature_type->update($update_data);
                });
                return redirect()->route('super_admin.feature_types-index')->with('success', 'Feature Updated Successfully');
            }
            return redirect()->route('super_admin.feature_types-index')->with('danger', 'Feature Not Found');
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
            $feature_type = FeatureType::find($id);
            if ($feature_type) {
                DB::transaction(function () use ($feature_type) {
                    $feature_type->delete();
                });
                return redirect()->route('super_admin.feature_types-index')->with('success', 'Feature Deleted Successfully');
            }
            return redirect()->route('super_admin.feature_types-index')->with('danger', 'Feature Not Found');
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
            $feature_types = FeatureType::onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.feature_types.trashed', compact('feature_types'));
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
            $feature_type = FeatureType::onlyTrashed()->find($id);
            if ($feature_type) {
                DB::transaction(function () use ($feature_type) {
                    $feature_type->restore();
                });
                return redirect()->route('super_admin.feature_types-index')->with('success', 'Feature Restored Successfully');
            }
            return redirect()->route('super_admin.feature_types-index')->with('danger', 'Feature Not Found');
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
            $feature_type = FeatureType::find($id);
            if ($feature_type) {
                if ($feature_type->status == 'Active') {
                    $feature_type->status = 2;
                } elseif ($feature_type->status == 'Inactive') {
                    $feature_type->status = 1;
                }
                $feature_type->save();
                return redirect()->route('super_admin.feature_types-index')->with('success', 'Feature Status Changed Successfully');
            }
            return redirect()->route('super_admin.feature_types-index')->with('danger', 'Feature Not Found');
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
