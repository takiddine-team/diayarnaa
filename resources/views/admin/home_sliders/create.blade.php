@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('resources/dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('resources/dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>اضافة سلايدر </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.home_sliders-index') }}">
                                    <span class="fa fa-th"></span> سلايدرات
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">اضافة سلايدر </li>
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
                                        <form id="createForm" action="{{ route('super_admin.home_sliders-store') }}"
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
                                                                @if (old('user_type') == 1) selected @endif>شركة
                                                            </option>
                                                            <option value="2"
                                                                @if (old('user_type') == 2) selected @endif> مكتب
                                                            </option>
                                                          
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Company name EN --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="company_name_en"> اسم الشركة بالانجليزي :
                                                        <strong class="text-danger">
                                                            *
                                                            @error('company_name_en')
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
                                                        <input type="text" name="company_name_en"
                                                            class="form-control @error('company_name_en') is-invalid @enderror"
                                                            id="company_name_en" placeholder="اسم الشركة بالانجليزي"
                                                            value="{!! old('company_name_en') ? old('company_name_en') : null !!}">
                                                    </div>
                                                </div>
                                                {{-- Company name AR --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="company_name_ar"> اسم الشركة بالعربي :
                                                        <strong class="text-danger">
                                                            *
                                                            @error('company_name_ar')
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
                                                        <input type="text" name="company_name_ar"
                                                            class="form-control @error('company_name_ar') is-invalid @enderror"
                                                            id="company_name_ar" placeholder="اسم الشركة بالعربي"
                                                            value="{!! old('company_name_ar') ? old('company_name_ar') : null !!}">
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


                                                 {{-- العنوان بالانجليزي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="title_en"> العنوان بالانجليزي :
                                                        <strong class="text-danger">
                                                            *
                                                            @error('title_en')
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
                                                        <input type="text" name="title_en"
                                                            class="form-control @error('title_en') is-invalid @enderror"
                                                            id="title_en" placeholder="العنوان بالانجليزي"
                                                            value="{!! old('title_en') ? old('title_en') : null !!}">
                                                    </div>
                                                </div>
                                                {{-- العنوان بالعربي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="title_ar"> العنوان بالعربي :
                                                        <strong class="text-danger">
                                                            *
                                                            @error('title_ar')
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
                                                        <input type="text" name="title_ar"
                                                            class="form-control @error('title_ar') is-invalid @enderror"
                                                            id="title_ar" placeholder="العنوان بالعربي "
                                                            value="{!! old('title_ar') ? old('title_ar') : null !!}">
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

                                                 {{--  Image --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="image">صورة  :
                                                        <strong class="text-danger">
                                                            @error('image')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="image" class="form-control"
                                                            id="image">
                                                    </div>
                                                </div>

                                                 {{--  License Image --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="license_image">صورة الترخيص :
                                                        <strong class="text-danger">
                                                            @error('license_image')
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

                                                
                                                  {{-- صلاحية    --}}
                                                <div class="col-md-6" id="expire_date_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="expire_date">
                                                        الصلاحية  :
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
                                                            id="expire_date" placeholder="الصلاحية"
                                                            value="{!! old('expire_date') ? old('expire_date') : null !!}">
                                                    </div>
                                                </div>
                                                {{--   وصف بالانجليزي: --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="description_en">
                                                         وصف بالانجليزي: <strong class="text-danger">
                                                            @error('description_en')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="description_en" class="form-control ckeditor" rows="5"
                                                            id='description_en'>{{ old('description_en') ? old('description_en') : null }}</textarea>
                                                    </div>
                                                </div>
                                                {{--   وصف بالعربي: --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="description_ar">
                                                         وصف بالعربي: <strong class="text-danger">
                                                            @error('description_ar')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="description_ar" class="form-control ckeditor" rows="5"
                                                            id='description_ar'>{{ old('description_ar') ? old('description_ar') : null }}</textarea>
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
                    url: "{{ route('super_admin.home_sliders-getDiyarnaaCities') }}",
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
                        }else{
                            var selectCity = '<option value="">اختر مدينة... </option>';
                            $('#diyarnaa_city_id').html(selectCity);
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
                        }else{
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
