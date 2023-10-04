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
                    <h1> تعديل الاعلان </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.advertisements-index') }}">
                                    <span class="fa fa-th"></span> الاعلانات
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
                                            action="{{ route('super_admin.advertisements-update', isset($advertisement->id) ? $advertisement->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{ $advertisement->user->user_type }}" name="user_type">
                                            <div class="form-row">
                                                {{--  العنوان بالعربي --}}
                                                <div class="col-md-6" id="title_ar_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="title_ar">
                                                        العنوان بالعربي: <strong class="text-danger">
                                                            * @error('title_ar')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" name="title_ar"
                                                            class="form-control @error('title_ar') is-invalid @enderror"
                                                            id="title_ar" placeholder=" العنوان بالعربي"
                                                            value="{{ isset($advertisement->title_ar) ? $advertisement->title_ar : null }}">
                                                    </div>
                                                </div>

                                                {{--  العنوان بالانجليزي --}}
                                                <div class="col-md-6" id="title_en_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="title_en">
                                                        العنوان بالانجليزي: <strong class="text-danger">
                                                            * @error('title_en')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" name="title_en"
                                                            class="form-control @error('title_en') is-invalid @enderror"
                                                            id="title_en" placeholder=" العنوان بالانجليزي"
                                                            value="{{ isset($advertisement->title_en) ? $advertisement->title_en : null }}">
                                                    </div>
                                                </div>
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
                                                            id="user_type" onchange="getUsers()">
                                                            <option value="" selected>نوع المستخدم...</option>
                                                            @if (old('user_type'))
                                                                <option value="1"
                                                                    @if (old('user_type') && old('user_type') == 1) selected @endif>مكتب
                                                                    عقاري
                                                                </option>
                                                                <option value="2"
                                                                    @if (old('user_type') && old('user_type') == 2) selected @endif>مالك
                                                                    عقار
                                                                </option>
                                                               
                                                            @else
                                                                <option value="1"
                                                                    @if (isset($advertisement->user->user_type) && $advertisement->user->user_type == 'Real Estate Office') selected @endif>مكتب
                                                                    عقاري
                                                                </option>
                                                                <option value="2"
                                                                    @if (isset($advertisement->user->user_type) && $advertisement->user->user_type == 'Real Estate Owner') selected @endif>مالك
                                                                    عقار
                                                                </option>
                                                               
                                                            @endif

                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- صاحب الاعلان --}}
                                                <div class="col-md-6 mb-3" id="user_id_box">

                                                    <label for="user_id">صاحب الاعلان:
                                                        <strong class="text-danger">* @error('user_id')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ $advertisement->user_id }}"
                                                        id="user_id_old_value" name="user_id_old">
                                                    <select name="user_id" id="user_id"
                                                        class=" user_id custom-select my-1 mr-sm-2 @error('user_id') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%" onchange="getDiyarnaaCities()">
                                                        >
                                                        <option value=""> صاحب الاعلان..</option>

                                                    </select>
                                                </div>
                                                {{-- الغرض --}}
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="target_id">الغرض
                                                            <strong class="text-danger">* @error('target_id')
                                                                    ( {{ $message }} )
                                                                @enderror
                                                            </strong>
                                                        </label>
                                                        <select name="target_id" id="target_id"
                                                            class="target_id custom-select my-1 mr-sm-2 @error('target_id') is-invalid @enderror form-control"
                                                            data-live-search="true" data-width="88%" data-actions-box="true"
                                                            style="width: 100%">
                                                            <option value="" selected>اختر الغرض ...
                                                            </option>
                                                            @if (isset($advertisement->target_id))
                                                                @foreach ($targets as $target)
                                                                    <option value="{{ $target->id }}"
                                                                        {{ $target->id == $advertisement->target_id ? 'selected' : '' }}>
                                                                        {{ $target->name_ar }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- التصنيفات الرئيسية --}}
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="category_id">التصنيف الرئيسي
                                                            <strong class="text-danger">* @error('category_id')
                                                                    ( {{ $message }} )
                                                                @enderror
                                                            </strong>
                                                        </label>
                                                        <select name="category_id" id="category_id"
                                                            onchange="getSubCategories()"
                                                            class="category_id custom-select my-1 mr-sm-2 @error('category_id') is-invalid @enderror form-control"
                                                            data-live-search="true" data-width="88%"
                                                            data-actions-box="true" style="width: 100%">
                                                            <option value="" selected>التصنيف الرئيسي ...
                                                            </option>
                                                            @if (isset($categories) && $categories->count() > 0)
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        @if (old('category_id') != null) @if (old('category_id') == $category->id) selected @endif
                                                                    @else
                                                                        @if ($advertisement->main_category_id == $category->id) selected @endif
                                                                        @endif>

                                                                        {{ isset($category->name_ar) ? $category->name_ar : '------' }}

                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- التصنيف الفرعي --}}
                                                <div class="col-md-6 mb-3" id="sub_category_id_box">

                                                    <label for="sub_category_id">التصنيف الفرعي :
                                                        <strong class="text-danger">* @error('sub_category_id')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ $advertisement->sub_category_id }}"
                                                        id="sub_category_id_old_value" name="sub_category_id_old">
                                                    <select name="sub_category_id" id="sub_category_id"
                                                        class=" sub_category_id custom-select my-1 mr-sm-2 @error('sub_category_id') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%" onchange="getFeatureType()">
                                                        >
                                                        <option value="">التصنيف الفرعي..</option>

                                                    </select>
                                                </div>

                                                {{-- عمر البناء  --}}
                                                <div class="col-md-6 mb-3" id="construction_age_box"
                                                    style="display: none">

                                                    <label for="construction_age"> عمر البناء :
                                                        <strong class="text-danger">* @error('construction_age')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ old('construction_age') }}"
                                                        id="construction_age_old_value">
                                                    <select name="construction_age" id="construction_age"
                                                        class=" construction_age custom-select my-1 mr-sm-2 @error('construction_age') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
                                                        <option value=""> عمر البناء..</option>
                                                        @if (isset($construction_ages) && $construction_ages->count() > 0)
                                                            @foreach ($construction_ages as $construction_age)
                                                                <option value="{{ $construction_age->id }}"
                                                                    @if (old('construction_age') != null) @if (old('construction_age') == $construction_age->id) selected @endif
                                                                @else
                                                                    @if ($advertisement->construction_age == $construction_age->id) selected @endif
                                                                    @endif>

                                                                    {{ isset($construction_age->name_ar) ? $construction_age->name_ar : '------' }}

                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                {{-- مساحة الارض  --}}
                                                <div class="col-md-6 mb-3" id="land_area_box" style="display: none">

                                                    <label for="land_area"> مساحة الارض :
                                                        <strong class="text-danger">* @error('land_area')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ old('land_area') }}"
                                                        id="land_area_old_value">
                                                    <select name="land_area" id="land_area"
                                                        class=" land_area custom-select my-1 mr-sm-2 @error('land_area') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
                                                        <option value=""> مساحة الارض..</option>
                                                        @if (isset($land_areas) && $land_areas->count() > 0)
                                                            @foreach ($land_areas as $land_area)
                                                                <option value="{{ $land_area->id }}"
                                                                    @if (old('land_area') != null) @if (old('land_area') == $land_area->id) selected @endif
                                                                @else
                                                                    @if ($advertisement->land_area == $land_area->id) selected @endif
                                                                    @endif>

                                                                    {{ isset($land_area->name_ar) ? $land_area->name_ar : '------' }}

                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                {{-- حالة العقار --}}
                                                <div class="col-md-6 mb-3" id="real_estate_status_box"
                                                    style="display: none">

                                                    <label for="real_estate_status"> حالة العقار:
                                                        <strong class="text-danger">* @error('real_estate_status')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ old('real_estate_status') }}"
                                                        id="real_estate_status_old_value">
                                                    <select name="real_estate_status" id="real_estate_status"
                                                        class=" real_estate_status custom-select my-1 mr-sm-2 @error('real_estate_status') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
                                                        <option value=""> حالة العقار ..</option>
                                                        @if (isset($real_estate_statuses) && $real_estate_statuses->count() > 0)
                                                            @foreach ($real_estate_statuses as $real_estate_status)
                                                                <option value="{{ $real_estate_status->id }}"
                                                                    @if (old('real_estate_status') != null) @if (old('real_estate_status') == $real_estate_status->id) selected @endif
                                                                @else
                                                                    @if ($advertisement->real_estate_status == $real_estate_status->id) selected @endif
                                                                    @endif>

                                                                    {{ isset($real_estate_status->name_ar) ? $real_estate_status->name_ar : '------' }}

                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                {{-- عدد الغرف --}}
                                                <div class="col-md-6 mb-3" id="number_of_rooms_box"
                                                    style="display: none">

                                                    <label for="number_of_rooms"> عدد الغرف:
                                                        <strong class="text-danger">* @error('number_of_rooms')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ old('number_of_rooms') }}"
                                                        id="number_of_rooms_old_value">
                                                    <select name="number_of_rooms" id="number_of_rooms"
                                                        class=" number_of_rooms custom-select my-1 mr-sm-2 @error('number_of_rooms') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
                                                        <option value=""> عدد الغرف ..</option>
                                                        @if (isset($number_of_rooms) && $number_of_rooms->count() > 0)
                                                            @foreach ($number_of_rooms as $number_of_room)
                                                                <option value="{{ $number_of_room->id }}"
                                                                    @if (old('number_of_rooms') != null) @if (old('number_of_rooms') == $number_of_room->id) selected @endif
                                                                @else
                                                                    @if ($advertisement->number_of_rooms == $number_of_room->id) selected @endif
                                                                    @endif>

                                                                    {{ isset($number_of_room->name_ar) ? $number_of_room->name_ar : '------' }}

                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                {{-- عدد الحمامات --}}
                                                <div class="col-md-6 mb-3" id="number_of_bathrooms_box"
                                                    style="display: none">

                                                    <label for="number_of_bathrooms"> عدد الحمامات:
                                                        <strong class="text-danger">* @error('number_of_bathrooms')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ old('number_of_bathrooms') }}"
                                                        id="number_of_bathrooms_old_value">
                                                    <select name="number_of_bathrooms" id="number_of_bathrooms"
                                                        class=" number_of_bathrooms custom-select my-1 mr-sm-2 @error('number_of_bathrooms') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
                                                        <option value=""> عدد الحمامات ..</option>
                                                        @if (isset($number_of_bathrooms) && $number_of_bathrooms->count() > 0)
                                                            @foreach ($number_of_bathrooms as $number_of_bathroom)
                                                                <option value="{{ $number_of_bathroom->id }}"
                                                                    @if (old('number_of_bathrooms') != null) @if (old('number_of_bathrooms') == $number_of_bathroom->id) selected @endif
                                                                @else
                                                                    @if ($advertisement->number_of_bathrooms == $number_of_bathroom->id) selected @endif
                                                                    @endif>

                                                                    {{ isset($number_of_bathroom->name_ar) ? $number_of_bathroom->name_ar : '------' }}

                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                {{-- الدول --}}
                                                <div class="col-md-6 mb-3" id="diyarnaa_country_id_box">
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
                                                                        @if ($advertisement->diyarnaa_country_id == $diyarnaa_country->id) selected @endif
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
                                                    <input type="hidden" value="{{ $advertisement->diyarnaa_city_id }}"
                                                        id="diyarnaa_city_id_old_value" name="diyarnaa_city_id_old_value">
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
                                                            * @error('diyarnaa_region_id')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden"
                                                        value="{{ $advertisement->diyarnaa_region_id }}"
                                                        id="diyarnaa_region_id_old_value">
                                                    <select name="diyarnaa_region_id" id="diyarnaa_region_id"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%"
                                                        class=" mb-3 customInput diyarnaa_region_id custom-select my-1 mr-sm-2 @error('diyarnaa_region_id') is-invalid @enderror form-control">
                                                        <option value="">المنطقة..</option>
                                                    </select>
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
                                                            value="{{ isset($advertisement->street) ? $advertisement->street : null }}">
                                                    </div>
                                                </div>

                                                {{-- الخريطة --}}
                                                <div class="col-md-6" id="url_map_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="url_map">
                                                        الخريطة: <strong class="text-danger">
                                                            * @error('url_map')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="url" name="url_map"
                                                            class="form-control @error('url_map') is-invalid @enderror"
                                                            id="url_map" placeholder=" الخريطة"
                                                            value="{{ isset($advertisement->url_map) ? $advertisement->url_map : null }}">
                                                    </div>
                                                </div>
                                                {{-- السعر --}}
                                                <div class="col-md-6" id="price_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="price">
                                                        السعر: <strong class="text-danger">
                                                            * @error('price')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" min="0" name="price" 
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            id="price" placeholder=" السعر"
                                                            value="{{ isset($advertisement->price) ? $advertisement->price : null }}">
                                                    </div>
                                                </div>

                                                  {{--  نوع المساحة --}}
                                                  <div class="col-md-6 mb-3" >

                                                    <label class="text-dark font-weight-medium mb-3" for="area_type_id">  نوع المساحة:
                                                        <strong class="text-danger">* @error('area_type_id')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <select name="area_type_id" id="area_type_id"
                                                        class=" land_area custom-select my-1 mr-sm-2 @error('area_type_id') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 90% !important">
                                                        <option value="">  نوع المساحة..</option>
                                                        @if (isset($land_areas) && $land_areas->count() > 0)
                                                            @foreach ($land_areas as $area_type)
                                                                <option value="{{ $area_type->id }}"
                                                                    @if ($advertisement->area_type_id == $area_type->id) selected @endif>
                                                                    {{ isset($area_type->name_ar) ? $area_type->name_ar : '------' }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>





                                                {{-- المساحة --}}
                                                <div class="col-md-6" id="area_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="area">
                                                        المساحة: <strong class="text-danger">
                                                            * @error('area')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" min="0" name="area"
                                                            class="form-control @error('area') is-invalid @enderror"
                                                            id="area" placeholder="المساحة"
                                                            value="{{ isset($advertisement->area) ? $advertisement->area : null }}">
                                                    </div>
                                                </div>

                                                {{-- الصورة الرئيسية  --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="main_image">
                                                        الصورة الرئيسية :
                                                        <strong class="text-danger">
                                                            * @error('main_image')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="main_image" class="form-control"
                                                            id="main_image">
                                                    </div>
                                                    @if (isset($advertisement->main_image) &&
                                                            $advertisement->getRawOriginal('main_image') &&
                                                            file_exists($advertisement->getRawOriginal('main_image')))
                                                        <img src="{{ asset($advertisement->main_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif
                                                </div>
                                                {{-- video --}}
                                                <div class="col-md-6 mb-3" id="video_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="video">
                                                        فيديو:
                                                        <strong class="text-danger">
                                                            @error('video')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="video" class="form-control"
                                                            id="video">
                                                    </div>
                                                    @if (isset($advertisement->video) &&
                                                            $advertisement->getRawOriginal('video') &&
                                                            file_exists($advertisement->getRawOriginal('video')))

                                                        <video width="320" height="240" controls>
                                                            <source src="{{ URL::asset($advertisement->video) }}"
                                                                type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @else
                                                        <video width="320" height="240" controls>
                                                            <source src="{{ URL::asset($advertisement->video) }}"
                                                                type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                </div>
                                                {{-- صورة  اخرى --}}
                                                <div class="col-md-6 mb-3" id="other_image_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="other_image">
                                                        صورة أخرى :
                                                        <strong class="text-danger">
                                                            @error('other_image')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="images[]" class="form-control"
                                                            id="other_image" multiple>
                                                    </div>

                                                </div>


                                               



                                                @if ($advertisement->user->user_type == 'Real Estate Owner')
                                                      {{-- contact_method --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">  @lang("front.ContactMethod")  : <strong class="text-danger">
                                                            * @error('contact_method')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="contact_method"
                                                            class="custom-select my-1 mr-sm-2 @error('contact_method') is-invalid @enderror"
                                                            id="inlineFormCustomSelectPref">
                                                            <option value="" selected>اختر طريقة التواصل...</option>
                                                            <option value="1"
                                                                @if ($advertisement->contact_method ==   @trans("front.Mobile")) selected @endif>@trans("front.Mobile")
                                                            </option>
                                                            <option value="2"
                                                                @if ($advertisement->contact_method == @trans("front.Whatsapp")) selected @endif> @trans("front.Whatsapp")
                                                            </option>
                                                            <option value="3"
                                                                @if ($advertisement->contact_method == @trans("front.Email")) selected @endif> @trans("front.Email") 
                                                            </option>
                                                            <option value="4"
                                                            @if ($advertisement->contact_method == @trans("front.EmailOrWhatsappOrMobile")) selected @endif> @trans("front.EmailOrWhatsappOrMobile")
                                                        </option>

                                                        </select>
                                                    </div>
                                                </div>
                                                @else
                                                 {{-- مرجع الاعلان --}}
                                                 <div class="col-md-6" id="ad_reference_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="ad_reference">
                                                        مرجع الاعلان: <strong class="text-danger">
                                                            * @error('ad_reference')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" name="ad_reference"
                                                            class="form-control @error('ad_reference') is-invalid @enderror"
                                                            id="ad_reference" placeholder=" مرجع الاعلان"
                                                            value="{{ isset($advertisement->ad_reference) ? $advertisement->ad_reference : null }}">
                                                    </div>
                                                </div>
                                                @endif
                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">الحالة : <strong class="text-danger">
                                                            * @error('status')
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
                                                                @if ($advertisement->status == 'Active') selected @endif>مفعل
                                                            </option>
                                                            <option value="5"
                                                                @if ($advertisement->status == 'Inactive') selected @endif>غير مفعل
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>
                                                {{--  الموقع --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="address">
                                                        الموقع: <strong class="text-danger">
                                                            * @error('address')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="address" class="form-control ckeditor" rows="5" id='address'>{{ $advertisement->address }}</textarea>
                                                    </div>
                                                </div>

                                                {{--  الصيغة العقارية --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="real_estate_formula">
                                                        الصيغة العقارية : <strong class="text-danger">
                                                            * @error('real_estate_formula')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="real_estate_formula" class="form-control ckeditor" rows="5"
                                                            id='real_estate_formula'>{{ isset($advertisement->real_estate_formula) ? $advertisement->real_estate_formula : null }}</textarea>
                                                    </div>
                                                </div>


                                                {{-- الوصف بالعربي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="description_ar">الوصف بالعربي: <strong class="text-danger">
                                                            * @error('description_ar')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="description_ar" class="form-control ckeditor" rows="5"
                                                            id='description_ar'>{{ isset($advertisement->description_ar) ? $advertisement->description_ar : null }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- الوصف بالانجليزي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="description_en">الوصف بالانجليزي: <strong
                                                            class="text-danger">
                                                            * @error('description_en')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="description_en" class="form-control ckeditor" rows="5"
                                                            id='description_en'>{{ isset($advertisement->description_en) ? $advertisement->description_en : null }}</textarea>
                                                    </div>
                                                </div>


                                                {{-- صلاحية الاعلان   --}}
                                                <div class="col-md-6" id="expiry_date_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="expiry_date">
                                                        صلاحية الاعلان :
                                                        <strong class="text-danger">
                                                            *
                                                            @error('expiry_date')
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
                                                        <input type="date" name="expiry_date"
                                                            class="form-control @error('expiry_date') is-invalid @enderror"
                                                            id="expiry_date" placeholder="expier date"
                                                            value="{{ isset($advertisement->expiry_date) ? $advertisement->expiry_date : null }}">
                                                    </div>
                                                </div>

                                                {{-- الميزة بالإنجليزي --}}
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-row">
                                                        <div id="buildyourform">
                                                            @if (isset($advertisement->extraFeatures) && $advertisement->extraFeatures->count() > 0)
                                                                @foreach ($advertisement->extraFeatures as $extraFeature)
                                                                    <div class="input-group fieldwrapper  col-md-12 mb-3"
                                                                        id="field1"><label style="padding:9px"
                                                                            class="text-dark font-weight-medium mb-3 ">
                                                                            الميزة
                                                                            بالإنجليزي : </label>
                                                                        <input placeholder="الميزة بالإنجليزي "
                                                                            type="text" name="feature_en[]"
                                                                            class="fieldname form-control"
                                                                            value="{{ isset($extraFeature->title_en) ? $extraFeature->title_en : null }}"><label
                                                                            style="padding:9px"
                                                                            class="text-dark font-weight-medium mb-3 ">
                                                                            الميزة
                                                                            بالعربي : </label>

                                                                        <input placeholder=" الميزة بالعربي"
                                                                            type="text" name="feature_ar[]"
                                                                            style="margin-right: 10px"
                                                                            class="fieldname form-control"
                                                                            value="{{ isset($extraFeature->title_ar) ? $extraFeature->title_ar : null }}">
                                                                        <input type="button"
                                                                            onclick=this.parentNode.parentNode.removeChild(this.parentNode)
                                                                            class="remove mdi btn btn-primary"
                                                                            value="-"><br>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <button class="mdi btn btn-primary" type="button"
                                                        id='add'><span class="mdi mdi-plus"></span>
                                                        اضافة ميزة جديدة</button>


                                                    <button class="mdi btn btn-primary" type="button"
                                                        onclick="allAreNull()"><span class="mdi mdi-plus"></span>تعديل
                                                        الاعلان </button>
                                                </div>
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
    @endsection

    @section('admin_javascript')
        <script>
            $(document).ready(function() {
                getCountry();
                getUsers();
                getDiyarnaaCities();
                setTimeout(() => {
                    getDiyarnaaRegions();
                    getSubCategories();
                    getFeatureType();
                }, 500);
            });

            $('#user_type').on('change', function() {
                getCountry();
            });

            function getCountry() {
                if ($('#user_type').val() == 1) {
                    $("#diyarnaa_country_id_box").css("display", "none");

                } else if ($('#user_type').val() == 3 || $('#user_type').val() == 2) {
                    $("#diyarnaa_country_id_box").css("display", "block");
                }
            }
        </script>
        <script>
            $('#user_type').on('change', function() {
                getCountry();
                getDiyarnaaCities();
            });
        </script>
        {{-- //=========================================================================================
        //========================================= getDiyarnaaCities==============================
        //========================================================================================= --}}
        <script>
            //=========================================================================================
            //========================================= getuser()==============================
            //=========================================================================================
            function getUsers() {
                if ($('#user_type').val() != 1) {
                    $('#diyarnaa_city_id').html('<option value="">المدينة  </option>');

                }
                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.advertisements-getUsers') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true) {
                            var selectUser = '<option value="">اختر صاحب الاعلان... </option>';
                            for (var key in data.user) {
                                // skip loop if the property is from prototype
                                if (!data.user.hasOwnProperty(key)) continue;

                                var obj = data.user[key];
                                for (var prop in obj) {
                                    // skip loop if the property is from prototype
                                    if (!obj.hasOwnProperty(prop)) continue;
                                    // your code
                                    var user_id_old_value = $("#user_id_old_value").val();
                                    if (user_id_old_value) {
                                        if (obj.id == user_id_old_value) {
                                            selectUser += '<option value="' + obj.id + '" selected>' + obj
                                                .name + '</option>';
                                        } else {
                                            selectUser += '<option value="' + obj.id + '">' + obj.name +
                                                '</option>';
                                        }
                                    } else {
                                        selectUser += '<option value="' + obj.id + '">' + obj.name +
                                            '</option>';
                                    }
                                    break;
                                }
                            }
                            $('#user_id').html(selectUser);
                        } else {
                            $('#user_id').html('<option value="">لا يوجد مستخدمين</option>');
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
        //========================================= getDiyarnaaCities==============================
        //========================================================================================= --}}
        <script>
            function getDiyarnaaCities() {





                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.advertisements-getDiyarnaaCities') }}",
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
                            $('#diyarnaa_city_id').html('<option value="">لا يوجد مدن</option>');
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
        //========================================= getDiyarnaaRegions==============================
        //========================================================================================= --}}
        <script>
            function getDiyarnaaRegions() {
                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.advertisements-getDiyarnaaRegions') }}",
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
        {{-- //=========================================================================================
        //========================================= getSubCategories==============================
        //========================================================================================= --}}
        <script>
            function getSubCategories() {
                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.advertisements-getSubCategories') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true) {
                            var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
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
                            $('#sub_category_id').html(selectCity);
                        } else {
                            $('#sub_category_id').html('<option value="">لا يوجد تصنيفات فرعية</option>');
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
        //========================================= getFeatureType==============================
        //========================================================================================= --}}
        <script>
            function getFeatureType() {
                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.advertisements-getFeatureType') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true) {
                            if (data.feature_type.includes(1)) {
                                $('#construction_age_box').css('display', 'block');
                            } else {
                                $('#construction_age_box').css('display', 'none');
                            }
                            if (data.feature_type.includes(2)) {
                                $('#land_area_box').css('display', 'block');
                            } else {
                                $('#land_area_box').css('display', 'none');
                            }
                            if (data.feature_type.includes(3)) {
                                $('#real_estate_status_box').css('display', 'block');
                            } else {
                                $('#real_estate_status_box').css('display', 'none');
                            }
                            if (data.feature_type.includes(4)) {
                                $('#number_of_rooms_box').css('display', 'block');
                            } else {
                                $('#number_of_rooms_box').css('display', 'none');
                            }
                            if (data.feature_type.includes(5)) {
                                $('#number_of_bathrooms_box').css('display', 'block');
                            } else {
                                $('#number_of_bathrooms_box').css('display', 'none');
                            }
                            if (data.feature_type.includes(6)) {
                                $('#number_of_floors_box').css('display', 'block');
                            } else {
                                $('#number_of_floors_box').css('display', 'none');
                            }
                        } else {
                            $('#construction_age_box').css('display', 'none');
                            $('#land_area_box').css('display', 'none');
                            $('#real_estate_status_box').css('display', 'none');
                            $('#number_of_rooms_box').css('display', 'none');
                            $('#number_of_bathrooms_box').css('display', 'none');
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
                $("#add").click(function() {
                    var lastField = $("#buildyourform div:last"); //bring last div in this id
                    var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1; //counter
                    var fieldWrapper = $("<div class=\"input-group fieldwrapper  col-md-12 mb-3\" id=\"field" +
                        intId + "\"/>");
                    fieldWrapper.data("idx", intId);
                    var flabel = $(
                        "<label style=\"padding:9px\" class=\"text-dark font-weight-medium mb-3 \" >  الميزة بالإنجليزي" +
                        intId + "  : </label>");

                    var fType = $(
                        "<input placeholder=\"الميزة بالإنجليزي " + intId +
                        "\"   type=\"text\" name=\"feature_en[]\" class=\"fieldname form-control\" />"
                    );
                    var flabelTwo = $(
                        "<label style=\"padding:9px\" class=\"text-dark font-weight-medium mb-3 \" > الميزة بالعربي " +
                        intId + " : </label>");


                    var fTypeTwo = $(
                        "<input placeholder=\"الميزة بالعربي" + intId +
                        "\"   type=\"text\" name=\"feature_ar[]\" style=\"margin-right: 10px\" class=\"fieldname form-control\" />"
                    );
                    var removeButton = $(
                        "<input  type=\"button\" class=\"remove mdi btn btn-primary\" value=\"-\" />");
                    removeButton.click(function() {
                        $(this).parent().remove();
                    });
                    // fieldWrapper.append(fName);

                    fieldWrapper.append(flabel);
                    fieldWrapper.append(fType);
                    fieldWrapper.append(flabelTwo);
                    fieldWrapper.append(fTypeTwo);
                    fieldWrapper.append(removeButton);
                    fieldWrapper.append("<br>");
                    $("#buildyourform").append(fieldWrapper);
                });

            });
        </script>
        <script>
            function allAreNull() {
                var feature_ar = document.getElementsByName('feature_ar[]');
                var feature_en = document.getElementsByName('feature_en[]');
                var flag = 0;
                for (var i = 0; i < feature_ar.length; i++) {
                    if (feature_ar[i].value == '' || feature_en[i].value == '') {
                        flag = 1;
                    }
                }

                // alert('erge');
                if (flag == 1) {
                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: " الرجاء ملئ جميع حقو الميزات الاضافيه ",
                        width: 400,
                    });

                } else {
                    document.getElementById('createForm').submit();
                }
            }
        </script>
    @endsection
