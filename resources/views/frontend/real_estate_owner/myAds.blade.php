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
                <h2>@lang('front.MyAddedAds')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.MyAddedAds')</span>
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
                                    <form action="{{ route('owner-myAdvertisements') }}" class="realStateFilter  signUp"
                                        id="createForm" style="text-align: initial">
                                        @csrf
                                        <div class="row align-items-center">

                                            {{-- City --}}
                                            <div class="col-md-3 mb-3">
                                                <div class="form-group">
                                                    <label for="diyarnaa_city_id">@lang('front.City')
                                                        {{-- <strong class="text-danger">
                                                            *
                                                            @error('diyarnaa_city_id')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong> --}}
                                                    </label>

                                                    <select class="form-control" name="diyarnaa_city_id"
                                                        id="diyarnaa_city_id" onchange="getDiyarnaaRegions()">
                                                        <option value="" selected>
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span class="realState_Location">
                                                                    المدينة </span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span class="realState_Location">
                                                                    City
                                                                </span>
                                                            @endif
                                                        </option>




                                                        @if (isset($user_cities) && count($user_cities) > 0)
                                                            @foreach ($user_cities as $city)
                                                                <option value="{{ $city->id }}"
                                                                    @if (Request('diyarnaa_city_id') == $city->id) selected @endif>
                                                                    @if (Config::get('app.locale') == 'ar')
                                                                        <span class="realState_Location">
                                                                            {{ isset($city->name_ar) ? $city->name_ar : null }}
                                                                        </span>
                                                                    @elseif (Config::get('app.locale') == 'en')
                                                                        <span class="realState_Location">
                                                                            {{ isset($city->name_en) ? $city->name_en : null }}
                                                                        </span>
                                                                    @endif
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- المنطقة --}}
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
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

                                            <div class="col-md-3">
                                                <input type="submit" class="submit" value="@lang('front.Search')">
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row my-5">
                                <!-- real state 1 -->
                                @if (isset($myAds) && $myAds->count() > 0)
                                    @foreach ($myAds as $advertisment)
                                        <div class="col-md-4 ">
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
                                                            href="{{ route('owner-myAdvertisementDetails', isset($advertisment->id) ? $advertisment->id : -1) }}">
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

                                                            <span
                                                                class="pice">${{ isset($advertisment->price) ? $advertisment->price : '' }}</span>
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
                                                <div class="links">
                                                    <ul>
                                                        <li>
                                                            @if (isset($advertisment->expiry_date) &&
                                                                    $advertisment->expiry_date < date('Y-m-d H:i:s') &&
                                                                    $advertisment->status == 'Active')
                                                                <a href="{{ route('owner-editAdvertisement', isset($advertisment->id) ? $advertisment->id : -1) }}"
                                                                    class="mainBg btn">
                                                                    @lang('front.RePublish')
                                                                </a>
                                                            @endif
                                                        </li>
                                                        @if (isset($advertisment->edit_balance) &&
                                                                isset($advertisment->expiry_date) &&
                                                                $advertisment->edit_balance > 0 &&
                                                                $advertisment->expiry_date > date('Y-m-d H:i:s') &&
                                                                $advertisment->status != 'Pending')
                                                            <li>
                                                                <a href="{{ route('owner-editAdvertisement', isset($advertisment->id) ? $advertisment->id : -1) }}"
                                                                    class="btn">
                                                                    @if (Config::get('app.locale') == 'ar')
                                                                        تعديل
                                                                    @elseif (Config::get('app.locale') == 'en')
                                                                        Edit
                                                                    @endif

                                                                </a>
                                                            </li>
                                                        @elseif($advertisment->advertisementEditRequests->count() == 0)
                                                            @if (
                                                                $advertisment->status != 'Pending' &&
                                                                    $advertisment->status != 'Accept with Conditions' &&
                                                                    $advertisment->expiry_date > date('Y-m-d H:i:s'))
                                                                <li>
                                                                    <a href="{{ route('owner-advertisementEditRequest', isset($advertisment->id) ? $advertisment->id : -1) }}"
                                                                        class="btn">
                                                                        @if (Config::get('app.locale') == 'ar')
                                                                            طلب تعديل
                                                                        @elseif (Config::get('app.locale') == 'en')
                                                                            Edit Request
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endif
                                                        @if (isset($advertisment->status) && ($advertisment->status == 'Active' || $advertisment->status == 'Inactive'))
                                                            <li>
                                                                <a class="btn"
                                                                    href="{{ route('owner-activeInactiveAdvertisement', isset($advertisment->id) ? $advertisment->id : -1) }}">
                                                                    @if (isset($advertisment->status))
                                                                        @if ($advertisment->status == 'Active')
                                                                            @if (Config::get('app.locale') == 'ar')
                                                                                تعطيل
                                                                            @elseif (Config::get('app.locale') == 'en')
                                                                                Inactive
                                                                            @endif
                                                                        @elseif($advertisment->status == 'Inactive')
                                                                            @if (Config::get('app.locale') == 'ar')
                                                                                تفعيل
                                                                            @elseif (Config::get('app.locale') == 'en')
                                                                                Active
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @endif

                                                        <li>
                                                            <a class="btn"
                                                                href="{{ route('owner-deleteAdvertisement', isset($advertisment->id) ? $advertisment->id : -1) }}">
                                                                @if (Config::get('app.locale') == 'ar')
                                                                    حذف
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    Delete
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

            setTimeout(() => {
                getDiyarnaaRegions();

            }, 1000);
            getSubCategories();


        });
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
                        var selectRegion = '<option value=""> @lang('front.SelectRegion')  ... </option>';
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
                        //var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
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
                        //  var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
                        var selectCity = '<option value=""> @lang('front.SelectSubCategory')... </option>';
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
