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
            <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            <div class="pageTitle">
                <h2> حساب المكتب العقاري </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">الرئيسية</a>
                <span class="enflip"> >> </span> <span> حساب المكتب العقاري</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== User menu section =============== --}}
            {{-- =========================================================== --}}

            @include('layouts.sideBar')

            {{-- =========================================================== --}}
            {{-- =================== dashboard content section =============== --}}
            {{-- =========================================================== --}}
            <section class="dashboardContent">
                <div class="container">
                    <div class="col-12">
                        <div class="allLeft">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('advertisements') }}" class="realStateFilter  signUp"
                                        id="createForm" style="text-align: initial">
                                        @csrf
                                        <div class="row align-items-center">
                                            {{-- الدولة --}}
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="diyarnaa_country_id">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                الدولة </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                الدولة
                                                            </span>
                                                        @endif
                                                    </label>
                                                    <select class="form-control" name="diyarnaa_country_id"
                                                        id="diyarnaa_country_id" onchange="getDiyarnaaCities()">
                                                        @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                            <option value="" selected>
                                                                @if (Config::get('app.locale') == 'ar')
                                                                    <span class="realState_Location">
                                                                        الدولة </span>
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    <span class="realState_Location">
                                                                        الدولة
                                                                    </span>
                                                                @endif
                                                            </option>
                                                            @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                                <option value="{{ $diyarnaa_country->id }}"
                                                                    @if (Request('diyarnaa_country_id') == $diyarnaa_country->id) selected @endif>

                                                                    @if (Config::get('app.locale') == 'ar')
                                                                        <span class="realState_Location">
                                                                            {{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : '------' }}
                                                                        </span>
                                                                    @elseif (Config::get('app.locale') == 'en')
                                                                        <span class="realState_Location">
                                                                            {{ isset($diyarnaa_country->name_en) ? $diyarnaa_country->name_en : '------' }}

                                                                        </span>
                                                                    @endif

                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- المحافظة --}}
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="diyarnaa_city_id">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                المحافظة </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                المحافظة
                                                            </span>
                                                        @endif
                                                    </label>
                                                    <input type="hidden"
                                                        @if (Request('diyarnaa_city_id')) value="{{ Request('diyarnaa_city_id') }}" @endif
                                                        id="diyarnaa_city_id_old_value">
                                                    <select class="form-control" name="diyarnaa_city_id"
                                                        id="diyarnaa_city_id" onchange="getDiyarnaaRegions()">
                                                        <option>
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span class="realState_Location">
                                                                    المحافظة </span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span class="realState_Location">
                                                                    المحافظة
                                                                </span>
                                                            @endif
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- المنطقة --}}
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="diyarnaa_region_id">

                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                المنطقة </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                المنطقة
                                                            </span>
                                                        @endif
                                                    </label>
                                                    <input type="hidden"
                                                        @if (Request('diyarnaa_region_id')) value="{{ Request('diyarnaa_region_id') }}" @endif
                                                        id="diyarnaa_region_id_old_value">
                                                    <select name="diyarnaa_region_id" id="diyarnaa_region_id"
                                                        class="form-control">
                                                        <option>
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span class="realState_Location">
                                                                    المنطقة </span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span class="realState_Location">
                                                                    المنطقة
                                                                </span>
                                                            @endif
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- code --}}
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">

                                                    <label for="code">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                كود الإعلان </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                كود الإعلان
                                                            </span>
                                                        @endif

                                                    </label>
                                                    <input type="text" class="form-control" id="code"
                                                        placeholder="ADV-xxxx" name="code"
                                                        @if (Request('code')) value="{{ Request('code') }}" @endif>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="submit" class="submit" value="ابحث">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row my-5">
                                <!-- real state 1 -->
                                <div class="col-md-6 ">
                                    <div class="realStateItem">

                                        <div class="top">
                                            <img src="{{ asset('style_files/frontend/img/s1.jpg') }}" class="img-fluid"
                                                alt="img">

                                            <div class="text">
                                                <a href="#">
                                                    <i class="fa-solid fa-circle-plus"></i>
                                                    <span class="realState_Location">
                                                        تفاصيل العقار </span>
                                                </a>
                                                <div class="topBottom">
                                                    <i class="fa-regular fa-heart"></i>
                                                    <span class="pice">$50.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bottom">
                                            <p>
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda, soluta.
                                            </p>
                                            <div class="footer">
                                                <span>
                                                    <img src="{{ asset('style_files/frontend/img/building.png') }}"
                                                        class="img-fluid" alt="img">
                                                    تست
                                                </span>
                                                <span>
                                                    <img src="{{ asset('style_files/frontend/img/land.png') }}"
                                                        class="img-fluid" alt="img">
                                                    <span class="realState_Location">متر مربع </span>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
