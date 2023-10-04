<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Search\UpdateSearchFormRequest;
use App\Models\Feature;
use App\Models\FeatureType;
use App\Models\Search;
use App\Models\SupportTicket;
use App\Models\Target;
use App\Traits\SharedTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    use SharedTrait, UploadImageTrait;

    //======================================================================
    //===========================Index function=============================
    //==========================Created By: Lujain Samdi====================

    public function index(Route $route)
    {
        try {
            $searches = Search::get();
            // return $searches;
            return view('admin.searches.index', compact('searches'));
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
    // ============================================== show function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    // ================================================================================================

    public function show($id, Route $route)
    {
        try {
            $searche = Search::find($id);
            // $construction_age = 

            if ($searche) {
                return view('admin.searches.show', compact('searche'));
            } else {
                return redirect()->back()->with('danger', 'Target not found');
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
    // ============================================== edit function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================

    public function edit($id, Route $route)
    {

        try {
            $search = Search::find($id);
            $targets = Target::where('status', 1)->get();
            $construction_ages = Feature::where('status', 1)->where('feature_type_id', 1)->get();
            $land_areas = Feature::where('status', 1)->where('feature_type_id', 2)->get();
            $real_estate_statuses = Feature::where('status', 1)->where('feature_type_id', 3)->get();
            $number_of_rooms = Feature::where('status', 1)->where('feature_type_id', 4)->get();
            $number_of_bathrooms = Feature::where('status', 1)->where('feature_type_id', 5)->get();
            if ($search) {
                return view('admin.searches.edit', compact('search', 'targets', 'construction_ages', 'land_areas', 'real_estate_statuses', 'number_of_rooms', 'number_of_bathrooms'));
            } else {
                return redirect()->back()->with('danger', 'الاعلان غير موجود');
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
    public function update(UpdateSearchFormRequest $request, $id, Route $route)
    {
        try {
            $search = Search::find($id);
            if ($search) {
               


                $update_data = [
                    'main_category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'diyarnaa_country_id' => $request->diyarnaa_country_id,
                    'diyarnaa_city_id' => $request->diyarnaa_city_id,
                    'diyarnaa_region_id' => $request->diyarnaa_region_id,
                    'price_from' => $request->price_from,
                    'price_to' => $request->price_to,
                    'area_from' => $request->area_from,
                    'area_to' => $request->area_to,
                    'title' => $request->title,
                    'status' => $request->status,
                    'area_type_id' => $request->area_type_id,
                ];

                $feature_type_array = FeatureType::WhereHas('subCategories', function ($query) use($request) {
                    $query->where('sub_category_id', $request->sub_category_id);
                })->pluck('id')->toArray();
                if (in_array(1, $feature_type_array)) {
                    $update_data['construction_age'] = $request->construction_age;
                }else {
                    $update_data['construction_age'] = null;
                }
                if (in_array(2, $feature_type_array)) {
                    $update_data['land_area'] = $request->land_area;
                }else {
                    $update_data['land_area'] = null;
                }
                if (in_array(3, $feature_type_array)) {
                    $update_data['real_estate_status'] = $request->real_estate_status;
                }else {
                    $update_data['real_estate_status'] = null;
                }
                if (in_array(4, $feature_type_array)) {
                    $update_data['number_of_rooms'] = $request->number_of_rooms;
                }else {
                    $update_data['number_of_rooms'] = null;
                }
                if (in_array(5, $feature_type_array)) {
                    $update_data['number_of_bathrooms'] = $request->number_of_bathrooms;
                }else {
                    $update_data['number_of_bathrooms'] = null;
                }
                // return $update_data;

                DB::transaction(function () use ($update_data, $search) {
                    $search->update($update_data);
                });
                return redirect()->route('super_admin.searches-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->back()->with('danger', ' البحث غير موجود');
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
            $advertisement = Search::find($id);
            if ($advertisement) {
                DB::transaction(function () use ($advertisement) {
                    $advertisement->delete();
                });
                return redirect()->route('super_admin.searches-index')->with('success', 'searche Deleted Successfully');
            } else {
                return redirect()->back()->with('danger', 'Target not found');
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
            $searches = new Search();
            $searches = $searches->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.searches.trashed', compact('searches'));
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
            $advertisement = Search::onlyTrashed()->find($id);
            if ($advertisement) {
                DB::transaction(function () use ($advertisement) {
                    $advertisement->restore();
                });
                return redirect()->route('super_admin.searches-showSoftDelete')->with('success', 'Restore Completed Successfully');
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
            $search = Search::find($id);
            if ($search) {
                if ($search->status == 'Active') {
                    $search->status = 2;  // 2 => Inactive
                } elseif ($search->status == 'Inactive') {
                    $search->status = 1;  // 1 => Active
                }
                $search->save();
                return redirect()->back()->with('success', 'تم تعديل الحالة بنجاح');
            } else {
                return redirect()->back()->with('danger', ' لم يتم العثور على الاعلان');
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
    //===========================getFeatureType Ajax function===================
    //==========================Created By: Lujain Samdi====================

    public function getFeatureType(Request $request)
    {
        if (!isset($request->sub_category_id) && !isset($request->sub_category_id_old)) {
            $feature_type = [];
        } else if (isset($request->sub_category_id)) {
            $feature_type = FeatureType::whereHas('subCategories', function ($q) use ($request) {
                $q->where('sub_category_id', $request->sub_category_id);
            })->pluck('id')->toArray();
        } else if (isset($request->sub_category_id_old)) {
            $feature_type = FeatureType::whereHas('subCategories', function ($q) use ($request) {
                $q->where('sub_category_id', $request->sub_category_id_old);
            })->pluck('id')->toArray();
        }
        if (count($feature_type) > 0) {
            return response()->json([
                'status' => true,
                'feature_type' => $feature_type,
            ]);
        } else {
            return response()->json([
                'status' => 'empty',
                'feature_type' => $feature_type,
            ]);
        }
    }
}
