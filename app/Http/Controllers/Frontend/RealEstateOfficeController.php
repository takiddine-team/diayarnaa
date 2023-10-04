<?php

namespace App\Http\Controllers\Frontend;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Target;
use App\Models\Feature;
use App\Models\FeatureType;
use App\Models\SubCategory;
use App\Traits\SharedTrait;
use App\Models\DiyarnaaCity;
use App\Models\ExtraFeature;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Models\DiyarnaaRegion;
use App\Models\EnqueryRequest;
use App\Models\UserMembership;
use App\Mail\SendEnquiryReplay;
use App\Traits\UploadImageTrait;
use App\Models\PremiumMembership;
use App\Models\AdvertisementImage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\CustomerRequestAndOffer;
use App\Models\AdvertisementEditRequest;
use App\Models\CustomerRequestAndOfferImage;
use App\Http\Requests\Frontend\EnqueryRequest\EnqueryRequestFormRequest;
use App\Http\Requests\Frontend\Advertisement\StoreAdvertisementFormRequest;
use App\Http\Requests\Frontend\Advertisement\updateAdvertisementFormRequest;
use App\Http\Requests\Frontend\EnqueryRequest\ReplayEnqueryRequestFormRequest;
use App\Http\Requests\Frontend\RealEstateOffice\UpdateRealEstateEmailFormRequest;
use App\Http\Requests\Frontend\RealEstateOffice\UpdateRealEstatePhoneFormRequest;
use App\Http\Requests\Frontend\RealEstateOffice\UpdateRealEstateOfficeEndFormRequest;
use App\Http\Requests\Frontend\RealEstateOffice\UpdateRealEstatePasswordFormRequest;
use App\Http\Requests\Frontend\CustomerRequestsOffer\StoreCustomerRequestsOfferFormRequest;
use App\Models\FavouriteAdvertisement;
use App\Models\Mail as ModelsMail;
use App\Models\Search;
use Illuminate\Support\Facades\Crypt;

class RealEstateOfficeController extends Controller
{
    use SharedTrait, UploadImageTrait;

    //================================================================
    //============== bookAdvertisement Form Function Section =========
    //====================Created by: Lujain Smadi====================
    //================================================================
    public function userDashboard(Route $route)
    {
        try {
            $user = auth()->guard('user')->user();

            return view('frontend.real_estate_office.userDashboard', compact('user'));
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
    //====================Created by: Lujain Smadi====================
    //================================================================
    public function changeRealEstateOfficeLoginInfo(Route $route)
    {
        try {
            return view('frontend.real_estate_office.changeRealEstateOfficeInfo');
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
    //====================Created by: Lujain Smadi====================
    //====================Modifed By Ahmad Obeidat    ================
    public function changeRealEstateOfficePassword(Route $route, UpdateRealEstatePasswordFormRequest $request)
    {
        try {


            if (!Hash::check($request->old_password, Auth::guard('user')->user()->password)) {
                return redirect()->back()->with('danger',@trans('front.OldPasswordNotCorrect'));
            }

            $update_data = [
                'password' => Hash::make($request->password),
            ];
            DB::transaction(function () use ($update_data) {
                User::whereId(auth()->user()->id)->update($update_data);
            });
            return redirect()->back()->with('success',@trans('front.PasswordChangedSuccessfully'));
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
    //====================Created by: Lujain Smadi====================
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
    //================================================================
    //================== changeRealEstateOfficePhone  Function Section
    //====================Created by: Lujain Smadi====================
    //====================Modified By Ahmad Obeidat ==================
    public function changeRealEstateOfficePhone(Route $route, UpdateRealEstatePhoneFormRequest $request)
    {
        try {


            if ($request->old_phone != Auth::guard('user')->user()->phone) {
                return redirect()->back()->with('danger', @trans('front.PhoneNumberIsNotCorrect'));
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
    //============== editUserDashboard  Section =========
    //====================Created by: Lujain Smadi====================
    public function editUserDashboard(Route $route, $id)
    {
        try {
            $user_cities = DiyarnaaCity::where('diyarnaa_country_id', auth()->guard('user')->user()->diyarnaa_country_id)->get();

            return view('frontend.real_estate_office.editUserDashboard', compact('user_cities'));
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
    //============== updateUserDashboard  Section =========
    //====================Created by: Lujain Smadi====================
    //====================Modified By :AHMAD Obeidat==================
    public function updateUserDashboard(Route $route, UpdateRealEstateOfficeEndFormRequest $request, $id)
    {
        try {

            $user = User::where('id', $id)->first();
            if ($user) {
                $update_request = [
                    'phone' => $request->phone,
                    'office_phone' => $request->office_phone,
                    'diyarnaa_country_id' => auth()->guard('user')->user()->diyarnaa_country_id,
                    'diyarnaa_city_id' => $request->diyarnaa_city_id,
                    'diyarnaa_region_id' => $request->diyarnaa_region_id,
                    'additional_information' => $request->additional_information,

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
                return redirect()->route('office-userDashboard')->with('success', @trans('front.ChangeDoneSuccessfully'));
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
    //============== myAdvertisements Form Function Section =========
    //====================Created by: Lujain Smadi====================
    public function myAdvertisements(Route $route, Request $request)
    {
        try {
            $targets = Target::where('status', 1)->get();
            $myAds = new Advertisement();
            $myAds = $myAds->select('*');
            $user_cities = DiyarnaaCity::where('diyarnaa_country_id', auth()->guard('user')->user()->diyarnaCountry->id)->get();
            if (isset($request->diyarnaa_city_id)) {
                $myAds = $myAds->where('diyarnaa_city_id', $request->diyarnaa_city_id);
            }
            if (isset($request->diyarnaa_region_id)) {
                $myAds = $myAds->where('diyarnaa_region_id', $request->diyarnaa_region_id);
            }
            if (isset($request->target_id)) {
                $myAds = $myAds->where('target_id', $request->target_id);
            }
            if (isset($request->category_id)) {
                $myAds = $myAds->where('main_category_id', $request->category_id);
            }
            if (isset($request->sub_category_id)) {
                $myAds = $myAds->where('sub_category_id', $request->sub_category_id);
            }
            if (isset($request->code)) {
                $myAds = $myAds->where('code', $request->code);
            }
            $myAds = $myAds->where('user_id', auth()->guard('user')->user()->id)->orderBy('created_at', 'desc')->get();


            return view('frontend.real_estate_office.myAds', compact('myAds', 'targets', 'user_cities'));
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
    //============== myFavAds Form Function Section ==================
    //====================Created by: Lujain Smadi====================
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





            return view('frontend.real_estate_office.my_fav_ads', compact('my_fav_ads', 'targets'));
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
    //============== addAdvertisements Form Function Section =========
    //====================Created by: Lujain Smadi====================
    //====================Modified By ahmad obeidat===================
    public function addAdvertisements(Route $route)
    {
        try {
            $user_premium = UserMembership::where('user_id', auth()->guard('user')->user()->id)->where('expiry_date', '>=', now())->where('number_of_ads', '>', 0)->where('status', 1)->first();
            if ($user_premium) {
                $targets = Target::where('status', 1)->get();
                $user_cities = DiyarnaaCity::where('diyarnaa_country_id', auth()->guard('user')->user()->diyarnaCountry->id)->get();
                $construction_ages = Feature::where('status', 1)->where('feature_type_id', 1)->get();
                $land_areas = Feature::where('status', 1)->where('feature_type_id', 2)->get();
                $real_estate_statuses = Feature::where('status', 1)->where('feature_type_id', 3)->get();
                $number_of_rooms = Feature::where('status', 1)->where('feature_type_id', 4)->get();
                $number_of_bathrooms = Feature::where('status', 1)->where('feature_type_id', 5)->get();
                return view('frontend.real_estate_office.addAdvertisements', compact('targets', 'user_cities', 'construction_ages', 'land_areas', 'real_estate_statuses', 'number_of_rooms', 'number_of_bathrooms'));
            } else {
                return redirect()->route('office-myPremiumMembership', auth()->guard('user')->user()->id)->with('danger', @trans('front.YouHaveToBuyPremiumMembership'));
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
    //============== addAdvertisementsRequest Form Function Section ==
    //====================Created by: Lujain Smadi====================
    //====================Modified By ahmad obeidat ==================

    public function addAdvertisementsRequest(StoreAdvertisementFormRequest $request, Route $route)
    {
        try {
            $user_premium = UserMembership::where('user_id', auth()->guard('user')->user()->id)->where('expiry_date', '>=', now())->where('number_of_ads', '>', 0)->where('status', 1)->first();
            if ($user_premium) {
                $input_data = [
                    'user_id' => auth()->guard('user')->user()->id,
                    'target_id' => $request->target_id,
                    'main_category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'construction_age' => $request->construction_age,
                    'land_area' => $request->land_area,
                    'real_estate_status' => $request->real_estate_status,
                    'number_of_rooms' => $request->number_of_rooms,
                    'number_of_bathrooms' => $request->number_of_bathrooms,
                    'diyarnaa_country_id' => auth()->guard('user')->user()->diyarnaCountry->id,
                    'diyarnaa_city_id' => $request->diyarnaa_city_id,
                    'diyarnaa_region_id' => $request->diyarnaa_region_id,
                    'street' => $request->street,
                    'url_map' => $request->url_map,
                    'address' => $request->address,
                    'price' => $request->price,
                    'area' => $request->area,
                    'real_estate_formula' => $request->real_estate_formula,
                    'area_type_id' => $request->area_type_id,
                    'ad_reference' => $request->ad_reference,
                    'status' => 1, // 1 => pending , 2 => approved , 3 => rejected
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'expiry_date' => now()->addDays($user_premium->premiumMembership->number_days_ad),
                    'real_estate_agent_name' => $request->real_estate_agent_name,
                ];
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

                // return $input_data;

                DB::transaction(function () use ($input_data, $request, $user_premium) {
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
                    $user_premium->number_of_ads = $user_premium->number_of_ads - 1;
                    $user_premium->save();
                });
                return redirect()->route('office-myAdvertisements')->with('success', @trans('front.AdHaveBeenAddedSuccessfully'));
            } else {
                return redirect()->route('office-myPremiumMembership')->with('danger', @trans('front.YouHaveExceededTheEditedTimes'));
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
    //===========================editAdvertisements  function===============
    //==========================Created By: Lujain Smadi====================
    //==========================Modified By Ahmad Obeidat ==================

    public function editAdvertisement(Route $route, $id)
    {
        try {
            // return @trans('front.TheAdHaveBeenEdited');

            $ad = Advertisement::where('user_id', auth()->guard('user')->user()->id)->where('id', $id)->first();

            if ($ad->edit_balance == 0 && $ad->expiry_date > now()) {
                return redirect()->route('office-myAdvertisements')->with('danger', @trans('front.YouHaveExceededTheEditedTimes'));
            } elseif ($ad->expiry_date < now()) {
                //repost
                $user_premium = UserMembership::where('user_id', auth()->guard('user')->user()->id)->where('expiry_date', '>=', now())->where('number_of_ads', '>', 0)->where('status', 1)->first();
                if (!$user_premium) {
                    return redirect()->back()->with('danger', @trans('front.YouHaveToBuyPremiumMembership'));
                }
            }
            $targets = Target::where('status', 1)->get();
            $user_country = auth()->guard('user')->user()->diyarnaCountry;
            $user_cities = DiyarnaaCity::where('diyarnaa_country_id', $user_country->id)->get();
            $construction_ages = Feature::where('status', 1)->where('feature_type_id', 1)->get();
            $land_areas = Feature::where('status', 1)->where('feature_type_id', 2)->get();
            $real_estate_statuses = Feature::where('status', 1)->where('feature_type_id', 3)->get();
            $number_of_rooms = Feature::where('status', 1)->where('feature_type_id', 4)->get();
            $number_of_bathrooms = Feature::where('status', 1)->where('feature_type_id', 5)->get();
            return view('frontend.real_estate_office.editAdvertisements', compact('targets', 'user_cities', 'construction_ages', 'land_areas', 'real_estate_statuses', 'number_of_rooms', 'number_of_bathrooms', 'ad'));
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
    //===========================updateAdvertisementRequest  function=======
    //==========================Created By: Lujain Smadi====================
    //==========================Modified By Ahmad Obeidat   ================


    public function updateAdvertisementRequest(Route $route, $id, updateAdvertisementFormRequest $request)
    {
        try {


            $user_membership = UserMembership::where('user_id', auth()->guard('user')->user()->id)->where('status', 1)->where('expiry_date', '>', date('Y-m-d H:i:s'))->where('number_of_ads', '>', 0)->first();
            $advertisement = Advertisement::find($id);
            if ($advertisement) {

                if ($advertisement->edit_balance == 0 && $advertisement->expiry_date > now()) {
                    return redirect()->route('office-myAdvertisements')->with('danger', @trans('front.YouHaveExceededTheEditedTimes'));
                } elseif ($advertisement->expiry_date < now()) {
                    //repost
                    $user_premium = UserMembership::where('user_id', auth()->guard('user')->user()->id)->where('expiry_date', '>=', now())->where('number_of_ads', '>', 0)->where('status', 1)->first();
                    if (!$user_premium) {
                        return redirect()->back()->with('danger', @trans('front.YouHaveToBuyPremiumMembership'));
                    }
                }
                if ($advertisement->expiry_date > date('Y-m-d H:i:s')) {

                    $update_data = [
                        'user_id' => auth()->guard('user')->user()->id,
                        'target_id' => $request->target_id,
                        'main_category_id' => $request->category_id,
                        'sub_category_id' => $request->sub_category_id,
                        'construction_age' => $request->construction_age,
                        'land_area' => $request->land_area,
                        'real_estate_status' => $request->real_estate_status,
                        'number_of_rooms' => $request->number_of_rooms,
                        'number_of_bathrooms' => $request->number_of_bathrooms,
                        'diyarnaa_country_id' => auth()->guard('user')->user()->diyarnaCountry->id,
                        'diyarnaa_city_id' => $request->diyarnaa_city_id,
                        'diyarnaa_region_id' => $request->diyarnaa_region_id,
                        'street' => $request->street,
                        'url_map' => $request->url_map,
                        'address' => $request->address,
                        'price' => $request->price,
                        'area' => $request->area,
                        'real_estate_formula' => $request->real_estate_formula,
                        'area_type_id' => $request->area_type_id,
                        'ad_reference' => $request->ad_reference,
                        'status' => 1,
                        'edit_balance' => 0,
                        'title_ar' => $request->title_ar,
                        'title_en' => $request->title_en,
                        'description_ar' => $request->description_ar,
                        'description_en' => $request->description_en,


                    ];


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

                    return redirect()->route('office-myAdvertisements')->with('success', @trans('front.TheAdHaveBeenEdited'));
                }
                //=====================================================================
                //===================================repost============================
                //=======================Modified By ahmad obeidat=====================
                $update_data = [
                    'user_id' => auth()->guard('user')->user()->id,
                    'target_id' => $request->target_id,
                    'main_category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'construction_age' => $request->construction_age,
                    'land_area' => $request->land_area,
                    'real_estate_status' => $request->real_estate_status,
                    'number_of_rooms' => $request->number_of_rooms,
                    'number_of_bathrooms' => $request->number_of_bathrooms,
                    'diyarnaa_country_id' => auth()->guard('user')->user()->diyarnaCountry->id,
                    'diyarnaa_city_id' => $request->diyarnaa_city_id,
                    'diyarnaa_region_id' => $request->diyarnaa_region_id,
                    'street' => $request->street,
                    'url_map' => $request->url_map,
                    'address' => $request->address,
                    'price' => $request->price,
                    'area' => $request->area,
                    'real_estate_formula' => $request->real_estate_formula,
                    'area_type_id' => $request->area_type_id,
                    'ad_reference' => $request->ad_reference,
                    'status' => 1,

                    'edit_balance' => 1,
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'description_ar' => $request->description_ar,
                    'expiry_date' => now()->addDays($user_membership->premiumMembership->number_days_ad),
                    'description_en' => $request->description_en,
                ];


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

                DB::transaction(function () use ($update_data, $advertisement, $request, $user_membership) {
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

                    DB::transaction(function () use ($user_membership) {
                        $user_membership->update(['number_of_ads' => DB::raw('number_of_ads - 1')]);
                    });
                });
                return redirect()->route('office-userDashboard')->with('success', @trans('front.RePublishRequestHasBeenSent'));
            } else {
                return redirect()->back()->with('danger', @trans('fornt.AdHaveNotBeenFound'));
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
    //===================myAdvertisementDetails  function===================
    //==========================Created By: Lujain Smadi====================
    //======================================================================

    public function myAdvertisementDetails(Route $route, $id)
    {
        try {
            $advertisement = Advertisement::find($id);

            if ($advertisement) {

                return view('frontend.real_estate_office.myAdvertisementDetails', compact('advertisement'));
            } else {
                return redirect()->back()->with('danger', 'advertisement not found');
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
    //===================myPremiumMembership  function======================
    //==========================Created By: Lujain Smadi====================
    //======================================================================

    public function myPremiumMembership(Route $route)
    {
        try {



            $user_premium_memberships = UserMembership::where('user_id', auth()->guard('user')->user()->id)->get();
            $premium_memberships = PremiumMembership::where('user_type', auth()->guard('user')->user()->getAttributes()['user_type'])->where('status', 1)->orderBy('featured_type', 'asc')->get();
            return view('frontend.real_estate_office.myPremiumMembership', compact('premium_memberships', 'user_premium_memberships'));
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
    // ================== activeInactiveAdvertisement ======================
    // ====================== Created By: Lujain Smadi =====================
    //=======================Modified By:a ahmad oebidat====================
    public function activeInactiveAdvertisement($id, Route $route)
    {
        try {
            $advertisement = Advertisement::find($id);
            if ($advertisement) {
                if ($advertisement->status == 'Active') {
                    $advertisement->status = 5;  // 2 => Inactive
                } elseif ($advertisement->status == 'Inactive') {
                    $advertisement->status = 4;  // 1 => Active
                }
                $advertisement->save();
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
    // ==================== deleteAdvertisement Function ======================
    // ======================= Created By: Lujain Smadi========================
    // ========================Modified By AHMAD OEBIDAT ======================
    public function deleteAdvertisement($id, Route $route)
    {
        try {
            $advertisement = Advertisement::find($id);
            if ($advertisement) {
                DB::transaction(function () use ($advertisement) {
                    $advertisement->delete();
                });
                return redirect()->route('office-myAdvertisements')->with('success', @trans('front.AdHaveBeenDeleted'));
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
    //===================advertisementEditRequest  function=================
    //==========================Created By: Lujain Smadi====================
    //==========================Modified By:Ahmad Obeidat-==================
    public function advertisementEditRequest(Route $route, $id)
    {
        try {
            $advertisement = Advertisement::find($id);
            if ($advertisement) {
                DB::transaction(function () use ($advertisement) {
                    $advertisement->advertisementEditRequests()
                        ->create([
                            'user_id' => auth()->guard('user')->user()->id,
                            'advertisement_id' => $advertisement->id,
                            'status' => 1,
                        ]);
                });
                return redirect()->back()->with('success', @trans('front.TheRequestToModifyTheAdHasBeenSent'));
            } else {
                return redirect()->back()->with('danger', @trans('front.AdDoesNotExist'));
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
    //===================enquiryDetails  function===========================
    //==========================Created By: Lujain Smadi====================
    //======================================================================
    public function enquiryDetails(Route $route, $id)
    {
        try {
            $enquery = EnqueryRequest::find($id);
            if ($enquery) {
                return view('frontend.real_estate_office.enquiry_details', compact('enquery'));
            } else {
                return redirect()->back()->with('danger', @trans('front.InquiryDoesNotExist'));
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
    //===================viewEnquiry  function==============================
    //==========================Created By: Lujain Smadi====================
    //======================================================================
    public function viewEnquiry(Route $route)
    {
        try {
            $advertisements = Advertisement::where('user_id', auth()->guard('user')->user()->id)->whereHas('enqueryRequests')->get();
            return view('frontend.real_estate_office.view_enquiry', compact('advertisements'));
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
    //===================destroyEnquiry  function===========================
    //==========================Created By: Lujain Smadi====================
    //==========================Modified By:Ahmad Obeidat ==================
    public function destroyEnquiry(Route $route, $id)
    {
        try {
            $enquery_request = EnqueryRequest::find($id);
            if ($enquery_request) {
                $enquery_request->delete();
                return redirect()->route('office-viewEnquiry')->with('success', @trans('front.InquiryHaveBeenDeleted'));
            } else {
                return redirect()->back()->with('danger', @trans('front.InquiryDoesNotExist'));
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
    //===================CustomerRequestsOffers  function===================
    //==========================Created By: Lujain Smadi====================
    //======================================================================
    public function customerRequestsOffers(Route $route)
    {
        try {
            $offers = CustomerRequestAndOffer::where('user_id', '=', auth()->guard('user')->user()->id)->orderBy('created_at', 'desc')->get();
            return view('frontend.real_estate_office.customer_requests_offers', compact('offers'));
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
    //===================createCustomerRequestsOffer  function==============
    //==========================Created By: Lujain Smadi====================
    //======================================================================
    public function createCustomerRequestsOffer(Route $route,)
    {
        try {
            $targets = Target::where('status', 1)->get();

            return view('frontend.real_estate_office.create_customer_requests_offers', compact('targets'));
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
    //===================storeCustomerRequestsOffer  function===============
    //==========================Created By: Lujain Smadi====================
    //==========================Modified By:Ahmad Obeidat ==================
    public function storeCustomerRequestsOffer(Route $route, StoreCustomerRequestsOfferFormRequest $request)
    {
        try {
            $input_data = [
                'user_id' => auth()->guard('user')->user()->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'target_id' => $request->target_id,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'diyarnaa_country_id' => $request->diyarnaa_country_id,
                'diyarnaa_city_id' => $request->diyarnaa_city_id,
                'diyarnaa_region_id' => $request->diyarnaa_region_id,
                'price' => $request->price,
                'area' => $request->area,
                'address' => $request->address,
                'type' => $request->type,
                'advertising' => $request->advertising,
            ];
            if (isset($request->video)) {
                $orginal_image = $request->file('video');
                $upload_location = 'storage/images/customer_request_and_offer/videos/';
                $input_data['video'] = $this->saveFile($orginal_image, $upload_location);
            }
            DB::transaction(function () use ($input_data, $request) {
                $offer = CustomerRequestAndOffer::create($input_data);
                if (isset($request->images)) {
                    foreach ($request->images as $value) {
                        $request_data = [
                            'customer_request_and_offer_id' => $offer->id,
                        ];
                        $orginal_image = $value;
                        $upload_location = 'storage/images/customer_request_and_offer/images/';
                        $request_data['image'] =  $this->saveFile($orginal_image, $upload_location);

                        CustomerRequestAndOfferImage::create($request_data);
                    }
                }
            });
            return redirect()->route('office-customerRequestsOffers')->with('success', @trans('front.AddedSuccessfully'));
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
    //===================showCustomerRequestsOffer  function================
    //==========================Created By: Lujain Smadi====================
    //====================Modified By:ahmad obeidat ========================
    public function showCustomerRequestsOffer(Route $route, $id)
    {
        try {
            $offer = CustomerRequestAndOffer::find($id);
            if ($offer) {
                // return $offer;
                return view('frontend.real_estate_office.show_customer_requests_offer', compact('offer'));
            } else {
                return redirect()->route('office-customerRequestsOffers')->with('error', @trans('front.ThisOfferDoesNotExist'));
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
    //===================destroyCustomerRequestOffer  function==============
    //==========================Created By: Lujain Smadi====================
    //==========================Modified By AHMAD Obeidat===================
    public function destroyCustomerRequestOffer(Route $route, $id)
    {

        try {
            $offer = CustomerRequestAndOffer::find($id);
            if ($offer) {
                $offer->delete();
                CustomerRequestAndOfferImage::where('customer_request_and_offer_id', $id)->delete();
                return redirect()->back()->with('success', @trans('front.DeletedSuccessfully'));
            } else {
                return redirect()->back()->with('danger', @trans('front.RequestNotFound'));
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
    //===================sendEnquiryReplay  function========================
    //==========================Created By: Lujain Smadi====================
    //======================================================================
    public function sendEnquiryReplay(Route $route, $id, ReplayEnqueryRequestFormRequest $request)
    {
        try {
            $replay = EnqueryRequest::find($id);
            if ($replay) {
                if ($request->replay == null) {
                    return redirect()->back()->with('danger', @trans('front.EmptyResponse'));
                }
                Mail::to($replay->email)->send(new SendEnquiryReplay($request->replay, $replay->advertisement_id));

                return redirect()->route('office-viewEnquiry')->with('success', @trans('front.ReplySent'));
            } else {
                return redirect()->route('office-viewEnquiry')->with('danger', @trans('front.InquiryDoesNotExist'));
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
    //===========================getDiyarnaaCities Ajax function============
    //==========================Created By: Lujain Smadi====================
    //======================================================================

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
    //===========================getFeatureType Ajax function===============
    //==========================Created By: Lujain Smadi====================
    //======================================================================

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

    //======================================================================
    //===========================getDiyarnaaCities Ajax function============
    //=========================Created By: Lujain Smadi=====================
    //======================================================================
    public function getDiyarnaaRegions(Request $request)
    {
        if (!isset($request->diyarnaa_city_id)) {
            $diyarnaa_regions = "";
        } else {
            $diyarnaa_regions = DiyarnaaRegion::where('diyarnaa_city_id', $request->diyarnaa_city_id)->select(
                'id',
                'name_' . config('app.locale') . ' as name',
            )->get();
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
}
