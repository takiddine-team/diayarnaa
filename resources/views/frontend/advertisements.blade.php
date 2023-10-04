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
                                <a href="{{ route('bookAdvertisement') }}">@lang('front.ReserveAnAd')</a>
                            </div>
                            <div class="bottomText">
                                <p>@lang('front.WelcomeElse')</p>
                                <span class="locationText">@lang('front.WelcomeCountry')</span>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                >> <span>@lang('front.Estate')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== العقارات section =============== --}}
            {{-- =========================================================== --}}

            <!-- filter -->
            <section class="realState mt-5 pt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('advertisements') }}" class="realStateFilter  signUp" id="createForm"
                                style="text-align: initial">
                                @csrf
                                <div class="row align-items-center">
                                    {{-- الدولة --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="diyarnaa_country_id">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        الدولة </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Country
                                                    </span>
                                                @endif
                                            </label>
                                            <select class="form-control" name="diyarnaa_country_id" id="diyarnaa_country_id"
                                                onchange="getDiyarnaaCities()">
                                                @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                    <option value="" selected>
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                الدولة </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                Country
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
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="diyarnaa_city_id">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        المحافظة </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        City
                                                    </span>
                                                @endif
                                            </label>
                                            <input type="hidden"
                                                @if (Request('diyarnaa_city_id')) value="{{ Request('diyarnaa_city_id') }}" @endif
                                                id="diyarnaa_city_id_old_value">
                                            <select class="form-control" name="diyarnaa_city_id" id="diyarnaa_city_id"
                                                onchange="getDiyarnaaRegions()">
                                                <option>
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            المحافظة </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            City
                                                        </span>
                                                    @endif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- المنطقة --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="diyarnaa_region_id">

                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        المنطقة </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Region
                                                    </span>
                                                @endif
                                            </label>
                                            <input type="hidden"
                                                @if (Request('diyarnaa_region_id')) value="{{ Request('diyarnaa_region_id') }}" @endif
                                                id="diyarnaa_region_id_old_value">
                                            <select name="diyarnaa_region_id" id="diyarnaa_region_id" class="form-control">
                                                <option disabled>
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            المنطقة </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Region
                                                        </span>
                                                    @endif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- التصنيف الرئيسي --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_id">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        التصنيف الرئيسي </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Main Category
                                                    </span>
                                                @endif
                                            </label>
                                            <select name="category_id" id="category_id" onchange="getSubCategories()"
                                                class="form-control" data-live-search="true" data-width="88%"
                                                data-actions-box="true" style="width: 100%">
                                                <option value="" selected>
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            التصنيف الرئيسي </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Main Category
                                                        </span>
                                                    @endif
                                                </option>
                                                @if (isset($categories) && $categories->count() > 0)
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if (Request('category_id') == $category->id) selected @endif>
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span class="realState_Location">
                                                                    {{ isset($category->name_ar) ? $category->name_ar : '------' }}</span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span class="realState_Location">
                                                                    {{ isset($category->name_en) ? $category->name_en : '------' }}
                                                                </span>
                                                            @endif

                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{-- التصنيف الفرعي --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="sub_category_id">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        التصنيف الفرعي </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        SubCategory
                                                    </span>
                                                @endif
                                            </label>
                                            <input type="hidden"
                                                @if (Request('sub_category_id')) value="{{ Request('sub_category_id') }}" @endif
                                                id="sub_category_id_old_value">
                                            <select name="sub_category_id" id="sub_category_id" class="form-control"
                                                data-live-search="true" data-width="88%" data-actions-box="true"
                                                style="width: 100%">
                                                <option value="">
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            التصنيف الفرعي </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Subcategory
                                                        </span>
                                                    @endif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- الغرض --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="realStateType">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        الغرض </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Target
                                                    </span>
                                                @endif
                                            </label>
                                            <select name="target_id" class="form-control">
                                                <option value="" selected>
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            اختر الغرض </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Choose Target
                                                        </span>
                                                    @endif
                                                </option>
                                                @if (isset($targets) && $targets->count() > 0)
                                                    @foreach ($targets as $target)
                                                        <option value="{{ $target->id }}"
                                                            @if (Request('target_id') == $target->id) selected @endif>
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span class="realState_Location">
                                                                    {{ isset($target->name_ar) ? $target->name_ar : '------' }}
                                                                </span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span class="realState_Location">
                                                                    {{ isset($target->name_en) ? $target->name_en : '------' }}
                                                                </span>
                                                            @endif

                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{-- code --}}
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">

                                            <label for="code">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        كود الإعلان </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                       Ad Code
                                                    </span>
                                                @endif

                                            </label>
                                            <input type="text" class="form-control" id="code"
                                                placeholder="ADV-xxxx" name="code"
                                                @if (Request('code')) value="{{ Request('code') }}" @endif>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="submit" class="submit" value="@lang('front.Search')">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row my-5">
                        <!-- real state 1 -->
                        @if (isset($advertisments) && $advertisments->count() > 0)
                            @foreach ($advertisments as $advertisment)
                                <div class="col-md-4 col-sm-6 col-xs-12 ">
                                    <div class="realStateItem">

                                        <div class="top">
                                            @if (isset($advertisment->main_image) && $advertisment->main_image && file_exists($advertisment->main_image))
                                                <img src="{{ asset($advertisment->main_image) }}" class="img-fluid"
                                                    alt="img" style="width: 100% ; height: 200px; ">
                                            @else
                                                <img src="{{ asset('style_files/frontend/img/s1.jpg') }}"
                                                    class="img-fluid" alt="img">
                                            @endif
                                            <div class="text">
                                                <a
                                                    href="{{ route('advertisementDetails', isset($advertisment->id) ? $advertisment->id : -1) }}">
                                                    <i class="fa-solid fa-circle-plus"></i>
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            تفاصيل العقار </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Real Estate Details
                                                        </span>
                                                    @endif
                                                </a>
                                                <div class="topBottom">

                                                    @if (Auth::guard('user')->check() && Auth::guard('user')->user()->id != $advertisment->user_id)
                                                        @if (isset(Auth::guard('user')->user()->favouriteAdvertisements) &&
                                                                Auth::guard('user')->user()->favouriteAdvertisements->contains('advertisement_id', $advertisment->id))
                                                            <a
                                                                href="{{ route('addRemoveFavAds', isset($advertisment->id) ? $advertisment->id : -1) }}">
                                                            </a><i class="fa-solid fa-heart"></i>
                                                        @else
                                                            <a
                                                                href="{{ route('addRemoveFavAds', isset($advertisment->id) ? $advertisment->id : -1) }}">
                                                            </a><i class="fa-regular fa-heart"></i>
                                                        @endif
                                                    @endif

                                                    <span>
                                                        {{ isset($advertisment->price) ? number_format(round($advertisment->price)) : null }}

                                                        $
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bottom">
                                            <p>
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        {!! isset($advertisment->title_ar) ? $advertisment->title_ar : '------' !!}
                                                    </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        {!! isset($advertisment->title_en) ? $advertisment->title_en : '------' !!}
                                                    </span>
                                                @endif
                                            </p>
                                            <div class="footer">
                                                <span>
                                                    <img src="{{ asset('style_files/frontend/img/building.png') }}"
                                                        class="img-fluid" alt="img">
                                                    {{ isset($advertisment) ? $advertisment->user->name : '------' }}
                                                </span>
                                                <span>
                                                    <img src="{{ asset('style_files/frontend/img/land.png') }}"
                                                        class="img-fluid" alt="img">
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            {{ isset($advertisment->area) ? $advertisment->area : '------' }}
                                                            {{ isset($advertisment->feature) ? $advertisment->feature->name_ar : '------' }}
                                                        </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            {{ isset($advertisment->area) ? $advertisment->area : '------' }}
                                                            {{ isset($advertisment->feature) ? $advertisment->feature->name_en : '------' }}
                                                        </span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            getDiyarnaaCities();

            setTimeout(() => {
                getDiyarnaaRegions();

            }, 1000);
            getSubCategories();


        });

        function getDiyarnaaCities() {
            var formData = new FormData($('#createForm')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('getDiyarnaaCities') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.status == true) {
                        //  var selectCity = '<option value="">اختر المحافظة... </option>';
                        var selectCity = '<option value="">@lang('front.StateSelect') ... </option>';
                        for (var key in data.diyarnaa_cities) {
                            // skip loop if the property is from prototype
                            if (!data.diyarnaa_cities.hasOwnProperty(key)) continue;

                            var obj = data.diyarnaa_cities[key];
                            for (var prop in obj) {
                                // skip loop if the property is from prototype
                                if (!obj.hasOwnProperty(prop)) continue;
                                // your code
                                var diyarnaa_city_id_old_value = $("#diyarnaa_city_id_old_value").val();
                                if (diyarnaa_city_id_old_value) {
                                    if (obj.id == diyarnaa_city_id_old_value) {
                                        selectCity += '<option value="' + obj.id + '" selected>' + obj
                                            .name + '</option>';
                                    } else {
                                        selectCity += '<option value="' + obj.id + '">' + obj.name +
                                            '</option>';
                                    }
                                } else {
                                    selectCity += '<option value="' + obj.id + '">' + obj.name +
                                        '</option>';
                                }
                                break;
                            }
                        }
                        $('#diyarnaa_city_id').html(selectCity);
                    } else {
                        //  $('#diyarnaa_city_id').html('<option value="">لا يوجد محافظات... </option>');
                        $('#diyarnaa_city_id').html('<option value="">@lang('front.NoState')... </option>');
                    }

                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });


        }
    </script>
    <script>
        function getDiyarnaaRegions() {
            var formData = new FormData($('#createForm')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('getDiyarnaaRegions') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.status == true) {
                        //   var selectRegion = '<option value="">اختر منطقة ... </option>';
                        var selectRegion = '<option value=""> @lang('front.SelectRegion') ... </option>';
                        for (var key in data.diyarnaa_regions) {
                            // skip loop if the property is from prototype
                            if (!data.diyarnaa_regions.hasOwnProperty(key)) continue;

                            var obj = data.diyarnaa_regions[key];
                            for (var prop in obj) {
                                // skip loop if the property is from prototype
                                if (!obj.hasOwnProperty(prop)) continue;
                                // your code
                                var diyarnaa_region_id_old_value = $("#diyarnaa_region_id_old_value").val();
                                if (diyarnaa_region_id_old_value) {
                                    if (obj.id == diyarnaa_region_id_old_value) {
                                        selectRegion += '<option value="' + obj.id + '" selected>' + obj
                                            .name + '</option>';
                                    } else {
                                        selectRegion += '<option value="' + obj.id + '">' + obj.name +
                                            '</option>';
                                    }
                                } else {
                                    selectRegion += '<option value="' + obj.id + '">' + obj.name +
                                        '</option>';
                                }
                                break;
                            }
                        }
                        $('#diyarnaa_region_id').html(selectRegion);
                    } else {
                        // var selectRegion = '<option value="">اختر منطقة ... </option>';
                        var selectRegion = '<option value=""> @lang('front.SelectRegion') ... </option>';
                        $('#diyarnaa_region_id').html(selectRegion);
                    }

                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });


        }
    </script>
    <script>
        function getSubCategories() {
            var formData = new FormData($('#createForm')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('getSubCategories') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.status == true) {
                        //  var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
                        var selectCity = '<option value="">  @lang('front.SelectSubCategory')... </option>';
                        for (var key in data.sub_category) {
                            // skip loop if the property is from prototype
                            if (!data.sub_category.hasOwnProperty(key)) continue;

                            var obj = data.sub_category[key];
                            for (var prop in obj) {
                                // skip loop if the property is from prototype
                                if (!obj.hasOwnProperty(prop)) continue;
                                // your code
                                var sub_category_id_old_value = $("#sub_category_id_old_value").val();
                                if (sub_category_id_old_value) {
                                    if (obj.id == sub_category_id_old_value) {
                                        selectCity += '<option value="' + obj.id + '" selected>' + obj
                                            .name + '</option>';
                                    } else {
                                        selectCity += '<option value="' + obj.id + '">' + obj.name +
                                            '</option>';
                                    }
                                } else {
                                    selectCity += '<option value="' + obj.id + '">' + obj.name +
                                        '</option>';
                                }
                                break;
                            }
                        }
                        $('#sub_category_id').html(selectCity);
                    } else {
                        //   var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
                        var selectCity = '<option value="">  @lang('front.SelectSubCategory')... </option>';
                        $('#sub_category_id').html(selectCity);
                    }

                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });


        }
    </script>
@endsection
