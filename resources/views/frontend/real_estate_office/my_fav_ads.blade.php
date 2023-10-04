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
                <h2>@lang('front.MyFavoriteAd')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.HomePage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.MyFavoriteAd')</span>
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
                                    <form action="{{ route('office-myFavAds') }}" class="realStateFilter  signUp"
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
                                                                Country
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

                                            {{-- City --}}
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="diyarnaa_city_id">@lang('front.City')
                                                        <strong class="text-danger">
                                                            *
                                                            @error('diyarnaa_city_id')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden"
                                                        @if (Request('diyarnaa_city_id')) value="{{ Request('diyarnaa_city_id') }}" @endif
                                                        id="diyarnaa_city_id_old_value">
                                                    <select name="diyarnaa_city_id" id="diyarnaa_city_id"
                                                        onchange="getDiyarnaaRegions()"
                                                        class=" diyarnaa_city_id custom-select my-1 mr-sm-2 @error('diyarnaa_city_id') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
                                                        <option value="">@lang('front.City')..</option>
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
                                                                Region
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
                                                                    Region
                                                                </span>
                                                            @endif
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- التصنيف الرئيسي --}}
                                            <div class="col-md-6 mb-3">
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
                                                    <select name="category_id" id="category_id"
                                                        onchange="getSubCategories()" class="form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
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
                                            <div class="col-md-6 mb-3">
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
                                                                    SubCategory
                                                                </span>
                                                            @endif
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- الغرض --}}
                                            <div class="col-md-6 mb-3">
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
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">

                                                    <label for="code">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                كود الإعلان </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                Code
                                                            </span>
                                                        @endif

                                                    </label>
                                                    <input type="text" class="form-control" id="code"
                                                        placeholder="ADV-xxxx" name="code"
                                                        @if (Request('code')) value="{{ Request('code') }}" @endif>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="submit" class="submit" value="@lang('front.Search')">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row my-5">
                                <!-- real state 1 -->
                                @if (isset($my_fav_ads) && $my_fav_ads->count() > 0)
                                    @foreach ($my_fav_ads as $advertisment)
                                        <div class="col-md-6 ">
                                            <div class="realStateItem">

                                                <div class="top">
                                                    @if (isset($advertisment->main_image) && $advertisment->main_image && file_exists($advertisment->main_image))
                                                        <img src="{{ asset($advertisment->main_image) }}"
                                                            class="img-fluid" alt="img"
                                                            style="width: 100% ; height: 200px; ">
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

                                                            <a
                                                                href="{{ route('addRemoveFavAds', isset($advertisment->id) ? $advertisment->id : -1) }}">
                                                            </a><i class="fa-solid fa-heart"></i>

                                                            <span
                                                                class="pice">{{ isset($advertisment->price) ? number_format(round($advertisment->price)) : '' }}
                                                                $</span>
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

                                                    <p>
                                                        <span class="realState_Location">
                                                            {!! isset($advertisment->status) ? $advertisment->status : '------' !!}
                                                        </span>

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
                                                                {{ isset($advertisment->area) ? $advertisment->area : '------' }}
                                                                <span class="realState_Location">
                                                                    {{ isset($advertisment->feature) ? $advertisment->feature->name_ar : '------' }}
                                                                </span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                {{ isset($advertisment->area) ? $advertisment->area : '------' }}
                                                                <span class="realState_Location">
                                                                    {{ isset($advertisment->feature) ? $advertisment->feature->name_en : '------' }}
                                                                </span>
                                                            @endif

                                                        </span>




                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">
                                            <h3>
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        لا يوجد اعلانات مفضلة </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        No Favorite Ads
                                                    </span>
                                                @endif
                                            </h3>
                                        </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
@section('javascript')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            getDiyarnaaCities()
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
                        //  var selectCity = '<option value="">اختر مدينة... </option>';
                        var selectCity = '<option value=""> @lang('front.SelectCity')... </option>';
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
                        //  $('#diyarnaa_city_id').html('<option value="">اختر منطقة</option>');
                        $('#diyarnaa_city_id').html('<option value=""> @lang('front.SelectCity')</option>');
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
                        // var selectRegion = '<option value="">اختر منطقة ... </option>';
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
                        //var selectRegion = '<option value="">اختر منطقة ... </option>';
                        var selectRegion = '<option value=""> @lang('front.SelectRegion')... </option>';
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
                        // var selectCity = '<option value="">التصنيف الفرعي </option>';
                        var selectCity = '<option value="">@lang('front.SelectSubCategory') </option>';
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
                        //var selectCity = '<option value="">التصنيف الفرعي  </option>';
                        var selectCity = '<option value=""> @lang('front.SelectSubCategory')  </option>';
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
