<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Employee\StoreEmployeeFormRequest;
use App\Http\Requests\Backend\Employee\UpdateEmployeeFormRequest;
use App\Models\Admin;
use App\Models\SupportTicket;
use App\Traits\SharedTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    use SharedTrait, UploadImageTrait;

    //======================================================================
    //===========================__construct function=============================
    //==========================Created By: Qusai Al-Nablse====================
    function __construct()
    {

        $this->middleware(function ($request, $next) {

            if (Auth::user()->type == 'Admin') {
                return $next($request);
            } else {
                return redirect()->route('super_admin.dashboard')->with('danger', '   لا يوجد لديك صلاحية للدخول الى الصفحه المطلوبة   ');
            }
        });
    }


    //======================================================================
    //===========================Index function=============================
    //==========================Created By: Qusai Al-Nablse====================

    public function index(Route $route)
    {
        try {
            $employees = Admin::where('email','!=','super_admin_bluray@diyarnaa.com')->get();
            return view('admin.employees.index', compact('employees'));
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
    //==========================Created By: Qusai Al-Nablse====================

    public function create(Route $route)
    {
        try {

            return view('admin.employees.create');
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
    //===========================Store function=============================
    //==========================Created By: Qusai Al-Nablse====================

    public function store(Route $route, StoreEmployeeFormRequest $request)
    {
        try {
            $request_data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,

                'password' => Hash::make($request->password),

            ];


            // return  $request_data;

            DB::transaction(function () use ($request_data, $request) {
                Admin::create($request_data);
            });
            return redirect()->route('super_admin.employees-index')->with('success', 'Employee created successfully');
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
    //===========================Edit function=============================
    //==========================Created By: Qusai Al-Nablse====================

    public function edit(Route $route, $id)
    {
        try {
            $employee = Admin::find($id);
            if ($employee) {
                return view('admin.employees.edit', compact('employee'));
            } else {
                return redirect()->route('super_admin.employees-index')->with('danger', 'Employee not found');
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
    //===========================Update function=============================
    //==========================Created By: Qusai Al-Nablse====================

    public function update(Route $route, $id, UpdateEmployeeFormRequest $request)
    {
        try {
            $employee = Admin::find($id);
            if ($employee) {
                $update_data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'type' => $request->type,

                ];


                if (isset($request->password)) {
                    $update_data['password'] = Hash::make($request->password);
                }




                DB::transaction(function () use ($update_data, $employee) {
                    $employee->update($update_data);
                });
                return redirect()->route('super_admin.employees-index')->with('success', 'Employee updated successfully');
            } else {
                return redirect()->route('super_admin.employees-index')->with('danger', 'Employee not found');
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

    // ========================================================================
    public function softDelete($id, Route $route)
    {
        try {
            $employee = Admin::find($id);
            if ($employee) {
                DB::transaction(function () use ($employee) {
                    $employee->delete();
                });
                return redirect()->route('super_admin.employees-index')->with('success', 'The Deletion process has been successful');
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
    // ====================== Show Soft Delete Function =======================

    // ========================================================================
    public function showSoftDelete(Request $request, Route $route)
    {
        try {
            $employees = new Admin();
            $employees = $employees->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.employees.trashed', compact('employees'));
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
            $employee = Admin::onlyTrashed()->find($id);
            if ($employee) {
                DB::transaction(function () use ($employee) {
                    $employee->restore();
                });
                return redirect()->route('super_admin.employees-showSoftDelete')->with('success', 'Restore Completed Successfully');
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
            return view('errors.support_tickets', compact(
                'th',
                'function_name',
                'end_error_ticket'
            ));
        }
    }
}
