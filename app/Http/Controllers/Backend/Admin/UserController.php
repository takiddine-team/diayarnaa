<?php

namespace App\Http\Controllers\Backend\Admin;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Models\User;
use App\Traits\SharedTrait;
use App\Models\DiyarnaaCity;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Models\DiyarnaaRegion;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\User\AddMembershipFormRequest;
use App\Http\Requests\Backend\User\StoreUserFormRequest;
use App\Http\Requests\Backend\User\UpdateUserFormRequest;
use App\Models\PremiumMembership;
use App\Models\UserMembership;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;

class UserController extends Controller
{
    use SharedTrait, UploadImageTrait;

    //======================================================================
    //===========================Index function=============================
    //==========================Created By: Lujain Samdi====================
    //==========================Created At: 2021-11-08=======================

    public function index(Route $route)
    {
        try {
            $users = User::all();
            return view('admin.users.index', compact('users'));
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
    //==========================Created At: 2022-11-08=======================

    public function create(Route $route)
    {
        try {

            return view('admin.users.create');
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

    public function store(Route $route, StoreUserFormRequest $request)
    {
        try {
            $request_data = [
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'office_phone' => $request->office_phone,
                'diyarnaa_country_id' => $request->diyarnaa_country_id,
                'diyarnaa_city_id' => $request->diyarnaa_city_id,
                'diyarnaa_region_id' => $request->diyarnaa_region_id,
                'street' => $request->street,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type,
                'status' => $request->status,
                'additional_information' => $request->additional_information,
                'expire_date' => $request->expire_date,
                'is_verified' => 2,
                'email_verified_at' => now(),


            ];

            if (isset($request->profile_image)) {
                $orginal_image = $request->file('profile_image');
                $upload_location = 'storage/images/profiles/';
                $request_data['profile_image'] = $this->saveFile($orginal_image, $upload_location);
            }
            if (isset($request->license_image)) {
                $orginal_image = $request->file('license_image');
                $upload_location = 'storage/images/licenses/';
                $request_data['license_image'] = $this->saveFile($orginal_image, $upload_location);
            }
            DB::transaction(function () use ($request_data, $request) {
                $user = User::create($request_data);
                if ($request->user_type == 1) {
                    $user->code = 'REF' . $user->id;
                    $user->save();
                } else if ($request->user_type == 2) {
                    $user->code  = 'REO' . $user->id;
                    $user->save();
                } elseif ($request->user_type == 3) {
                    $user->code  = 'RES' . $user->id;
                    $user->save();
                }
            });
            return redirect()->route('super_admin.users-index')->with('success', 'User created successfully');
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
    //===========================Show function=============================
    //==========================Created By: Lujain Samdi====================
    public function show(Route $route, $id)
    {
        try {
            $user = User::find($id);
            // return $user->user_type;
            return view('admin.users.show', compact('user'));
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
            $user = User::find($id);
            if ($user) {
                return view('admin.users.edit', compact('user'));
            } else {
                return redirect()->route('super_admin.users-index')->with('danger', 'User not found');
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

    public function update(Route $route, $id, UpdateUserFormRequest $request)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $update_data = [
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'office_phone' => $request->office_phone,
                    'diyarnaa_country_id' => $request->diyarnaa_country_id,
                    'diyarnaa_city_id' => $request->diyarnaa_city_id,
                    'diyarnaa_region_id' => $request->diyarnaa_region_id,
                    'street' => $request->street,
                    'user_type' => $request->user_type,
                    'status' => $request->status,
                    'additional_information' => $request->additional_information,
                    'expire_date' => $request->expire_date,
                ];
                if ($request->user_type != $user->user_type) {
                    if ($request->user_type == 1) {
                        $update_data['code'] = 'REF' . $user->id;
                    } else if ($request->user_type == 2) {
                        $update_data['code'] = 'REO' . $user->id;
                    } else if ($request->user_type == 3) {
                        $update_data['code'] = 'RES' . $user->id;
                    }
                }

                if (isset($request->password)) {
                    $update_data['password'] = Hash::make($request->password);
                }

                if (isset($request->profile_image)) {
                    $file_name = $this->saveFile($request->profile_image, 'storage/images/profiles/');
                    $update_data['profile_image'] = $file_name;
                } else {
                    $update_data['profile_image'] = $user->profile_image;
                }

                if (isset($request->license_image)) {
                    $file_name = $this->saveFile($request->license_image, 'storage/images/licenses/');
                    $update_data['license_image'] = $file_name;
                } else {
                    $update_data['license_image'] = $user->license_image;
                }
                DB::transaction(function () use ($update_data, $user) {
                    $user->update($update_data);
                });
                return redirect()->route('super_admin.users-index')->with('success', 'User updated successfully');
            } else {
                return redirect()->route('super_admin.users-index')->with('danger', 'User not found');
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
            $user = User::find($id);
            if ($user) {
                DB::transaction(function () use ($user) {
                    $user->delete();
                });
                return redirect()->route('super_admin.users-index')->with('success', 'The Deletion process has been successful');
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
            $users = new User();
            $users = $users->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.users.trashed', compact('users'));
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
            $user = User::onlyTrashed()->find($id);
            if ($user) {
                DB::transaction(function () use ($user) {
                    $user->restore();
                });
                return redirect()->route('super_admin.users-showSoftDelete')->with('success', 'Restore Completed Successfully');
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
            $user = User::find($id);
            if ($user) {
                if ($user->status == 'Active' || $user->status == 'Accept') {
                    $user->status = 5;  // 2 => Inactive
                } elseif ($user->status == 'Inactive' || $user->status == 'Reject') {
                    $user->status = 4;  // 1 => Active
                    $user->save();
                    if ($user->expire_date == null) {
                        return redirect()->route('super_admin.users-edit', $id)->with('success', ' تم الموافقه على المكتب .. يجب تحديد مده صلاحيه الحساب');
                    }
                }
                $user->save();
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
    // ================== Reject Function =============================
    // ====================Created by: Lujain Smadi====================
    // ================================================================

    public function reject(Route $route, $id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                if ($user->status == 'Pending') {
                    DB::transaction(function () use ($user) {
                        $user->update([
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
            $user = User::find($id);
            if ($user) {
                if ($user->status == 'Pending') {
                    DB::transaction(function () use ($user) {
                        $user->update([
                            'status' => 4,
                        ]);
                    });
                    $verify_id = Crypt::encryptString($user->id);
                    $type = 'Accept';
                    FacadesMail::send('email.EmailVerification', ['verify_id' => $verify_id, 'type' => $type], function ($message) use ($user) {
                        $message->to($user->email);
                        $message->subject('Verify Email');
                    });
                }

                return redirect()->route('super_admin.users-edit', $id)->with('success', ' تم الموافقه على المكتب .. يجب تحديد مده صلاحيه الحساب');
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
    public function export()
    {
        $users = User::select(
            'name',
            'email',
            'phone',
            'user_type'
        )->get();
        return Excel::download(new UsersExport($users), 'users.xlsx');
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


    //======================================================================
    //===========================getDiyarnaaCities Ajax function=============================
    //==========================Created By: Lujain Samdi====================

    public function getDiyarnaaRegions(Request $request)
    {
        if (!isset($request->diyarnaa_city_id)) {
            $diyarnaa_regions = "";
        } else {
            $diyarnaa_regions = DiyarnaaRegion::where('diyarnaa_city_id', $request->diyarnaa_city_id)->get();
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
    //===========================addMembership function=============================
    //==========================Created By: Lujain Samdi====================

    public function addMembership(Route $route, $id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $premium_memberships = PremiumMembership::where('status', 1)->where('user_type', $user->getAttributes()['user_type'])->orderBy('featured_type', 'asc')->get();

                return view('admin.users.addMembership', compact('user', 'premium_memberships'));
            } else {
                return redirect()->route('super_admin.users-index')->with('danger', 'User not found');
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
    //===========================addMembershipRequest function=============================
    //==========================Created By: Lujain Samdi====================

    public function addMembershipRequest(Route $route, $id, AddMembershipFormRequest $request)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $premium_membership = PremiumMembership::where('id', $request->premium_membership_id)->where('status', 1)->where('user_type', $user->getAttributes()['user_type'])->first();
                if ($premium_membership) {
                    // التحقق اذا كانت نوع العضويه يتكون من عدد غير محدود من الاعلانات
                    UserMembership::create([
                        'user_id' => $user->id,
                        'premium_membership_id' => $premium_membership->id,
                        'number_of_ads' => 1000,
                        'expiry_date' => now()->addYear(5),
                        'status' => 1,
                    ]);
                    return redirect()->route('super_admin.users-index')->with('success', 'Membership has been purchased successfully');
                } else {
                    return redirect()->back()->with('danger', 'Premium Membership not found');
                }

                return redirect()->route('super_admin.users-index')->with('success', 'User updated successfully');
            } else {
                return redirect()->route('super_admin.users-index')->with('danger', 'User not found');
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
