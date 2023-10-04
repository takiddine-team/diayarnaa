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
            @if (isset($background_image->user_signup) &&
                    $background_image->getRawOriginal('user_signup') &&
                    file_exists($background_image->getRawOriginal('user_signup')))
                <img src="{{ asset($background_image->user_signup) }}" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif
            <div class="pageTitle">
                <h2>@lang('front.UserSignup')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                >> <span>@lang('front.UserRegister')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== login section =============== --}}
            {{-- =========================================================== --}}
            <section class="login signUp mt-5 pt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form action="{{ route('userSignupRequest') }}" class="loginForm signUpForm" id="createForm"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mx-auto mb-3 formHead text-center">
                                        <h2 class="mainColor">
                                            @lang('front.UserRegisterNow') </h2>
                                        <p>@lang('front.RegisterInUnder')</p>
                                    </div>
                                    <div class="col-md-12 my-3 checkboxTab text-center">
                                        <input type="radio" name="user_type" value="1" id="realestateOffice"
                                            {{ old('user_type') == '1' ? 'checked' : '' }}>
                                        <label for="realestateOffice"
                                            class="{{ old('user_type') == '1' ? 'show' : '' }} 1">@lang('front.EstateOffice')</label>
                                        <input type="radio" name="user_type" value="2" id="realestateOwner"
                                            {{ old('user_type') == '2' ? 'checked' : '' }}>
                                        <label for="realestateOwner" class="{{ old('user_type') == '2' ? 'show' : '' }} 2">
                                            @lang('front.EstateOwner')</label>
                                        <input type="radio" name="user_type" value="3" id="restateOfficeSeeker"
                                            {{ old('user_type') == '3' ? 'checked' : '' }}>
                                        <label for="restateOfficeSeeker"
                                            class="{{ old('user_type') == '3' ? 'show' : '' }} show 3">
                                            @lang('front.EstateSearcher')</label>
                                    </div>
                                    <strong style="color: red" class="text-center">
                                        @error('user_type')
                                            - {{ $message }}
                                        @enderror
                                    </strong>

                                    <div class="col-12 mb-3 text-center pInnerr">

                                        <p id="signtext">@lang('front.EstateSearcher')</p>

                                    </div>
                                    <div class="col-12 mb-3 text-center">
                                        <!-- actual upload which is hidden -->
                                        <input type="file" id="actualBtn" onchange="loadFile(event)" hidden
                                            name="profile_image" />
                                        <!-- our custom upload button -->
                                        <label for="actualBtn" id="img" class="uploadImage">

                                            <img src="{{ asset('style_files/frontend/img/user.png') }}" id="selectedBanner"
                                                alt="">

                                            <div class="camera">
                                                <i class="fa-solid fa-camera"></i>
                                            </div>
                                        </label>
                                    </div>

                                    {{-- Country --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="country">@lang('front.CountryName')
                                                <strong class="text-danger">
                                                    *
                                                    @error('diyarnaa_country_id')
                                                        -
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <select class="form-control" name="diyarnaa_country_id" id="diyarnaa_country_id"
                                                onchange="getDiyarnaaCities()">
                                                @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                    <option value="" selected>@lang('front.SelectCountry')</option>
                                                    @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                        <option value="{{ $diyarnaa_country->id }}"
                                                            @if (old('diyarnaa_country_id') != null) @if (old('diyarnaa_country_id') == $diyarnaa_country->id) selected @endif
                                                        @else @if ($diyarnaa_country->diyarnaa_country_id == $diyarnaa_country->id) selected @endif
                                                            @endif>

                                                            {{--  {{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : '------' }}  --}}

                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span>
                                                                    {{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : null }}</span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span>{{ isset($diyarnaa_country->name_en) ? $diyarnaa_country->name_en : null }}</span>
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
                                            <label for="state">@lang('front.StateSelect')</label>
                                            <strong class="text-danger">
                                                *
                                                @error('diyarnaa_city_id')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                            </label>
                                            <input type="hidden" value="{{ old('diyarnaa_city_id') }}"
                                                id="diyarnaa_city_id_old_value">
                                            <select class="form-control" name="diyarnaa_city_id" id="diyarnaa_city_id"
                                                onchange="getDiyarnaaRegions()">
                                                <option>@lang('front.StateSelect')</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- Region --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="Region">@lang('front.SelectRegion')
                                                <strong class="text-danger">
                                                    *
                                                    @error('diyarnaa_region_id')
                                                        -
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="hidden" value="{{ old('diyarnaa_region_id') }}"
                                                id="diyarnaa_region_id_old_value">
                                            <select name="diyarnaa_region_id" id="diyarnaa_region_id" class="form-control">
                                                <option> @lang('front.SelectRegion') </option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- street --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="street">@lang('front.Street')
                                            <strong class="text-danger">

                                                @error('street')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" id="street"
                                            placeholder="@lang('front.Street')" name="street" value="{!! old('street') ? old('street') : null !!}">
                                    </div>
                                    {{-- Name --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="name">@lang('front.Name')
                                            <strong class="text-danger">
                                                *
                                                @error('name')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="@lang('front.Name')" name="name"
                                            value="{!! old('name') ? old('name') : null !!}">
                                    </div>
                                    {{-- Last Name --}}
                                    <div class="col-md-6 mb-3" id="last_name_div">
                                        <label for="last_name">@lang('front.LastName')
                                            <strong class="text-danger">
                                                *
                                                @error('last_name')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" id="last_name"
                                            placeholder="@lang('front.LastName')" name="last_name"
                                            value="{!! old('last_name') ? old('last_name') : null !!}">
                                    </div>
                                    {{-- office_phone --}}
                                    <div class="col-md-6 mb-3" id="office_phone" style="display: none">
                                        <label for="office_phone">@lang('front.OfficePhone')
                                            <strong class="text-danger">
                                                *
                                                @error('office_phone')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="tel" class="form-control" id="office_phone" name="office_phone"
                                            placeholder="xxxxxxx852" value="{!! old('office_phone') ? old('office_phone') : null !!}">
                                    </div>
                                    {{-- mobile --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="phone2">@lang('front.Phone')
                                            <strong class="text-danger">
                                                *
                                                @error('phone')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            placeholder="xxxxxxx852" value="{!! old('phone') ? old('phone') : null !!}">
                                    </div>
                                    {{-- Email --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="email">@lang('front.Email')
                                            <strong class="text-danger">
                                                *
                                                @error('email')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="email" id="email" class="form-control" name="email"
                                            placeholder=" xxxxx@xxxx.xxxx" value="{!! old('email') ? old('email') : null !!}">
                                    </div>
                                    {{-- password --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="password">@lang('front.Password')
                                            <strong class="text-danger">
                                                *
                                                @error('password')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder=" ********">
                                    </div>
                                    {{-- password_confirmation --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="confirm_password">
                                            @lang('front.PasswordConfirmation') <strong class="text-danger">
                                                @error('password_confirmation')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="********" id="Rpassword">
                                    </div>
                                    {{-- License --}}
                                    <div class="col-md-6 mb-3" id="license_image_div" style="display: none">
                                        <label for="lessonImage">@lang('front.LicenseImage')
                                            <span class="text-danger">(jpeg,png,jpg,gif,svg) ( Max-Size : 2MB )</span>
                                            <strong class="text-danger">
                                                * @error('license_image')
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="file" id="lessonImage" class="form-control" name="license_image"
                                            placeholder="@lang('front.LicenseImage')" id="license_image">
                                    </div>
                                    {{-- Additional Information --}}
                                    <div class="col-md-12 mb-3" id="additional_information_div">
                                        <label for="info">@lang('front.AddiotionalInformation')
                                            <strong class="text-danger">
                                                @error('additional_information')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="additional_information" id="additional_information" cols="30" rows="5"
                                            class="form-control" placeholder="@lang('front.WelcomeElse')">{{ old('additional_information') ? old('additional_information') : '' }}</textarea>
                                    </div>
                                    {{-- Confirmation --}}
                                    <div class="col-12 mb-3">
                                        <input type="checkbox" id="confirm" required>
                                        <a href="{{ route('termsAndConditions') }}" target="_blank"> <label
                                                for="confirm " class="small">@lang('front.ByClickingYouAgreeToTerms')
                                            </label></a>
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
@endsection

@section('javascript')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


    <script>
        var loadFile = function(event) {
            var image = document.getElementById('selectedBanner');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>



    <script>
        $("input[name$='user_type']").click(function() {
            if ($(this).val() == 1) {
                $("#office_phone").show();
                $("#license_image_div").show();
                $("#last_name_div").hide();
                $("#street_div").hide();
            } else if ($(this).val() == 2) {
                $("#office_phone").hide();
                $("#license_image_div").hide();
                $("#last_name_div").show();
                $("#street_div").show();
            } else if ($(this).val() == 3) {
                $("#office_phone").hide();
                $("#license_image_div").hide();
                $("#additional_information_div").hide();
                $("#last_name_div").show();
                $("#street_div").show();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            if ($("input[type='radio'][name='user_type']:checked").val() == 1) {
                $("#office_phone").show();
                $("#license_image_div").show();
                $("#last_name_div").hide();
                $("#street_div").hide();
            } else if ($("input[type='radio'][name='user_type']:checked").val() == 2) {
                $("#office_phone").hide();
                $("#license_image_div").hide();
                $("#last_name_div").show();
                $("#street_div").show();
            } else if ($("input[type='radio'][name='user_type']:checked").val() == 3) {
                $("#office_phone").hide();
                $("#license_image_div").hide();
                $("#last_name_div").show();
                $("#street_div").show();
                $("#additional_information_div").hide();

            }


        });
    </script>
    <script>
        $(document).ready(function() {
            getDiyarnaaCities();

            setTimeout(() => {
                getDiyarnaaRegions();

            }, 500);


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
                        var selectCity = '<option value="">@lang('front.StateSelect') </option>';
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
                        $('#diyarnaa_city_id').html('<option value="">@lang('front.NoState') </option>');
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
                    //    var selectRegion = '<option value="">اختر منطقة ... </option>';
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
                        //var selectRegion = '<option value="">اختر منطقة ... </option>';
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

    <script>
        $(document).ready(function() {
            $(".checkboxTab label").click(function() {
                $(".checkboxTab label").removeClass("show");
                $(this).addClass("show");
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $(".checkboxTab label").click(function() {
                $(".checkboxTab label").removeClass("show");
                $(this).addClass("show");
            });

            $(".3").click(function() {
                $("#signtext").text(
                    //"هذا النموذج مخصص للشخص الراغب بالبحث عن أي عقار يريده في أي دولة من دول الموقع"
                    "{{ @trans('front.EstateSearcherForm') }}"

                );
            });

            $(".2").click(function() {
                $("#signtext").text(
                    //"هذا النموذج مخصص لمالكي العقارات في أي دولة من دول الموقع."
                    "{{ @trans('front.EstateOwnerForm') }}"

                );
            });

            $(".1").click(function() {
                $("#signtext").text(
                    //    "هذا النموذج مخصص لتسجيل المكاتب والشركات العقارية المرخصة فقط"
                    "{{ @trans('front.EstateOfficeForm') }}"
                );
            });

        });
    </script>
@endsection
