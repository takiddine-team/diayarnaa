<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Target;
use App\Models\Feature;
use App\Models\FeatureType;
use App\Models\SubCategory;
use App\Traits\SharedTrait;
use App\Models\DiyarnaaCity;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Models\DiyarnaaRegion;
use App\Models\DiyarnaaCountry;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Advertisement\AcceptWithConditionFormRequest;
use App\Http\Requests\Backend\Advertisement\StoreAdvertisementFormRequest;
use App\Http\Requests\Backend\Advertisement\UpdateAdvertisementFormRequest;
use App\Models\AdvertisementImage;
use App\Models\ExtraFeature;
use App\Models\Mail;
use App\Models\Search;
use Illuminate\Support\Facades\File;

class AdvertisementController extends Controller
{
    use SharedTrait, UploadImageTrait;

    //======================================================================
    //===========================Index function=============================
    //==========================Created By: Lujain Samdi====================
    //==========================Created At: 2021-11-08=======================

    public function index(Route $route)
    {
        try {
            $advertisements = Advertisement::get();
            // return $advertisements[0]->user->name ;
            return view('admin.advertisements.index', compact('advertisements'));
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
    //===========================Create function=============================
    //==========================Created By: Lujain Samdi====================
    //==========================Created At: 2021-11-08=======================

    public function create(Route $route)
    {
        try {

            $targets = Target::where('status', 1)->get();
            $construction_ages = Feature::where('status', 1)->where('feature_type_id', 1)->get();
            $land_areas = Feature::where('status', 1)->where('feature_type_id', 2)->get();
            $real_estate_statuses = Feature::where('status', 1)->where('feature_type_id', 3)->get();
            $number_of_rooms = Feature::where('status', 1)->where('feature_type_id', 4)->get();
            $number_of_bathrooms = Feature::where('status', 1)->where('feature_type_id', 5)->get();
            $users = User::where('user_type', 1)->where('status', 4)->orWhere('status', 2)->get();
            return view('admin.advertisements.create', compact('users', 'targets', 'construction_ages', 'land_areas', 'real_estate_statuses', 'number_of_rooms', 'number_of_bathrooms'));
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
    public function store(StoreAdvertisementFormRequest $request, Route $route)
    {
        try {
            // return $request;
            $diyarnaa_country_id = DiyarnaaCity::where('id', $request->diyarnaa_city_id)->first();
            $input_data = [
                'user_id' => $request->user_id,
                'target_id' => $request->target_id,
                'main_category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'construction_age' => $request->construction_age,
                'land_area' => $request->land_area,
                'real_estate_status' => $request->real_estate_status,
                'number_of_rooms' => $request->number_of_rooms,
                'number_of_bathrooms' => $request->number_of_bathrooms,
                'diyarnaa_country_id' => $diyarnaa_country_id->diyarnaa_country_id,
                'diyarnaa_city_id' => $request->diyarnaa_city_id,
                'diyarnaa_region_id' => $request->diyarnaa_region_id,
                'street' => $request->street,
                'url_map' => $request->url_map,
                'address' => $request->address,
                'price' => $request->price,
                'area' => $request->area,
                'real_estate_formula' => $request->real_estate_formula,


                'area_type_id' => $request->area_type_id,


                'status' => $request->status,
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
                'expiry_date' => $request->expiry_date,
            ];

            if ($request->user_type == 2) {
                $input_data['contact_method'] = $request->contact_method;
            }else{
                $input_data['ad_reference'] = $request->ad_reference;
            }


            if (isset($request->main_image)) {
                $orginal_image = $request->file('main_image');
                $upload_location = 'storage/images/advertisements/main_images/';
                $input_data['main_image'] = $this->saveFile($orginal_image, $upload_location);
            }

            if (isset($request->video)) {
                $orginal_image = $request->file('video');
                $upload_location = 'storage/images/advertisements/videos/';
                $input_data['video'] = $this->saveFile($orginal_image, $upload_location);
            }


            DB::transaction(function () use ($input_data, $request) {
                $advertisement = Advertisement::create($input_data);
                if (isset($request->images)) {
                    foreach ($request->images as $key => $value) {
                        $request_data = [
                            'advertisement_id' => $advertisement->id,
                        ];
                        $orginal_image = $value;
                        $upload_location = 'storage/images/advertisements/other_images/';
                        $request_data['image'] =  $this->saveFile($orginal_image, $upload_location);

                        AdvertisementImage::create($request_data);
                    }
                }
                if (isset($request->feature_en)) {

                    foreach ($request->feature_en as $key => $value) {
                        $request_data = [
                            'advertisement_id' => $advertisement->id,
                            'title_ar' => $request->feature_ar[$key],
                            'title_en' => $request->feature_en[$key],
                        ];

                        ExtraFeature::create($request_data);
                    }
                }
                $advertisement->code = 'ADV' . $advertisement->id;
                $advertisement->save();
            });
            return redirect()->route('super_admin.advertisements-index')->with('success', 'تمت الاضافة بنجاح');
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
            $advertisement = Advertisement::find($id);
            // $construction_age = 

            if ($advertisement) {
                return view('admin.advertisements.show', compact('advertisement'));
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
            $advertisement = Advertisement::find($id);
            $targets = Target::where('status', 1)->get();
            $construction_ages = Feature::where('status', 1)->where('feature_type_id', 1)->get();
            $land_areas = Feature::where('status', 1)->where('feature_type_id', 2)->get();
            $real_estate_statuses = Feature::where('status', 1)->where('feature_type_id', 3)->get();
            $number_of_rooms = Feature::where('status', 1)->where('feature_type_id', 4)->get();
            $number_of_bathrooms = Feature::where('status', 1)->where('feature_type_id', 5)->get();
            $users = User::where('user_type', 1)->where('status', 4)->orWhere('status', 2)->get();
            if ($advertisement) {
                return view('admin.advertisements.edit', compact('advertisement', 'users', 'targets', 'construction_ages', 'land_areas', 'real_estate_statuses', 'number_of_rooms', 'number_of_bathrooms'));
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
    // ============================================== acceptWithCondition function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================

    public function acceptWithCondition($id, Route $route)
    {

        try {
            $advertisement = Advertisement::find($id);
            if ($advertisement)
                return view('admin.advertisements.accept_with_condition', compact('advertisement'));
            else {
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
    // ============================================== acceptWithConditionRequest function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    // ================================================================================================
    public function acceptWithConditionRequest(AcceptWithConditionFormRequest $request, $id, Route $route)
    {

        try {
            $advertisement = Advertisement::find($id);
            if ($advertisement) {
                if ($advertisement->status == 'Pending') {
                    $update_data_ad = [
                        'status' => 6,
                        'edit_balance' => 1,
                    ];
                    $update_data = [
                        'sender_id' => auth()->user()->id,
                        'sender_type' => 1,
                        'receiver_id' => $advertisement->user_id,
                        'receiver_type' => 2,
                        'advertisement_id' => $advertisement->id,
                        'email_type' => 5,
                        'details' => $request->details,
                    ];
                    if (isset($request->file)) {
                        $file_name = $this->saveFile($request->file, 'storage/images/advertisements/accept_with_condition/files/');
                        $update_data['file'] = $file_name;
                    } else {
                        $update_data['file'] = $advertisement->file;
                    }
                    DB::transaction(function () use ($update_data, $update_data_ad, $advertisement) {
                        $advertisement->update($update_data_ad);

                        Mail::create($update_data);
                    });
                    return redirect()->route('super_admin.advertisements-index')->with('success', 'تم  ارسال رسالة طلب التعديل ');
                }
            } else {
                return redirect()->route('super_admin.advertisements-index')->with('danger', 'هذا الاعلان غير موجود');
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
    public function update(UpdateAdvertisementFormRequest $request, $id, Route $route)
    {

        try {

            $advertisement = Advertisement::find($id);
            if ($advertisement) {
                $diyarnaa_country_id = DiyarnaaCity::where('id', $request->diyarnaa_city_id)->first();
                $update_data = [
                    'user_id' => $request->user_id,
                    'target_id' => $request->target_id,
                    'main_category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'construction_age' => $request->construction_age,
                    'land_area' => $request->land_area,
                    'real_estate_status' => $request->real_estate_status,
                    'number_of_rooms' => $request->number_of_rooms,
                    'number_of_bathrooms' => $request->number_of_bathrooms,
                    'diyarnaa_country_id' => $diyarnaa_country_id->diyarnaa_country_id,
                    'diyarnaa_city_id' => $request->diyarnaa_city_id,
                    'diyarnaa_region_id' => $request->diyarnaa_region_id,
                    'street' => $request->street,
                    'url_map' => $request->url_map,
                    'address' => $request->address,
                    'price' => $request->price,
                    'area' => $request->area,
                    'real_estate_formula' => $request->real_estate_formula,
                    'area_type_id' => $request->area_type_id,
                    'status' => $request->status,
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'expiry_date' => $request->expiry_date,
                ];

                if ($request->user_type == 2) {
                    $update_data['contact_method'] = $request->contact_method;
                }else{
                    $update_data['ad_reference'] = $request->ad_reference;
                }






                if (isset($request->main_image)) {
                    $file_name = $this->saveFile($request->main_image, 'storage/images/advertisements/main_images/');
                    $update_data['main_image'] = $file_name;
                } else {
                    $update_data['main_image'] = $advertisement->main_image;
                }


                if (isset($request->other_image)) {
                    $file_name = $this->saveFile($request->other_image, 'storage/images/advertisements/other_images/');
                    $update_data['other_image'] = $file_name;
                } else {
                    $update_data['other_image'] = $advertisement->other_image;
                }
                if (isset($request->video)) {
                    $file_name = $this->saveFile($request->video, 'storage/images/advertisements/videos/');
                    $update_data['video'] = $file_name;
                } else {
                    $update_data['video'] = $advertisement->video;
                }

                DB::transaction(function () use ($update_data, $advertisement, $request) {
                    $advertisement->update($update_data);

                    if (isset($request->images)) {
                        foreach ($request->images as $key => $value) {
                            $request_data = [
                                'advertisement_id' => $advertisement->id,
                            ];
                            $orginal_image = $value;
                            $upload_location = 'storage/images/advertisements/other_images/';
                            $request_data['image'] =  $this->saveFile($orginal_image, $upload_location);

                            AdvertisementImage::create($request_data);
                        }
                    }

                    DB::table('extra_features')->where('advertisement_id',  $advertisement->id)->delete();
                    if (isset($request->feature_en)) {
                        foreach ($request->feature_en as $key => $value) {
                            $request_data = [
                                'advertisement_id' => $advertisement->id,
                                'title_ar' => $request->feature_ar[$key],
                                'title_en' => $request->feature_en[$key],
                            ];

                            ExtraFeature::create($request_data);
                        }
                    }
                });
                return redirect()->route('super_admin.advertisements-index')->with('success', 'advertisement updated successfully');
            } else {
                return redirect()->route('super_admin.advertisements-index')->with('danger', 'advertisement not found');
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
            $advertisement = Advertisement::find($id);
            if ($advertisement) {
                DB::transaction(function () use ($advertisement) {
                    $advertisement->delete();
                });
                return redirect()->route('super_admin.advertisements-index')->with('success', 'Target Deleted Successfully');
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
            $advertisements = new Advertisement();
            $advertisements = $advertisements->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.advertisements.trashed', compact('advertisements'));
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
            $advertisement = Advertisement::onlyTrashed()->find($id);
            if ($advertisement) {
                DB::transaction(function () use ($advertisement) {
                    $advertisement->restore();
                });
                return redirect()->route('super_admin.advertisements-showSoftDelete')->with('success', 'Restore Completed Successfully');
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
            $advertisement = Advertisement::find($id);
            if ($advertisement) {
                if ($advertisement->status == 'Active' || $advertisement->status == 'Accept') {
                    $advertisement->status = 5;  // 2 => Inactive
                } elseif ($advertisement->status == 'Inactive' || $advertisement->status == 'Reject') {
                    $advertisement->status = 4;  // 1 => Active
                }
                $advertisement->save();
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

    // ========================================================================
    // ==================== Delete Other Images Function ======================
    // ==================== Created By : Lujain Smadi ======================
    // ========================================================================
    public function deleteImages($id, Route $route)
    {
        try {
            // check if id exists and deleted it :
            $image = AdvertisementImage::findOrFail($id);
            if ($image) {
                DB::transaction(function () use ($image) {
                    $image->delete();
                    File::delete($image->image);
                });
                return redirect()->back()->with('success', 'Deleted Successfully');
            } else {
                return redirect()->back()->with('danger', 'This record does not exist in the records');
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


    //======================================================================
    //===========================get Users Ajax function=============================
    //==========================Created By: Lujain Samdi====================

    public function getUsers(Request $request)
    {



        if (!isset($request->user_type)) {
            $user = "";
        } else {
            $user = User::where('user_type', $request->user_type)->where('status', 4)->get();
        }
        if (count($user) > 0) {
            return response()->json([
                'status' => true,
                'user' => $user,
                'user_type' => $request->user_type,
            ]);
        } else {
            return response()->json([
                'status' => 'empty',
                'user' => $user,
            ]);
        }
    }
    //======================================================================
    //===========================get Diyarnaa Cities Ajax function=============================
    //==========================Created By: Lujain Samdi====================

    public function getDiyarnaaCities(Request $request)
    {


        if ($request->user_id) {
            $user = User::find($request->user_id);
        } else {
            $user = User::find($request->user_id_old);
        }

        if ($user && $user->user_type == "Real Estate Office") {
            $diyarnaa_cities = DiyarnaaCity::where('diyarnaa_country_id', $user->diyarnaa_country_id)->where('status', 1)->get();
        } else if (isset($request->diyarnaa_country_id)) {
            $diyarnaa_cities = DiyarnaaCity::where('diyarnaa_country_id', $request->diyarnaa_country_id)->where('status', 1)->get();
        } else {
            $diyarnaa_cities = '';
        }
        if ($diyarnaa_cities != null || $diyarnaa_cities != "") {

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
        } else {
            return response()->json([
                'status' => 'empty',
                'diyarnaa_cities' => $diyarnaa_cities,
            ]);
        }
    }


    //======================================================================
    //===========================get Diyarnaa Regions Ajax function=============================
    //==========================Created By: Lujain Samdi====================

    public function getDiyarnaaRegions(Request $request)
    {


        if (isset($request->diyarnaa_city_id)) {
            $diyarnaa_regions = DiyarnaaRegion::where('diyarnaa_city_id', $request->diyarnaa_city_id)->get();
        } else if (isset($request->diyarnaa_city_id_old_value)) {
            $diyarnaa_regions = DiyarnaaRegion::where('diyarnaa_city_id', $request->diyarnaa_city_id_old_value)->get();
        } else {
            $diyarnaa_regions = "";
        }
        if (
            $diyarnaa_regions != null || $diyarnaa_regions != ""
        ) {
            if (count($diyarnaa_regions) > 0) {
                return response()->json([
                    'status' => true,
                    'diyarnaa_regions' => $diyarnaa_regions,
                ]);
            } else {
                return response()->json([
                    'status' => 'empty',
                    'diyarnaa_regions' => $diyarnaa_regions,
                ]);
            }
        } else {
            return response()->json([
                'status' => 'empty',
                'diyarnaa_regions' => $diyarnaa_regions,
            ]);
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

    // ================================================================
    // ================== Reject Function =============================
    // ====================Created by: Lujain Smadi====================
    // ================================================================

    public function reject(Route $route, $id)
    {
        try {
            $advertisement = Advertisement::find($id);
            if ($advertisement) {
                if ($advertisement->status == 'Pending') {
                    DB::transaction(function () use ($advertisement) {
                        $advertisement->update([
                            'status' => 3,
                        ]);
                        $input_request = [
                            'sender_id' => auth()->user()->id,
                            'sender_type' => 1,
                            'receiver_id' => $advertisement->user_id,
                            'receiver_type' => 2,
                            'advertisement_id' => $advertisement->id,
                            'email_type' => 4,
                            'details' => 'تم رفض إعلانك',

                        ];
                        Mail::create(
                            $input_request
                        );
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
            $advertisement = Advertisement::find($id);
            if ($advertisement) {
                if ($advertisement->status == 'Pending') {
                    DB::transaction(function () use ($advertisement) {
                        $advertisement->update([
                            'status' => 4,
                        ]);

                        $input_request = [
                            'sender_id' => auth()->user()->id,
                            'sender_type' => 1,
                            'receiver_id' => $advertisement->user_id,
                            'receiver_type' => 2,
                            'advertisement_id' => $advertisement->id,
                            'email_type' => 3,
                            'details' => 'تم قبول إعلانك',

                        ];
                        Mail::create(
                            $input_request
                        );




                        // get all Searchs that match the added Advertisement
                        $searches =  new Search();
                        $searches = $searches->select('*');
                        if (isset($advertisement->diyarnaa_country_id)) {

                            $searches = $searches->where('diyarnaa_country_id', $advertisement->diyarnaa_country_id);
                        }
                        if (isset($advertisement->diyarnaa_city_id)) {

                            $searches = $searches->where('diyarnaa_city_id', $advertisement->diyarnaa_city_id);
                        }
                        if (isset($advertisement->diyarnaa_region_id)) {

                            $searches = $searches->where('diyarnaa_region_id', $advertisement->diyarnaa_region_id);
                        }
                        if (isset($advertisement->category_id)) {

                            $searches = $searches->where('main_category_id', $advertisement->category_id);
                        }
                        if (isset($advertisement->sub_category_id)) {

                            $searches = $searches->where('sub_category_id', $advertisement->sub_category_id);
                        }
                        if (isset($advertisement->construction_age)) {

                            $searches = $searches->where('construction_age', $advertisement->construction_age);
                        }
                        if (isset($advertisement->land_area)) {

                            $searches = $searches->where('land_area', $advertisement->land_area);
                        }
                        if (isset($advertisement->real_estate_status)) {

                            $searches = $searches->where('real_estate_status', $advertisement->real_estate_status);
                        }
                        if (isset($advertisement->number_of_rooms)) {
                            $searches = $searches->where('number_of_rooms', $advertisement->number_of_rooms);
                        }
                        if (isset($advertisement->number_of_bathrooms)) {
                            $searches = $searches->where('number_of_bathrooms', $advertisement->number_of_bathrooms);
                        }
                        if (isset($advertisement->price)) {
                            $searches = $searches->where('price_from', '<=', $advertisement->price);
                        }
                        if (isset($advertisement->price)) {
                            $searches = $searches->where('price_to', '>=', $advertisement->price);
                        }

                        if (isset($advertisement->area)) {
                            $searches = $searches->where('area_from', '<=', $advertisement->area);
                        }
                        if (isset($advertisement->area)) {
                            $searches = $searches->where('area_to', '>=', $advertisement->area);
                        }
                        $searches = $searches->where('status', 1)->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
                        if (count($searches) > 0) {
                            foreach ($searches as $key => $searche) {
                                $update_data = [
                                    'sender_id' => 1,
                                    'sender_type' => 1,
                                    'receiver_id' => $searche->user_id,
                                    'receiver_type' => 2,
                                    'advertisement_id' => $advertisement->id,
                                    'email_type' => 6,
                                    'details' => 'تم العثور على إعلان يطابق بحثك',
                                ];
                                Mail::create($update_data);
                            }
                        }
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
}
