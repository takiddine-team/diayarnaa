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
                <h2>@lang('front.BrokerRequest') </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.WelcomePage')</a>
                >> <span>@lang('front.BrokerRequest')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== login section =============== --}}
            {{-- =========================================================== --}}
            <section class="login signUp mt-5 pt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form action="{{ route('WebsiteBrokerRequest') }}" class="loginForm signUpForm" id="createForm"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mx-auto mb-5 formHead text-center">
                                        <h2 class="mainColor">
                                            @lang('front.BrokerRequest') </h2>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name">@lang('front.Name')
                                            * <strong class="text-danger">
                                                @error('name')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" id="name" id="name"
                                            name="name" value="{{ old('name') ? old('name') : '' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">@lang('front.LastName')
                                            * <strong class="text-danger">
                                                @error('last_name')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            id="last_name" value={{ old('last_name') ? old('last_name') : '' }}>
                                    </div>
                                    {{-- Country --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="diyarnaa_country_id">@lang('front.CountryName')
                                                * <strong class="text-danger">
                                                    @error('diyarnaa_country_id')
                                                        - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <select class="form-control" name="diyarnaa_country_id" id="diyarnaa_country_id"
                                                onchange="getDiyarnaaCities()">
                                                @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                    <option value=""selected> @lang('front.SelectCountry')</option>
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
                                            <label for="diyarnaa_city_id">@lang('front.State')
                                                * <strong class="text-danger">
                                                    @error('diyarnaa_city_id')
                                                        - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="hidden" value="{{ old('diyarnaa_city_id') }}"
                                                id="diyarnaa_city_id_old_value">
                                            <select class="form-control" name="diyarnaa_city_id" id="diyarnaa_city_id">
                                                <option value="1">@lang('front.StateSelect')</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="email">@lang('front.Email')
                                            * <strong class="text-danger">
                                                @error('email')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="email" id="email" class="form-control" name="email"
                                            value={{ old('email') ? old('email') : '' }}>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone">@lang('front.Phone')
                                            * <strong class="text-danger">
                                                @error('phone')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value={{ old('phone') ? old('phone') : '' }}>
                                    </div>


                                    <div class="col-md-12 mb-3">
                                        <label for="details">
                                            @lang('front.Details')
                                            * <strong class="text-danger">
                                                @error('details')
                                                    - {{ $message }}
                                                @enderror
                                        </label>
                                        <textarea name="details" id="details" cols="30" rows="5" class="form-control">{{ old('details') ? old('details') : '' }}</textarea>
                                    </div>

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
@endsection
@section('javascript')
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
                        var selectCity = '<option value=""> @lang('front.StateSelect')... </option>';
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
                        $('#diyarnaa_city_id').html('<option value=""> @lang('front.NoState') ... </option>');
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
