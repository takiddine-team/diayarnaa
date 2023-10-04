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
                <h2>@lang('front.ChangeLoginInformation')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.ChangeLoginInformation')</span>
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
                            <form
                                action="{{ route('owner-updateUserDashboard', isset(Auth::guard('user')->user()->id) ? Auth::guard('user')->user()->id : -1) }}"
                                id="createForm" class="editUserForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h2>@lang('front.PersonalInformation')</h2>
                                <div class="row">



                                    {{-- Country --}}
                                    {{-- <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="diyarnaa_country_id">الدولة
                                                * <strong class="text-danger">
                                                    @error('diyarnaa_country_id')
                                                        - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <select class="form-control" name="diyarnaa_country_id" id="diyarnaa_country_id"
                                                onchange="getDiyarnaaCities()">
                                                @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                    <option value=""selected> اختر الدولة </option>
                                                    @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                        <option value="{{ $diyarnaa_country->id }}"
                                                            @if (old('diyarnaa_country_id') != null)
                                                                @if (old('diyarnaa_country_id') == $diyarnaa_country->id) selected @endif
                                                            @else
                                                                 @if (Auth::guard('user')->user()->diyarnaa_country_id == $diyarnaa_country->id) selected @endif
                                                            @endif>

                                                            {{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : '------' }}

                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div> --}}

                                    {{-- City --}}
                                    {{-- <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="diyarnaa_city_id">المحافظة
                                                * <strong class="text-danger">
                                                    @error('diyarnaa_city_id')
                                                        - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="hidden"
                                                @if (old('diyarnaa_city_id')) value={{ old('diyarnaa_city_id') }}
                                                @else
                                                value ={{ isset(Auth::guard('user')->user()->diyarnaa_city_id) ? Auth::guard('user')->user()->diyarnaa_city_id : '' }} @endif
                                                id="diyarnaa_city_id_old_value">
                                            <select class="form-control" name="diyarnaa_city_id" id="diyarnaa_city_id"
                                                onchange="getDiyarnaaRegions()">
                                                <option value="1">اختر المحافظة</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                    {{-- Region --}}
                                    {{-- <div class="col-md-6 mb-4">
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
                                                @if (old('diyarnaa_region_id')) value={{ old('diyarnaa_region_id') }}
                                                @else
                                                value ={{ isset(Auth::guard('user')->user()->diyarnaa_region_id) ? Auth::guard('user')->user()->diyarnaa_region_id : '' }} @endif
                                                id="diyarnaa_region_id_old_value">
                                            <select name="diyarnaa_region_id" id="diyarnaa_region_id" class="form-control">
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
                                    </div> --}}

                                    {{-- mobile --}}
                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="phone2"> رقم الموبايل
                                            <strong class="text-danger">
                                                *
                                                @error('phone')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value="@if (old('phone')) {{ old('phone') }}
                                                @else
                                                {{ isset(Auth::guard('user')->user()->phone) ? Auth::guard('user')->user()->phone : null }} @endif">
                                    </div> --}}


                                    {{-- Additional Information --}}
                                    <div class="col-md-12 mb-3">
                                        <label for="info">

                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    معلومات اضافية </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Additional Information
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                * @error('additional_information')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="additional_information" id="additional_information" cols="30" rows="5" class="form-control">
@if (old('additional_information'))
{{ strip_tags(old('additional_information')) }}@else{!! isset(
    auth()->guard('user')->user()->additional_information,
)
    ? strip_tags(
        auth()->guard('user')->user()->additional_information,
    )
    : '' !!}
@endif
</textarea>
                                    </div>

                                    {{-- image --}}
                                    <div class="col-12 mb-3">
                                        <label for="cart_image">@lang('front.UploadPersonalPicture')
                                            <span class="text-danger">(jpeg,png,jpg,gif,svg) ( Max-Size : 2MB )</span>
                                            <strong class="text-danger">
                                                @error('additional_information')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <!-- actual upload which is hidden -->
                                        <input type="file" id="actualBtn" onchange="loadFile(event)" hidden
                                            name="profile_image" />
                                        <!-- our custom upload button -->
                                        <label for="actualBtn" id="img" class="uploadImage">
                                            @if (isset(auth()->guard('user')->user()->profile_image) &&
                                                    auth()->guard('user')->user()->getRawOriginal('profile_image') &&
                                                    file_exists(auth()->guard('user')->user()->getRawOriginal('profile_image')))
                                                <img src="{{ asset(auth()->guard('user')->user()->profile_image) }}"
                                                    class="img-fluid">
                                            @else
                                                <img src="{{ asset('style_files/frontend/img/logo.png') }}"
                                                    class="img-fluid" alt="img">
                                            @endif
                                          
                                            @if (Config::get('app.locale') == 'ar')
                                                <img src="{{ asset('style_files/frontend/img/uploade.png') }}"
                                                    id="selectedBanner" alt="">
                                            @elseif (Config::get('app.locale') == 'en')
                                                <img src="{{ asset('style_files/frontend/img/uploadfromhere.png') }}"
                                                    id="selectedBanner" alt="">
                                            @endif

                                        </label>
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-12 mb-3">
                                        <input type="submit" class="submit" value="@lang('front.Send')">
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

    <script>
        var loadFile = function(event) {
            var image = document.getElementById('selectedBanner');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
        var loadFile2 = function(event) {
            var image2 = document.getElementById('selectedBanner2');
            image2.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
@section('javascript')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            getDiyarnaaCities();

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
                        // var selectCity = '<option value="">اختر المحافظة... </option>';
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
                        //   $('#diyarnaa_city_id').html('<option value="">لا يوجد محافظات... </option>');
                        $('#diyarnaa_city_id').html('<option value="">@lang('front.NoCity')... </option>');
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
                        // var selectRegion = '<option value="">اختر منطقة ... </option>';
                        var selectRegion = '<option value="">@lang('front.SelectRegion')  ... </option>';
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
@endsection
