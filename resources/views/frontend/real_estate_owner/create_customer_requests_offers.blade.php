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
                <h2>@lang('front.CustomerProposalRequests')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                >> <span>@lang('front.CustomerProposalRequests')</span>
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
                    <div class="row">
                        <div class="col-12 bShadow">
                            <form action="{{ route('owner-storeCustomerRequestsOffer') }}" class="editUserForm"
                                method="POST" id="createForm" enctype="multipart/form-data">
                                @csrf
                                <h2> طلبات وعروض العملاء</h2>
                                <div class="row">

                                    {{-- الاسم --}}
                                    <div class="col-md-6 mb-3" id="name">
                                        <label for="area">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الاسم</span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Name
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                *
                                                @error('name')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label> <input type="text" class="form-control" placeholder="" name="name"
                                            value="{{ old('name') ? old('name') : '' }}">
                                    </div>
                                    {{-- mobile --}}
                                    <div class="col-md-6 mb-3">

                                        <label for="area">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الموبايل </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    phone
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                *
                                                @error('phone')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>

                                        <input type="telephone" class="form-control" placeholder="ex: +962 777777777"
                                            name="phone" value="{{ old('phone') ? old('phone') : '' }}">
                                    </div>


                                    {{-- الغرض --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="area">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        الغرض</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        The Purpose
                                                    </span>
                                                @endif
                                                <strong class="text-danger">
                                                    *
                                                    @error('target_id')
                                                        -
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>

                                            <select class="form-control" onchange="getDiyarnaaCities()" name="target_id">
                                                @if (isset($targets) && $targets->count() > 0)
                                                    <option value="" selected>@lang('front.TheItem') </option>
                                                    @foreach ($targets as $target)
                                                        <option value="{{ $target->id }}"
                                                            @if (old('target_id') != null) @if (old('target_id') == $target->id) selected @endif
                                                        @else @if ($target->target_id == $target->id) selected @endif
                                                            @endif>


                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span>{{ isset($target->name_ar) ? $target->name_ar : '------' }}</span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span>{{ isset($target->name_en) ? $target->name_en : '------' }}</span>
                                                            @endif

                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    {{-- التصنيف الرئيسي --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="area">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        التصنيف الرئيسي</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Main Category
                                                    </span>
                                                @endif
                                                <strong class="text-danger">
                                                    *
                                                    @error('category_id')
                                                        -
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>

                                            <select name="category_id" id="category_id" class="form-control"
                                                onchange="getSubCategories()">
                                                <option value="">
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            اختر التصنيف الرئيسي
                                                        </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Select Main Category
                                                        </span>
                                                    @endif
                                                </option>
                                                @if (isset($categories) && count($categories) > 0)
                                                    @foreach ($categories as $key => $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : null }}>
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span class="realState_Location">
                                                                    {{ isset($category->name_ar) ? $category->name_ar : null }}
                                                                </span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span class="realState_Location">
                                                                    {{ isset($category->name_en) ? $category->name_en : null }}
                                                                </span>
                                                            @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    {{-- التصنيف الفرعي --}}
                                    <div class="col-md-6 mb-4">
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
                                                <strong class="text-danger">
                                                    *
                                                    @error('sub_category_id')
                                                        -
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="hidden" value="{{ old('sub_category_id') }}"
                                                id="sub_category_id_old_value">
                                            <select name="sub_category_id" id="sub_category_id" class="form-control"
                                                data-live-search="true" data-width="88%" data-actions-box="true"
                                                style="width: 100%" onchange="getFeatureType()">
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


                                    {{-- Country --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="area">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        الدولة</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Country
                                                    </span>
                                                @endif
                                                <strong class="text-danger">
                                                    *
                                                    @error('diyarnaa_country_id')
                                                        -
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label> <select class="form-control" name="diyarnaa_country_id"
                                                id="diyarnaa_country_id" onchange="getDiyarnaaCities()">
                                                @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                    <option value="" selected>@lang('front.SelectCity') </option>
                                                    @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                        <option value="{{ $diyarnaa_country->id }}"
                                                            @if (old('diyarnaa_country_id') != null) @if (old('diyarnaa_country_id') == $diyarnaa_country->id) selected @endif
                                                        @else @if ($diyarnaa_country->diyarnaa_country_id == $diyarnaa_country->id) selected @endif
                                                            @endif>
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
                                            <label for="area">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        المدينة</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        City
                                                    </span>
                                                @endif
                                                <strong class="text-danger">
                                                    *
                                                    @error('diyarnaa_city_id')
                                                        -
                                                        {{ $message }}
                                                    @enderror

                                                    <input type="hidden" id="diyarnaa_city_id_old_value"
                                                        value="{{ old('diyarnaa_city_id') }}">
                                                </strong>
                                            </label>
                                            <select name="diyarnaa_city_id" id="diyarnaa_city_id"
                                                onchange="getDiyarnaaRegions()"
                                                class=" diyarnaa_city_id custom-select my-1 mr-sm-2 @error('diyarnaa_city_id') is-invalid @enderror form-control"
                                                data-live-search="true" data-width="88%" data-actions-box="true"
                                                style="width: 100%">
                                                <option value="">@lang('front.City')..</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Region --}}
                                    <div class="col-md-6 mb-4">
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
                                                    *
                                                    @error('diyarnaa_region_id')
                                                        -
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="hidden"
                                                value="{{ old('diyarnaa_region_id') ? old('diyarnaa_region_id') : '' }}"
                                                id="diyarnaa_region_id_old_value">
                                            <select name="diyarnaa_region_id" id="diyarnaa_region_id"
                                                class="form-control">
                                                <option>
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            اختر المنطقه </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Choose Region
                                                        </span>
                                                    @endif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- type --}}
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="diyarnaa_region_id">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        النوع
                                                    </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Type
                                                    </span>
                                                @endif
                                                <strong class="text-danger">
                                                    *
                                                    @error('type')
                                                        -
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>

                                            <select name="type"
                                                class="custom-select my-1 mr-sm-2 @error('type') is-invalid @enderror"
                                                id="type">
                                                <option value="" selected> @lang('front.SelectStatus')...</option>
                                                <option value="1" @if (old('type') == 1) selected @endif>
                                                    @lang('front.Request')
                                                </option>
                                                <option value="2" @if (old('type') == 2) selected @endif>
                                                    @lang('front.Offer')
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- المساحة --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="area">
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            المساحة </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Area
                                                        </span>
                                                    @endif
                                                    <strong class="text-danger">
                                                        *
                                                        @error('area')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <input type="number" min="0" class="form-control"
                                                    placeholder=" " name="area"
                                                    value="{{ old('area') ? old('area') : '' }}">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- السعر --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="area">
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            السعر </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Price
                                                        </span>
                                                    @endif
                                                    <strong class="text-danger">
                                                        * (@lang('front.PriceInsertDollar'))
                                                        @error('price')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <input type="number" min="0" class="form-control" name="price"
                                                    value="{{ old('price') ? old('price') : null }}">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- العنوان --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="area">
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            العنوان
                                                        </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Address
                                                        </span>
                                                    @endif
                                                    <strong class="text-danger">
                                                        *
                                                        @error('advertising')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <textarea name="advertising" id="advertising" cols="30" rows="5" class="form-control">{{ old('advertising') ? old('advertising') : null }}</textarea>

                                            </div>
                                        </div>
                                    </div>



                                    {{-- الاعلان --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="area">
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            الاعلان
                                                        </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            Add
                                                        </span>
                                                    @endif
                                                    <strong class="text-danger">
                                                        *
                                                        @error('advertising')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <textarea name="advertising" id="advertising" cols="30" rows="5" class="form-control">{{ old('advertising') ? old('advertising') : null }}</textarea>

                                            </div>
                                        </div>
                                    </div>





                                    {{-- other images --}}
                                    <div class="col-md-6 mb-4">
                                        <label class="text-dark font-weight-medium mb-3" for="cart_image">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    صور
                                                    <span class="text-danger">(jpeg,png,jpg,gif,svg) ( Max-Size : 2MB
                                                        )</span>
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Images
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                @error('image')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>


                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            </div>
                                            <input type="file" id="image" class="form-control" name="images[]"
                                                multiple />
                                        </div>



                                    </div>

                                    {{-- video --}}
                                    <div class="col-md-6 mb-4" id="video_div">
                                        <label class="text-dark font-weight-medium mb-3" for="video">
                                            @lang('front.video') <span class="text-danger">(mp4,ogx,oga,ogv,ogg,webm) (
                                                Max-Size : 20MB )</span> :
                                            <strong class="text-danger">
                                                @error('video')
                                                    {{ $message }}
                                                @enderror
                                            </strong></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            </div>
                                            <input type="file" name="video" class="form-control" id="video">
                                        </div>
                                    </div>


                                    {{-- Submit --}}
                                    <div class="col-12 mb-3">
                                        <input type="submit" class="submit" value="@lang('front.Add')">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

    <!--- show the selected Image -->
@endsection
@section('javascript')
    {{-- //=========================================================================================
        //=========================================getDiyarnaaCities==============================
        //========================================================================================= --}}
    <script>
        $(document).ready(function() {
            getSubCategories();
            getDiyarnaaCities();

            setTimeout(() => {
                getDiyarnaaRegions();

            }, 1000);


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
                        //   var selectCity = '<option value="">اختر المحافظة... </option>';
                        var selectCity = '<option value="">@lang('front.SelectCity')... </option>';
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
                        $('#diyarnaa_city_id').html('<option value="">  @lang('front.NoCity')... </option>');
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

    {{-- //=========================================================================================
        //=========================================getDiyarnaaRegions==============================
        //========================================================================================= --}}
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
                        var selectRegion = '<option value="">@lang('front.SelectRegion') ... </option>';
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
                        var selectRegion = '<option value="">@lang('front.SelectRegion') ... </option>';
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
    {{-- //=========================================================================================
        //=========================================SubCategory==============================
        //========================================================================================= --}}
    <script>
        function getSubCategories() {
            var formData = new FormData($('#createForm')[0]);
            $('#construction_age_box').css('display', 'none');
            $('#land_area_box').css('display', 'none');
            $('#real_estate_status_box').css('display', 'none');
            $('#number_of_rooms_box').css('display', 'none');
            $('#number_of_bathrooms_box').css('display', 'none');
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
                        var selectCity = '<option value="">@lang('front.SelectSubCategory')... </option>';
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
                        // $('#sub_category_id').html('<option value="">لا يوجد تصنيفات فرعية</option>');
                        $('#sub_category_id').html('<option value="">@lang('front.NoSubCategory')</option>');
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
