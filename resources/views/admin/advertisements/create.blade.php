@extends('admin.layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>اضافة إعلان</h1>
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
                                        <form id="createForm" action="{{ route('super_admin.advertisements-store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                {{-- Title AR --}}
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
                                                            value="{{ old('title_ar') ? old('title_ar') : null }}">
                                                    </div>
                                                </div>
                                                {{-- Title EN --}}
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
                                                            value="{{ old('title_en') ? old('title_en') : null }}">
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
                                                        <select name="user_type" data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 90% !important"
                                                            class="target_id custom-select my-1 mr-sm-2 @error('user_type') is-invalid @enderror form-control"
                                                            id="user_type" onchange="getUsers()">
                                                            <option value="" selected>نوع المستخدم...</option>
                                                            <option value="1"
                                                                @if (old('user_type') == 1) selected @endif>مكتب عقاري
                                                            </option>
                                                            <option value="2"
                                                                @if (old('user_type') == 2) selected @endif>مالك عقار
                                                            </option>
                                                           
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
                                                    <input type="hidden" value="{{ old('user_id') }}"
                                                        id="user_id_old_value" name="user_id_old">
                                                    <select name="user_id" id="user_id"
                                                        class=" user_id custom-select my-1 mr-sm-2 @error('user_id') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 90% !important" onchange="getDiyarnaaCities()">
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
                                                            style="width: 90% !important">
                                                            <option value="" selected>اختر الغرض ...
                                                            </option>
                                                            @if (isset($targets) && $targets->count() > 0)
                                                                @foreach ($targets as $target)
                                                                    <option value="{{ $target->id }}"
                                                                        @if (old('target_id') != null) @if (old('target_id') == $target->id) selected @endif
                                                                    @else
                                                                        @if ($target->target_id == $target->id) selected @endif
                                                                        @endif>

                                                                        {{ isset($target->name_ar) ? $target->name_ar : '------' }}

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
                                                            data-actions-box="true" style="width: 90% !important">
                                                            <option value="" selected>التصنيف الرئيسي ...
                                                            </option>
                                                            @if (isset($categories) && $categories->count() > 0)
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        @if (old('category_id') != null) @if (old('category_id') == $category->id) selected @endif
                                                                    @else
                                                                        @if ($category->category_id == $category->id) selected @endif
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
                                                    <input type="hidden" value="{{ old('sub_category_id') }}"
                                                        id="sub_category_id_old_value" name="sub_category_id_old">
                                                    <select name="sub_category_id" id="sub_category_id"
                                                        class=" sub_category_id custom-select my-1 mr-sm-2 @error('sub_category_id') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 90% !important" onchange="getFeatureType()">
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
                                                        style="width: 90% !important">
                                                        <option value=""> عمر البناء..</option>
                                                        @if (isset($construction_ages) && $construction_ages->count() > 0)
                                                            @foreach ($construction_ages as $construction_age)
                                                                <option value="{{ $construction_age->id }}"
                                                                    @if (old('construction_age') != null) @if (old('construction_age') == $construction_age->id) selected @endif
                                                                @else
                                                                    @if ($construction_age->construction_ag == $construction_age->id) selected @endif
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
                                                        class=" land_area custom-select my-1 mr-sm-2 @error('construction_age') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 90% !important">
                                                        <option value=""> مساحة الارض..</option>
                                                        @if (isset($land_areas) && $land_areas->count() > 0)
                                                            @foreach ($land_areas as $land_area)
                                                                <option value="{{ $land_area->id }}"
                                                                    @if (old('land_area') != null) @if (old('land_area') == $land_area->id) selected @endif
                                                                @else
                                                                    @if ($land_area->construction_ag == $land_area->id) selected @endif
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
                                                        class=" real_estate_status custom-select my-1 mr-sm-2 @error('construction_age') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 90% !important">
                                                        <option value=""> حالة العقار ..</option>
                                                        @if (isset($real_estate_statuses) && $real_estate_statuses->count() > 0)
                                                            @foreach ($real_estate_statuses as $real_estate_status)
                                                                <option value="{{ $real_estate_status->id }}"
                                                                    @if (old('real_estate_status') != null) @if (old('real_estate_status') == $real_estate_status->id) selected @endif
                                                                @else
                                                                    @if ($real_estate_status->construction_ag == $real_estate_status->id) selected @endif
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
                                                        style="width: 90% !important">
                                                        <option value=""> عدد الغرف ..</option>
                                                        @if (isset($number_of_rooms) && $number_of_rooms->count() > 0)
                                                            @foreach ($number_of_rooms as $number_of_room)
                                                                <option value="{{ $number_of_room->id }}"
                                                                    @if (old('number_of_rooms') != null) @if (old('number_of_rooms') == $number_of_room->id) selected @endif
                                                                @else
                                                                    @if ($number_of_room->construction_ag == $number_of_room->id) selected @endif
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
                                                        style="width: 90% !important">
                                                        <option value=""> عدد الحمامات ..</option>
                                                        @if (isset($number_of_bathrooms) && $number_of_bathrooms->count() > 0)
                                                            @foreach ($number_of_bathrooms as $number_of_bathroom)
                                                                <option value="{{ $number_of_bathroom->id }}"
                                                                    @if (old('number_of_bathrooms') != null) @if (old('number_of_bathrooms') == $number_of_bathroom->id) selected @endif
                                                                @else
                                                                    @if ($number_of_bathroom->construction_ag == $number_of_bathroom->id) selected @endif
                                                                    @endif>

                                                                    {{ isset($number_of_bathroom->name_ar) ? $number_of_bathroom->name_ar : '------' }}

                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                {{-- الدولة --}}
                                                <div class="col-md-6 mb-3" id="diyarnaa_country_id_box"
                                                    style="display: none">
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
                                                            data-actions-box="true" style="width: 90% !important">
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
                                                        style="width: 90% !important">
                                                        <option value="">المدينة..</option>
                                                    </select>
                                                </div>

                                                {{-- المنطقة --}}
                                                <div class="selectedMethod col-md-6 mb-3" id="diyarnaa_region_id_box">
                                                    <label for="diyarnaa_region_id">
                                                        المنطقة :
                                                        <strong class="text-danger">
                                                            *@error('diyarnaa_region_id')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ old('diyarnaa_region_id') }}"
                                                        id="diyarnaa_region_id_old_value">
                                                    <select name="diyarnaa_region_id" id="diyarnaa_region_id" cl
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 90% !important"
                                                        class="sub_category_id custom-select my-1 mr-sm-2 @error('diyarnaa_region_id') is-invalid @enderror form-control">
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
                                                            value="{{ old('street') ? old('street') : null }}">
                                                    </div>
                                                </div>

                                                {{-- الخريطة --}}
                                                <div class="col-md-6" id="url_map_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="url_map">
                                                        الخريطة: <strong class="text-danger">
                                                            @error('url_map')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="url" name="url_map"
                                                            class="form-control @error('url_map') is-invalid @enderror"
                                                            id="url_map" placeholder=" الخريطة"
                                                            value="{{ old('url_map') ? old('url_map') : null }}">
                                                    </div>
                                                </div>
                                                {{-- السعر --}}
                                                <div class="col-md-6" id="price_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="price">
                                                        السعر: <strong class="text-danger">
                                                            *@error('price')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" min="0" name="price"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            id="price" placeholder=" السعر"
                                                            value="{{ old('price') ? old('price') : null }}">
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
                                                                            @if (old('area_type_id') == $area_type->id) selected @endif>
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
                                                            value="{{ old('area') ? old('area') : null }}">
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
                                                </div>

                                                {{-- صور  اخرى --}}
                                                <div class="col-md-6 mb-3" id="image_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="image">
                                                        صور أخرى :
                                                        <strong class="text-danger">
                                                            @error('image')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="images[]" class="form-control"
                                                            id="image" multiple>
                                                    </div>
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
                                                        <textarea style="width: 90% !important" name="address" class="form-control ckeditor" rows="5" id='address'>{{ old('address') ? old('address') : null }}</textarea>
                                                    </div>
                                                </div>

                                                {{--  الصيغة العقارية --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="real_estate_formula">
                                                        الصيغة العقارية : <strong class="text-danger">
                                                            *@error('real_estate_formula')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="real_estate_formula" class="form-control ckeditor" rows="5"
                                                            id='real_estate_formula'>{{ old('real_estate_formula') ? old('real_estate_formula') : null }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- مرجع الاعلان --}}
                                                <div class="col-md-6" id="ad_reference_div" style="display: none">
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
                                                            value="{{ old('ad_reference') ? old('ad_reference') : null }}">
                                                    </div>
                                                </div>



                                                {{-- contact_method --}}
                                                <div class="col-md-6 mb-3"  id="contact_method_div"style="display: none">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">  @lang("front.ContactMethod") : <strong
                                                            class="text-danger">
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
                                                                @if (old('contact_method') == '1') selected @endif>Mobile
                                                            </option>
                                                            <option value="2"
                                                                @if (old('contact_method') == '2') selected @endif>
                                                                Whatsapp
                                                            </option>
                                                            <option value="3"
                                                                @if (old('contact_method') == '3') selected @endif> Email
                                                            </option>
                                                            <option value="4"
                                                                @if (old('contact_method') == '4') selected @endif> Email
                                                                Or Whatsapp or Mobile
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>


                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">الحالة : <strong class="text-danger">
                                                            *
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
                                                                @if (old('status') == 5) selected @endif>غير
                                                                مفعل
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {{--  الوصف بالعربي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="description_ar">
                                                        الوصف بالعربي: <strong class="text-danger">
                                                            * @error('description_ar')
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

                                                {{--  الوصف بالانجليزي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="description_en">
                                                        الوصف بالانجليزي: <strong class="text-danger">
                                                            * @error('description_en')
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

                                                {{-- صلاحية الحساب   --}}
                                                <div class="col-md-6" id="expiry_date_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="expiry_date">
                                                        صلاحية الحساب :
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
                                                            value="{!! old('expiry_date') ? old('expiry_date') : null !!}">
                                                    </div>
                                                </div>


                                                <div class="col-md-12 mb-3">

                                                    <hr>
                                                    <div class="form-row">
                                                        <div id="buildyourform">


                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <button class="mdi btn btn-primary" type="button"
                                                            id='add'><span class="mdi mdi-plus"></span>
                                                            اضافة ميزات جديدة</button>



                                                    </div>
                                                    <hr>
                                                    <div class="col-md-12 mb-3">


                                                        <button class="mdi btn btn-primary" type="button"
                                                            onclick="allAreNull()"><span class="mdi mdi-plus"></span>اضافة
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

                if ($('#user_type').val() == 1) {
                    $("#contact_method_div").css("display","none");
                    $("#ad_reference_div").css("display","block");
                } 
                if ($('#user_type').val() == 2) {
                    $("#contact_method_div").css("display","block");
                    $("#ad_reference_div").css("display","none");
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
                $('#diyarnaa_region_id').html('<option value="">المدينة  </option>');

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
                if (flag == 1) {

                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: " الرجاء ملئ جميع حقول الميزات الاضافيه ",
                        width: 400,
                    });

                } else {
                    document.getElementById('createForm').submit();
                }
            }
        </script>
    @endsection
