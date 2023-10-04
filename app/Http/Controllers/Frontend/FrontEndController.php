<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Crypt;

use App\Models\Job;
use App\Models\Mail;
use App\Models\User;
use App\Models\About;
use App\Models\Target;
use App\Models\Opinion;
use App\Models\Complaint;
use App\Models\HomeSlider;
use App\Models\JobRequest;
use App\Models\SubCategory;
use App\Traits\SharedTrait;
use App\Models\DiyarnaaCity;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\PrivacyPolicy;
use App\Models\SupportTicket;
use App\Models\TermCondition;
use App\Models\WebsiteBroker;
use Illuminate\Routing\Route;
use App\Models\DiyarnaaRegion;
use App\Models\EnqueryRequest;
use App\Models\DiyarnaaCountry;
use App\Models\ContactUsRequest;
use App\Traits\UploadImageTrait;
use App\Models\PremiumMembership;
use Illuminate\Support\Facades\DB;
use App\Models\NewsletterSubscribe;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PremiumMembershipPage;
use App\Models\FavouriteAdvertisement;
use App\Http\Requests\Frontend\Chat\StoreChatFormRequest;
use App\Http\Requests\Frontend\Login\userLoginFormRequest;
use App\Http\Requests\Frontend\JobRequest\StoreJobFormRequest;
use App\Http\Requests\Frontend\Complaint\StoreComplaintFormRequest;
use App\Http\Requests\Frontend\Signup\userSignupRequestFormRequest;
use App\Http\Requests\Frontend\WebsiteBroker\WebsiteBrokerFormRequest;
use App\Http\Requests\Frontend\EnqueryRequest\EnqueryRequestFormRequest;
use App\Http\Requests\Frontend\Newsletter\StoreNewsletterSubscribemRequest;
use App\Http\Requests\Frontend\BookAdvertisement\BookAdvertisementFormRequest;
use App\Http\Requests\Backend\ContactUsRequest\storeContactUsRequestFormRequest;
use App\Http\Requests\Frontend\Opinion\StoreOpinionFormRequest;
use App\Models\UserMembership;
use Illuminate\Support\Facades\Mail as FacadesMail;

class FrontEndController extends Controller
{
    use SharedTrait, UploadImageTrait;
    //================================================================
    //==================== welcome Function Section ==================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function welcome(Route $route)
    {
        try {
            $home_sliders = HomeSlider::where('status', 4)->where('user_type', 1)->where('expire_date', '>=', now())->get();
            $countries = DiyarnaaCountry::where('status', 1)->get();
            $advertisments = Advertisement::where('status', 4)->orderBy('id', 'DESC')->where('expiry_date', '>=', now())->limit(6)->get();
            $opinions = Opinion::where('status', 1)->get();




            return view('welcome', compact('home_sliders', 'countries', 'advertisments', 'opinions'));
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
    //==================== aboutUs Function Section ==================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function aboutUs(Route $route)
    {
        try {
            $about_us = About::first();
            return view('frontend.aboutUs', compact('about_us'));
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
    //==================== TermsAndConditions Function Section =======
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function termsAndConditions(Route $route)
    {
        try {

            $terms_and_conditions = TermCondition::where('status', 1)->get();
            return view('frontend.TermsAndConditions', compact('terms_and_conditions'));
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
    //==================== privacyAndPolicy Function Section =========
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function privacyAndPolicy(Route $route)
    {
        try {
            $privacy_policies = PrivacyPolicy::where('status', 1)->get();
            return view('frontend.privacyAndpolicy', compact('privacy_policies'));
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
    //==================== contactUs Function Section ================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function contactUs(Route $route)
    {
        try {
            return view('frontend.contactUs');
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
    //==================== ContactUsRequest Function Section =========
    //====================Created by: Lujain Samdi====================
    //=====================Modified By:ahmad obeidat==================
    public function ContactUsRequest(Route $route, storeContactUsRequestFormRequest  $request)
    {
        try {
            $request_data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ];
            DB::transaction(function () use ($request_data) {
                ContactUsRequest::create($request_data);
            });
            return redirect()->back()->with('success', @trans('front.ContactUsRequestHasBeenCreated'));
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
    //==================== aboutCompany  Section =====================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function aboutCompany(Route $route)
    {
        try {
            $about = About::first();
            $number_of_office = User::where('user_type', 1)->where('status', 4)->count();
            $number_of_owners = User::where('user_type', 2)->where('status', 4)->count();
            $number_of_seekers = User::where('user_type', 3)->where('status', 4)->count();
            return view('frontend.aboutCompany', compact('about', 'number_of_office', 'number_of_owners', 'number_of_seekers'));
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
    //==================== opinionForm  Section ======================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function opinionForm(Route $route)
    {
        try {
            return view('frontend.opinion');
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
    //==================== StoreOpinion  Section =====================
    //====================Created by: Lujain Samdi====================
    //====================Modified By Ahmad Obeidat ==================
    public function storeOpinion(Route $route, StoreOpinionFormRequest $request)
    {
        try {
            $input_data = [
                'name' => $request->name,
                'opinion' => $request->opinion,
                'user_id' => Auth::guard('user')->user()->id,
            ];
            DB::transaction(function () use ($input_data) {
                Opinion::create($input_data);
            });
            return redirect()->back()->with('success', @trans('front.ThanksForYourOpinion'));
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
    //============== user Signup Function Section ====================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function userSignup(Route $route)
    {

        try {
            if (Auth::guard('user')->check()) {
                return redirect()->intended(route('welcome'));
            }

            return view('frontend.signup');
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
    //============== user Signup Request Function Section ============
    //====================Created by: Lujain Samdi====================
    //====================Modified BY ahmad obeidat===================
    public function userSignupRequest(userSignupRequestFormRequest $request, Route $route)
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
                'status' => $request->user_type == 1 ? 1 : 4,
                'additional_information' => $request->additional_information,
            ];
            if (isset($request->profile_image)) {
                $orginal_image = $request->file('profile_image');
                $upload_location = 'storage/images/users/profile/';
                $request_data['profile_image'] = $this->saveFile($orginal_image, $upload_location);
            }
            if (isset($request->license_image)) {
                $orginal_image = $request->file('license_image');
                $upload_location = 'storage/images/users/license/';
                $request_data['license_image'] = $this->saveFile($orginal_image, $upload_location);
            }
            DB::transaction(function () use ($request_data, $request) {
                $user = User::create($request_data);
                if ($request->user_type == 1) {
                    $user->code = 'REF' . $user->id;
                    $user->save();
                } else if ($request->user_type == 2) {
                    $user->code  = 'REO' . $user->id + 20001;
                    $user->save();
                } elseif ($request->user_type == 3) {
                    $user->code  = 'RES' . $user->id + 30001;
                    $user->save();
                }
            });
            if ($request->user_type != 1) {

                // Attempt to log the user in
                if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    Auth::guard('user')->user()->expire_date = now()->addYear();
                    Auth::guard('user')->user()->save();

                    $verify_id = Crypt::encryptString(Auth::guard('user')->user()->id);
                    $type = 'Verification';
                    FacadesMail::send('email.EmailVerification', ['verify_id' => $verify_id, 'type' => $type], function ($message) {
                        $message->to(Auth::guard('user')->user()->email);
                        $message->subject('Verify Email');
                    });
                    return redirect()->route('welcome')->with('welcome', @trans("front.WelcomeDiyaranVerifyEmail"));
                }
            } else {
                return redirect()->route('welcome')->with('success', @trans('front.YourRequestHasBeenSent'));
            }
            // Auth::guard('user')->user();
            return redirect()->intended(route('welcome'));
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
    //============== user Login Function Section =====================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function userLogin(Route $route)
    {

        try {





            if (Auth::guard('user')->check()) {
                return redirect()->intended(route('welcome'));
            } else {
                return view('frontend.login');
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
    //============== user Login Request Function Section =============
    //====================Created by: Lujain Samdi====================
    //==================Updated By:Ahmad Obeidat =====================
    //================================================================
    public function userLoginRequest(Route $route, userLoginFormRequest $request)
    {

        try {
            // Check If User Auth :
            if (Auth::guard('user')->check()) {
                if (Auth::guard('user')->user()->status == 'Pending') {
                    Auth::guard('user')->logout();
                    return redirect()->route('welcome')->with('danger', @trans('YourRequestToJoinIsPending'));
                } else if (Auth::guard('user')->user()->status == 'Reject') {
                    Auth::guard('user')->logout();
                    return redirect()->route('welcome')->with('danger', @trans('front.YourRequestToJoinHaveBeenDenied'));
                }
            } elseif (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {


                if ((Auth::guard('user')->user()->status == 'Pending')) {
                    Auth::guard('user')->logout();
                    return redirect()->route('welcome')->with('danger', @trans('YourRequestToJoinIsPending'));
                } else if ((Auth::guard('user')->user()->status == 'Reject') || (Auth::guard('user')->user()->status == 'Inactive')) {
                    Auth::guard('user')->logout();
                    return redirect()->route('welcome')->with('danger', @trans('front.YourRequestToJoinHaveBeenDenied'));
                }

                if ((Auth::guard('user')->user()->user_type == 'Real Estate Office' &&  Auth::guard('user')->user()->expire_date < now())) {
                    Auth::guard('user')->logout();
                    return redirect()->route('welcome')->with('danger', @trans('AccountValidityEndedContactTheManagement'));
                }
                if ((Auth::guard('user')->user()->status == 'Accept' || Auth::guard('user')->user()->status == 'Active')) {
                    if (Auth::guard('user')->user()->is_verified == 'Verified') {
                        return redirect()->route('welcome')->with('welcome', @trans("front.WelcomeDiyaran"));
                    } else {
                        $verify_id = Crypt::encryptString(Auth::guard('user')->user()->id);
                        $type = 'Verification';

                        FacadesMail::send('email.EmailVerification', ['verify_id' => $verify_id, 'type' => $type], function ($message) {
                            $message->to(Auth::guard('user')->user()->email);
                            $message->subject('Verify Email');
                        });
                        return redirect()->route('welcome')->with('welcome', @trans("front.WelcomeDiyaranVerifyEmail"));
                    }
                }
            }



            // if unsuccessful
            // return redirect()->back()->withInput($request->only('email'))->with('danger', 'البريد الالكتروني او كلمة المرور غير صحيحة');
            return redirect()->back()->withInput($request->only('email'))->with('danger', @trans('front.PasswordOrEmailNotCorrect'));
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
    // ======================= user Logout Function ===========================
    // ==================== Created By : Lujain Al-Smadi ======================
    // ========================================================================
    public function userLogout(Route $route)
    {
        try {
            Auth::guard('user')->logout();
            return redirect()->route('welcome')->with('success', @trans("front.Soon"));
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
    //============== WebsiteBroker Function Section ==================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function WebsiteBroker(Route $route)
    {
        try {

            $diyarnaa_countries = DiyarnaaCountry::where('status', 1)->whereHas('websiteBrokers')->get();

            return view('frontend.WebsiteBroker', compact('diyarnaa_countries'));
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
    //============== WebsiteBrokerForm Function Section ==============
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function WebsiteBrokerRequestForm(Route $route)
    {
        try {
            return view('frontend.WebsiteBrokerRequestForm');
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
    //============== Website Broker Request Function Section =========
    //====================Created by: Lujain Samdi====================
    //====================Modified BY:ahmad obeidat===================
    public function WebsiteBrokerRequest(Route $route, WebsiteBrokerFormRequest $request)
    {
        try {
            $input_request = [
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'diyarnaa_country_id' => $request->diyarnaa_country_id,
                'diyarnaa_city_id' => $request->diyarnaa_city_id,
                'details' => $request->details,
                'status' => 1,
            ];
            DB::transaction(function () use ($input_request) {
                WebsiteBroker::create($input_request);
            });
            return redirect()->route('welcome')->with('success', @trans('BrokerRequestHaveBeenSent'));
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
    //============== internalMail Function Section ===================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function internalMail(Route $route)
    {
        try {
            return view('frontend.internalMail');
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
    //============== messageDetails Function Section =================
    //====================Created by: Lujain Samdi====================
    //=====================Modified By:Ahmad Obeidat==================
    public function messageDetails(Route $route, $id)
    {
        try {
            $message_details = Mail::find($id);
            if ($message_details) {
                if ($message_details->deleter_type != null) {

                    if (Auth::guard('user')->user()->id == $message_details->sender_id && $message_details->sender_type == 'User') {
                        if ($message_details->deleter_type == 'Sender') {
                            return redirect()->route('internalMail')->with('danger', @trans('TheMessageDoesNotExist'));
                        } else {

                            return view('frontend.messageDetails', compact('message_details'));
                        }
                    } else if (Auth::guard('user')->user()->id == $message_details->receiver_id && $message_details->receiver_type == 'User') {
                        if ($message_details->deleter_type == 'Receiver') {
                            return redirect()->route('internalMail')->with('danger', @trans('TheMessageDoesNotExist'));
                        } else {
                            DB::transaction(function () use ($message_details) {
                                $message_details->update([
                                    'is_read' => 1,
                                ]);
                            });
                            return view('frontend.messageDetails', compact('message_details'));
                        }
                    }
                } else {
                    if (Auth::guard('user')->user()->id == $message_details->receiver_id && $message_details->receiver_type == 'User') {
                        DB::transaction(function () use ($message_details) {
                            $message_details->update([
                                'is_read' => 1,
                            ]);
                        });
                    }
                    return view('frontend.messageDetails', compact('message_details'));
                }
            } else {
                return redirect()->route('internalMail')->with('danger', @trans('TheMessageDoesNotExist'));
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
    //============== sendEmail Function Section ======================
    //====================Created by: Lujain Samdi====================
    //=====================Modified:By ahmad obeidat==================
    public function sendEmail(Route $route, StoreChatFormRequest $request)
    {
        try {

            $input_request = [
                'sender_id' => Auth::guard('user')->user()->id,
                'receiver_id' => 1,
                'sender_type' => 2,
                'receiver_type' => 1,
                'details' => $request->details,
                'email_type' => 1,
            ];

            if (isset($request->file)) {
                $file_name = $this->saveFile($request->file, 'storage/mails/files/');
                $input_request['file'] = $file_name;
                $file = $file_name;
            } else {
                $input_request['file'] = null;
                $file = null;
            }

            DB::transaction(function () use ($input_request) {

                Mail::create($input_request);
            });
            return redirect()->back()->with('success', @trans('TheMassageHaveBeenSent'));
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
    //============== replyMessage Function Section ===================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function replyMessage(Route $route, $id)
    {
        try {
            $message_details = Mail::where('id', $id)->first();
            return view('frontend.replyMessage', compact('message_details'));
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
    //============== forword Function Section ========================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function forword(Route $route, $id)
    {
        try {
            $message_details = Mail::where('id', $id)->first();
            return view('frontend.forword', compact('message_details'));
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
    //============== delete Function Section =========================
    //====================Created by: Lujain Samdi====================
    //====================Modified By:Ahmad Obeidat===================
    public function delete(Route $route, $id)
    {
        try {
            $mail = Mail::find($id);
            if ($mail) {
                if ($mail->deleter_type == null) {
                    if (Auth::guard('user')->user()->id == $mail->sender_id && $mail->sender_type == 'User') {
                        $mail->update([
                            'deleter_type' => 1,

                        ]);
                    } else if (Auth::guard('user')->user()->id == $mail->receiver_id && $mail->receiver_type == 'User') {
                        $mail->update([
                            'deleter_type' => 2,

                        ]);
                    }
                } else {
                    DB::transaction(function () use ($mail) {
                        $mail->update([
                            'deleter_type' => 3,

                        ]);
                        $mail->delete();
                    });
                }

                return redirect()->route('internalMail')->with('success', @trans('front.TheMessageHaveBeenDeletedSuccessfully'));
            } else {
                return redirect()->back()->with('danger', @trans('font.ThisMessageHaveNotBeenFound'));
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
    //============== Premium Membership Function Section =============
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function PremiumMembership(Route $route)
    {
        try {

            if (Auth::guard('user')->check()) {
                $premium_membership_page = PremiumMembershipPage::first();
                $user = User::find(auth()->guard('user')->user()->id);
                $premium_memberships = PremiumMembership::where('status', 1)->where('user_type', $user->getAttributes()['user_type'])->orderBy('featured_type', 'asc')->get();

                return view('frontend.PremiumMembership', compact('premium_membership_page', 'premium_memberships'));
            } else {
                return redirect()->route('userLogin')->with('danger', @trans('front.PleaseSignIn'));
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
    //============== advertisements Function Section =================
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function advertisements(Route $route, Request $request)
    {
        try {
            $advertisments =  new Advertisement();
            $home_sliders = new HomeSlider();
            $advertisments = $advertisments->select('*');
            $targets = Target::where('status', 1)->get();


            $home_sliders = $home_sliders->where('status', 4)->where('user_type', 2)->where('expire_date', '>=', now());
            if (isset($request->diyarnaa_country_id)) {
                $advertisments = $advertisments->where('diyarnaa_country_id', $request->diyarnaa_country_id);
                $home_sliders = $home_sliders->where('diyarnaa_country_id', $request->diyarnaa_country_id);
            }
            if (isset($request->diyarnaa_city_id)) {
                $advertisments = $advertisments->where('diyarnaa_city_id', $request->diyarnaa_city_id);
            }
            if (isset($request->diyarnaa_region_id)) {
                $advertisments = $advertisments->where('diyarnaa_region_id', $request->diyarnaa_region_id);
            }
            if (isset($request->target_id)) {
                $advertisments = $advertisments->where('target_id', $request->target_id);
            }
            if (isset($request->category_id)) {
                $advertisments = $advertisments->where('main_category_id', $request->category_id);
            }
            if (isset($request->sub_category_id)) {
                $advertisments = $advertisments->where('sub_category_id', $request->sub_category_id);
            }
            if (isset($request->code)) {
                $advertisments = $advertisments->where('code', $request->code);
            }

            $advertisments = $advertisments->where('status', 4)->where('expiry_date', '>=', now())->orderBy('created_at', 'desc')->get();
            $home_sliders = $home_sliders->get();

            // return  $advertisments;
            return view('frontend.advertisements', compact('advertisments', 'targets', 'home_sliders'));
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
    //============== bookAdvertisement Form Function Section =========
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function bookAdvertisement(Route $route, Request $request)
    {
        try {
            return view('frontend.bookAdvertisement');
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
    //============== bookAdvertisement Form Function Section =========
    //====================Created by: Lujain Samdi====================
    //===============Modified By:ahmad obeidat========================
    public function bookAdvertisementRequest(Route $route, BookAdvertisementFormRequest $request)
    {
        try {
            $request_data = [
                'company_name_ar' => $request->company_name_ar,
                'company_name_en' =>  $request->company_name_en,
                'diyarnaa_country_id' => $request->diyarnaa_country_id,
                'diyarnaa_city_id' => $request->diyarnaa_city_id,
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
                'phone' => $request->phone,
                'email' =>  $request->email,
                'status' => '1',
            ];
            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/images/book_advertisement/images/';
                $request_data['image'] = $this->saveFile($orginal_image, $upload_location);
            }
            if (isset($request->license_image)) {
                $orginal_image = $request->file('license_image');
                $upload_location = 'storage/images/book_advertisement/images/';
                $request_data['license_image'] = $this->saveFile($orginal_image, $upload_location);
            }
            DB::transaction(function () use ($request_data) {
                HomeSlider::create($request_data);
            });
            return redirect()->back()->with('success', @trans('front.YourRequestHaveBeenSubmitted'));
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
    //============== advertisementDetails Function   =================
    //====================Created by: Lujain Samdi====================
    //====================Modified By:Ahmad Obeidat===================
    public function advertisementDetails(Route $route, $id)
    {
        try {
            $advertisement = Advertisement::where('id', $id)->where('expiry_date', '>=', now())->where('status', 4)->first();
            if ($advertisement) {

                return view('frontend.advertisementDetails', compact('advertisement'));
            } else {
                return redirect()->back()->with('danger', @trans('TheRequestedAdHasNotBeenFound'));
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
    //=================== sendEnquiry  function ============================
    //==========================Created By: Lujain Samdi====================
    //==========================Modified BY:Ahmad Obeidat===================
    public function sendEnquiry(Route $route, EnqueryRequestFormRequest $request, $id)
    {
        try {
            $advertisement = Advertisement::find($id);
            if ($advertisement) {
                $input_request = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'message' => $request->message,
                    'real_estate_office_id' => $advertisement->user->id,
                    'advertisement_id' => $advertisement->id,
                    'diyarnaa_country_id' => auth()->guard('user')->user() ? auth()->guard('user')->user()->diyarnaa_country_id : $request->diyarnaa_country_id,
                ];
                DB::transaction(function () use ($input_request) {
                    EnqueryRequest::create($input_request);
                });
                return redirect()->back()->with('success', @trans('front.InquiryHaveBeenSent'));
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
    //=================== complaints  function =============================
    //==========================Created By: Lujain Samdi====================
    //======================================================================
    public function complaints(Route $route)
    {
        try {
            return view('frontend.complaints');
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
    //=================== sendComplaints  function =========================
    //==========================Created By: Lujain Samdi====================
    //=====================Modified By :Ahmad Obeidat ======================
    public function sendComplaints(Route $route, StoreComplaintFormRequest $request)
    {
        try {
            $input_request = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'subject' => $request->subject,
                'description' => $request->description,

            ];
            DB::transaction(function () use ($input_request) {
                Complaint::create($input_request);
            });
            return redirect()->back()->with('success', @trans('front.ComplaintHaveBeenSent'));
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
    //=================== job  function ====================================
    //==========================Created By: Lujain Samdi====================
    //======================================================================
    public function jobs(Route $route)
    {
        try {
            $jobs = Job::where('status', 1)->where('expiry_date', '>=', now())->get();
            return view('frontend.jobs', compact('jobs'));
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
    //=================== jobDetails  function =============================
    //==========================Created By: Lujain Samdi====================
    //=========================Modified By:AHMAD OBEIDAT====================
    public function jobDetails(Route $route, $id)
    {
        try {
            $job = Job::where('id', '=', $id)->where('status', 1)->where('expiry_date', '>=', now())->first();

            if ($job) {
                return view('frontend.jobDetails', compact('job'));
            } else {
                return redirect()->route('welcome')->with('danger', @trans('RequestedJobNotFound'));
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
    //=================== jobRequest  function =============================
    //==========================Created By: Lujain Samdi====================
    //=========================Modified By:Ahmad Obeidat====================
    public function jobRequest(Route $route, StoreJobFormRequest $request, $id)
    {
        try {
            $input_request = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'job_id' => $id,


            ];
            if (isset($request->file)) {
                $orginal_image = $request->file('file');
                $upload_location = 'storage/jobs/files/';
                $input_request['file'] = $this->saveFile($orginal_image, $upload_location);
            }
            DB::transaction(function () use ($input_request) {
                JobRequest::create($input_request);
            });
            return redirect()->back()->with('success', @trans('YourRequestHasBeenSent'));
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
    //============== addRemoveFavAds Form Function Section ===========
    //====================Created by: Lujain Samdi====================
    //=====================Modified By:ahmad obeidat==================
    public function addRemoveFavAds(Route $route, $id)
    {
        try {
            $my_fav_ad = FavouriteAdvertisement::where('advertisement_id', $id)->where('user_id', auth()->guard('user')->user()->id)->first();
            if ($my_fav_ad) {
                $my_fav_ad->delete();
                return redirect()->back()->with('success', @trans('front.AdDeletedSuccessfully'));
            } else {
                $my_fav_ad = FavouriteAdvertisement::create([
                    'advertisement_id' => $id,
                    'user_id' => auth()->guard('user')->user()->id,
                ]);
                return redirect()->back()->with('success', @trans('front.AdHaveBeenAddedSuccessfully'));
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
    //==================== newsletterSubscribe Function Section ======
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function newsletterSubscribe(StoreNewsletterSubscribemRequest $request, Route $route)
    {
        try {
            $request_data = [
                'email' => $request->email_subscribe,
            ];

            $email = NewsletterSubscribe::where('email', $request_data['email'])->first();

            // return  $email ;
            if (!$email) {
                DB::transaction(function () use ($request_data) {
                    newsletterSubscribe::create($request_data);
                });
            } else {
                if ($email->is_verified == 'Verified') {
                    return redirect()->back()->with('success',  @trans('front.SubscribeNewsletter'));
                }
            }


            FacadesMail::send('email.EmailVerificationToSubscribeNewsletter', ['email' => $request->email_subscribe], function ($message) use ($request) {
                $message->to($request->email_subscribe);
                $message->subject('Verify Email to Subscribe To The Newsletter');
            });


            return redirect()->back()->with('success',  @trans('front.EmailVerificationToSubscribeNewsletter'));
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
    //==========================Created By: Lujain Samdi====================
    //======================================================================
    public function getDiyarnaaCities(Request $request)
    {
        if (!isset($request->diyarnaa_country_id)) {
            $diyarnaa_cities = "";
            $currency = "";
        } else {

            $currency = DiyarnaaCountry::find($request->diyarnaa_country_id)->currency;
            $diyarnaa_cities = DiyarnaaCity::where('diyarnaa_country_id', $request->diyarnaa_country_id)->select(
                'id',
                'name_' . config('app.locale') . ' as name',
            )->get();
        }
        if ($diyarnaa_cities != null || $diyarnaa_cities != "") {
            if (count($diyarnaa_cities) > 0) {
                return response()->json([
                    'status' => true,
                    'diyarnaa_cities' => $diyarnaa_cities,
                    'currency' => $currency,
                ]);
            } else {
                return response()->json([
                    'status' => 'empty',
                    'diyarnaa_cities' => $diyarnaa_cities,
                    'currency' => $currency,
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
    //===========================getDiyarnaaRegions Ajax function===========
    //=========================Created By: Lujain Samdi=====================
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
    //======================================================================
    //===========================getSubCategories Ajax function=============
    //==========================Created By: Lujain Samdi====================
    //======================================================================
    public function getSubCategories(Request $request)
    {
        if (!isset($request->category_id)) {
            $sub_category = [];
        } else {
            $sub_category = SubCategory::where('category_id', $request->category_id)->select(
                'id',

                'name_' . config('app.locale') . ' as name',
            )->get();
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
    //===========================buyPremiumMembership  function=============
    //==========================Created By: Lujain Samdi====================
    //======================================================================
    public function buyPremiumMembership(Request $request, $premium_membership_id)
    {
        if (isset($premium_membership_id)) {
            $user = User::find(auth()->guard('user')->user()->id);
            $premium_membership = PremiumMembership::where('id', $premium_membership_id)->where('status', 1)->where('user_type', $user->getAttributes()['user_type'])->first();
            if ($premium_membership) {
                // التحقق اذا كانت نوع العضويه يتكون من عدد غير محدود من الاعلانات
                if ($premium_membership->unlimited_status == 'True') {
                    UserMembership::create([
                        'user_id' => $user->id,
                        'premium_membership_id' => $premium_membership->id,
                        'number_of_ads' => 1000,
                        'expiry_date' => now()->addDays($premium_membership->number_days_membership),
                        'status' => 1,
                    ]);
                } else {
                    UserMembership::create([
                        'user_id' => $user->id,
                        'premium_membership_id' => $premium_membership->id,
                        'number_of_ads' => $premium_membership->number_of_ads,
                        'expiry_date' => now()->addDays($premium_membership->number_days_membership),
                        'status' => 1,
                    ]);
                }
                return redirect()->back()->with('success', 'Membership has been purchased successfully');
            } else {
                return redirect()->back()->with('danger', 'Premium Membership not found');
            }
        } else {
            return redirect()->back()->with('danger', 'Premium Membership not found');
        }
    }


    //================================================================
    //==================== paymentTransactions Function Section ======
    //====================Created by: Lujain Samdi====================
    //================================================================
    public function paymentTransactions(Route $route)
    {
        try {
            return view('frontend.paymentTransactions');
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
    // ==============Email Verify Function ====================================
    // ==================== Created By : QUSAI ================================
    // ========================================================================
    public function EmailVerify(Route $route, $verify_id)
    {

        try {
            $id = Crypt::decryptString($verify_id);
            $user = User::where('id', $id)->get()->first();
            if ($user) {
                $data = [
                    'is_verified' => 2,
                    'email_verified_at' => now(),
                ];
                DB::transaction(function () use ($data, $user) {
                    $user->update($data);
                });
                if ($user->user_type == 'Real Estate Owner') {
                    return redirect()->route('owner-userDashboard')->with('success',  @trans('front.verify_email_done'));
                } elseif ($user->user_type == 'Real Estate Seeker') {
                    return redirect()->route('seeker-userDashboard')->with('success',  @trans('front.verify_email_done'));
                } else {
                    auth('user')->login($user);
                    return redirect()->route('office-userDashboard')->with('success',  @trans('front.verify_email_done'));
                }
            } else {

                return redirect()->route('welcome')->with('danger',  @trans('front.user_not_found'));
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
    // ==============Email Verify Subscribe Newsletter Function ===============
    // ==================== Created By : QUSAI ================================
    // ========================================================================
    public function EmailVerifySubscribeNewsletter(Route $route, $email)
    {

        try {
            $newsletter_subscribe = NewsletterSubscribe::where('email', $email)->first();
            if ($newsletter_subscribe) {
                $data = [
                    'is_verified' => 2,
                    'email_verified_at' => now(),
                ];
                DB::transaction(function () use ($data, $newsletter_subscribe) {
                    $newsletter_subscribe->update($data);
                });
                return redirect()->route('welcome')->with('success',  @trans('front.verify_email_done'));
            } else {

                return redirect()->route('welcome')->with('danger',  @trans('front.user_not_found'));
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
