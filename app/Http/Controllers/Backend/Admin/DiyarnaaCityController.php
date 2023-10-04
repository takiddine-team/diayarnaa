<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\DiyarnaaCity;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DiyarnaaCity\StoreDiyarnaaCityFormRequest;
use App\Http\Requests\Backend\DiyarnaaCity\UpdateDiyarnaaCityFormRequest;
use App\Models\DiyarnaaCountry;

class DiyarnaaCityController extends Controller
{

    // ===================================================================================================================
    // ============================================== create function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    // ================================================================================================
    public function create(Route $route, $country_id)
    
    {
        try {
            $diyarnaa_country = DiyarnaaCountry::find($country_id);
            if($diyarnaa_country)
            return view('admin.diyarnaa_cities.create', compact('diyarnaa_country'));
            else
            return redirect()->back()->with('danger', 'Country not found');
          
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
    public function store(StoreDiyarnaaCityFormRequest $request, Route $route)
    {
        try {
            $request_data = [
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'diyarnaa_country_id' => $request->diyarnaa_country_id,
            ];
            DB::transaction(function () use ($request_data) {
                DiyarnaaCity::create($request_data);
            });
            return redirect()->route('super_admin.diyarnaa_countries-showCities', $request->diyarnaa_country_id)->with('success', 'City created successfully');

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
            $diyarnaa_city = DiyarnaaCity::find($id);

            if ($diyarnaa_city) {
                return view('admin.diyarnaa_cities.edit', compact('diyarnaa_city'));
            } else {
                return redirect()->back()->with('danger', ' المدينة غير موجودة');
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
    public function update(UpdateDiyarnaaCityFormRequest $request, $id, Route $route)
    {

        try {
            $diyarnaa_city = DiyarnaaCity::find($id);
            if ($diyarnaa_city) {
                $update_data = [
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'status' => $request->status,
                ];
                
                DB::transaction(function () use ($update_data, $diyarnaa_city) {
                    $diyarnaa_city->update($update_data);
                });
                return redirect()->route('super_admin.diyarnaa_countries-showCities', $diyarnaa_city->diyarnaa_country_id)->with('success', 'City Updated Successfully');
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
    // ================================================================
    // ================== Active/Inactive Single ======================
    // ==================== Created By : Lujain Al-Smadi ==============
    // ================================================================
    public function activeInactiveSingle($id, Route $route)
    {
        try {
            $diyarnaa_city = DiyarnaaCity::find($id);
            if ($diyarnaa_city) {
                if ($diyarnaa_city->status == 'Active') {
                    $diyarnaa_city->status = 2;  // 2 => Inactive
                } elseif ($diyarnaa_city->status == 'Inactive') {
                    $diyarnaa_city->status = 1;  // 1 => Active
                }
                $diyarnaa_city->save();
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
    // ===================================================================================================================
    // ============================================== show Regions function ===================================================
    // ===========================================Created by: Lujain Smadi =====================================================
    // ================================================================================================

    public function showRegions($id, Route $route)
    {
        try {
            $diyarnaa_city = DiyarnaaCity::find($id);
            if ($diyarnaa_city) {
                return view('admin.diyarnaa_cities.show_regions', compact('diyarnaa_city'));
            } else {
                return redirect()->back()->with('danger', 'City not found');
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
            return view('errors.support_tickets', compact('th', 'function_name',
                    'end_error_ticket'
                ));
        }
    }
}
