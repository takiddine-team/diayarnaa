@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div class="col-md-12">
                    <h1> تعديل السلايدر</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.home_sliders-index') }}">
                                    <i class="fas fa-users-cog"></i> قائمة السلايدرات
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">تعديل</li>
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
                                            action="{{ route('super_admin.home_sliders-update', isset($home_slider->id) ? $home_slider->id : -1) }}"
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
                                                                @if (isset($home_slider->user_type) && $home_slider->user_type == 'Company') selected @endif>شركة
                                                            </option>
                                                            <option value="2"
                                                                @if (isset($home_slider->user_type) && $home_slider->user_type  == 'Office') selected @endif> مكتب
                                                            </option>

                                                        </select>
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
                                                                @if (isset($home_slider->status)  && $home_slider->status == 'Active') selected @endif> مفعل
                                                            </option>
                                                            <option value="5"
                                                                @if (isset($home_slider->status)  && $home_slider->status == 'Inactive') selected @endif>غير مفعل
                                                            </option>


                                                        </select>
                                                    </div>
                                                </div>


                                                {{-- Company name EN --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="company_name_ar">
                                                        اسم الشركة بالانجليزي :
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
                                                            value="{{ isset($home_slider->company_name_en) ? $home_slider->company_name_en : null }}">
                                                    </div>
                                                </div>
                                                {{-- Company name AR --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="company_name_ar">
                                                        اسم الشركة بالعربي :
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
                                                            value="{{ isset($home_slider->company_name_ar) ? $home_slider->company_name_ar : null }}">
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
                                                            value="{{ isset($home_slider->phone) ? $home_slider->phone : null }}">
                                                    </div>
                                                </div>

                                                {{-- البريد الالكتروني --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="email">
                                                        البريد
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
                                                            value="{{ isset($home_slider->email) ? $home_slider->email : null }}">
                                                    </div>
                                                </div>


                                                {{-- العنوان بالانجليزي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="title_en">
                                                        العنوان بالانجليزي :
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
                                                           value="{{ isset($home_slider->title_en) ? $home_slider->title_en : null }}">
                                                    </div>
                                                </div>
                                                {{-- العنوان بالعربي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="title_ar">
                                                        العنوان بالعربي :
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
                                                            value="{{ isset($home_slider->title_ar) ? $home_slider->title_ar : null }}">
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
                                                                        @if ($home_slider->diyarnaa_country_id == $diyarnaa_country->id) selected @endif
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
                                                    <input type="hidden" value="{{ $home_slider->diyarnaa_city_id }}"
                                                        id="diyarnaa_city_id_old_value">
                                                    <select name="diyarnaa_city_id" id="diyarnaa_city_id"
                                                        class=" diyarnaa_city_id custom-select my-1 mr-sm-2 @error('diyarnaa_city_id') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
                                                        <option value="">City..</option>
                                                    </select>
                                                </div>

                                               

                                                {{--  Image --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="image">
                                                        صورة :
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
                                                    @if (isset($home_slider->image) && $home_slider->getRawOriginal('image') && file_exists($home_slider->getRawOriginal('image')))
                                                        <img src="{{ asset($home_slider->image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>

                                                {{-- License Image --}}
                                                <div class="col-md-6 mb-3" id="license_image_div">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="license_image">صورة الترخيص :
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
                                                    @if (isset($home_slider->license_image) &&
                                                        $home_slider->getRawOriginal('license_image') &&
                                                        file_exists($home_slider->getRawOriginal('license_image')))
                                                        <img src="{{ asset($home_slider->license_image) }}" width="100"
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

                                                 {{-- الصلاحية  --}}
                                                <div class="col-md-6" id="expire_date_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="expire_date">
                                                        الصلاحية:
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
                                                            id="expire_date" placeholder="تاريخ انتهاء "
                                                            value="{!! isset($home_slider->expire_date) ? $home_slider->expire_date : null !!}">
                                                    </div>
                                                </div>


                                                {{--   وصف بالانجليزي: --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="description_en">
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
                                                            id='description_en'>{!! isset($home_slider->description_en) ? $home_slider->description_en : null !!}</textarea>
                                                    </div>
                                                </div>
                                                {{--   وصف بالعربي: --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="description_ar">
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
                                                            id='description_ar'>{!! isset($home_slider->description_ar) ? $home_slider->description_ar : null !!}</textarea>
                                                    </div>
                                                </div>

                                               

                                            </div>
                                            <div class="col-md-12 mb-3">

                                                <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
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
                        }else{
                            var selectCity = '<option value="">اختر مدينة ... </option>';
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
    @endsection
