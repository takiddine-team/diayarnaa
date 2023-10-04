<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Traits\SharedTrait;
use App\Models\DiyarnaaCity;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\WebsiteBroker;
use Illuminate\Routing\Route;
use App\Models\DiyarnaaCountry;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Backend\WebsiteBroker\StoreWebsiteBrokerFormRequest;
use App\Http\Requests\Backend\WebsiteBroker\UpdateWebsiteBrokerFormRequest;

class WebsiteBrokerController extends Controller
{
    use SharedTrait, UploadImageTrait;

    //======================================================================
    //===========================Index function=============================
    //==========================Created By: Lujain Samdi====================
    //==========================Created At: 2021-11-08=======================

    public function index(Route $route)
    {
        try {
            $website_brokers = WebsiteBroker::all();
            return view('admin.website_brokers.index', compact('website_brokers'));
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
            $diyarnaa_countries = DiyarnaaCountry::get();
            return view('admin.website_brokers.create', compact('diyarnaa_countries'));
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
    //==========================Created By: Lujain Samdi====================
    //==========================Created At: 2021-11-08=======================

    public function store(Route $route, StoreWebsiteBrokerFormRequest $request)
    {
        try {
            $request_data = [
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'diyarnaa_country_id' => $request->diyarnaa_country_id,
                'diyarnaa_city_id' => $request->diyarnaa_city_id,
                'status' => $request->status,

            ];
            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/images/website_borkers/images/';
                $request_data['image'] = $this->saveFile($orginal_image, $upload_location);
            }
            if (isset($request->file)) {
                $orginal_image = $request->file('file');
                $upload_location = 'storage/images/website_borkers/files/';
                $request_data['file'] = $this->saveFile($orginal_image, $upload_location);
            }
            DB::transaction(function () use ($request_data) {
                WebsiteBroker::create($request_data);
            });
            return redirect()->route('super_admin.website_brokers-index')->with('success', 'User created successfully');
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
    //==========================Created By: Lujain Samdi====================

    public function edit(Route $route, $id)
    {
        try {
            $website_broker = WebsiteBroker::find($id);
            if ($website_broker) {
                return view('admin.website_brokers.edit', compact('website_broker'));
            } else {
                return redirect()->route('super_admin.website_brokers-index')->with('danger', 'Website Broker does not found');
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
    //==========================Created By: Lujain Samdi====================

    public function update(Route $route, $id, UpdateWebsiteBrokerFormRequest $request)
    {
        try {
            $website_broker = WebsiteBroker::find($id);
            if ($website_broker) {
                $update_data = [
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'diyarnaa_country_id' => $request->diyarnaa_country_id,
                    'diyarnaa_city_id' => $request->diyarnaa_city_id,
                    'status' => $request->status,
                ];
                if (isset($request->image)) {
                    $file_name = $this->saveFile($request->image, 'storage/images/website_borkers/images/');
                    $update_data['image'] = $file_name;
                } else {
                    $update_data['image'] = $website_broker->image;
                }

                if (isset($request->file)) {
                    $file_name = $this->saveFile($request->file, 'storage/images/website_borkers/files/');
                    $update_data['file'] = $file_name;
                } else {
                    $update_data['file'] = $website_broker->file;
                }
                DB::transaction(function () use ($update_data, $website_broker) {
                    $website_broker->update($update_data);
                });
                return redirect()->route('super_admin.website_brokers-index')->with('success', 'Website Broker updated successfully');
            } else {
                return redirect()->route('super_admin.website_brokers-index')->with('danger', 'Website Broker does not found');
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
            $website_broker = WebsiteBroker::find($id);
            if ($website_broker) {
                DB::transaction(function () use ($website_broker) {
                    $website_broker->delete();
                });
                return redirect()->route('super_admin.website_brokers-index')->with('success', 'The Deletion process has been successful');
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
            $website_brokers = new WebsiteBroker();
            $website_brokers = $website_brokers->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.website_brokers.trashed', compact('website_brokers'));
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
            $website_broker = WebsiteBroker::onlyTrashed()->find($id);
            if ($website_broker) {
                DB::transaction(function () use ($website_broker) {
                    $website_broker->restore();
                });
                return redirect()->route('super_admin.website_brokers-showSoftDelete')->with('success', 'Restore Completed Successfully');
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

    // ================================================================
    // ================== Active/Inactive Single ======================
    // ================================================================
    public function activeInactiveSingle($id, Route $route)
    {
        try {

            $website_broker = WebsiteBroker::find($id);
            if ($website_broker) {
                if ($website_broker->status == 'Active' || $website_broker->status == 'Accept') {
                    $website_broker->status = 5;  // 2 => Inactive
                    $website_broker->save();
                } elseif ($website_broker->status == 'Inactive' || $website_broker->status == 'Reject') {
                    $website_broker->status = 4;
                    $website_broker->save();
                    // 1 => Active
                    if ($website_broker->image == null) {
                        return redirect()->route('super_admin.website_brokers-edit', $id)->with('danger', 'Please upload the image first');
                    }
                }
                return redirect()->back()->with('success', 'تمت العملية بنجاح');
            } else {
                return redirect()->back()->with('danger', 'هذا العنصر غير موجود في السجلات');
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
            $website_broker = WebsiteBroker::find($id);
            if ($website_broker) {
                if ($website_broker->status == 'Pending') {
                    DB::transaction(function () use ($website_broker) {
                        $website_broker->update([
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
            $website_broker = WebsiteBroker::find($id);
            if ($website_broker) {
                if ($website_broker->status == 'Pending') {
                    DB::transaction(function () use ($website_broker) {
                        $website_broker->update([
                            'status' => 4,
                        ]);
                    });
                }
                return redirect()->route('super_admin.website_brokers-edit', $id)->with('success', 'The process has successfully');
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
}
