<div class="innerPage">
    <div class="dashboard page_wrapper">
        <div class="menuIcon">
            <img class="m" src="{{ asset('style_files/frontend/img/icons/menu1.png') }}" class="img-fluid"
                alt="img">
            <img class="x hide" src="{{ asset('style_files/frontend/img/icons/menu2.png') }}" class="img-fluid"
                alt="img">
        </div>
        <section class="userMenu">
            <div class="top">

                @if (isset(Auth::guard('user')->user()->profile_image) &&
                        Auth::guard('user')->user()->getRawOriginal('profile_image') &&
                        file_exists(Auth::guard('user')->user()->getRawOriginal('profile_image')))
                    <img src="{{ asset(Auth::guard('user')->user()->profile_image) }}" class="img-fluid" alt="t1">
                @else
                    <img src="{{ asset('style_files/frontend/img/logo.png') }}" class="img-fluid" alt="img">
                @endif




                <h3>{{ isset(Auth::guard('user')->user()->name) ? Auth::guard('user')->user()->name : null }}</h3>
            </div>

            @if (isset(Auth::guard('user')->user()->user_type) && Auth::guard('user')->user()->user_type == 'Real Estate Office')
                <ul>
                    <li>
                        <a href="{{ route('office-userDashboard') }}">
                            <i class="fa fa-user"></i>
                            @lang('front.PersonalInformation')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('office-changeRealEstateOfficeLoginInfo') }}">
                            <i class="fa fa-lock"></i>
                            @lang('front.ChangeLoginInformation') </a>
                    </li>
                    @if (Auth::guard('user')->user()->is_verified == 'Verified')
                        <li>
                            <a href="{{ route('paymentTransactions') }}">
                                <i class="fas fa-sack-dollar"></i>
                                @lang('front.Payments') </a>
                        </li>
                        <li>
                            <a href="{{ route('office-addAdvertisements') }}">
                                <i class="fa fa-plus"></i>
                                @lang('front.AddNewAd') </a>
                        </li>
                        <li>
                            <a href="{{ route('office-myAdvertisements') }}">
                                <i class="fa fa-plus"></i>
                                @lang('front.MyAds') </a>
                        </li>
                        <li>
                            <a href="{{ route('office-myFavAds') }}">
                                <i class="fa-solid fa-heart"></i>
                                @lang('front.FavAd') </a>
                        </li>
                        <li>
                            <a href="{{ route('office-viewEnquiry') }}">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                @lang('front.InqueryRequest') </a>
                        </li>
                        <li>
                            <a href="{{ route('office-customerRequestsOffers') }}">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                @lang('front.CustomerProposalRequests') </a>
                        </li>
                        <li>
                            <a href="{{ route('internalMail') }}">
                                <i class="fa-solid fa-comment"></i>
                                @lang('front.InternalEmail') ( @if (isset($mails_not_read_count) && $mails_not_read_count > 0)
                                    {{ $mails_not_read_count }}
                                @else
                                    0
                                @endif )
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('office-myPremiumMembership') }}">
                                <i class="fas fa-award"></i>
                                @lang('front.PremiumMembership') </a>
                        </li>
                    @endif
                    {{-- <li>
                        <a href="#">
                            <i class="fa-solid fa-heart"></i>
                            اعلاناتي المميزة
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('userLogout') }}">
                            <i class="fa-solid fa-power-off"></i>
                            @lang('front.LogOut') </a>
                    </li>
                </ul>
            @elseif(isset(Auth::guard('user')->user()->user_type) && Auth::guard('user')->user()->user_type == 'Real Estate Owner')
                <ul>
                    <li>
                        <a href="{{ route('owner-userDashboard') }}">
                            <i class="fa fa-user"></i>
                            @lang('front.PersonalInformation')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('owner-changeRealEstateOfficeLoginInfo') }}">
                            <i class="fa fa-lock"></i>
                            @lang('front.ChangeLoginInformation') </a>
                    </li>
                    @if (Auth::guard('user')->user()->is_verified == 'Verified')


                        <li>
                            <a href="{{ route('paymentTransactions') }}">
                                <i class="fas fa-sack-dollar"></i>
                                @lang('front.Payments') </a>
                        </li>
                        <li>
                            <a href="{{ route('owner-addAdvertisements') }}">
                                <i class="fa fa-plus"></i>
                                @lang('front.AddNewAd') </a>
                        </li>
                        <li>
                            <a href="{{ route('owner-myAdvertisements') }}">
                                <i class="fa fa-plus"></i>
                                @lang('front.MyAds') </a>
                        </li>
                        <li>
                            <a href="{{ route('owner-myFavAds') }}">
                                <i class="fa-solid fa-heart"></i>
                                @lang('front.FavAd') </a>
                        </li>
                        <li>
                            <a href="{{ route('owner-viewEnquiry') }}">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                @lang('front.InqueryRequest') </a>
                        </li>

                        <li>
                            <a href="{{ route('internalMail') }}">
                                <i class="fa-solid fa-comment"></i>
                                @lang('front.InternalEmail') ( @if (isset($mails_not_read_count) && $mails_not_read_count > 0)
                                    {{ $mails_not_read_count }}
                                @else
                                    0
                                @endif )
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('owner-myPremiumMembership') }}">
                                <i class="fas fa-award"></i>
                                @lang('front.PremiumMembership') </a>
                        </li>
                        {{-- <li>
                        <a href="#">
                            <i class="fa-solid fa-heart"></i>
                            اعلاناتي المميزة
                        </a>
                    </li> --}}
                    @endif
                    <li>
                        <a href="{{ route('userLogout') }}">
                            <i class="fa-solid fa-power-off"></i>
                            @lang('front.LogOut') </a>
                    </li>
                </ul>
            @elseif(isset(Auth::guard('user')->user()->user_type) && Auth::guard('user')->user()->user_type == 'Real Estate Seeker')
                <ul>
                    <li>
                        <a href="{{ route('seeker-userDashboard') }}">
                            <i class="fa fa-user"></i>
                            @lang('front.PersonalInformation')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('seeker-changeRealEstateOfficeLoginInfo') }}">
                            <i class="fa fa-lock"></i>
                            @lang('front.ChangeLoginInformation') </a>
                    </li>
                    @if (Auth::guard('user')->user()->is_verified == 'Verified')
                        <li>
                            <a href="{{ route('paymentTransactions') }}">
                                <i class="fas fa-sack-dollar"></i>
                                @lang('front.Payments') </a>
                        </li>

                        <li>
                            <a href="{{ route('seeker-addSearch') }}">
                                <i class="fa fa-plus"></i>
                                @lang('front.AddNewSearch')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('seeker-MyResearch') }}">
                                <i class="fa fa-plus"></i>
                                @lang('front.AddedSearches')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('seeker-myFavAds') }}">
                                <i class="fa-solid fa-heart"></i>
                                @lang('front.FavAd') </a>
                        </li>
                        <li>
                            <a href="{{ route('internalMail') }}">
                                <i class="fa-solid fa-comment"></i>
                                @lang('front.InternalEmail') ( @if (isset($mails_not_read_count) && $mails_not_read_count > 0)
                                    {{ $mails_not_read_count }}
                                @else
                                    0
                                @endif )
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('seeker-myPremiumMembership') }}">
                                <i class="fas fa-award"></i>
                                @lang('front.PremiumMembership') </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('userLogout') }}">
                            <i class="fa-solid fa-power-off"></i>
                            @lang('front.LogOut') </a>
                    </li>
                </ul>
            @endif
        </section>
