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
                <h2>@lang('front.MyAddedResearches')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.MyAddedResearches')</span>
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
                                    <form action="{{ route('seeker-MyResearch') }}" class="realStateFilter  signUp"
                                        id="createForm" style="text-align: initial">
                                        @csrf
                                        <div class="row align-items-center">


                                            {{-- country --}}
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="diyarnaa_country_id">@lang('front.CountryName')
                                                        <strong class="text-danger">
                                                            @error('diyarnaa_country_id')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <select class="form-control" name="diyarnaa_country_id"
                                                        id="diyarnaa_country_id" onchange="getDiyarnaaCities()">
                                                        @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                            <option value="" selected>@lang('front.SelectCountry')</option>
                                                            @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                                <option value="{{ $diyarnaa_country->id }}"
                                                                    @if (Request('diyarnaa_country_id') == $diyarnaa_country->id) selected @endif>
                                                                    @if (Config::get('app.locale') == 'ar')
                                                                        <span>{{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : '------' }}</span>
                                                                    @elseif (Config::get('app.locale') == 'en')
                                                                        <span>{{ isset($diyarnaa_country->name_en) ? $diyarnaa_country->name_en : '------' }}</span>
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

                                                            @error('diyarnaa_city_id')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ Request('diyarnaa_city_id') }}"
                                                        id="diyarnaa_city_id_old_value">
                                                    <select class="form-control" name="diyarnaa_city_id"
                                                        id="diyarnaa_city_id" onchange="getDiyarnaaRegions()">
                                                        <option value="1">@lang('front.SelectCity')</option>
                                                    </select>
                                                </div>
                                            </div>


                                            {{-- Region --}}
                                            <div class="col-md-6  mb-4">
                                                <div class="form-group">
                                                    <label for="diyarnaa_region_id">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                المنطقه </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                Region
                                                            </span>
                                                        @endif
                                                        <strong class="text-danger">

                                                            @error('diyarnaa_region_id')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ Request('diyarnaa_region_id') }}"
                                                        id="diyarnaa_region_id_old_value">
                                                    <select name="diyarnaa_region_id" id="diyarnaa_region_id"
                                                        class="form-control">
                                                        <option>
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span class="realState_Location">
                                                                    اختر المنطقه </span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span class="realState_Location">
                                                                    choose Region
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
                                                                Subcategory
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


                                            {{-- title --}}
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">

                                                    <label for="title">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                العنوان </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                Title
                                                            </span>
                                                        @endif

                                                    </label>
                                                    <input type="text" class="form-control" id="title"
                                                        name="title"
                                                        @if (Request('title')) value="{{ Request('title') }}" @endif>
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

                                            <div class="col-md-6 ">
                                                <input type="submit" class="submit" value="@lang('front.Search')">
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row my-5">
                                @if (isset($searches) && $searches->count() > 0)
                                    @foreach ($searches as $searche)
                                        <div class="col-md-6 ">
                                            <div class="realStateItem">
                                                <div class="bottom">
                                                    <p>
                                                        <span class="realState_Location">
                                                            {!! isset($searche->title) ? $searche->title : '------' !!}
                                                        </span>

                                                    </p>

                                                    <p>
                                                        <span class="realState_Location">
                                                            {!! isset($searche->status) ? $searche->status : '------' !!}
                                                        </span>

                                                    </p>
                                                    <div class="footer">
                                                        <span>
                                                            <img src="{{ asset('style_files/frontend/img/building.png') }}"
                                                                class="img-fluid" alt="img">
                                                            {{ isset($searche->mainCategory) ? $searche->mainCategory->name_ar : '------' }}
                                                            -
                                                            {{ isset($searche->subCategory) ? $searche->subCategory->name_ar : '------' }}
                                                        </span>
                                                        <span>
                                                            <img src="{{ asset('style_files/frontend/img/land.png') }}"
                                                                class="img-fluid" alt="img">
                                                            @if (Config::get('app.locale') == 'ar')
                                                                {{ isset($searche->area_from) ? $searche->area_from : '------' }}
                                                                -
                                                                {{ isset($searche->area_to) ? $searche->area_to : '------' }}
                                                                <span class="realState_Location">
                                                                    {{ isset($searche->feature) ? $searche->feature->name_ar : '------' }}
                                                                </span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                {{ isset($searche->area_from) ? $searche->area_from : '------' }}
                                                                -
                                                                {{ isset($searche->area_to) ? $searche->area_to : '------' }}
                                                                <span class="realState_Location">
                                                                    {{ isset($searche->feature) ? $searche->feature->name_en : '------' }}
                                                                </span>
                                                            @endif

                                                        </span>
                                                        <span>
                                                            <img src="{{ asset('style_files/frontend/img/icons/2.png') }}"
                                                                style="width: 17px;" class="img-fluid" alt="img">
                                                            <span
                                                                class="pice">{{ isset($searche->price_from) ? number_format(round($searche->price_from)) : '' }}</span>
                                                            -
                                                            <span
                                                                class="pice">{{ isset($searche->price_to) ? number_format(round($searche->price_to)) : '' }}</span>
                                                            $
                                                        </span>
                                                        <span>
                                                            <img src="{{ asset('style_files/frontend/img/icons/9.png') }}"
                                                                style="width: 17px;" class="img-fluid" alt="img">
                                                            <span
                                                                class="pice">{{ isset($searche->code) ? $searche->code : '' }}</span>


                                                        </span>




                                                    </div>
                                                </div>
                                                <div class="links">
                                                    <ul>

                                                        <a href="{{ route('seeker-mySearchDetails', isset($searche->id) ? $searche->id : -1) }}"
                                                            class="mainBg btn">
                                                            @lang('front.View')
                                                        </a>

                                                        <li>
                                                            @if (isset($searche->expiry_date) &&
                                                                    $searche->expiry_date <
                                                                        date('Y-m-d
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                H:i:s') &&
                                                                    $searche->status == 'Active')
                                                                <a href="{{ route('seeker-editSearch', isset($searche->id) ? $searche->id : -1) }}"
                                                                    class="mainBg btn">
                                                                     @lang('front.RePublish')
                                                                </a>
                                                            @endif
                                                        </li>
                                                        @if (isset($searche->edit_balance) &&
                                                                isset($searche->expiry_date) &&
                                                                $searche->edit_balance > 0 &&
                                                                $searche->expiry_date > date('Y-m-d H:i:s'))
                                                            <li>
                                                                <a href="{{ route('seeker-editSearch', isset($searche->id) ? $searche->id : -1) }}"
                                                                    class="btn">
                                                                    @if (Config::get('app.locale') == 'ar')
                                                                        تعديل
                                                                    @elseif (Config::get('app.locale') == 'en')
                                                                        edit
                                                                    @endif

                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a class="btn"
                                                                href="{{ route('seeker-activeInactiveSearch', isset($searche->id) ? $searche->id : -1) }}">
                                                                @if (isset($searche->status))
                                                                    @if ($searche->status == 'Active')
                                                                        @if (Config::get('app.locale') == 'ar')
                                                                            تعطيل
                                                                        @elseif (Config::get('app.locale') == 'en')
                                                                            Inactive
                                                                        @endif
                                                                    @elseif($searche->status == 'Inactive')
                                                                        @if (Config::get('app.locale') == 'ar')
                                                                            تفعيل
                                                                        @elseif (Config::get('app.locale') == 'en')
                                                                            Active
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a class="btn"
                                                                href="{{ route('seeker-deleteSearch', isset($searche->id) ? $searche->id : -1) }}">
                                                                @if (Config::get('app.locale') == 'ar')
                                                                    حذف
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    delete
                                                                @endif
                                                            </a>
                                                        </li>
                                                    </ul>
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

    </div>
@endsection
@section('javascript')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            getSubCategories();
            getDiyarnaaCities()
            setTimeout(() => {
                getDiyarnaaRegions();

            }, 500);
        });
    </script>
    {{-- getDiyarnaaCities --}}
    <script>
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
                        // var selectCity = '<option value="">اختر المحافظة... </option>';
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
                        // $('#diyarnaa_city_id').html('<option value="">لا يوجد محافظات... </option>');
                        $('#diyarnaa_city_id').html('<option value=""> @lang('front.NoCity')... </option>');
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


    {{-- getDiyarnaaRegions --}}
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
                        //var selectRegion = '<option value="">اختر منطقة ... </option>';
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
                        var selectRegion = '<option value="">@lang('front.SelectRegion')  ... </option>';
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
    {{-- getSubCategories --}}
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
                        //   var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
                        var selectCity = '<option value=""> @lang('front.SelectSubCategory')... </option>';
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
