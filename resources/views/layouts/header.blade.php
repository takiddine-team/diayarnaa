<header class="phoneHeader">
    <div class="container">

        <div class="row">
            <div class="col-12 px-md-0">

                <nav class="navbar navbar-expand-lg px-0 py-3">
                    <a class="navbar-brand" href="{{ route('welcome') }}">
                        <img src="{{ asset('style_files/frontend/img/logo.png') }}" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="fa-solid fa-bars"></i>
                        </span>

                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('welcome') }}">@lang('front.Homepage') <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('aboutUs') }}"> @lang('front.AboutUs')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('WebsiteBroker') }}">@lang('front.BrokerSite')</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href={{ route('PremiumMembership') }}>@lang('front.PremiumMembership')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('aboutCompany') }}">@lang('front.AboutCompany')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contactUs') }}">@lang('front.ContactUs')</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#"> <i class="fa fa-search" aria-hidden="true"></i> </a>
                            </li> --}}

                            @if (Auth::guard('user')->check())
                            <li class="nav-item userAccount ">
                                <a class="nav-link" href="javascript:0"> <i class="fa fa-user"
                                        aria-hidden="true"></i>
                                    <span>@lang('front.Account')</span> <i class="fa-sharp fa-solid fa-caret-down"></i></a>

                                <ul>
                                    @if (Auth::guard('user')->check())
                                        <li class="nav-item login ">
                                            <a class="nav-link" href="{{ route('userLogout') }}">
                                                <i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i>
                                                <span>@lang('front.LogOut')</span></a>
                                        </li>
                                        @if (Auth::guard('user')->user()->user_type == 'Real Estate Office')
                                            <li class="nav-item login ">
                                                <a class="nav-link" href="{{ route('office-userDashboard') }}">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <span>
                                                        {{ Auth::guard('user')->user()->name }}
                                                    </span>
                                                </a>
                                            </li>
                                        @elseif(Auth::guard('user')->user()->user_type == 'Real Estate Owner')
                                            <li class="nav-item login ">
                                                <a class="nav-link" href="{{ route('owner-userDashboard') }}">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <span>
                                                        {{ Auth::guard('user')->user()->name }}
                                                    </span>
                                                </a>
                                            </li>
                                        @elseif(Auth::guard('user')->user()->user_type == 'Real Estate Seeker')
                                            <li class="nav-item login ">
                                                <a class="nav-link" href="{{ route('seeker-userDashboard') }}">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <span>
                                                        {{ Auth::guard('user')->user()->name }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endif
                                    @elseif(Auth::guard('super_admin')->check())
                                        <li class="nav-item login ">
                                            <a class="nav-link" href="{{ route('super_admin.dashboard') }}"> <i
                                                    class="fa fa-user" aria-hidden="true"></i>
                                                <span>@lang('front.Dashboard')</span></a>
                                        </li>

                                    @endif
                                </ul>
                            </li>
                            @endif


                            @if(Auth::guard('super_admin')->check())
                                <li class="nav-item login ">
                                    <a class="nav-link" href="{{ route('super_admin.dashboard') }}"> <i
                                            class="fa fa-user" aria-hidden="true"></i>
                                        <span>@lang('front.Dashboard')</span></a>
                                </li>
                            @endif

                            @if (!Auth::guard('user')->check() && !Auth::guard('super_admin')->check())
                                <li class="nav-item login  ">
                                    <a class="nav-link" href="{{ route('userLogin') }}"> <i class="fa fa-user"
                                            aria-hidden="true"></i>
                                        <span>@lang('front.Registration')</span></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="btn-group c_lang">
                        <button type="button" class="btn dropdown-toggle lang" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            @if (Config::get('app.locale') == 'en')
                                English
                            @else
                                العربية
                            @endif
                        </button>
                        <div class="dropdown-menu">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</header>
