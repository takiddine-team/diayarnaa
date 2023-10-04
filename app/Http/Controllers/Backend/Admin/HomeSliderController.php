<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\HomeSlider;
use App\Traits\SharedTrait;
use App\Models\DiyarnaaCity;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Models\DiyarnaaCountry;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\HomeSlider\StoreHomeSliderFormRequest;
use App\Http\Requests\Backend\HomeSlider\UpdateHomeSliderFormRequest;

class HomeSliderController extends Controller
{
    use SharedTrait, UploadImageTrait;

    // ========================================================================
    // ====================== index Function =======================
    // ==================== Created By Lujain Al-Smadi ======================
    // ========================================================================
    public function index(Route $route)
    {
        try {
            $home_sliders = HomeSlider::get();
            return view('admin.home_sliders.index', compact('home_sliders'));
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
            $diyarnaa_countries = DiyarnaaCountry::get();
            return view('admin.home_sliders.create', compact('diyarnaa_countries'));
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
    public function store(StoreHomeSliderFormRequest $request, Route $route)
    {
        try {

            $request_data = [
                'company_name_ar' => $request->company_name_ar,
                'company_name_en' => $request->company_name_en,
                'diyarnaa_country_id' => $request->diyarnaa_country_id,
                'diyarnaa_city_id' => $request->diyarnaa_city_id,
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => 4,
                'expire_date' => $request->expire_date,
                'user_type' => $request->user_type,
            ];

            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/images/home_sliders/images/';
                $request_data['image'] = $this->saveFile($orginal_image, $upload_location);
            }
            if (isset($request->license_image)) {
                $orginal_image = $request->file('license_image');
                $upload_location = 'storage/images/home_sliders/licenses/';
                $request_data['license_image'] = $this->saveFile($orginal_image, $upload_location);
            }
            DB::transaction(function () use ($request_data) {
                HomeSlider::create($request_data);
            });
            return redirect()->route('super_admin.home_sliders-index')->with('success', 'Home Slider Created Successfully');
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
            $home_slider = HomeSlider::find($id);
            return view('admin.home_sliders.show', compact('home_slider'));
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
            $home_slider = HomeSlider::find($id);
            $diyarnaa_countries = DiyarnaaCountry::get();
            if($home_slider){
                return view('admin.home_sliders.edit', compact('home_slider', 'diyarnaa_countries'));

            }
            else{
                return redirect()->route('super_admin.home_sliders-index')->with('danger', 'السلايدر غير موجود');
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
    public function update(UpdateHomeSliderFormRequest $request, $id, Route $route)
    {
        try {
            $home_slider = HomeSlider::find($id);
            if ($home_slider) {
                $update_data = [
                    'company_name_ar' => $request->company_name_ar,
                    'company_name_en' => $request->company_name_en,
                    'diyarnaa_country_id' => $request->diyarnaa_country_id,
                    'diyarnaa_city_id' => $request->diyarnaa_city_id,
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'status' => $request->status,
                    'expire_date' => $request->expire_date,
                    'user_type' => $request->user_type,
                ];
                // return $update_data;
                if (isset($request->image)) {
                    $file_name = $this->saveFile($request->image, 'storage/images/home_sliders/images/');
                    $update_data['image'] = $file_name;
                } else {
                    $update_data['image'] = $home_slider->image;
                }

                if (isset($request->license_image)) {
                    $file_name = $this->saveFile($request->license_image, 'storage/images/home_sliders/licenses/');
                    $update_data['license_image'] = $file_name;
                } else {
                    $update_data['license_image'] = $home_slider->license_image;
                }
                DB::transaction(function () use ($update_data, $home_slider) {
                    $home_slider->update($update_data);
                });
                return redirect()->route('super_admin.home_sliders-index')->with('success', 'تم تعديل البيانات بنجاح');
            } else {
                return redirect()->route('super_admin.home_sliders-index')->with('danger', 'هذا العنصر غير موجود');
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
    // ======================== Soft Delete Function ==========================
    
    // ========================================================================
    public function softDelete($id, Route $route)
    {
        try {
            $home_slider = HomeSlider::find($id);
            if ($home_slider) {
                DB::transaction(function () use ($home_slider) {
                    $home_slider->delete();
                });
                return redirect()->route('super_admin.home_sliders-index')->with('success', 'Home Slider Deleted Successfully');
            }
            return redirect()->route('super_admin.home_sliders-index')->with('danger', 'Home Slider Not Found');
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
            $home_sliders = HomeSlider::onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.home_sliders.trashed', compact('home_sliders'));
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
            $home_slider = HomeSlider::onlyTrashed()->find($id);
            if ($home_slider) {
                DB::transaction(function () use ($home_slider) {
                    $home_slider->restore();
                });
                return redirect()->route('super_admin.home_sliders-index')->with('success', 'Home Slider Restored Successfully');
            }
            return redirect()->route('super_admin.home_sliders-index')->with('danger', 'Home Slider Not Found');
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
            $home_slider = HomeSlider::find($id);

            if ($home_slider) {
                if ($home_slider->status == 'Active'|| $home_slider->status == 'Accept' ) {
                    $home_slider->status = 5;  // 2 => Inactive
                } elseif ($home_slider->status == 'Inactive' || $home_slider->status == 'Rejected') {
                    $home_slider->status = 4;  // 1 => Active
                }
                $home_slider->save();
                return redirect()->back()->with('success', 'The process has successfully');
            } else {
                return redirect()->route('super_admin.home_sliders-index')->with('danger', 'Home Slider Not Found');
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


    // ================================================================
    // ================== Reject Function =============================
    // ====================Created by: Lujain Smadi====================
    // ================================================================

    public function reject(Route $route, $id)
    {
        try {
            $home_slider = HomeSlider::find($id);
            if ($home_slider) {
                if ($home_slider->status == 'Pending') {
                    DB::transaction(function () use ($home_slider) {
                        $home_slider->update([
                            'status' => 3,
                        ]);
                    });
                }
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
            return view('errors.support_tickets', compact(
                'th',
                'function_name',
                'end_error_ticket'
            ));
        }
    }

    // ================================================================
    // ================== Accept Function =============================
    // ====================Created by: Lujain Smadi====================
    // ================================================================

    public function accept(Route $route, $id)
    {
        try {
            $home_slider = HomeSlider::find($id);
            if ($home_slider) {
                if ($home_slider->status == 'Pending') {
                    DB::transaction(function () use ($home_slider) {
                        $home_slider->update([
                            'status' => 4,
                        ]);
                    });
                }
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
            return view('errors.support_tickets', compact(
                'th',
                'function_name',
                'end_error_ticket'
            ));
        }
    }

    //======================================================================
    //===========================getDiyarnaaCities Ajax function=============================
    //==========================Created By: Lujain Samdi====================

    public function getDiyarnaaCities(Request $request)
    {
        if (!isset($request->diyarnaa_country_id)) {
            $diyarnaa_cities = "";
        } else {
            $diyarnaa_cities = DiyarnaaCity::where('diyarnaa_country_id', $request->diyarnaa_country_id)->get();
        }
        if (count($diyarnaa_cities) > 0) {
            return response()->json([
                'status' => true,
                'diyarnaa_cities' => $diyarnaa_cities,
            ]);
        } else {
            return response()->json([
                'status' => 'empty',
                'diyarnaa_cities' => $diyarnaa_cities,
            ]);
        }
    }
}
