<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



use DateTime;
use App\Models\User;

use App\Models\Target;
use App\Models\Feature;
use App\Models\FeatureType;
use App\Traits\SharedTrait;
use App\Models\DiyarnaaCity;
use App\Models\Advertisement;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Models\UserMembership;
use App\Traits\UploadImageTrait;
use App\Models\PremiumMembership;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Frontend\RealEstateOffice\UpdateRealEstateEmailFormRequest;
use App\Http\Requests\Frontend\RealEstateOffice\UpdateRealEstatePhoneFormRequest;
use App\Http\Requests\Frontend\RealEstateOffice\UpdateRealEstateOfficeEndFormRequest;
use App\Http\Requests\Frontend\RealEstateOffice\UpdateRealEstatePasswordFormRequest;
use App\Http\Requests\Frontend\Search\StoreSearchFormRequest;
use App\Http\Requests\Frontend\Search\UpdateSearchFormRequest;
use App\Models\Mail as ModelsMail;
use App\Models\Search;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class RealEstateSeekerController extends Controller
{
    use SharedTrait, UploadImageTrait;

    public $search;
    //================================================================
    //============== bookAdvertisement Form Function Section =========
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function userDashboard(Route $route)
    {
        try {
            $user = auth()->guard('user')->user();

            return view('frontend.real_estate_seeker.userDashboard', compact('user'));
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
    //================================================================
    //============== change Login Info Form Function Section =========
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function changeRealEstateOfficeLoginInfo(Route $route)
    {
        try {
            return view('frontend.real_estate_seeker.changeRealEstateOfficeInfo');
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
    //================================================================
    //============== changeRealEstateOfficePassword  Function Section
    //====================Created by: Lujain Samdi====================
    //====================Modified BY ahmad obeidat ==================
    //================================================================
    public function changeRealEstateOfficePassword(Route $route, UpdateRealEstatePasswordFormRequest $request)
    {
        try {


            if (!Hash::check($request->old_password, Auth::guard('user')->user()->password)) {
                return redirect()->back()->with('danger', @trans('front.OldPasswordNotCorrect'));
            }

            $update_data = [
                'password' => Hash::make($request->password),
            ];
            DB::transaction(function () use ($update_data) {
                User::whereId(auth()->user()->id)->update($update_data);
            });
            return redirect()->back()->with('success', @trans('front.PasswordChangedSuccessfully'));
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
    //============== changeRealEstateOfficeEmail  Function Section ===
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function changeRealEstateOfficeEmail(Route $route, UpdateRealEstateEmailFormRequest $request)
    {
        try {

            $update_data = [
                'email' => $request->email,
                'is_verified' => 1,
                'email_verified_at' => null,
            ];
            DB::transaction(function () use ($update_data) {
                User::whereId(auth()->user()->id)->update($update_data);
            });
            $verify_id = Crypt::encryptString(Auth::guard('user')->user()->id);
            $type = 'Verification';

            Mail::send('email.EmailVerification', ['verify_id' => $verify_id, 'type' => $type], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Verify Email');
            });
            return redirect()->back()->with('success', @trans("front.EditeEmail"));
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
    //============== changeRealEstateOfficePhone  Function Section ===
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function changeRealEstateOfficePhone(Route $route, UpdateRealEstatePhoneFormRequest $request)
    {
        try {


            if ($request->old_phone != Auth::guard('user')->user()->phone) {
                return redirect()->back()->with('danger',@trans('front.PhoneNumberIsNotCorrect'));
            }

            $update_data = [
                'phone' => $request->phone,
            ];
            DB::transaction(function () use ($update_data) {
                User::whereId(auth()->user()->id)->update($update_data);
            });
            return redirect()->back()->with('success', @trans('front.PhoneNumberUpdatedSuccessfully'));
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
    //================================================================
    //============== editUserDashboard  Section ======================
    //====================Created by: Lujain Samdi====================
    public function editUserDashboard(Route $route, $id)
    {
        try {
            $user_cities = DiyarnaaCity::where('diyarnaa_country_id', auth()->guard('user')->user()->diyarnaa_country_id)->get();

            return view('frontend.real_estate_seeker.editUserDashboard', compact('user_cities'));
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
    //================================================================
    //============== updateUserDashboard  Section ====================
    //====================Created by: Lujain Smadi====================
    //====================Modified By ahmad obeidat ==================
    public function updateUserDashboard(Route $route, UpdateRealEstateOfficeEndFormRequest $request, $id)
    {
        try {
            $user = User::where('id', $id)->first();
            if ($user) {
                $update_request = [

                    'diyarnaa_city_id' => $request->diyarnaa_city_id,
                    'diyarnaa_region_id' => $request->diyarnaa_region_id,


                ];
                if (isset($request->profile_image)) {
                    $file_name = $this->saveFile($request->profile_image, 'storage/images/profiles/');
                    $update_request['profile_image'] = $file_name;
                } else {
                    $update_request['profile_image'] = $user->profile_image;
                }
                DB::transaction(function () use ($update_request, $user) {
                    $user->update($update_request);
                });
                return redirect()->route('seeker-userDashboard')->with('success', @trans('front.ChangeDoneSuccessfully'));
            }
            return redirect()->route('userLogin')->with('danger', @trans('front.PLeaseLogInFirst'));
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
    //================================================================
    //============== MyResearch Form Function Section ================
    //====================Created by: Lujain Samdi====================
    public function MyResearch(Route $route, Request $request)
    {
        try {
            // return $request;
            $searches = new Search();
            $searches = $searches->select('*');
            if (isset($request->diyarnaa_country_id)) {
                $searches = $searches->where('diyarnaa_country_id', $request->diyarnaa_country_id);
            }
            if (isset($request->diyarnaa_city_id)) {
                $searches = $searches->where('diyarnaa_city_id', $request->diyarnaa_city_id);
            }

            if (isset($request->diyarnaa_region_id)) {
                $searches = $searches->where('diyarnaa_region_id', $request->diyarnaa_region_id);
            }
            if (isset($request->category_id)) {
                $searches = $searches->where('main_category_id', $request->category_id);
            }
            if (isset($request->sub_category_id)) {
                $searches = $searches->where('sub_category_id', $request->sub_category_id);
            }
            if (isset($request->code)) {
                $searches = $searches->where('code', 'like', '%' . $request->code . '%');
            }
            if (isset($request->title)) {
                $searches = $searches->where('title', 'like', '%' . $request->title . '%');
            }
            $searches = $searches->where('user_id', auth()->guard('user')->user()->id)->orderBy('created_at', 'desc')->get();


            // return  $searches[5]->feature->name_ar;
            return view('frontend.real_estate_seeker.myResearch', compact('searches'));
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
    // =====================================================================
    // ================== activeInactiveSearch =============================
    // ====================== Created By: Lujain Smadi =====================
    //===================Modified By ahmad obeidat =========================
    public function activeInactiveSearch($id, Route $route)
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
                return redirect()->back()->with('success', @trans('front.StatusChanged'));
            } else {
                return redirect()->back()->with('danger', @trans('front.AdHaveNotBeenFound'));
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
    // ==================== deleteSearch Function =============================
    // ======================= Created By: Lujain Smadi========================
    //========================Modified By ahmad obeidat =======================
    public function deleteSearch($id, Route $route)
    {
        try {
            $search = Search::find($id);
            if ($search) {
                DB::transaction(function () use ($search) {
                    $search->delete();
                });
                return redirect()->route('seeker-MyResearch')->with('success', @trans('front.AdHaveBeenDeleted'));
            } else {
                return redirect()->back()->with('danger', @trans('front.AdHaveNotBeenFound'));
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
    //===========================editSearch  function=======================
    //==========================Created By: Lujain Smadi====================
    //=============modified By  Ahmad Obeidat ==============================
    public function editSearch(Route $route, $id)
    {
        try {
            $search = Search::where('user_id', auth()->guard('user')->user()->id)->where('id', $id)->first();

            if ($search->edit_balance == 0 && $search->expiry_date > now()) {
                return redirect()->route('seeker-MyResearch')->with('danger', @trans('front.YouHaveExceededTheEditedTimes'));
            } elseif ($search->expiry_date < now()) {
                //repost
                $user_premium = UserMembership::where('user_id', auth()->guard('user')->user()->id)->where('expiry_date', '>=', now())->where('number_of_ads', '>', 0)->where('status', 1)->first();
                if (!$user_premium) {
                    return redirect()->back()->with('danger', @trans('front.YouHaveToBuyPremiumMembership'));
                }
            }
            $targets = Target::where('status', 1)->get();
            $construction_ages = Feature::where('status', 1)->where('feature_type_id', 1)->get();
            $land_areas = Feature::where('status', 1)->where('feature_type_id', 2)->get();
            $real_estate_statuses = Feature::where('status', 1)->where('feature_type_id', 3)->get();
            $number_of_rooms = Feature::where('status', 1)->where('feature_type_id', 4)->get();
            $number_of_bathrooms = Feature::where('status', 1)->where('feature_type_id', 5)->get();
            return view('frontend.real_estate_seeker.editSearch', compact('search', 'targets', 'construction_ages', 'land_areas', 'real_estate_statuses', 'number_of_rooms', 'number_of_bathrooms'));
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
    //===========================updateSearchRequest  function==============
    //==========================Created By: Lujain Smadi====================
    //==========================Modified By ahmad obeidat ==================
    public function updateSearchRequest(Route $route, $id, UpdateSearchFormRequest $request)
    {
        try {
            $user_membership = UserMembership::where('user_id', auth()->guard('user')->user()->id)->where('status', 1)->where('expiry_date', '>', date('Y-m-d H:i:s'))->where('number_of_ads', '>', 0)->first();
            $search = Search::find($id);
            if ($search) {

                if ($search->edit_balance == 0 && $search->expiry_date > now()) {
                    return redirect()->route('seeker-MyResearch')->with('danger', @trans('front.YouHaveExceededTheEditedTimes'));
                } elseif ($search->expiry_date < now()) {
                    //repost
                    if (!$user_membership) {
                        return redirect()->back()->with('danger', @trans('front.YouHaveToBuyPremiumMembership'));
                    }
                }
                if ($search->expiry_date > date('Y-m-d H:i:s')) {
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
                        'status' => 1,
                        'edit_balance' => 0,
                        'area_type_id' => $request->area_type_id,
                    ];

                    $feature_type_array = FeatureType::WhereHas('subCategories', function ($query) use ($request) {
                        $query->where('sub_category_id', $request->sub_category_id);
                    })->pluck('id')->toArray();
                    if (in_array(1, $feature_type_array)) {
                        $update_data['construction_age'] = $request->construction_age;
                    } else {
                        $update_data['construction_age'] = null;
                    }
                    if (in_array(2, $feature_type_array)) {
                        $update_data['land_area'] = $request->land_area;
                    } else {
                        $update_data['land_area'] = null;
                    }
                    if (in_array(3, $feature_type_array)) {
                        $update_data['real_estate_status'] = $request->real_estate_status;
                    } else {
                        $update_data['real_estate_status'] = null;
                    }
                    if (in_array(4, $feature_type_array)) {
                        $update_data['number_of_rooms'] = $request->number_of_rooms;
                    } else {
                        $update_data['number_of_rooms'] = null;
                    }
                    if (in_array(5, $feature_type_array)) {
                        $update_data['number_of_bathrooms'] = $request->number_of_bathrooms;
                    } else {
                        $update_data['number_of_bathrooms'] = null;
                    }





                    DB::transaction(function () use ($update_data, $search) {
                        $search->update($update_data);
                    });

                    // get all Advertisements that match the added Search
                    $advertisments =  new Advertisement();
                    $advertisments = $advertisments->select('*');
                    if (isset($request->diyarnaa_country_id)) {

                        $advertisments = $advertisments->where('diyarnaa_country_id', $request->diyarnaa_country_id);
                    }
                    if (isset($request->diyarnaa_city_id)) {

                        $advertisments = $advertisments->where('diyarnaa_city_id', $request->diyarnaa_city_id);
                    }
                    if (isset($request->diyarnaa_region_id)) {

                        $advertisments = $advertisments->where('diyarnaa_region_id', $request->diyarnaa_region_id);
                    }
                    if (isset($request->category_id)) {

                        $advertisments = $advertisments->where('main_category_id', $request->category_id);
                    }
                    if (isset($request->sub_category_id)) {

                        $advertisments = $advertisments->where('sub_category_id', $request->sub_category_id);
                    }
                    if (isset($request->construction_age)) {

                        $advertisments = $advertisments->where('construction_age', $request->construction_age);
                    }
                    if (isset($request->land_area)) {

                        $advertisments = $advertisments->where('land_area', $request->land_area);
                    }
                    if (isset($request->real_estate_status)) {

                        $advertisments = $advertisments->where('real_estate_status', $request->real_estate_status);
                    }
                    if (isset($request->number_of_rooms)) {
                        $advertisments = $advertisments->where('number_of_rooms', $request->number_of_rooms);
                    }
                    if (isset($request->number_of_bathrooms)) {
                        $advertisments = $advertisments->where('number_of_bathrooms', $request->number_of_bathrooms);
                    }
                    if (isset($request->price_from) && isset($request->price_to)) {
                        $advertisments = $advertisments->whereBetween('price', [$request->price_from, $request->price_to]);
                    }
                    if (isset($request->area_from) && isset($request->area_to)) {
                        $advertisments = $advertisments->whereBetween('area', [$request->area_from, $request->area_to]);
                    }

                    $advertisments = $advertisments->where('status', 4)->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();

                    if (count($advertisments) > 0) {
                        DB::transaction(function () use ($advertisments) {
                            foreach ($advertisments as $key => $advertisment) {
                                $update_data = [
                                    'sender_id' => 1,
                                    'sender_type' => 1,
                                    'receiver_id' => auth()->guard('user')->user()->id,
                                    'receiver_type' => 2,
                                    'advertisement_id' => $advertisment->id,
                                    'email_type' => 6,
                                    'details' => @trans('front.SearchWasFound'),
                                ];
                                ModelsMail::create($update_data);
                            }
                        });
                        return redirect()->route('seeker-MyResearch')->with('success', @trans('front.SearchEditCheckInbox'));
                    } else {
                        return redirect()->route('seeker-MyResearch')->with('success',@trans('front.EditSearchSuccessfully'));
                    }
                }
                //=====================================================================
                //===================================repost=============================
                //======================================================================
                $repost_data = [
                    'user_id' => auth()->guard('user')->user()->id,
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
                    'status' => 1,
                    'expiry_date' => now()->addDays($user_membership->premiumMembership->number_days_ad),
                    'edit_balance' => 1,
                    'area_type_id' => $request->area_type_id,
                ];
                $feature_type_array = FeatureType::WhereHas('subCategories', function ($query) use ($request) {
                    $query->where('sub_category_id', $request->sub_category_id);
                })->pluck('id')->toArray();
                if (in_array(1, $feature_type_array)) {
                    $repost_data['construction_age'] = $request->construction_age;
                } else {
                    $repost_data['construction_age'] = null;
                }
                if (in_array(2, $feature_type_array)) {
                    $repost_data['land_area'] = $request->land_area;
                } else {
                    $repost_data['land_area'] = null;
                }
                if (in_array(3, $feature_type_array)) {
                    $repost_data['real_estate_status'] = $request->real_estate_status;
                } else {
                    $repost_data['real_estate_status'] = null;
                }
                if (in_array(4, $feature_type_array)) {
                    $repost_data['number_of_rooms'] = $request->number_of_rooms;
                } else {
                    $repost_data['number_of_rooms'] = null;
                }
                if (in_array(5, $feature_type_array)) {
                    $repost_data['number_of_bathrooms'] = $request->number_of_bathrooms;
                } else {
                    $repost_data['number_of_bathrooms'] = null;
                }
                DB::transaction(function () use ($repost_data, $search, $user_membership) {
                    $search->update($repost_data);
                    $user_membership->update(['number_of_ads' => DB::raw('number_of_ads - 1')]);
                });



                // get all Advertisements that match the added Search
                $advertisments =  new Advertisement();
                $advertisments = $advertisments->select('*');
                if (isset($request->diyarnaa_country_id)) {

                    $advertisments = $advertisments->where('diyarnaa_country_id', $request->diyarnaa_country_id);
                }
                if (isset($request->diyarnaa_city_id)) {

                    $advertisments = $advertisments->where('diyarnaa_city_id', $request->diyarnaa_city_id);
                }
                if (isset($request->diyarnaa_region_id)) {

                    $advertisments = $advertisments->where('diyarnaa_region_id', $request->diyarnaa_region_id);
                }
                if (isset($request->category_id)) {

                    $advertisments = $advertisments->where('main_category_id', $request->category_id);
                }
                if (isset($request->sub_category_id)) {

                    $advertisments = $advertisments->where('sub_category_id', $request->sub_category_id);
                }
                if (isset($request->construction_age)) {

                    $advertisments = $advertisments->where('construction_age', $request->construction_age);
                }
                if (isset($request->land_area)) {

                    $advertisments = $advertisments->where('land_area', $request->land_area);
                }
                if (isset($request->real_estate_status)) {

                    $advertisments = $advertisments->where('real_estate_status', $request->real_estate_status);
                }
                if (isset($request->number_of_rooms)) {
                    $advertisments = $advertisments->where('number_of_rooms', $request->number_of_rooms);
                }
                if (isset($request->number_of_bathrooms)) {
                    $advertisments = $advertisments->where('number_of_bathrooms', $request->number_of_bathrooms);
                }
                if (isset($request->price_from) && isset($request->price_to)) {
                    $advertisments = $advertisments->whereBetween('price', [$request->price_from, $request->price_to]);
                }
                if (isset($request->area_from) && isset($request->area_to)) {
                    $advertisments = $advertisments->whereBetween('area', [$request->area_from, $request->area_to]);
                }

                $advertisments = $advertisments->where('status', 4)->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();

                if (count($advertisments) > 0) {
                    DB::transaction(function () use ($advertisments) {
                        foreach ($advertisments as $key => $advertisment) {
                            $update_data = [
                                'sender_id' => 1,
                                'sender_type' => 1,
                                'receiver_id' => auth()->guard('user')->user()->id,
                                'receiver_type' => 2,
                                'advertisement_id' => $advertisment->id,
                                'email_type' => 6,
                                'details' => @trans('front.SearchWasFound'),
                            ];
                            ModelsMail::create($update_data);
                        }
                    });
                    return redirect()->route('seeker-MyResearch')->with('success', @trans('front.RepublishCheckInbox'));
                } else {
                    return redirect()->route('seeker-MyResearch')->with('success', @trans('front.RepublishWithSuccess'));
                }
            } else {
                return redirect()->back()->with('danger', @trans('front.SearchNotFound'));
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
    //===================mySearchDetails  function==========================
    //==========================Created By: Lujain Samdi====================
    //==========================Modified By ahmad obeidat===================
    public function mySearchDetails(Route $route, $id)
    {
        try {
            $search = Search::where('user_id', auth()->guard('user')->user()->id)->where('id', $id)->first();

            if ($search) {

                return view('frontend.real_estate_seeker.mySearchDetails', compact('search'));
            } else {
                return redirect()->back()->with('danger', @trans('front.SearchNotFound'));
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
    //================================================================
    //============== addSearch Form Function Section =================
    //====================Created by: Lujain Samdi====================
    //====================Modfied By ahmad obeidat ===================
    public function addSearch(Route $route)
    {
        try {
            $user_premium = UserMembership::where('user_id', auth()->guard('user')->user()->id)->where('number_of_ads', '>', 0)->where('status', 1)->first();
            if ($user_premium) {
                $targets = Target::where('status', 1)->get();
                $construction_ages = Feature::where('status', 1)->where('feature_type_id', 1)->get();
                $land_areas = Feature::where('status', 1)->where('feature_type_id', 2)->get();
                $real_estate_statuses = Feature::where('status', 1)->where('feature_type_id', 3)->get();
                $number_of_rooms = Feature::where('status', 1)->where('feature_type_id', 4)->get();
                $number_of_bathrooms = Feature::where('status', 1)->where('feature_type_id', 5)->get();
                return view('frontend.real_estate_seeker.addSearch', compact('targets', 'construction_ages', 'land_areas', 'real_estate_statuses', 'number_of_rooms', 'number_of_bathrooms'));
            } else {
                return redirect()->route('seeker-myPremiumMembership', auth()->guard('user')->user()->id)->with('danger', @trans('front.YouHaveToBuyPremiumMembership'));
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
    //================================================================
    //============== addSearchRequest Form Function Section ==========
    //====================Created by: Lujain Samdi====================
    //=====================Modified By ahmad obeidat =================
    public function addSearchRequest(StoreSearchFormRequest $request, Route $route)
    {
        try {
            $user_premium = UserMembership::where('user_id', auth()->guard('user')->user()->id)->where('number_of_ads', '>', 0)->where('status', 1)->first();
            if ($user_premium) {
                // return $request;
                $input_data = [
                    'user_id' => auth()->guard('user')->user()->id,
                    'main_category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'construction_age' => $request->construction_age,
                    'land_area' => $request->land_area,
                    'real_estate_status' => $request->real_estate_status,
                    'number_of_rooms' => $request->number_of_rooms,
                    'number_of_bathrooms' => $request->number_of_bathrooms,
                    'diyarnaa_country_id' => $request->diyarnaa_country_id,
                    'diyarnaa_city_id' => $request->diyarnaa_city_id,
                    'diyarnaa_region_id' => $request->diyarnaa_region_id,
                    'price_from' => $request->price_from,
                    'price_to' => $request->price_to,
                    'area_type_id' => $request->area_type_id,
                    'area_from' => $request->area_from,
                    'area_to' => $request->area_to,
                    'title' => $request->title,
                    'status' => 1,


                    'expiry_date' => now()->addDays($user_premium->premiumMembership->number_days_ad),
                ];

                // return $input_data;
                DB::transaction(function () use ($input_data, $user_premium) {
                    $this->search = Search::create($input_data);
                    $this->search->code = 'Search' . $this->search->id;
                    $this->search->save();
                    $user_premium->number_of_ads = $user_premium->number_of_ads - 1;
                    $user_premium->save();
                });

                // get all Advertisements that match the added Search
                $advertisments =  new Advertisement();
                $advertisments = $advertisments->select('*');
                if (isset($request->diyarnaa_country_id)) {

                    $advertisments = $advertisments->where('diyarnaa_country_id', $request->diyarnaa_country_id);
                }
                if (isset($request->diyarnaa_city_id)) {

                    $advertisments = $advertisments->where('diyarnaa_city_id', $request->diyarnaa_city_id);
                }
                if (isset($request->diyarnaa_region_id)) {

                    $advertisments = $advertisments->where('diyarnaa_region_id', $request->diyarnaa_region_id);
                }
                if (isset($request->category_id)) {

                    $advertisments = $advertisments->where('main_category_id', $request->category_id);
                }
                if (isset($request->sub_category_id)) {

                    $advertisments = $advertisments->where('sub_category_id', $request->sub_category_id);
                }
                if (isset($request->construction_age)) {

                    $advertisments = $advertisments->where('construction_age', $request->construction_age);
                }
                if (isset($request->land_area)) {

                    $advertisments = $advertisments->where('land_area', $request->land_area);
                }
                if (isset($request->real_estate_status)) {

                    $advertisments = $advertisments->where('real_estate_status', $request->real_estate_status);
                }
                if (isset($request->number_of_rooms)) {
                    $advertisments = $advertisments->where('number_of_rooms', $request->number_of_rooms);
                }
                if (isset($request->number_of_bathrooms)) {
                    $advertisments = $advertisments->where('number_of_bathrooms', $request->number_of_bathrooms);
                }
                if (isset($request->price_from) && isset($request->price_to)) {
                    $advertisments = $advertisments->whereBetween('price', [$request->price_from, $request->price_to]);
                }
                if (isset($request->area_from) && isset($request->area_to)) {
                    $advertisments = $advertisments->whereBetween('area', [$request->area_from, $request->area_to]);
                }

                $advertisments = $advertisments->where('status', 4)->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();

                if (count($advertisments) > 0) {
                    DB::transaction(function () use ($advertisments) {
                        foreach ($advertisments as $key => $advertisment) {
                            $update_data = [
                                'sender_id' => 1,
                                'sender_type' => 1,
                                'receiver_id' => auth()->guard('user')->user()->id,
                                'receiver_type' => 2,
                                'advertisement_id' => $advertisment->id,
                                'email_type' => 6,
                                'details' => @trans('front.SearchWasFound'),
                            ];
                            ModelsMail::create($update_data);
                        }
                    });
                    return redirect()->route('seeker-MyResearch')->with('success', @trans('front.SearchFoundMatch'));
                } else {
                    return redirect()->route('seeker-MyResearch')->with('success', @trans('front.SearchHasBeenAddedSuccessfully'));
                }
            } else {
                return redirect()->route('seeker-userDashboard')->with('danger', @trans('front.YouHaveToBuyPremiumMembership'));
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
    //===================myPremiumMembership  function===================
    //==========================Created By: Lujain Samdi====================
    public function myPremiumMembership(Route $route)
    {
        try {


            $user_premium_memberships = UserMembership::where('user_id', auth()->guard('user')->user()->id)->get();
            $premium_memberships = PremiumMembership::where('user_type', auth()->guard('user')->user()->getAttributes()['user_type'])->where('status', 1)->orderBy('featured_type', 'asc')->get();
            return view('frontend.real_estate_seeker.myPremiumMembership', compact('premium_memberships', 'user_premium_memberships'));
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
    //===========================getFeatureType Ajax function===============
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

    //================================================================
    //============== myFavAds Form Function Section =========
    //====================Created by: Lujain Samdi====================
    public function myFavAds(Route $route, Request $request)
    {
        try {
            $targets = Target::where('status', 1)->get();
            $my_fav_ads = new Advertisement();

            if (isset($request->diyarnaa_country_id)) {
                $my_fav_ads = $my_fav_ads->where('diyarnaa_country_id', $request->diyarnaa_country_id);
            }
            if (isset($request->diyarnaa_city_id)) {
                $my_fav_ads = $my_fav_ads->where('diyarnaa_city_id', $request->diyarnaa_city_id);
            }
            if (isset($request->diyarnaa_region_id)) {
                $my_fav_ads = $my_fav_ads->where('diyarnaa_region_id', $request->diyarnaa_region_id);
            }
            if (isset($request->target_id)) {
                $my_fav_ads = $my_fav_ads->where('target_id', $request->target_id);
            }
            if (isset($request->category_id)) {
                $my_fav_ads = $my_fav_ads->where('main_category_id', $request->category_id);
            }
            if (isset($request->sub_category_id)) {
                $my_fav_ads = $my_fav_ads->where('sub_category_id', $request->sub_category_id);
            }
            if (isset($request->code)) {
                $my_fav_ads = $my_fav_ads->where('code', $request->code);
            }


            $my_fav_ads = $my_fav_ads->whereHas('favouriteAdvertisements', function ($q) {
                $q->where('user_id', auth()->guard('user')->user()->id);
            })->get();




            return view('frontend.real_estate_seeker.my_fav_ads', compact('my_fav_ads', 'targets'));
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
