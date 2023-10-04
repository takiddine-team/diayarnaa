@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('resources/dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('resources/dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- =========================================================== --}}
            {{-- ====================== Sweet Alert ======================== --}}
            {{-- =========================================================== --}}
            <div>
                @if (session()->has('success'))
                    <script>
                        swal("Great Job !!!", "{!! Session::get('success') !!}", "success", {
                            button: "OK",
                        });
                    </script>
                @endif
                @if (session()->has('danger'))
                    <script>
                        swal("Oops !!!", "{!! Session::get('danger') !!}", "error", {
                            button: "Close",
                        });
                    </script>
                @endif
            </div>
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>تعديل </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.users-index') }}">
                                    <span class="fa fa-th"></span> المستخدمين
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">تعديل </li>
                        </ol>
                    </nav>
                </div>

                <div class="content-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                                    </div>
                                    <div class="card-body">
                                        <form id="createForm"
                                            action="{{ route('super_admin.users-update', isset($user->id) ? $user->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">


                                                {{-- نوع المستخدم --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3" for="user_type">نوع
                                                        المستخدم : <strong class="text-danger"> *
                                                            @error('user_type')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="user_type"
                                                            class="custom-select my-1 mr-sm-2 content-creator @error('user_type') is-invalid @enderror"
                                                            id="user_type">
                                                            <option value="" selected>نوع المستخدم...</option>
                                                            <option value="1"
                                                                @if (isset($user->user_type) && $user->user_type == 'Real Estate Office') selected @endif>مكتب عقاري
                                                            </option>
                                                            <option value="2"
                                                                @if (isset($user->user_type) && $user->user_type == 'Real Estate Owner') selected @endif>مالك عقار
                                                            </option>
                                                            <option value="3"
                                                                @if (isset($user->user_type) && $user->user_type == 'Real Estate Seeker') selected @endif>باحث مميز
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Name  --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="username"> الإسم
                                                        <strong class="text-danger">
                                                            *
                                                            @error('name')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="username" placeholder="الاسم"
                                                            value="{{ isset($user->name) ? $user->name : null }}">
                                                    </div>
                                                </div>

                                                {{-- Last Name  --}}
                                                <div class="col-md-6" id="last_name_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="last_name">الاسم
                                                        الاخير
                                                        <strong class="text-danger">
                                                            *
                                                            @error('last_name')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="last_name"
                                                            class="form-control @error('last_name') is-invalid @enderror"
                                                            id="last_name" placeholder="الإسم الاخير"
                                                            value="{{ isset($user->last_name) ? $user->last_name : null }}">
                                                    </div>
                                                </div>


                                                {{-- Email --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="email"> البريد
                                                        الالكتروني
                                                        <strong class="text-danger">
                                                            *
                                                            @error('email')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="email" name="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" placeholder="البريد الالكتروني"
                                                            value="{{ isset($user->email) ? $user->email : null }}">
                                                    </div>
                                                </div>

                                                {{-- Phone --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="phone"> رقم
                                                        هاتف :
                                                        <strong class="text-danger">
                                                            *
                                                            @error('phone')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="phone" name="phone"
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            id="phone" placeholder="رقم هاتف"
                                                            value="{{ isset($user->phone) ? $user->phone : null }}">
                                                    </div>
                                                </div>

                                                {{-- Office Phone --}}
                                                <div class="col-md-6" id="office_phone">
                                                    <label class="text-dark font-weight-medium mb-3" for="office_phone">
                                                        هاتف المكتب : <strong class="text-danger">
                                                            *
                                                            @error('office_phone')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="office_phone" name="office_phone"
                                                            class="form-control @error('office_phone') is-invalid @enderror"
                                                            id="office_phone" placeholder="هاتف المكتب"
                                                            value="{{ isset($user->office_phone) ? $user->office_phone : null }}">
                                                    </div>
                                                </div>

                                                {{-- الدول --}}
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="diyarnaa_country_id">الدول
                                                            <strong class="text-danger">* @error('diyarnaa_country_id')
                                                                    ( {{ $message }} )
                                                                @enderror
                                                            </strong>
                                                        </label>
                                                        <select name="diyarnaa_country_id" id="diyarnaa_country_id"
                                                            onchange="getDiyarnaaCities()"
                                                            class="diyarnaa_country_id custom-select my-1 mr-sm-2 @error('diyarnaa_country_id') is-invalid @enderror form-control"
                                                            data-live-search="true" data-width="88%"
                                                            data-actions-box="true" style="width: 100%">
                                                            <option value="" selected>الدول ...
                                                            </option>
                                                            @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                                @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                                    <option value="{{ $diyarnaa_country->id }}"
                                                                        @if (old('diyarnaa_country_id') != null) @if (old('diyarnaa_country_id') == $diyarnaa_country->id) selected @endif
                                                                    @else
                                                                        @if ($user->diyarnaa_country_id == $diyarnaa_country->id) selected @endif
                                                                        @endif>

                                                                        @if (Config::get('app.locale') == 'ar')
                                                                            {{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : '------' }}
                                                                        @elseif (Config::get('app.locale') == 'en')
                                                                            {{ isset($diyarnaa_country->name_en) ? $diyarnaa_country->name_en : '------' }}
                                                                        @endif

                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- مدينة --}}
                                                <div class="col-md-6 mb-3" id="diyarnaa_city_id_box">

                                                    <label for="diyarnaa_city_id">
                                                        مدينة :
                                                        <strong class="text-danger">* @error('diyarnaa_city_id')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    @if (old('diyarnaa_city_id'))
                                                        <input type="hidden" value="{{ old('diyarnaa_city_id') }}"
                                                            id="diyarnaa_city_id_old_value">
                                                    @else
                                                        <input type="hidden" value="{{ $user->diyarnaa_city_id }}"
                                                            id="diyarnaa_city_id_old_value">
                                                    @endif
                                                    <select name="diyarnaa_city_id" id="diyarnaa_city_id"
                                                        onchange="getDiyarnaaRegions()"
                                                        class=" diyarnaa_city_id custom-select my-1 mr-sm-2 @error('diyarnaa_city_id') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
                                                        <option value="">City..</option>


                                                    </select>
                                                </div>

                                                {{-- المنطقة --}}
                                                <div class="selectedMethod col-md-6 mb-3" id="diyarnaa_region_id_box">
                                                    <label for="diyarnaa_region_id">
                                                        المنطقة :
                                                        <strong class="text-danger">
                                                            @error('diyarnaa_region_id')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    @if (old('diyarnaa_region_id'))
                                                        <input type="hidden" value="{{ old('diyarnaa_region_id') }}"
                                                            id="diyarnaa_region_id_old_value">
                                                    @else
                                                        <input type="hidden" value="{{ $user->diyarnaa_region_id }}"
                                                            id="diyarnaa_region_id_old_value">
                                                    @endif
                                                    <select name="diyarnaa_region_id" id="diyarnaa_region_id"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%"
                                                        class=" mb-3 customInput diyarnaa_region_id custom-select my-1 mr-sm-2 @error('diyarnaa_region_id') is-invalid @enderror form-control">
                                                        <option value="">اختر المنطقة </option>
                                                    </select>
                                                </div>

                                                {{-- Profile Image --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="profile_image">
                                                        صورة الحساب :
                                                        <strong class="text-danger">
                                                            @error('profile_image')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="profile_image" class="form-control"
                                                            id="profile_image">
                                                    </div>
                                                    @if (isset($user->profile_image) &&
                                                        $user->getRawOriginal('profile_image') &&
                                                        file_exists($user->getRawOriginal('profile_image')))
                                                        <img src="{{ asset($user->profile_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('profile_image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>


                                                {{-- الشارع --}}
                                                <div class="col-6" id="street_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="street">
                                                        الشارع: <strong class="text-danger">
                                                            @error('street')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <input type="text" name="street"
                                                            class="form-control @error('street') is-invalid @enderror"
                                                            id="street" placeholder=" الشارع"
                                                            value="{{ isset($user->street) ? $user->street : null }}">
                                                    </div>
                                                </div>

                                                {{-- User Password  --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="password">
                                                        الرقم السري : <strong class="text-danger">

                                                            @error('password')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="password" name="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            id="password" placeholder="الرقم السري">
                                                    </div>
                                                </div>


                                                {{-- Confirm Password  --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="Rpassword">تأكيد
                                                        الرقم السري : <strong class="text-danger">
                                                            @error('password_confirmation')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                                            id="Rpassword" placeholder="تأكيد الرقم السري">
                                                    </div>
                                                </div>


                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">الحالة : <strong class="text-danger"> *
                                                            @error('status')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="status"
                                                            class="custom-select my-1 mr-sm-2 @error('status') is-invalid @enderror"
                                                            id="inlineFormCustomSelectPref">
                                                            <option value="" selected>اختر الحالة...</option>
                                                            <option value="4"
                                                                @if ($user->status == 'Active') selected @endif>مفعل
                                                            </option>
                                                            <option value="5"
                                                                @if ($user->status == 'Inactive') selected @endif>غير مفعل
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- License Image --}}
                                                <div class="col-md-6 mb-3" id="license_image_div">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="license_image">صورة الترخيص التجاري :
                                                        <strong class="text-danger">
                                                            * @error('license_image')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="license_image" class="form-control"
                                                            id="license_image">
                                                    </div>
                                                    @if (isset($user->license_image) &&
                                                        $user->getRawOriginal('license_image') &&
                                                        file_exists($user->getRawOriginal('license_image')))
                                                        <img src="{{ asset($user->license_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('license_image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>



                                                {{-- معلومات اضافية --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="additional_information">
                                                        معلومات اضافية: <strong class="text-danger">
                                                            @error('additional_information')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="additional_information" class="form-control ckeditor" rows="5"
                                                            id='additional_information'>{{ isset($user->additional_information) ? $user->additional_information : null }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- Expiry Date   --}}
                                                <div class="col-md-6" id="expire_date_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="expire_date">
                                                        صلاحية الحساب :
                                                        <strong class="text-danger">
                                                            *
                                                            @error('expire_date')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="date" name="expire_date"
                                                            class="form-control @error('expire_date') is-invalid @enderror"
                                                            id="expire_date" placeholder="صلاحية الحساب"
                                                            value="{!! isset($user->expire_date) ? $user->expire_date : null !!}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <button class="mdi btn btn-primary" type="submit"><span
                                                            class="mdi mdi-plus"></span>تعديل</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                getType();
            });

            $('#user_type').on('change', function() {
                getType();
            });

            function getType() {
                if ($('#user_type').val() == 1) {

                    $("#expire_date_div").css("display", "block");
                    $("#office_phone").css("display", "block");
                    $("#last_name_div").css("display", "none");
                    $("#street_div").css("display", "none");
                    $("#license_image_div").css("display", "block");

                } else {

                    $("#expire_date_div").css("display", "none");
                    $("#office_phone").css("display", "none");
                    $("#last_name_div").css("display", "block");
                    $("#street_div").css("display", "block");
                    $("#license_image_div").css("display", "none");
                }
            }
        </script>
    @endsection

    @section('admin_javascript')
        <script>
            $(document).ready(function() {


                setTimeout(() => {
                    getDiyarnaaCities();

                }, 500);
                setTimeout(() => {
                    getDiyarnaaRegions();

                }, 1000);


            });


            function getDiyarnaaCities() {
                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.users-getDiyarnaaCities') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true) {
                            var selectCity = '<option value="">اختر مدينة ... </option>';
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
                                                .name_ar + '</option>';
                                        } else {
                                            selectCity += '<option value="' + obj.id + '">' + obj.name_ar +
                                                '</option>';
                                        }
                                    } else {
                                        selectCity += '<option value="' + obj.id + '">' + obj.name_ar +
                                            '</option>';
                                    }
                                    break;
                                }
                            }
                            $('#diyarnaa_city_id').html(selectCity);
                        } else {
                            $('#diyarnaa_city_id').html('<option value="">لا يوجد مدن ... </option>');
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
                    url: "{{ route('super_admin.users-getDiyarnaaRegions') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true) {
                            var selectRegion = '<option value="">اختر المنطقة ... </option>';
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
                                                .name_ar + '</option>';
                                        } else {
                                            selectRegion += '<option value="' + obj.id + '">' + obj.name_ar +
                                                '</option>';
                                        }
                                    } else {
                                        selectRegion += '<option value="' + obj.id + '">' + obj.name_ar +
                                            '</option>';
                                    }
                                    break;
                                }
                            }
                            $('#diyarnaa_region_id').html(selectRegion);
                        } else {
                            $('#diyarnaa_region_id').html('<option value="">لا يوجد مناطق ... </option>');
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
