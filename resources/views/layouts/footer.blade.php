<footer>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-5">
                <h2>@lang('front.SubscribeToNews')</h2>
                <div class="subscibe">
                    <form action="{{ route('newsletterSubscribe') }}" class="subscibe" method="POST">
                        @csrf
                        @error('email_subscribe')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="@lang('front.Email')" class="text" name="email_subscribe"
                            required>
                        <button type="submit">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-7 linkList d-flex justify-content-between">
                <ul>
                    <li>
                        <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                    </li>
                    <li>
                        <a href="{{ route('aboutUs') }}">@lang('front.AboutUs')</a>
                    </li>
                    <li>
                        <a href="{{ route('WebsiteBroker') }}">@lang('front.BrokerSite')</a>
                    </li>
                    <li>
                        <a href="{{ route('PremiumMembership') }}">@lang('front.PremiumMembership')</a>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a href="{{ route('aboutCompany') }}">
                            @lang('front.AboutCompany') </a>
                    </li>
                    <li>
                        <a href="{{ route('userSignup') }}">
                            @lang('front.UserSignup')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('userLogin') }}">
                            @lang('front.UserLogin')
                        </a>
                    </li>
                </ul>

                <ul>
                    @if (Auth::guard('user')->check())
                        <li>
                            <a href="{{ route('complaints') }}">
                                @lang('front.Complaints') </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('jobs') }}">
                            @lang('front.Jobs') </a>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contactUs') }}">
                            @lang('front.ContactUs') </a>
                    </li>
                    @if (Auth::guard('user')->check())
                        <li>
                            <a href="{{ route('opinionForm') }}">
                                @lang('front.OpinionForm') </a>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row">
            <div class=" col-12 bottomFooter d-flex justify-content-between align-items-end"
                style="align-items: center !important;">
                <a href="{{ route('welcome') }}"><img src="{{ asset('style_files/frontend/img/flogo.png') }}"
                        alt="logo"></a>

                <div class="social d-flex align-items-center">
                    <span>@lang('front.StayConnected')</span>
                    <ul class="d-flex ">
                        <li>
                            <a href="{{ isset($contact_us->twitter) ? $contact_us->twitter : -1 }}" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ isset($contact_us->instagram) ? $contact_us->instagram : -1 }}"
                                target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ isset($contact_us->linkedin) ? $contact_us->linkedin : -1 }}" target="_blank">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ isset($contact_us->facebook) ? $contact_us->facebook : -1 }}" target="_blank">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ isset($contact_us->youtube) ? $contact_us->youtube : -1 }}" target="_blank">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="copyRight py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="copyRightContent d-flex justify-content-between">
                    <p class="mb-0">@lang('front.Developed') <a href="https://bluerayws.com/" target="_blank">@lang('front.CompanyOfDevelopment')</a>
                        @lang('front.CompanyRights') </p>
                    {{-- <a href="#" class="language">
                        <i class="fa-solid fa-globe"></i>
                        العربية
                    </a> --}}
                    <ul class="d-flex g-10">
                        <li>
                            <a href="{{ route('termsAndConditions') }}">
                                @lang('front.TermsAndConditions') </a>
                        </li>
                        <li>
                            <a href="{{ route('privacyAndPolicy') }}">
                                @lang('front.PrivacyPolicy') </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
