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
                                <a href="{{ route('super_admin.searches-index') }}">
                                    <span class="fa fa-th"></span> الابحاث المضافة
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
                                            action="{{ route('super_admin.searches-update', isset($search->id) ? $search->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                {{-- العنوان  --}}
                                                <div class="col-md-6 mb-4">
                                                    <label for="location">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                العنوان
                                                            </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                Title </span>
                                                        @endif
                                                        <strong class="text-danger">
                                                            *
                                                            @error('title')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="text" class="form-control" name="title"
                                                        value="{{ old('title') ? old('title') : $search->title }}">
                                                </div>


                                                {{--  التصنيف الرئيسي  --}}
                                                <div class="col-md-6 mb-4">
                                                    <label for="category_id">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                التصنيف الرئيسي
                                                            </span>
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
                                                                    Main Category
                                                                </span>
                                                            @endif
                                                        </option>
                                                        @if (isset($categories) && count($categories) > 0)
                                                            @foreach ($categories as $key => $category)
                                                                <option value="{{ $category->id }}"
                                                                    @if (old('category_id')) {{ old('category_id') == $category->id ? 'selected' : null }}
                                                                    @else
                                                                    {{ $search->main_category_id == $category->id ? 'selected' : null }} @endif>
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
                                                {{-- التصنيف الفرعي --}}
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <label for="sub_category_id">
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span class="realState_Location">
                                                                    التصنيف الفرعي </span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span class="realState_Location">
                                                                    Subcategory
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

                                                        @if (old('sub_category_id'))
                                                            <input type="hidden" value="{{ old('sub_category_id') }}"
                                                                id="sub_category_id_old_value">
                                                        @else
                                                            <input type="hidden" value="{{ $search->sub_category_id }}"
                                                                id="sub_category_id_old_value">
                                                        @endif




                                                        <select name="sub_category_id" id="sub_category_id"
                                                            class="form-control" data-live-search="true" data-width="88%"
                                                            data-actions-box="true" style="width: 100%"
                                                            onchange="getFeatureType()">
                                                            <option value="">
                                                                @if (Config::get('app.locale') == 'ar')
                                                                    <span class="realState_Location">
                                                                        التصنيف الفرعي </span>
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    <span class="realState_Location">
                                                                        Subcategory
                                                                    </span>
                                                                @endif
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- عمر البناء  --}}
                                                <div class="col-md-6 mb-3" id="construction_age_box" style="display: none">

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
                                                                    @if (old('construction_age')) {{ old('construction_age') == $construction_age->id ? 'selected' : null }}
                                                                    @else
                                                                    {{ $search->construction_age == $construction_age->id ? 'selected' : null }} @endif>

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
                                                                    @if (old('land_area')) {{ old('land_area') == $land_area->id ? 'selected' : null }}
                                                                    @else
                                                                    {{ $search->land_area == $land_area->id ? 'selected' : null }} @endif>

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
                                                                    @if (old('real_estate_status')) {{ old('real_estate_status') == $real_estate_status->id ? 'selected' : null }}
                                                                    @else
                                                                    {{ $search->real_estate_status == $real_estate_status->id ? 'selected' : null }} @endif>

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
                                                                    @if (old('number_of_rooms')) {{ old('number_of_rooms') == $number_of_room->id ? 'selected' : null }}
                                                                    @else
                                                                    {{ $search->number_of_rooms == $number_of_room->id ? 'selected' : null }} @endif>

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
                                                                    @if (old('number_of_bathrooms')) {{ old('number_of_bathrooms') == $number_of_bathroom->id ? 'selected' : null }}
                                                                    @else
                                                                    {{ $search->number_of_bathrooms == $number_of_bathroom->id ? 'selected' : null }} @endif>

                                                                    {{ isset($number_of_bathroom->name_ar) ? $number_of_bathroom->name_ar : '------' }}

                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                {{-- Country --}}
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="diyarnaa_country_id">الدولة
                                                            * <strong class="text-danger">
                                                                @error('diyarnaa_country_id')
                                                                    - {{ $message }}
                                                                @enderror
                                                            </strong>
                                                        </label>
                                                        <select class="form-control" name="diyarnaa_country_id"
                                                            id="diyarnaa_country_id" onchange="getDiyarnaaCities()">
                                                            @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                                <option value=""selected> اختر الدولة </option>
                                                                @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                                    <option value="{{ $diyarnaa_country->id }}"
                                                                        @if (old('diyarnaa_country_id')) {{ old('diyarnaa_country_id') == $diyarnaa_country->id ? 'selected' : null }}
                                                                    @else
                                                                    {{ $search->diyarnaa_country_id == $diyarnaa_country->id ? 'selected' : null }} @endif>

                                                                        {{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : '------' }}

                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- City --}}
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="diyarnaa_city_id">المحافظة
                                                            <strong class="text-danger">
                                                                *
                                                                @error('diyarnaa_city_id')
                                                                    - {{ $message }}
                                                                @enderror
                                                            </strong>
                                                        </label>

                                                        @if (old('diyarnaa_city_id'))
                                                            <input type="hidden" value="{{ old('diyarnaa_city_id') }}"
                                                                id="diyarnaa_city_id_old_value">
                                                        @else
                                                            <input type="hidden" value="{{ $search->diyarnaa_city_id }}"
                                                                id="diyarnaa_city_id_old_value">
                                                        @endif



                                                        <select class="form-control" name="diyarnaa_city_id"
                                                            id="diyarnaa_city_id" onchange="getDiyarnaaRegions()">
                                                            <option value="1">اختر المحافظة</option>
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


                                                        @if (old('diyarnaa_region_id'))
                                                            <input type="hidden" value="{{ old('diyarnaa_region_id') }}"
                                                                id="diyarnaa_region_id_old_value">
                                                        @else
                                                            <input type="hidden"
                                                                value="{{ $search->diyarnaa_region_id }}"
                                                                id="diyarnaa_region_id_old_value">
                                                        @endif




                                                        <select name="diyarnaa_region_id" id="diyarnaa_region_id"
                                                            class="form-control">
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
                                                </div>
                                                {{-- price_from --}}
                                                <div class="col-md-6 mb-4">
                                                    <label for="price_from">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                السعر من </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                Price From
                                                            </span>
                                                        @endif
                                                        </option>
                                                        <strong class="text-danger">
                                                            *
                                                            @error('price_from')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="number" min="0" class="form-control"
                                                        id="price_from" name="price_from"
                                                        value="{!! old('price_from') ? old('price_from') : $search->price_from !!}">
                                                </div>
                                                {{-- price_to --}}
                                                <div class="col-md-6 mb-4">
                                                    <label for="price_to">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                السعر الى </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                Price To
                                                            </span>
                                                        @endif
                                                        </option>
                                                        <strong class="text-danger">
                                                            *
                                                            @error('price_to')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="number" min="0" class="form-control"
                                                        id="price_to" name="price_to" value="{!! old('price_to') ? old('price_to') : $search->price_to !!}">
                                                </div>





                                                {{--  نوع المساحة --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">نوع المساحة  : <strong class="text-danger">
                                                            * @error('area_type_id')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="area_type_id"
                                                            class="custom-select my-1 mr-sm-2 @error('area_type_id') is-invalid @enderror"
                                                            id="inlineFormCustomSelectPref">
                                                            <option value="" selected>  نوع المساحة..</option>

                                                            @if (isset($land_areas) && $land_areas->count() > 0)
                                                            @foreach ($land_areas as $area_type)
                                                                <option value="{{ $area_type->id }}"
                                                                    @if ($search->area_type_id == $area_type->id) selected @endif>
                                                                    {{ isset($area_type->name_ar) ? $area_type->name_ar : '------' }}
                                                                </option>
                                                            @endforeach
                                                        @endif

                                                        </select>
                                                    </div>
                                                </div>


                                                





                                                {{-- area_from --}}
                                                <div class="col-md-6 mb-4">
                                                    <label for="area_from">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                المساحة من </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                Area From
                                                            </span>
                                                        @endif
                                                        </option>
                                                        <strong class="text-danger">
                                                            *
                                                            @error('area_from')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="number" min="0" class="form-control"
                                                        id="area_from" name="area_from" value="{!! old('area_from') ? old('area_from') : $search->area_from !!}">
                                                </div>

                                                {{-- area_to --}}
                                                <div class="col-md-6 mb-4">
                                                    <label for="area_to">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                المساحة الى </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                Area To
                                                            </span>
                                                        @endif
                                                        </option>
                                                        <strong class="text-danger">
                                                            *
                                                            @error('area_to')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="number" min="0" class="form-control"
                                                        id="area_to" name="area_to" value="{!! old('area_to') ? old('area_to') : $search->area_to !!}">
                                                </div>


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
                                                            <option value="1"
                                                                @if ($search->status == 'Active') selected @endif>مفعل
                                                            </option>
                                                            <option value="2"
                                                                @if ($search->status == 'Inactive') selected @endif>
                                                                غير مفعل
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Submit --}}
                                                <div class="col-12 mb-3">
                                                    <div class="form-row">
                                                        <div id="buildyourform">


                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <button class="mdi btn btn-primary" type="submit"><span
                                                                class="mdi mdi-plus"></span>تعديل
                                                            البحث </button>
                                                    </div>
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
                            var selectCity = '<option value="">اختر المحافظة... </option>';
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
                            $('#diyarnaa_city_id').html('<option value="">لا يوجد محافظات... </option>');
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
            $(document).ready(function() {
                getSubCategories();
                getDiyarnaaCities()
                setTimeout(() => {
                    getFeatureType();
                    getDiyarnaaRegions();

                }, 500);


            });

            function getFeatureType() {
                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.searches-getFeatureType') }}",
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
    @endsection
