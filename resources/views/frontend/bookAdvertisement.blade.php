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
                <h2>@lang('front.ReserveAnAd')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.ReserveAnAd')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== login section =============== --}}
            {{-- =========================================================== --}}
            <section class="login signUp mt-5 pt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form action="{{ route('bookAdvertisementRequest') }}" class="loginForm signUpForm"
                                id="createForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    {{-- ==========company name AR ============= --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="companyName">
                                                    @lang('front.ArabicName')
                                                    <strong class="text-danger">
                                                        *
                                                        @error('company_name_ar')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <input type="text" class="form-control" placeholder="@lang('front.ArabicName')"
                                                    name='company_name_ar'
                                                    value="{{ old('company_name_ar') ? old('company_name_ar') : null }}">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ============= company name EN============== --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="companyName">
                                                    @lang('front.EnglishName')
                                                    <strong class="text-danger">
                                                        *
                                                        @error('company_name_en')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <input type="text" class="form-control" placeholder="@lang('front.EnglishName')"
                                                    name='company_name_en'
                                                    value="{{ old('company_name_en') ? old('company_name_en') : null }}">
                                            </div>
                                        </div>
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
                                                    <option value=""selected> @lang('front.SelectCountry') </option>
                                                    @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                        <option value="{{ $diyarnaa_country->id }}"
                                                            @if (old('diyarnaa_country_id') != null) @if (old('diyarnaa_country_id') == $diyarnaa_country->id) selected @endif
                                                        @else @if ($diyarnaa_country->diyarnaa_country_id == $diyarnaa_country->id) selected @endif
                                                            @endif>
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span>{{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : '------' }}/span>
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
                                            <label for="state">@lang('front.City')
                                                <strong class="text-danger">
                                                    *
                                                    @error('diyarnaa_city_id')
                                                        -
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="hidden"
                                                value="{{ old('diyarnaa_city_id') ? old('diyarnaa_city_id') : null }}"
                                                id="diyarnaa_city_id_old_value">
                                            <select class="form-control" name="diyarnaa_city_id" id="diyarnaa_city_id">
                                                <option>@lang('front.SelectCity')</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- mobile --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="phone2">@lang('front.Mobile')
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

                                    {{-- عنوان الاعلان بالعربي --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title_ar">
                                                @lang('front.AdTitleInArabic')
                                                 <strong class="text-danger">
                                                    * @error('title_ar')
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="text" class="form-control" placeholder="@lang('front.AdTitleInArabic')"
                                                id=" title_ar" name="title_ar"
                                                value="{{ old('title_ar') ? old('title_ar') : null }}">
                                        </div>
                                    </div>


                                    {{-- عنوان الاعلان بالانجليزي --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title_en">
                                                @lang('front.AdTitleInEnglish')
                                                <strong class="text-danger">
                                                    * @error('title_en')
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="text" class="form-control"
                                                placeholder="@lang('front.AdTitleInEnglish')" id=" title_en" name="title_en"
                                                value="{{ old('title_en') ? old('title_en') : null }}">
                                        </div>
                                    </div>

                                    {{-- ======= صورة الاعلان =============== --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">@lang('front.AdImage')
                                                <span class="text-danger">(jpeg,png,jpg,gif,svg) ( Max-Size : 2MB )</span>
                                                <strong class="text-danger">
                                                    * @error('image')
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="file" class="form-control" id="image" name="image"
                                                accept="image/*">
                                        </div>
                                    </div>


                                    {{-- ======= صورة الترخيص =============== --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="license_image">@lang('front.LicenseImage')
                                                <span class="text-danger">(jpeg,png,jpg,gif,svg) ( Max-Size : 2MB )</span>
                                                <strong class="text-danger">
                                                    * @error('license_image')
                                                        {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="file" class="form-control" id="license_image"
                                                name="license_image" accept="image/*">
                                        </div>
                                    </div>

                                    {{-- =============== description AR============ --}}
                                    <div class="col-md-12 mb-3">
                                        <label for="description_ar"> @lang('front.AdDescriptionAr')
                                            <strong class="text-danger">
                                                @error('description_ar')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="description_ar" id="description_ar" cols="30" rows="5" class="form-control">{{ old('description_ar') ? old('description_ar') : null }}</textarea>
                                    </div>
                                    {{-- =============== description EN============ --}}
                                    <div class="col-md-12 mb-3">
                                        <label for="description_en">@lang('front.AdDescriptionEn')
                                            <strong class="text-danger">
                                                @error('description_en')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="description_en" id="description_en" cols="30" rows="5" class="form-control">{{ old('description_en') ? old('description_en') : null }}</textarea>
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

    <script></script>
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
                      //  var selectCity = '<option value="">اختر المحافظة... </option>';
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
                      //  $('#diyarnaa_city_id').html('<option value="">لا يوجد محافظات... </option>');
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
@endsection
