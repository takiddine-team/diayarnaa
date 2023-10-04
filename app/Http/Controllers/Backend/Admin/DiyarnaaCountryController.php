<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Traits\SharedTrait;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DiyarnaaCountry\StoreDiyarnaaCountryRequestForm;
use App\Http\Requests\Backend\DiyarnaaCountry\UpdateDiyarnaaCountryRequestForm;
use App\Models\DiyarnaaCity;
use App\Models\DiyarnaaCountry;
use App\Models\PublicCountry;

class DiyarnaaCountryController extends Controller
{
    use SharedTrait, UploadImageTrait;

    // =====================================================================================
    // ============================================== index function =======================
    // ===========================================Created by: Lujain Smadi =================
    // =====================================================================================
    public function index(Route $route)
    {
        try {
            $diyarnaa_countries = DiyarnaaCountry::get();
            return view('admin.diyarnaa_countries.index', compact('diyarnaa_countries'));
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
            $public_country_ids = DiyarnaaCountry::pluck('public_country_id')->toArray();
            return view('admin.diyarnaa_countries.create', compact('public_country_ids'));
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
    public function store(StoreDiyarnaaCountryRequestForm $request, Route $route)
    {

        try {

            $public_country = PublicCountry::where('id', $request->public_country_id)->first();

            $request_data = [
                'name_ar' => $public_country->name_ar,
                'name_en' => $public_country->name_en,
                'country_key' => $public_country->country_key,
                'public_country_id' => $request->public_country_id,
                'public_currency_id' => $request->public_currency_id,
                'status' => $request->status,
                'country_code' => $request->country_code,
            ];

            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/diyarnaa_countries/image/';
                $request_data['image'] = $this->saveFile($orginal_image, $upload_location);
            } else {
                $request_data['image'] = null;
            }


            if (isset($request->flag)) {
                $orginal_image = $request->file('flag');
                $upload_location = 'storage/diyarnaa_countries/flag/';
                $request_data['flag'] = $this->saveFile($orginal_image, $upload_location);
            } else {
                $request_data['flag'] = null;
            }


            DB::transaction(function () use ($request_data, $public_country) {
                $diyarnaa_country = DiyarnaaCountry::create($request_data);
                if (isset($public_country->regions) && $public_country->regions->count() > 0) {
                    foreach ($public_country->regions as $region) {
                        DiyarnaaCity::create([
                            'name_ar' => $region->name_ar,
                            'name_en' => $region->name_en,
                            'diyarnaa_country_id' => $diyarnaa_country->id,
                            'status' => 1,

                        ]);
                    }
                }
            });

            return redirect()->route('super_admin.diyarnaa_countries-index')->with('success', 'Country Added Successfully');
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
    // ============================================== show Cities function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    // ================================================================================================

    public function showCities($id, Route $route)
    {
        try {
            $diyarnaa_country = DiyarnaaCountry::find($id);
            if ($diyarnaa_country) {
                return view('admin.diyarnaa_countries.show_cities', compact('diyarnaa_country'));
            } else {
                return redirect()->back()->with('danger', 'Country not found');
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
            $diyarnaa_country = DiyarnaaCountry::find($id);

            if ($diyarnaa_country) {
                return view('admin.diyarnaa_countries.edit', compact('diyarnaa_country'));
            } else {
                return redirect()->back()->with('danger', 'Country not found');
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
    public function update(UpdateDiyarnaaCountryRequestForm $request, $id, Route $route)
    {

        try {
            $diyarnaa_country = DiyarnaaCountry::find($id);
            if ($diyarnaa_country) {
                $update_data = [
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'public_currency_id' => $request->public_currency_id,
                    'status' => $request->status,
                    'country_code' => $request->country_code,
                ];
                if (isset($request->image)) {
                    $file_name = $this->saveFile($request->image, 'storage/diyarnaa_countries/images/');
                    $update_data['image'] = $file_name;
                }
                if (isset($request->flag)) {
                    $file_name = $this->saveFile($request->flag, 'storage/diyarnaa_countries/flags/');
                    $update_data['flag'] = $file_name;
                }
                DB::transaction(function () use ($update_data, $diyarnaa_country) {
                    $diyarnaa_country->update($update_data);
                });
                return redirect()->route('super_admin.diyarnaa_countries-index')->with('success', 'Country Updated Successfully');
            } else {
                return redirect()->back()->with('danger', 'Country not found');
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
            $diyarnaa_country = DiyarnaaCountry::find($id);
            if ($diyarnaa_country) {
                DB::transaction(function () use ($diyarnaa_country) {
                    $diyarnaa_country->delete();
                });
                return redirect()->route('super_admin.diyarnaa_countries-index')->with('success', 'Country Deleted Successfully');
            } else {
                return redirect()->back()->with('danger', 'Country not found');
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
            $diyarna_countries = new DiyarnaaCountry();
            $diyarna_countries = $diyarna_countries->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.diyarnaa_countries.trashed', compact('diyarna_countries'));
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
            $diyarnaa_country = DiyarnaaCountry::onlyTrashed()->find($id);
            if ($diyarnaa_country) {
                DB::transaction(function () use ($diyarnaa_country) {
                    $diyarnaa_country->restore();
                });
                return redirect()->route('super_admin.diyarnaa_countries-showSoftDelete')->with('success', 'Restore Completed Successfully');
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
            $diyarnaa_country = DiyarnaaCountry::find($id);
            if ($diyarnaa_country) {
                if ($diyarnaa_country->status == 'Active') {
                    $diyarnaa_country->status = 2;  // 2 => Inactive
                } elseif ($diyarnaa_country->status == 'Inactive') {
                    $diyarnaa_country->status = 1;  // 1 => Active
                }
                $diyarnaa_country->save();
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
