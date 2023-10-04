@extends('layouts.app')
@section('content')
    {{-- =========================================================== --}}
    {{-- ================== Sweet Alert Section ==================== --}}
    {{-- =========================================================== --}}
    <div>
        @if (session()->has('success'))
            <script>
                swal("@lang('front.Thank')", "{!! Session::get('success') !!}", "success", {
                    button: "OK",
                });
            </script>
        @endif
        @if (session()->has('danger'))
            <script>
                swal("@lang('front.Sorry')", "{!! Session::get('danger') !!}", "error", {
                    button: "Close",
                });
            </script>
        @endif
    </div>

    <div class="innerPage">
        {{-- =========================================================== --}}
        {{-- =================== Breadcrumb Section ==================== --}}
        {{-- =========================================================== --}}
        <section class="innerImage aboutUs">
            @if (isset($background_image->user_dashboard) &&
                    $background_image->getRawOriginal('user_dashboard') &&
                    file_exists($background_image->getRawOriginal('user_dashboard')))
                <img src="{{ asset($background_image->user_dashboard) }}" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif
            <div class="pageTitle">
                <h2>@lang('front.PersonalInformation')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.PersonalInformation')</span>
            </div>

            {{-- test --}}
            {{-- =========================================================== --}}
            {{-- =================== User menu section =============== --}}
            {{-- =========================================================== --}}

            @include('layouts.sideBar')



            {{-- =========================================================== --}}
            {{-- =================== dashboard content section =============== --}}
            {{-- =========================================================== --}}
            <section class="dashboardContent">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="bShadow">

                                <div class="image">
                                    @if (isset($user->profile_image) &&
                                            $user->getRawOriginal('profile_image') &&
                                            file_exists($user->getRawOriginal('profile_image')))
                                        <img src="{{ asset($user->profile_image) }}" class="img-fluid" alt="img">
                                    @else
                                        <img src="{{ asset('style_files/frontend/img/logo.png') }}" class="img-fluid"
                                            alt="img">
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 mb-3 lBorder">
                            <div class="bShadow leftInfo">
                                <div class="Text">
                                    <h2> {{ isset($user->name) ? $user->name : null }}</h2>
                                    <span class="inside">
                                        @if (isset($user->diyarnaCountry->flag) &&
                                                $user->diyarnaCountry->getRawOriginal('flag') &&
                                                file_exists($user->diyarnaCountry->getRawOriginal('flag')))
                                            <img src="{{ asset($user->diyarnaCountry->flag) }}" class="img-fluid">
                                        @else
                                            <img src="{{ asset('style_files/frontend/img/jo.png') }}" class="img-fluid"
                                                alt="img">
                                        @endif

                                        @if (Config::get('app.locale') == 'ar')
                                            <span>{{ isset($user->diyarnaCountry->name_ar) ? $user->diyarnaCountry->name_ar : null }}</span>
                                        @elseif (Config::get('app.locale') == 'en')
                                            <span>{{ isset($user->diyarnaCountry->name_en) ? $user->diyarnaCountry->name_en : null }}</span>
                                        @endif
                                    </span>
                                    <span class="inside">
                                        <img src="{{ asset('style_files/frontend/img/calendar.png') }}" class="img-fluid"
                                            alt="img">
                                        <span>
                                            @lang('front.RegDate'):
                                            {{ isset($user->created_at) ? $user->created_at->format('Y/m/d') : null }}
                                        </span>
                                    </span>
                                </div>
                                <a href="{{ route('seeker-editUserDashboard', isset($user->id) ? $user->id : -1) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    @lang('front.EditAccount') </a>
                            </div>
                        </div>
                        @if (Auth::guard('user')->user()->is_verified != 'Verified')
                            <div class="col-md-12" style="text-align: center">
                                <h1 style="color: red">{{ @trans('front.VerifyEmail') }}</h1>
                            </div>
                        @endif
                        <div class="col-12 tBorder mt-5">
                            <div class="bShadow">
                                <ul>
                                    <li>
                                        <div class="image">
                                            <img src="{{ asset('style_files/frontend/img/smartphone.png') }}"
                                                class="img-fluid" alt="img">
                                        </div>
                                        <span class="text">
                                            @lang('front.Email') :
                                            <span>{{ isset($user->email) ? $user->email : null }}

                                            </span>
                                            @if (Auth::guard('user')->user()->is_verified == 'Verified')
                                                <span style="color: green">({{ @trans('front.Verified') }})</span>
                                            @else
                                                <span style="color: red">({{ @trans('front.NotVerified') }})</span>
                                            @endif
                                        </span>

                                    </li>
                                    <li>
                                        <div class="image">
                                            <img src="{{ asset('style_files/frontend/img/numeric.png') }}"
                                                class="img-fluid" alt="img">
                                        </div>
                                        <span class="text">
                                            @lang('front.SeekerCode') :
                                            <span>{{ isset($user->code) ? $user->code : null }}</span>
                                        </span>
                                    </li>

                                    <li>
                                        <div class="image">
                                            <img src="{{ asset('style_files/frontend/img/rashtrapati.png') }}"
                                                class="img-fluid" alt="img">
                                        </div>
                                        <span class="text">
                                            @lang('front.CountryName') :


                                            @if (Config::get('app.locale') == 'ar')
                                                <span>{{ isset($user->diyarnaCountry->name_ar) ? $user->diyarnaCountry->name_ar : null }}</span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span>{{ isset($user->diyarnaCountry->name_en) ? $user->diyarnaCountry->name_en : null }}</span>
                                            @endif


                                        </span>

                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="image">
                                            <img src="{{ asset('style_files/frontend/img/rashtrapati.png') }}"
                                                class="img-fluid" alt="img">
                                        </div>
                                        <span class="text">
                                            @lang('front.City') :

                                            @if (Config::get('app.locale') == 'ar')
                                                <span>{{ isset($user->diyarnaCity->name_ar) ? $user->diyarnaCity->name_ar : null }}</span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span>{{ isset($user->diyarnaCity->name_en) ? $user->diyarnaCity->name_en : null }}</span>
                                            @endif
                                        </span>

                                    </li>
                                    <li>

                                        <div class="image">
                                            <img src="{{ asset('style_files/frontend/img/rashtrapati.png') }}"
                                                class="img-fluid" alt="img">
                                        </div>
                                        <span class="text">
                                            @lang('front.Region') :

                                            @if (Config::get('app.locale') == 'ar')
                                                <span>{{ isset($user->diyarnaRegion->name_ar) ? $user->diyarnaRegion->name_ar : null }}</span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span>{{ isset($user->diyarnaRegion->name_en) ? $user->diyarnaRegion->name_en : null }}</span>
                                            @endif
                                        </span>
                                    </li>

                                    <li>
                                        <div class="image">
                                            <img src="{{ asset('style_files/frontend/img/smartphone.png') }}"
                                                class="img-fluid" alt="img">
                                        </div>
                                        <span class="text">
                                            @lang('front.Mobile') :
                                            <span>{{ isset($user->phone) ? $user->phone : null }}</span>
                                        </span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
