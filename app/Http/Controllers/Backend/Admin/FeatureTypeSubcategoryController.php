<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\FeatureType;
use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\FeatureTypeSubCategory;
use App\Http\Requests\Backend\FeatureTypeSubcategory\StoreFeatureTypeSubcategoryFormRequest;
use App\Http\Requests\Backend\FeatureTypeSubcategory\UpdateFeatureTypeSubcategoryFormRequest;

class FeatureTypeSubcategoryController extends Controller
{
    // ========================================================================
    // ====================== Index Function ==================================
    // ==================== Created By Lujain Al-Smadi ========================
    public function index(Route $route)
    {
        try {
            $sub_categories = SubCategory::whereHas('featureTypes')->get();
            return view('admin.feature_type_sub_categories.index', compact('sub_categories'));
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
    // ====================== Create Function ==================================
    // ==================== Created By Lujain Al-Smadi ========================
    public function create(Route $route)
    {
        try {
            $categories = MainCategory::where('status', 1)->get();
            $feature_types = FeatureType::where('status', 1)->get();
            return view('admin.feature_type_sub_categories.create', compact('categories', 'feature_types'));
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
    // ====================== Store Function ==================================
    // ==================== Created By Lujain Al-Smadi ========================
    public function store(Route $route, StoreFeatureTypeSubcategoryFormRequest $request)
    {
        try {

            $sub_category =  SubCategory::find($request->sub_category_id);
            if ($sub_category) {
                DB::transaction(function () use ($sub_category, $request) {

                    if ($sub_category->featureTypes)
                        $sub_category->featureTypes()->sync($request->feature_type_ids);
                });
                return redirect()->route('super_admin.feature_type_sub_categories-index')->with('success', 'Feature Type Subcategory Created Successfully');
            } else {
                return redirect()->route('super_admin.feature_type_sub_categories-index')->with('danger', 'Subcategory Not Found');
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
    // ====================== Edit Function ==================================
    // ==================== Created By Lujain Al-Smadi ========================
    public function edit(Route $route, $id)
    {
        try {
            $categories = MainCategory::where('status', 1)->get();
            $sub_category = SubCategory::with('featureTypes')->find($id);
            $feature_type_array = FeatureType::WhereHas('subCategories', function ($query) use ($id) {
                $query->where('sub_category_id', $id);
            })->pluck('id')->toArray();
            if ($sub_category) {
                $feature_types = FeatureType::where('status', 1)->get();
                return view('admin.feature_type_sub_categories.edit', compact('categories', 'sub_category', 'feature_types', 'feature_type_array'));
            }
            return redirect()->route('super_admin.feature_type_sub_categories-index')->with('danger', 'الفئة الفرعية غير موجودة');
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
    // ====================== Update Function ==================================
    // ==================== Created By Lujain Al-Smadi ========================
    public function update(Route $route, UpdateFeatureTypeSubcategoryFormRequest $request, $id)
    {
        try {

            $sub_category =  SubCategory::find($request->sub_category_id);
            if ($sub_category) {
                DB::transaction(function () use ($sub_category, $request) {

                    if ($sub_category->featureTypes)
                        $sub_category->featureTypes()->sync($request->feature_type_ids);
                });
                return redirect()->route('super_admin.feature_type_sub_categories-index')->with('success', 'Feature Type Subcategory Updated Successfully');
            } else {
                return redirect()->route('super_admin.feature_type_sub_categories-index')->with('danger', 'Subcategory Not Found');
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
    // ================================================================
    // ======================= destroy Function =======================
    // ================================================================
    public function destroy($id, Route $route)
    {
        try {
            $sub_category = SubCategory::find($id);
            if ($sub_category) {
                DB::table('feature_type_sub_categories')->where('sub_category_id', $id)->delete();
                return redirect()->route('super_admin.feature_type_sub_categories-index')->with('success', 'Feature Type Subcategory Deleted Successfully');
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
    //===========================getSubCategories Ajax function=============================
    //==========================Created By: Lujain Samdi====================
    public function getSubCategories(Request $request)
    {
        if (!isset($request->category_id)) {
            $sub_category = "";
        } else {
            $sub_category = SubCategory::where('category_id', $request->category_id)->get();
        }
        if (count($sub_category) > 0) {
            return response()->json([
                'status' => true,
                'sub_category' => $sub_category,
            ]);
        } else {
            return response()->json([
                'status' => 'empty',
                'sub_category' => $sub_category,
            ]);
        }
    }
}
