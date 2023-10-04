<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Job;
use App\Traits\SharedTrait;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Job\StoreJobFormRequest;
use App\Http\Requests\Backend\Job\UpdateJobFormRequest;

class JobController extends Controller
{
    use SharedTrait, UploadImageTrait;

    //======================================================================
    //===========================Index function=============================
    //==========================Created By: Lujain Samdi====================
    //==========================Created At: 2021-11-08=======================

    public function index(Route $route)
    {
        try {
            $jobs = Job::get();

            return view('admin.jobs.index', compact('jobs'));
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

            return view('admin.jobs.create');
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
    public function store(StoreJobFormRequest $request, Route $route)
    {
        try {
            $input_data = [
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
                'status' => $request->status,
                'expiry_date' => $request->expiry_date,
            ];
            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/images/jobs/images/';
                $input_data['image'] = $this->saveFile($orginal_image, $upload_location);
            }

            if (isset($request->file)) {
                $orginal_image = $request->file('file');
                $upload_location = 'storage/images/jobs/files/';
                $input_data['file'] = $this->saveFile($orginal_image, $upload_location);
            }

            // return $input_data;

            DB::transaction(function () use ($input_data, $request) {
                Job::create($input_data);
            });
            return redirect()->route('super_admin.jobs-index')->with('success', 'تمت الاضافة بنجاح');
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
    public function show($id, Route $route)
    {
        try {
            $job = Job::find($id);
            // $construction_age = 

            if ($job) {
                return view('admin.jobs.show', compact('job'));
            } else {
                return redirect()->back()->with('danger', 'الوظيفة غير موجودة');
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
            $job = Job::find($id);

            if ($job) {
                return view('admin.jobs.edit', compact('job'));
            } else {
                return redirect()->back()->with('danger', 'الوظيفه غير موجودة');
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
    public function update(UpdateJobFormRequest $request, $id, Route $route)
    {

        try {

            $job = Job::find($id);
            if ($job) {

                $update_data = [
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'status' => $request->status,
                    'expiry_date' => $request->expiry_date,
                ];

                if (isset($request->image)) {
                    $file_name = $this->saveFile($request->image, 'storage/jobs/images/');
                    $update_data['image'] = $file_name;
                } else {
                    $update_data['image'] = $job->image;
                }



                if (isset($request->file)) {
                    $file_name = $this->saveFile($request->file, 'storage/jobs/files/');
                    $update_data['file'] = $file_name;
                } else {
                    $update_data['file'] = $job->file;
                }

                DB::transaction(function () use ($update_data, $job) {
                    $job->update($update_data);
                });
                return redirect()->route('super_admin.jobs-index')->with('success', 'تم تعديل الوظيفة بنجاح');
            } else {
                return redirect()->route('super_admin.jobs-index')->with('danger', ' الوظيفة غير موجودة');
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
            $job = Job::find($id);
            if ($job) {
                DB::transaction(function () use ($job) {
                    $job->delete();
                });
                return redirect()->route('super_admin.jobs-index')->with('success', 'Target Deleted Successfully');
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
            $jobs = new Job();
            $jobs = $jobs->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.jobs.trashed', compact('jobs'));
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
            $job = Job::onlyTrashed()->find($id);
            if ($job) {
                DB::transaction(function () use ($job) {
                    $job->restore();
                });
                return redirect()->route('super_admin.jobs-showSoftDelete')->with('success', ' تم استعادة العنصر بنجاح');
            } else {
                return redirect()->back()->with('danger', 'هذا العنصر غير موجود');
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
            $job = Job::find($id);
            if ($job) {
                if ($job->status == 'Active') {
                    $job->status = 2;
                } elseif ($job->status == 'Inactive') {
                    $job->status = 1;  // 1 => Active
                }
                $job->save();
                return redirect()->back()->with('success', 'تمت العملية بنجاح');
            } else {
                return redirect()->back()->with('danger', 'هذا العنصر غير موجود');
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
