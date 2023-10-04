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
        @if (session()->has('welcome'))
            <script>
                swal("@lang('front.Welcome')", "{!! Session::get('welcome') !!}", "success", {
                    button: "Close",
                });
            </script>
        @endif
    </div>
    <div class="page__content">
        {{-- =========================================================== --}}
        {{-- ================== Slider Section ==================== --}}
        {{-- =========================================================== --}}
        <section class="slider">
            <!-- social links -->
            <ul class="socialLinks">
                <li>
                <li>
                    <a href="{{ isset($contact_us->facebook) ? $contact_us->facebook : null }}" target="_blank">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                </li>
                <a href="{{ isset($contact_us->twitter) ? $contact_us->twitter : null }}" target="_blank">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                </li>
                <li>
                    <a href="{{ isset($contact_us->instagram) ? $contact_us->instagram : null }}" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ isset($contact_us->linkedin) ? $contact_us->linkedin : null }}" target="_blank">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ isset($contact_us->youtube) ? $contact_us->youtube : null }}" target="_blank">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>


            </ul>

            {{-- sliders --}}
            <ul class="mainSlider" id="mainSlider">
                @if (isset($home_sliders) && $home_sliders->count() > 0)
                    @foreach ($home_sliders as $home_slider)
                        <li>
                            @if (isset($home_slider->image) && $home_slider->image && file_exists($home_slider->image))
                                <img src="{{ asset($home_slider->image) }}" class="img-fluid" alt="img">
                            @else
                                <img src="{{ asset('style_files/frontend/img/s1.jpg') }}" class="img-fluid" alt="slider1">
                            @endif
                            <div class="slider__caption">
                                <div class="text">

                                    @if (Config::get('app.locale') == 'ar')
                                        <h2> {{ isset($home_slider->company_name_ar) ? $home_slider->company_name_ar : null }}
                                        </h2>
                                    @elseif (Config::get('app.locale') == 'en')
                                        <h2> {{ isset($home_slider->company_name_en) ? $home_slider->company_name_en : null }}
                                        </h2>
                                    @endif

                                    @if (Config::get('app.locale') == 'ar')
                                        <p> {{ isset($home_slider->title_ar) ? $home_slider->title_ar : @trans('front.WelcomeElse') }}
                                        </p>
                                    @elseif (Config::get('app.locale') == 'en')
                                        <p> {{ isset($home_slider->title_en) ? $home_slider->title_en : @trans('front.WelcomeElse') }}
                                        </p>
                                    @endif
                                    <a href="{{ route('bookAdvertisement') }}">@lang('front.ReserveAnAd')</a>

                                </div>
                                <div class="bottomText">


                                    @if (Config::get('app.locale') == 'ar')
                                        <p> {!! isset($home_slider->description_ar) ? $home_slider->description_ar : @trans('front.WelcomeElse') !!}
                                        </p>
                                    @elseif (Config::get('app.locale') == 'en')
                                        <p> {!! isset($home_slider->description_en) ? $home_slider->description_en : @trans('front.WelcomeElse') !!}
                                        </p>
                                    @endif

                                    @if (Config::get('app.locale') == 'ar')
                                        <span class="locationText">

                                            {{ isset($home_slider->diyarnaaCountry->name_ar) ? $home_slider->diyarnaaCountry->name_ar : @trans('front.WelcomeCountry') }},

                                            {{ isset($home_slider->diyarnaaCity->name_ar) ? $home_slider->diyarnaaCity->name_ar : @trans('front.WelcomeCountry') }}
                                        </span>
                                    @elseif (Config::get('app.locale') == 'en')
                                        <span class="locationText">
                                            {{ isset($home_slider->diyarnaaCountry->name_en) ? $home_slider->diyarnaaCountry->name_en : @trans('front.WelcomeCountry') }},

                                            {{ isset($home_slider->diyarnaaCity->name_en) ? $home_slider->diyarnaaCity->name_en : @trans('front.WelcomeCountry') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li>
                        <img src="{{ asset('style_files/frontend/img/s1.jpg') }}" class="img-fluid" alt="slider1">
                        <div class="slider__caption">
                            <div class="text">
                                <h2>@lang('front.WelcomeToDiyarna')</h2>
                                <p>@lang('front.WelcomeElse')</p>
                                <a href="{{ route('bookAdvertisement') }}"> @lang('front.ReserveAnAd')</a>
                            </div>
                            <div class="bottomText">
                                <p>@lang('front.WelcomeElse')</p> <span class="locationText"> @lang('front.WelcomeCountry')</span>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </section>
        {{-- =========================================================== --}}
        {{-- ================== Country Section ==================== --}}
        {{-- =========================================================== --}}
        <section class="country py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="countryGrid">
                            @if (isset($countries) && $countries->count() > 0)
                                @foreach ($countries as $country)
                                    <li>

                                        @if (isset($country->image) && $country->image && file_exists($country->image))
                                            <img src="{{ asset($country->image) }}" class="img-fluid" alt="img"
                                                style="width: 300px; height: 200px;">
                                        @else
                                            <img src="{{ asset('style_files/frontend/img/cc1.jpg') }}" class="img-fluid"
                                                style="width: 300px; height: 200px;" alt="c1">
                                        @endif


                                        <a href="{{ route('advertisements', ['diyarnaa_country_id' => $country->id]) }}"
                                            class="cLink">
                                            @if (isset($country->flag) && $country->flag && file_exists($country->flag))
                                                <img src="{{ asset($country->flag) }}" class="img-fluid" alt="img"
                                                    style="    max-width: 30px;
                                                    border-radius: 15px;
                                                    height: 30px;">
                                            @else
                                                <img src="{{ asset('style_files/frontend/img/c1.png') }}" class="img-fluid"
                                                    alt="c1"
                                                    style="    max-width: 30px;
                                                    border-radius: 15px;
                                                    height: 30px;">
                                            @endif


                                            @if (Config::get('app.locale') == 'ar')
                                                {{ isset($country->name_ar) ? $country->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                {{ isset($country->name_en) ? $country->name_en : null }}
                                            @endif



                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <img src="{{ asset('style_files/frontend/img/cc1.jpg') }}" class="img-fluid"
                                        alt="c1">
                                    <a href="#" class="cLink">
                                        <img src="{{ asset('style_files/frontend/img/c1.png') }}" class="img-fluid"
                                            alt="c1">
                                        الاردن
                                    </a>
                                </li>
                            @endif


                        </ul>
                    </div>
                </div>
            </div>
        </section>
        {{-- =========================================================== --}}
        {{-- ================== العقارات Section ==================== --}}
        {{-- =========================================================== --}}
        <section class="realEstate py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 headerText">
                        <h2>@lang('front.NewlyListedProperties')</h2>
                        <a href="{{ route('advertisements') }}" class="allState">
                            @lang('front.AllProperties') <i class="fa-solid fa-arrow-left-long"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="realStateGrid">
                            <!-- 1 -->
                            @if (isset($advertisments) && $advertisments->count() > 0)
                                @foreach ($advertisments as $advertisment)
                                    <li>
                                        <div class="image">
                                            @if (isset($advertisment->main_image) && $advertisment->main_image && file_exists($advertisment->main_image))
                                                <img src="{{ asset($advertisment->main_image) }}" class="img-fluid"
                                                    alt="img">
                                            @else
                                                <img src="{{ asset('style_files/frontend/img/cc1.jpg') }}"
                                                    class="img-fluid" alt="c1">
                                            @endif


                                        </div>

                                        <a href="{{ route('advertisementDetails', isset($advertisment->id) ? $advertisment->id : -1) }}"
                                            class="text">

                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="label sale">
                                                    {{ isset($advertisment->target->name_ar) ? $advertisment->target->name_ar : null }}</span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="label sale">
                                                    {{ isset($advertisment->target->name_en) ? $advertisment->target->name_en : null }}</span>
                                            @endif

                                            @if (Config::get('app.locale') == 'ar')
                                                <p>
                                                    {{ isset($advertisment->title_ar) ? $advertisment->title_ar : @trans('front.WelcomeCountry') }}

                                                </p>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <p>
                                                    {{ isset($advertisment->title_en) ? $advertisment->title_en : @trans('front.WelcomeCountry') }}

                                                </p>
                                            @endif


                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    {{ isset($advertisment->diyarnaaCountry->name_ar) ? $advertisment->diyarnaaCountry->name_ar : null }},{{ isset($advertisment->diyarnaaCity->name_ar) ? $advertisment->diyarnaaCity->name_ar : null }}
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    {{ isset($advertisment->diyarnaaCountry->name_en) ? $advertisment->diyarnaaCountry->name_en : null }},{{ isset($advertisment->diyarnaaCity->name_en) ? $advertisment->diyarnaaCity->name_en : null }}
                                                </span>
                                            @endif



                                            <span class="date">
                                             @lang('front.InsertionDate'):
                                                <span class="adding_date">
                                                    {{ isset($advertisment->created_at) ? date('d-m-Y', strtotime($advertisment->created_at)) : null }}
                                                </span>
                                            </span>
                                        </a>


                                    </li>
                                @endforeach
                            @else
                                <!-- 4 -->
                                <h4 style="text_align:center;">@lang('front.NoProperties')</h4>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        {{-- =========================================================== --}}
        {{-- ================== اراء العملاء Section ==================== --}}
        {{-- =========================================================== --}}
        <section class="testamonial py-5">
            <div class="bg">

                @if (isset($background_image->customer_opinion) &&
                        $background_image->getRawOriginal('customer_opinion') &&
                        file_exists($background_image->getRawOriginal('customer_opinion')))
                    <img src="{{ asset($background_image->customer_opinion) }}" class="img-fluid" alt="t1">
                @else
                    <img src="{{ asset('style_files/frontend/img/tbg.jpg') }}" class="img-fluid" alt="t1">
                @endif




            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-3">
                        <h2>@lang('front.CustomerReviews')</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="testemonialSlider">
                            @if (isset($opinions) && count($opinions) > 0)
                                @foreach ($opinions as $opinion)
                                    <div class="testamonialFeed">
                                        <div class="image">

                                            @if (isset($opinion->user->profile_image) &&
                                                    $opinion->user->getRawOriginal('profile_image') &&
                                                    file_exists($opinion->user->getRawOriginal('profile_image')))
                                                <img src="{{ asset($opinion->user->profile_image) }}" class="img-fluid">
                                            @else
                                                <img src="{{ asset('style_files/frontend/img/logo.png') }}"
                                                    class="img-fluid" alt="img">
                                            @endif

                                        </div>
                                        <i class="fa-solid fa-quote-left d-block mr-auto mb-3 text-muted"></i>
                                        <div class="text">
                                            <p>{{ $opinion->opinion }}
                                            </p>
                                            <div class="name">
                                                <span class="personName">
                                                    {{ isset($opinion->user->name) ? $opinion->user->name : '' }} </span>
                                                <span class="personName">
                                                    {{ isset($opinion->created_at) ? date('d-m-Y', strtotime($opinion->created_at)) : date('d-m-Y', strtotime(now())) }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
