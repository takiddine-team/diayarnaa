<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\DiyarnaaCity;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Models\DiyarnaaRegion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DiyarnaaRegion\StoreDiyarnaaRegionFormRequest;
use App\Http\Requests\Backend\DiyarnaaRegion\UpdateDiyarnaaRegionFormRequest;

class DiyarnaaRegionController extends Controller
{
    //======================================================================
    //===========================  create function   =======================
    //===========================Created by: Lujain Smadi ==================
    public function create(Route $route, $city_id)
    {
        try {
            $diyarnaa_city = DiyarnaaCity::find($city_id);
            if ($diyarnaa_city) {
                return view('admin.diyarnaa_regions.create', compact('diyarnaa_city'));
            }
            return redirect()->route('super_admin.diyarnaa_countries-showCities', $city_id)->with(['danger' => 'This city doesn\'t exist']);
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
    //===========================  store function   =======================
    //===========================Created by: Lujain Smadi ==================
    public function store(Route $route, StoreDiyarnaaRegionFormRequest $request)
    {
        try {
            $diyarnaa_city = DiyarnaaCity::find($request->diyarnaa_city_id);
            if ($diyarnaa_city) {
                DB::transaction(function () use ($request) {
                    foreach ($request->name_en as $key => $value) {
                        $diyarnaa_region = DiyarnaaRegion::where('name_en', $request->name_en[$key])->Where('name_ar', $request->name_ar[$key])->where('diyarnaa_city_id', $request->diyarnaa_city_id)->first();
                        if (!$diyarnaa_region) {
                            DiyarnaaRegion::create([
                                'name_en' => $request->name_en[$key],
                                'name_ar' => $request->name_ar[$key],
                                'diyarnaa_city_id' => $request->diyarnaa_city_id,
                            ]);
                        }
                    }
                });
                return redirect()->route('super_admin.diyarnaa_cities-showRegions', $diyarnaa_city->id)->with(['success' => 'The region has been added successfully']);
            } else {
                return redirect()->route('super_admin.diyarnaa_cities-showRegions', $diyarnaa_city->id)->with(['danger' => 'This city doesn\'t exist']);
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
    //===========================  edit function   =======================
    //===========================Created by: Lujain Smadi ==================

    public function edit(Route $route, $id)
    {
        try {
            $diyarnaa_region = DiyarnaaRegion::find($id);
            if ($diyarnaa_region) {
                return view('admin.diyarnaa_regions.edit', compact('diyarnaa_region'));
            }
            return redirect()->route('super_admin.diyarnaa_countries-showCities', $diyarnaa_region->diyarnaaCity->diyarnaa_country_id)->with(['danger' => 'هذه المنطقة غير موجودة']);
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
    //===========================  update function   =======================
    //===========================Created by: Lujain Smadi ==================

    public function update(Route $route, UpdateDiyarnaaRegionFormRequest $request, $id)
    {
        try {
            $diyarnaa_region = DiyarnaaRegion::find($id);
            if ($diyarnaa_region) {
                $update_data = [
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'status' => $request->status,
                ];
                DB::transaction(function () use ($diyarnaa_region, $update_data) {
                    $diyarnaa_region->update($update_data);
                });
                return redirect()->route('super_admin.diyarnaa_cities-showRegions', $diyarnaa_region->diyarnaa_city_id)->with(['success' => 'The region has been updated successfully']);
            }
            return redirect()->route('super_admin.diyarnaa_cities-showRegions', $diyarnaa_region->diyarnaa_city_id)->with(['danger' => 'This region doesn\'t exist']);
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
            $diyarnaa_region = DiyarnaaRegion::find($id);
            if ($diyarnaa_region) {
                if ($diyarnaa_region->status == 'Active') {
                    $diyarnaa_region->status = 2;  // 2 => Inactive
                } elseif ($diyarnaa_region->status == 'Inactive') {
                    $diyarnaa_region->status = 1;  // 1 => Active
                }
                $diyarnaa_region->save();
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
