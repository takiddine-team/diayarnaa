@extends('admin.layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>اضافة </h1>
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
                            <li class="breadcrumb-item" aria-current="page">اضافة </li>
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
                                        <form id="createForm" action="{{ route('super_admin.users-store') }}" method="POST"
                                            enctype="multipart/form-data">
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
                                                                @if (old('user_type') == 1) selected @endif>مكتب عقاري
                                                            </option>
                                                            <option value="2"
                                                                @if (old('user_type') == 2) selected @endif>مالك عقار
                                                            </option>
                                                            <option value="3"
                                                                @if (old('user_type') == 3) selected @endif>باحث مميز
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- الاسم  --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="username"> الاسم :
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
                                                            value="{!! old('name') ? old('name') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- Last Name  --}}
                                                <div class="col-md-6" id="last_name_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="last_name">الإسم
                                                        الاخير:
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
                                                            value="{!! old('last_name') ? old('last_name') : null !!}">
                                                    </div>
                                                </div>


                                                {{-- البريد الالكتروني --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="email"> البريد
                                                        الالكتروني:
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
                                                            value="{!! old('email') ? old('email') : null !!}">
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
                                                            value="{!! old('phone') ? old('phone') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- هاتف المكتب --}}
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
                                                            value="{!! old('office_phone') ? old('office_phone') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- الدولة --}}
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="diyarnaa_country_id">الدولة
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
                                                            <option value="" selected>الدولة ...
                                                            </option>
                                                            @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                                @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                                    <option value="{{ $diyarnaa_country->id }}"
                                                                        @if (old('diyarnaa_country_id') != null) @if (old('diyarnaa_country_id') == $diyarnaa_country->id) selected @endif
                                                                    @else
                                                                        @if ($diyarnaa_country->diyarnaa_country_id == $diyarnaa_country->id) selected @endif
                                                                        @endif>

                                                                        {{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : '------' }}

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
                                                    <input type="hidden" value="{{ old('diyarnaa_city_id') }}"
                                                        id="diyarnaa_city_id_old_value">
                                                    <select name="diyarnaa_city_id" id="diyarnaa_city_id"
                                                        onchange="getDiyarnaaRegions()"
                                                        class=" diyarnaa_city_id custom-select my-1 mr-sm-2 @error('diyarnaa_city_id') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
                                                        <option value="">المدينة..</option>
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
                                                    <input type="hidden" value="{{ old('diyarnaa_region_id') }}"
                                                        id="diyarnaa_region_id_old_value">
                                                    <select name="diyarnaa_region_id" id="diyarnaa_region_id"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%"
                                                        class=" mb-3 customInput diyarnaa_region_id custom-select my-1 mr-sm-2 @error('diyarnaa_region_id') is-invalid @enderror form-control">
                                                        <option value="">المنطقة..</option>
                                                    </select>
                                                </div>

                                                {{-- Profile Image --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="profile_image">صورة الحساب :
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
                                                </div>


                                                {{-- الشارع --}}
                                                <div class="col-md-6" id="street_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="street">
                                                        الشارع: <strong class="text-danger">
                                                            @error('street')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" name="street"
                                                            class="form-control @error('street') is-invalid @enderror"
                                                            id="street" placeholder=" الشارع"
                                                            value="{{ old('street') }}">
                                                    </div>
                                                </div>

                                                {{-- الرقم السري  --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="password">
                                                        الرقم السري : <strong class="text-danger">
                                                            *
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


                                                {{-- تأكيد الرقم لسري  --}}
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
                                                                @if (old('status') == 4) selected @endif>مفعل
                                                            </option>
                                                            <option value="5"
                                                                @if (old('status') == 5) selected @endif>غير مفعل
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- صورة الترخيص التجاري --}}
                                                <div class="col-md-6 mb-3" id="license_image_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="license_image">
                                                        صورة الترخيص التجاري :
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
                                                </div>



                                                {{-- معلومات إضافية --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="additional_information">
                                                        معلومات إضافية: <strong class="text-danger">
                                                            @error('additional_information')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="additional_information" class="form-control ckeditor" rows="5"
                                                            id='additional_information'>{{ old('additional_information') ? old('additional_information') : null }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- صلاحية الحساب   --}}
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
                                                            id="expire_date" placeholder="expier date"
                                                            value="{!! old('expire_date') ? old('expire_date') : null !!}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <button class="mdi btn btn-primary" type="submit"><span
                                                            class="mdi mdi-plus"></span>إضافة</button>
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
                getDiyarnaaCities();

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
                            var selectCity = '<option value="">اختر مدينة... </option>';
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
                            $('#diyarnaa_city_id').html('<option value="">لا يوجد مدن... </option>');
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
                            var selectRegion = '<option value="">اختر منطقة ... </option>';
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
                            var selectRegion = '<option value="">اختر منطقة ... </option>';
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
