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
                <h2>@lang('front.SearchDetails')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.SearchDetails')</span>
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
                    <div class="col-12">
                        <div class="allLeft">

                            {{-- تفاصيل --}}
                            <div class="leftBox details">
                                <h2 class="title">
                                    @if (Config::get('app.locale') == 'ar')
                                        تفاصيل البحث
                                    @elseif (Config::get('app.locale') == 'en')
                                        Search details
                                    @endif
                                </h2>
                                <ul>
                                    {{--   عنوان  --}}
                                    <li>
                                        @lang('front.SearchTitle') :
                                        {{ isset($search->title) ? $search->title : null }}


                                    </li>
                                    {{--   الحالة --}}
                                    <li>
                                        @lang('front.SearchStatus') :
                                        {{ isset($search->status) ? $search->status : null }}


                                    </li>
                                    {{-- التصنيف الرئيسي  --}}
                                    <li>

                                        @if (Config::get('app.locale') == 'ar')
                                            التصنيف الرئيسي :
                                            {{ isset($search->mainCategory->name_ar) ? $search->mainCategory->name_ar : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Main Category:
                                            {{ isset($search->mainCategory->name_en) ? $search->mainCategory->name_en : null }}
                                        @endif
                                    </li>
                                    {{-- التصنيف الفرعي  --}}
                                    <li>

                                        @if (Config::get('app.locale') == 'ar')
                                            التصنيف الفرعي :
                                            {{ isset($search->subCategory->name_ar) ? $search->subCategory->name_ar : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Sub Category:
                                            {{ isset($search->subCategory->name_en) ? $search->subCategory->name_en : null }}
                                        @endif
                                    </li>
                                    {{-- Country --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            الدولة :

                                            {{ isset($search->diyarnaaCountry->name_ar) ? $search->diyarnaaCountry->name_ar : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Country :
                                            {{ isset($search->diyarnaaCountry->name_en) ? $search->diyarnaaCountry->name_en : null }}
                                        @endif
                                    </li>
                                    {{-- City --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            المحافظة :
                                            {{ isset($search->diyarnaaCity->name_ar) ? $search->diyarnaaCity->name_ar : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            City :
                                            {{ isset($search->diyarnaaCity->name_en) ? $search->diyarnaaCity->name_en : null }}
                                        @endif
                                    </li>
                                    {{-- Region --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            المنطقة :
                                            {{ isset($search->diyarnaaRegion->name_ar) ? $search->diyarnaaRegion->name_ar : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Region :
                                            {{ isset($search->diyarnaaRegion->name_en) ? $search->diyarnaaRegion->name_en : null }}
                                        @endif
                                    </li>
                                    {{-- كود البحث --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            كود البحث :
                                            {{ isset($search->code) ? $search->code : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Ad code :
                                            {{ isset($search->code) ? $search->code : null }}
                                        @endif
                                    </li>
                                    {{-- price_from --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            السعر من :
                                            {{ isset($search->price_from) ? $search->price_from : null }}

                                            $
                                        @elseif (Config::get('app.locale') == 'en')
                                            Price From :


                                            {{ isset($search->price_from) ? $search->price_from . '$ ' : null }}
                                        @endif


                                    </li>
                                    {{-- price_to --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            السعر الى :
                                            {{ isset($search->price_to) ? $search->price_to : null }}
                                            $
                                        @elseif (Config::get('app.locale') == 'en')
                                            Price To :


                                            {{ isset($search->price_to) ? $search->price_to . '$ ' : null }}
                                        @endif

                                    </li>
                                    {{-- المساحه من --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            المساحه من:
                                            {{ isset($search->area_from) ? $search->area_from : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Area From :
                                            {{ isset($search->area_from) ? $search->area_from : null }}
                                        @endif
                                    </li>
                                    {{-- المساحه الى --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            المساحه الى:
                                            {{ isset($search->area_to) ? $search->area_to : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Area To:
                                            {{ isset($search->area_to) ? $search->area_to : null }}
                                        @endif
                                    </li>

                                    @if (isset($search->contact_method))
                                        <li>

                                            @if (Config::get('app.locale') == 'ar')
                                                @lang('front.ContactMethod') :
                                                {{ isset($search->contact_method) ? $search->contact_method : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Contact Method:
                                                {{ isset($search->contact_method) ? $search->contact_method : null }}
                                            @endif

                                        </li>
                                    @endif
                                    @if (isset($search->number_of_rooms))
                                        <li>


                                            @if (Config::get('app.locale') == 'ar')
                                                عدد الغرف :
                                                {{ isset($search->numberOfRoom->name_ar) ? $search->numberOfRoom->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Number of rooms :
                                                {{ isset($search->numberOfRoom->name_en) ? $search->numberOfRoom->name_en : null }}
                                            @endif



                                        </li>
                                    @endif
                                    @if (isset($search->number_of_bathrooms))
                                        <li>
                                            @if (Config::get('app.locale') == 'ar')
                                                عدد الحمامات :
                                                {{ isset($search->numberOfBathroom->name_ar) ? $search->numberOfBathroom->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Number of Bathrooms :
                                                {{ isset($search->numberOfBathroom->name_en) ? $search->numberOfBathroom->name_en : null }}
                                            @endif
                                        </li>
                                    @endif
                                    @if (isset($search->construction_age))
                                        <li>
                                            @if (Config::get('app.locale') == 'ar')
                                                عمر البناء :
                                                {{ isset($search->constructionAge->name_ar) ? $search->constructionAge->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Construction age :
                                                {{ isset($search->constructionAge->name_en) ? $search->constructionAge->name_en : null }}
                                            @endif
                                        </li>
                                    @endif
                                    @if (isset($search->land_area))
                                        <li>
                                            @if (Config::get('app.locale') == 'ar')
                                                مساحة الارض :
                                                {{ isset($search->landArea->name_ar) ? $search->landArea->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Land area :
                                                {{ isset($search->landArea->name_en) ? $search->landArea->name_en : null }}
                                            @endif
                                        </li>
                                    @endif
                                    @if (isset($search->real_estate_status))
                                        <li>
                                            @if (Config::get('app.locale') == 'ar')
                                                حالة العقار:
                                                {{ isset($search->realestateStatus->name_ar) ? $search->realestateStatus->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Real estate status :
                                                {{ isset($search->realestateStatus->name_en) ? $search->realestateStatus->name_en : null }}
                                            @endif
                                        </li>
                                    @endif
                                </ul>
                            </div>



                            {{-- footer links --}}
                            <div class="footerLinksState">
                                @if (isset($search->expiry_date) && $search->expiry_date < date('Y-m-d H:i:s') && $search->status != 'Pending')
                                    <a href="{{ route('seeker-editSearch', isset($search->id) ? $search->id : -1) }}"
                                        class="mainBg btn">
                                        @lang('front.RePublish')
                                    </a>
                                @endif
                                @if (isset($search->edit_balance) &&
                                        isset($search->expiry_date) &&
                                        $search->edit_balance > 0 &&
                                        $search->expiry_date > date('Y-m-d H:i:s') &&
                                        $search->status != 'Pending')
                                    <a href="{{ route('seeker-editSearch', isset($search->id) ? $search->id : -1) }}">
                                        @lang('front.Edit')
                                    </a>
                                @endif
                                @if (isset($search->status) && ($search->status == 'Active' || $search->status == 'Inactive'))
                                    <a
                                        href="{{ route('seeker-activeInactiveSearch', isset($search->id) ? $search->id : -1) }}">
                                        @if (isset($search->status))
                                            @if ($search->status == 'Active')
                                                @lang('front.Stop')
                                            @elseif($search->status == 'Inactive')
                                                @lang('front.Active')
                                            @endif
                                        @endif
                                    </a>
                                @endif
                                <a href="{{ route('seeker-deleteSearch', isset($search->id) ? $search->id : -1) }}">
                                    @lang('front.Delete')</a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
