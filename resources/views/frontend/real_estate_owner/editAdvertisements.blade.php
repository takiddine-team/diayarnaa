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
                <h2>
                    @if ($ad->expiry_date > now())
                        @lang('front.EditAd')
                    @else
                        @lang('front.RePublishAd')
                    @endif

                </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>
                    @if ($ad->expiry_date > now())
                        @lang('front.EditAd')
                    @else
                        @lang('front.RePublishAd')
                    @endif
                </span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== User menu section =============== --}}
            {{-- =========================================================== --}}

            @include('layouts.sideBar')

            {{-- =========================================================== --}}
            {{-- =================== dashboard content section =============== --}}
            {{-- =========================================================== --}}
            <section class="dashboardContent">
                <div class="container">
                    <div class="row">
                        <div class="col-12 bShadow">
                            <form class="editUserForm" class="realStateFilter" id="createForm" style="text-align: initial"
                                action="{{ route('owner-updateAdvertisementRequest', isset($ad->id) ? $ad->id : -1) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <h2>
                                    @if ($ad->expiry_date > now())
                                        @lang('front.EditAd')
                                    @else
                                        @lang('front.RePublishAd')
                                    @endif
                                </h2>
                                <div class="row">


                                    {{-- العنوان بالعربي --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="location">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    العنوان بالعربي
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Title in Arabic </span>
                                            @endif
                                            <strong class="text-danger">
                                                *
                                                @error('title_ar')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" name="title_ar"
                                            value="{{ isset($ad->title_ar) ? $ad->title_ar : null }}">
                                    </div>


                                    {{-- العنوان بالانجليزي --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="title_en">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    العنوان بالانجليزي
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Title in English </span>
                                            @endif
                                            <strong class="text-danger">
                                                *
                                                @error('title_en')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" name="title_en" id='title_en'
                                            value='{{ isset($ad->title_en) ? $ad->title_en : null }}'>
                                    </div>


                                    {{-- الغرض  --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="target_id">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الغرض
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Target
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                *
                                                @error('target_id')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <select name="target_id" id="target_id" class="form-control">
                                            @if (isset($targets) && count($targets) > 0)
                                                @foreach ($targets as $key => $target)
                                                    <option value="{{ $target->id }}">
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span class="realState_Location">
                                                                {{ isset($target->name_ar) ? $target->name_ar : null }}
                                                            </span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span class="realState_Location">
                                                                {{ isset($target->name_en) ? $target->name_en : null }}
                                                            </span>
                                                        @endif
                                                @endforeach
                                            @endif
                                        </select>
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
                                                        Select Main Category
                                                    </span>
                                                @endif
                                            </option>
                                            @if (isset($categories) && count($categories) > 0)
                                                @foreach ($categories as $key => $category)
                                                    <option value="{{ $category->id }}"
                                                        @if (old('category_id')) {{ old('category_id') == $category->id ? 'selected' : null }}
                                                            @else
                                                                {{ $ad->main_category_id == $category->id ? 'selected' : null }} @endif>
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
                                                        SubCategory
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
                                                <input type="hidden" value="{{ $ad->sub_category_id }}"
                                                    id="sub_category_id_old_value">
                                            @endif

                                            <select name="sub_category_id" id="sub_category_id" class="form-control"
                                                data-live-search="true" data-width="88%" data-actions-box="true"
                                                style="width: 100%" onchange="getFeatureType()">
                                                <option value="">
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            التصنيف الفرعي </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            SubCategory
                                                        </span>
                                                    @endif
                                                </option>
                                            </select>
                                        </div>
                                    </div>


                                    {{-- عمر البناء  --}}
                                    <div class="col-md-6 mb-3" id="construction_age_box" style="display: none">

                                        <label for="construction_age">@lang('front.ConstructionAge'):
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
                                            <option value=""> @lang('front.ConstructionAge')..</option>
                                            @if (isset($construction_ages) && $construction_ages->count() > 0)
                                                @foreach ($construction_ages as $construction_age)
                                                    <option value="{{ $construction_age->id }}"
                                                        @if (old('construction_age')) {{ $construction_age->id == old('construction_age') ? 'selected' : '' }}
                                                        @else
                                                            {{ $construction_age->id == $ad->construction_age ? 'selected' : '' }} @endif>
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span>{{ isset($construction_age->name_ar) ? $construction_age->name_ar : '------' }}</span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span>{{ isset($construction_age->name_en) ? $construction_age->name_en : '------' }}</span>
                                                        @endif

                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    {{-- مساحة الارض  --}}
                                    <div class="col-md-6 mb-3" id="land_area_box" style="display: none">
                                        <label for="land_area"> @lang('front.LandArea') :
                                            <strong class="text-danger">* @error('land_area')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="hidden" value="{{ old('land_area') }}" id="land_area_old_value">
                                        <select name="land_area" id="land_area"
                                            class=" land_area custom-select my-1 mr-sm-2 @error('construction_age') is-invalid @enderror form-control"
                                            data-live-search="true" data-width="88%" data-actions-box="true"
                                            style="width: 100%">
                                            <option value=""> @lang('front.LandArea')..</option>
                                            @if (isset($land_areas) && $land_areas->count() > 0)
                                                @foreach ($land_areas as $land_area)
                                                    <option value="{{ $land_area->id }}"
                                                        @if (old('land_area')) @if (old('land_area') == $land_area->id) selected @endif
                                                    @else @if ($ad->land_area == $land_area->id) selected @endif
                                                        @endif
                                                        >
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span>
                                                                {{ isset($land_area->name_ar) ? $land_area->name_ar : '------' }}</span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span>{{ isset($land_area->name_en) ? $land_area->name_en : '------' }}</span>
                                                        @endif

                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    {{-- حالة العقار --}}
                                    <div class="col-md-6 mb-3" id="real_estate_status_box" style="display: none">
                                        <label for="real_estate_status"> @lang('front.EstateStatus'):
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
                                            style="width: 100%">
                                            <option value=""> @lang('front.EstateStatus') ..</option>
                                            @if (isset($real_estate_statuses) && $real_estate_statuses->count() > 0)
                                                @foreach ($real_estate_statuses as $real_estate_status)
                                                    <option value="{{ $real_estate_status->id }}"
                                                        @if (old('real_estate_status')) @if (old('real_estate_status') == $real_estate_status->id) selected @endif
                                                    @else @if ($ad->real_estate_status == $real_estate_status->id) selected @endif
                                                        @endif
                                                        >
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span>{{ isset($real_estate_status->name_ar) ? $real_estate_status->name_ar : '------' }}</span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span>{{ isset($real_estate_status->name_en) ? $real_estate_status->name_en : '------' }}</span>
                                                        @endif

                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    {{-- عدد الغرف --}}
                                    <div class="col-md-6 mb-3" id="number_of_rooms_box" style="display: none">

                                        <label for="number_of_rooms"> @lang('front.NumberOfRooms'):
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
                                            <option value="">@lang('front.NumberOfRooms') ..</option>
                                            @if (isset($number_of_rooms) && $number_of_rooms->count() > 0)
                                                @foreach ($number_of_rooms as $number_of_room)
                                                    <option value="{{ $number_of_room->id }}"
                                                        @if (old('number_of_rooms')) @if (old('number_of_rooms') == $number_of_room->id) selected @endif
                                                    @else @if ($ad->number_of_rooms == $number_of_room->id) selected @endif
                                                        @endif
                                                        >
                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span>
                                                                {{ isset($number_of_room->name_ar) ? $number_of_room->name_ar : '------' }}</span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span>{{ isset($number_of_room->name_en) ? $number_of_room->name_en : '------' }}</span>
                                                        @endif

                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    {{-- عدد الحمامات --}}
                                    <div class="col-md-6 mb-3" id="number_of_bathrooms_box" style="display: none">
                                        <label for="number_of_bathrooms">@lang('front.NumberOfBathrooms'):
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
                                            <option value=""> @lang('front.NumberOfBathrooms') ..</option>
                                            @if (isset($number_of_bathrooms) && $number_of_bathrooms->count() > 0)
                                                @foreach ($number_of_bathrooms as $number_of_bathroom)
                                                    <option value="{{ $number_of_bathroom->id }}"
                                                        @if (old('number_of_bathrooms')) {{ $number_of_bathroom->id == old('number_of_bathroom') ? 'selected' : '' }}
                                                    @else
                                                        @if ($ad->number_of_bathrooms == $number_of_bathroom->id) selected @endif
                                                        @endif>

                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span>{{ isset($number_of_bathroom->name_ar) ? $number_of_bathroom->name_ar : '------' }}</span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span>{{ isset($number_of_bathroom->name_en) ? $number_of_bathroom->name_en : '------' }}</span>
                                                        @endif

                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
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
                                            <select class="form-control" name="diyarnaa_country_id"
                                                id="diyarnaa_country_id" onchange="getDiyarnaaCities()">
                                                @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                    <option value=""selected>@lang('front.CountryName') </option>
                                                    @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                        <option value="{{ $diyarnaa_country->id }}"
                                                            @if (old('diyarnaa_country_id') != null) @if (old('diyarnaa_country_id') == $diyarnaa_country->id) selected @endif
                                                        @else @if ($ad->diyarnaa_country_id == $diyarnaa_country->id) selected @endif
                                                            @endif>
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span>{{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : '------' }}</span>
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
                                            <label for="diyarnaa_city_id">@lang('front.City')
                                                * <strong class="text-danger">
                                                    @error('diyarnaa_city_id')
                                                        - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            @if (old('diyarnaa_city_id'))
                                                <input type="hidden" value="{{ old('diyarnaa_city_id') }}"
                                                    id="diyarnaa_city_id_old_value">
                                            @else
                                                <input type="hidden" value="{{ $ad->diyarnaa_city_id }}"
                                                    id="diyarnaa_city_id_old_value">
                                            @endif

                                            <select class="form-control" name="diyarnaa_city_id" id="diyarnaa_city_id"
                                                onchange="getDiyarnaaRegions()">
                                                <option value="1">@lang('front.SelectCity')</option>
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
                                                <input type="hidden" value="{{ $ad->diyarnaa_region_id }}"
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
                                                            Choose Region
                                                        </span>
                                                    @endif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- street --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="street">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الشارع </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Street
                                                </span>
                                            @endif
                                            </option>
                                            <strong class="text-danger">
                                                *
                                                @error('street')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" id="street" name="street"
                                            value="{{ isset($ad->street) ? $ad->street : null }}">
                                    </div>

                                    {{-- Map Url --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="url_map">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الخريطة </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Map URL
                                                </span>
                                            @endif
                                            </option>
                                            <strong class="text-danger">
                                                *
                                                @error('url_map')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="url" class="form-control" id="url_map" name="url_map"
                                            value="{{ isset($ad->url_map) ? $ad->url_map : null }}">
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="price">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    السعر </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Price
                                                </span>
                                            @endif
                                            </option>
                                            <strong class="text-danger">
                                                * (@lang('front.PriceInsertDollar'))
                                                @error('price')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="number" min="0" class="form-control" id="price"
                                            name="price" value="{{ isset($ad->price) ? $ad->price : null }}">
                                    </div>

                                    {{--  نوع المساحة --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="area_type_id"> @lang('front.AreaType'):
                                            <strong class="text-danger">* @error('area_type_id')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        <select name="area_type_id" id="area_type_id"
                                            class=" land_area custom-select my-1 mr-sm-2 @error('area_type_id') is-invalid @enderror form-control"
                                            data-live-search="true" data-width="88%" data-actions-box="true"
                                            style="width: 100%">
                                            <option value=""> @lang('front.AreaType')..</option>
                                            @if (isset($land_areas) && $land_areas->count() > 0)
                                                @foreach ($land_areas as $area_type)
                                                    <option value="{{ $area_type->id }}"
                                                        @if ($ad->area_type_id == $area_type->id) selected @endif>

                                                        @if (Config::get('app.locale') == 'ar')
                                                            <span>{{ isset($area_type->name_ar) ? $area_type->name_ar : '------' }}</span>
                                                        @elseif (Config::get('app.locale') == 'en')
                                                            <span>{{ isset($area_type->name_en) ? $area_type->name_en : '------' }}</span>
                                                        @endif
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    {{-- area --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="area">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    المساحة </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Area
                                                </span>
                                            @endif
                                            </option>
                                            <strong class="text-danger">
                                                *
                                                @error('area')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="number" min="0" class="form-control" id="area"
                                            name="area" value="{{ isset($ad->area) ? $ad->area : null }}">
                                    </div>

                                    {{--  العنوان  --}}
                                    <div class="col-md-12 mb-4">
                                        <label for="real_estate_formula	">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    العنوان (اختياري)</span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Address (Optional)
                                                </span>
                                            @endif
                                            <strong class="text-danger">

                                                @error('address')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="address" id="address" cols="30" rows="5" class="form-control">{!! isset($ad->address) ? strip_tags($ad->address) : null !!}</textarea>
                                    </div>

                                    {{-- الصيغة  العقارية  --}}
                                    <div class="col-md-12 mb-4">
                                        <label for="real_estate_formula">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الصيغة العقارية (إجباري) ( يجب ألا تقل عن 100 حرف.)</span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Real Estate Formula (Must Be 100 Characters At Least)
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                @error('real_estate_formula')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="real_estate_formula" id="real_estate_formula" cols="30" rows="5" class="form-control">{!! isset($ad->real_estate_formula) ? strip_tags($ad->real_estate_formula) : null !!}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            @lang('front.ContactMethod') : <strong class="text-danger">
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
                                                <option value="" selected> @lang('front.ContactMethod')...</option>
                                                <option value="1" @if ($ad->contact_method == @trans('front.Mobile')) selected @endif>
                                                    @lang('front.Mobile')
                                                </option>
                                                <option value="2" @if ($ad->contact_method == @trans('front.Whatsapp')) selected @endif>
                                                    @lang('front.Whatsapp')
                                                </option>
                                                <option value="3" @if ($ad->contact_method == @trans('front.Email')) selected @endif>
                                                    @lang('front.Email')
                                                </option>
                                                <option value="4" @if ($ad->contact_method == @trans('front.EmailOrWhatsappOrMobile')) selected @endif>
                                                    @lang('front.EmailOrWhatsappOrMobile')
                                                </option>

                                            </select>
                                        </div>
                                    </div>

                                    {{-- image --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="main_image">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الصورة الرئيسية
                                                    <span class="text-danger">(jpeg,png,jpg,gif,svg) ( Max-Size : 2MB
                                                        )</span>
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Main Image
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                @error('main_image')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <!-- actual upload which is hidden -->
                                        <input type="file" id="actualBtn" onchange="loadFile(event)" hidden
                                            name="main_image" />
                                        <!-- our custom upload button -->
                                        <label for="actualBtn" id="img" class="uploadImage">

                                            @if (Config::get('app.locale') == 'ar')
                                            <img src="{{ asset('style_files/frontend/img/uploade.png') }}"
                                                id="selectedBanner" alt="">
                                        @elseif (Config::get('app.locale') == 'en')
                                            <img src="{{ asset('style_files/frontend/img/uploadfromhere.png') }}"
                                                id="selectedBanner" alt="">
                                        @endif

                                        </label>
                                    </div>


                                    {{-- other images --}}
                                    <div class="col-md-6 mb-4">
                                        <label for="cart_image">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    صور أخرى
                                                    <span class="text-danger">(jpeg,png,jpg,gif,svg) ( Max-Size : 2MB
                                                        )</span>
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Other Images
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                @error('image')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>

                                        <!-- actual upload which is hidden -->
                                        <input type="file" id="image" name="images[]" multiple />
                                        <!-- our custom upload button -->

                                    </div>

                                    {{-- video --}}
                                    <div class="col-md-6 mb-4" id="video_div">
                                        <label class="text-dark font-weight-medium mb-3" for="video"> :
                                            @lang('front.video') : <span class="text-danger d-block">
                                                (mp4,ogx,oga,ogv,ogg,webm) (
                                                Max-Size : 20MB
                                                )</span>
                                            <strong class="text-danger">
                                                @error('video')
                                                    {{ $message }}
                                                @enderror
                                            </strong></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            </div>
                                            <input type="file" name="video" class="form-control" id="video">
                                        </div>
                                    </div>

                                    {{-- الوصف بالعربي    --}}
                                    <div class="col-md-12 mb-4">
                                        <label for="description_ar">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الوصف بالعربي (اختياري)</span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Description in Arabic
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                @error('description_ar ')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="description_ar" id="description_ar" cols="30" rows="5" class="form-control">{!! isset($ad->description_ar) ? strip_tags($ad->description_ar) : null !!}</textarea>
                                    </div>

                                    {{-- الوصف بالانجليزي    --}}
                                    <div class="col-md-12 mb-4">
                                        <label for="description_en">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الوصف بالانجليزي (اختياري)</span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Description in English
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                @error('description_en')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="description_en" id="description_en" cols="30" rows="5" class="form-control">{!! isset($ad->description_en) ? strip_tags($ad->description_en) : null !!}</textarea>
                                    </div>


                                    {{-- Submit --}}
                                    <div class="col-md-12 mb-3">
                                        <div class="form-row">
                                            <div id="buildyourform">
                                                @if (isset($ad->extraFeatures) && $ad->extraFeatures->count() > 0)
                                                    @foreach ($ad->extraFeatures as $extraFeature)
                                                        <div class="input-group fieldwrapper  col-md-12 mb-3"
                                                            id="field1"><label style="padding:9px"
                                                                class="text-dark font-weight-medium mb-3 ">
                                                                @lang('front.FeatureInEnglish')
                                                                : </label>
                                                            <input placeholder="@lang('front.FeatureInEnglish')" type="text"
                                                                name="feature_en[]" class="fieldname form-control"
                                                                value="{{ isset($extraFeature->title_en) ? $extraFeature->title_en : null }}"><label
                                                                style="padding:9px"
                                                                class="text-dark font-weight-medium mb-3 ">

                                                                @lang('front.FeatureInArabic') : </label>

                                                            <input placeholder="@lang('front.FeatureInArabic')" type="text"
                                                                name="feature_ar[]" style="margin-right: 10px"
                                                                class="fieldname form-control"
                                                                value="{{ isset($extraFeature->title_ar) ? $extraFeature->title_ar : null }}">
                                                            <input type="button"
                                                                onclick=this.parentNode.parentNode.removeChild(this.parentNode)
                                                                class="remove mdi btn btn-primary" value="-"><br>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <button class="mdi btn btn-primary" type="button" id='add'><span
                                                class="mdi mdi-plus"></span>
                                            @lang('front.AddNewFeatures')</button>


                                        <button class="mdi btn btn-primary" type="button" onclick="allAreNull()"><span
                                                class="mdi mdi-plus"></span>
                                            @lang('front.EditAd') </button>
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
@endsection
@section('javascript')
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
                        //  var selectCity = '<option value="">اختر المحافظة... </option>';
                        var selectCity = '<option value="">@lang('front.SelectCity')... </option>';
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
                        //  var selectRegion = '<option value="">اختر منطقة ... </option>';
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
                        //  var selectRegion = '<option value="">اختر منطقة ... </option>';
                        var selectRegion = '<option value="">@lang('front.SelectRegion') ... </option>';
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
                        //   var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
                        var selectCity = '<option value="">@lang('front.SelectSubCategory')... </option>';
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
                        //  $('#sub_category_id').html('<option value="">لا يوجد تصنيفات فرعية</option>');
                        $('#sub_category_id').html('<option value="">@lang('front.NoSubCategory')</option>');
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
                    // "<label style=\"padding:9px\" class=\"text-dark font-weight-medium mb-3 \" >  الميزة بالإنجليزي" +
                    "<label style=\"padding:9px\" class=\"text-dark font-weight-medium mb-3 \" > @lang('front.FeatureInEnglish')" +
                    intId + "  : </label>");

                var fType = $(
                    //  "<input placeholder=\"الميزة بالإنجليزي " + intId +
                    "<input placeholder=\"@lang('front.FeatureInEnglish')" + intId +
                    "\"   type=\"text\" name=\"feature_en[]\" class=\"fieldname form-control\" />"
                );
                var flabelTwo = $(
                    // "<label style=\"padding:9px\" class=\"text-dark font-weight-medium mb-3 \" > الميزة بالعربي " +
                    "<label style=\"padding:9px\" class=\"text-dark font-weight-medium mb-3 \" >  @lang('front.FeatureInArabic') " +
                    intId + " : </label>");


                var fTypeTwo = $(
                    // "<input placeholder=\"الميزة بالعربي" + intId +
                    "<input placeholder=\"@lang('front.FeatureInArabic')" + intId +
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
                    // text: " الرجاء ملئ جميع حقو الميزات الاضافيه ",
                    text: "@lang('front.PleaseFillTheFeatureBox')",
                    width: 400,
                });

            } else {
                document.getElementById('createForm').submit();
            }
        }
    </script>
    {{-- //=========================================================================================
        //========================================= getFeatureType==============================
        //========================================================================================= --}}
    <script>
        $(document).ready(function() {
            getDiyarnaaCities()
            getSubCategories();
            setTimeout(() => {
                getDiyarnaaRegions();

                getFeatureType();
            }, 500);
        });

        function getFeatureType() {
            var formData = new FormData($('#createForm')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('owner-getFeatureType') }}",
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
