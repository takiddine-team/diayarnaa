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
                <h2>@lang('front.AdDetails')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.AdDetails')</span>
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

                            {{-- slider --}}
                            @if (isset($advertisement->advertisementImage) && $advertisement->advertisementImage->count() > 0)
                                <div class="leftBox">
                                    <div class="innerDetailsSlider">
                                        <div id="wrap">
                                            <!-- new slider -->
                                            <ul id="imageGallery">
                                                @foreach ($advertisement->advertisementImage as $advertisement_image)
                                                @if (isset($advertisement_image->image) &&
                                                        $advertisement_image->getRawOriginal('image') &&
                                                        file_exists($advertisement_image->getRawOriginal('image')))
                                                <li data-thumb="{{ asset($advertisement_image->image) }}" data-src="{{ asset($advertisement_image->image) }}">
                                                    <img src="{{ asset($advertisement_image->image) }}" />
                                                  </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                            <!-- new slider -->
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- video --}}
                            @if (isset($advertisement->video))
                                <div class="leftBox">

                                    <div class="videoBox">
                                        @if (isset($advertisement->video) && $advertisement->video && file_exists($advertisement->video))
                                            <video width="100%" height="240" controls>
                                                <source src="{{ URL::asset($advertisement->video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif

                                    </div>
                                </div>
                            @endif
                            {{-- text --}}
                            <div class="leftBox">
                                <h2 class="title">
                                    @if (Config::get('app.locale') == 'ar')
                                        معلومات العقار
                                    @elseif (Config::get('app.locale') == 'en')
                                        Real Estate Information
                                    @endif
                                </h2>
                                <p>
                                    @if (Config::get('app.locale') == 'ar')
                                        {!! isset($advertisement->description_ar) ? $advertisement->description_ar : null !!}
                                    @elseif (Config::get('app.locale') == 'en')
                                        {!! isset($advertisement->description_en) ? $advertisement->description_en : null !!}
                                    @endif
                                </p>
                            </div>
                            {{-- تفاصيل --}}
                            <div class="leftBox details">
                                <h2 class="title">
                                    @if (Config::get('app.locale') == 'ar')
                                        تفاصيل العقار
                                    @elseif (Config::get('app.locale') == 'en')
                                        Real Estate Details
                                    @endif
                                </h2>
                                <ul>

                                    {{--   الحالة --}}
                                    <li>
                                        @lang('front.EstateStatus'):
                                        {{ isset($advertisement->status) ? $advertisement->status : null }}


                                    </li>


                                    <li>
                                        <img src="{{ asset('style_files/frontend/img/icons/1.png') }}" alt="img">
                                        <span>
                                            @if (Config::get('app.locale') == 'ar')
                                                {{ isset($advertisement->diyarnaaCountry->name_ar) ? $advertisement->diyarnaaCountry->name_ar : null }}
                                                -
                                                {{ isset($advertisement->diyarnaaCity->name_ar) ? $advertisement->diyarnaaCity->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                {{ isset($advertisement->diyarnaaCountry->name_en) ? $advertisement->diyarnaaCountry->name_en : null }}
                                                -
                                                {{ isset($advertisement->diyarnaaCity->name_en) ? $advertisement->diyarnaaCity->name_en : null }}
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <img src="{{ asset('style_files/frontend/img/icons/2.png') }}" alt="img">
                                        <span>
                                            @if (Config::get('app.locale') == 'ar')
                                                :السعر
                                                {{ isset($advertisement->price) ? $advertisement->price : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Price:
                                                {{ isset($advertisement->price) ? $advertisement->price : null }}
                                            @endif

                                        </span>
                                    </li>
                                    {{-- كود الاعلان --}}
                                    <li>
                                        <img src="{{ asset('style_files/frontend/img/icons/9.png') }}" alt="img">
                                        <span>
                                            @if (Config::get('app.locale') == 'ar')
                                                كود الاعلان :
                                                {{ isset($advertisement->code) ? $advertisement->code : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Ad Code :
                                                {{ isset($advertisement->code) ? $advertisement->code : null }}
                                            @endif

                                        </span>
                                    </li>
                                    {{-- المساحه --}}
                                    <li>
                                        <img src="{{ asset('style_files/frontend/img/icons/3.png') }}" alt="img">
                                        @if (Config::get('app.locale') == 'ar')
                                            المساحه :
                                            {{ isset($advertisement->area) ? $advertisement->area : null }}
                                            {{ isset($advertisement->feature) ? $advertisement->feature->name_ar : '------' }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Area:
                                            {{ isset($advertisement->area) ? $advertisement->area : null }}
                                            {{ isset($advertisement->feature) ? $advertisement->feature->name_en : '------' }}
                                        @endif

                                    </li>
                                    @if (isset($advertisement->contact_method))
                                        <li>

                                            @if (Config::get('app.locale') == 'ar')
                                                @lang('front.ContactMethod') :
                                                {{ isset($advertisement->contact_method) ? $advertisement->contact_method : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Contact Method:
                                                {{ isset($advertisement->contact_method) ? $advertisement->contact_method : null }}
                                            @endif

                                        </li>
                                    @endif

                                    @if (isset($advertisement->number_of_rooms))
                                        <li>
                                            <span>


                                                @if (Config::get('app.locale') == 'ar')
                                                    عدد الغرف :
                                                    {{ isset($advertisement->numberOfRoom->name_ar) ? $advertisement->numberOfRoom->name_ar : null }}
                                                @elseif (Config::get('app.locale') == 'en')
                                                    Number of Rooms :
                                                    {{ isset($advertisement->numberOfRoom->name_en) ? $advertisement->numberOfRoom->name_en : null }}
                                                @endif

                                            </span>
                                        </li>
                                    @endif
                                    @if (isset($advertisement->number_of_bathrooms))
                                        <li>
                                            <span>
                                                @if (Config::get('app.locale') == 'ar')
                                                    عدد الحمامات :
                                                    {{ isset($advertisement->numberOfBathroom->name_ar) ? $advertisement->numberOfBathroom->name_ar : null }}
                                                @elseif (Config::get('app.locale') == 'en')
                                                    Number of Bathrooms :
                                                    {{ isset($advertisement->numberOfBathroom->name_en) ? $advertisement->numberOfBathroom->name_en : null }}
                                                @endif
                                            </span>
                                        </li>
                                    @endif
                                    @if (isset($advertisement->construction_age))
                                        <li>
                                            <span>
                                                @if (Config::get('app.locale') == 'ar')
                                                    عمر البناء :
                                                    {{ isset($advertisement->constructionAge->name_ar) ? $advertisement->constructionAge->name_ar : null }}
                                                @elseif (Config::get('app.locale') == 'en')
                                                    Construction Age :
                                                    {{ isset($advertisement->constructionAge->name_en) ? $advertisement->constructionAge->name_en : null }}
                                                @endif
                                            </span>
                                        </li>
                                    @endif
                                    @if (isset($advertisement->land_area))
                                        <li>
                                            <span>
                                                @if (Config::get('app.locale') == 'ar')
                                                    مساحة الارض :
                                                    {{ isset($advertisement->landArea->name_ar) ? $advertisement->landArea->name_ar : null }}
                                                @elseif (Config::get('app.locale') == 'en')
                                                    Land area :
                                                    {{ isset($advertisement->landArea->name_en) ? $advertisement->landArea->name_en : null }}
                                                @endif
                                            </span>
                                        </li>
                                    @endif
                                    @if (isset($advertisement->real_estate_status))
                                        <li>
                                            <span>
                                                @if (Config::get('app.locale') == 'ar')
                                                    حالة العقار:
                                                    {{ isset($advertisement->realestateStatus->name_ar) ? $advertisement->realestateStatus->name_ar : null }}
                                                @elseif (Config::get('app.locale') == 'en')
                                                    Real Estate Status :
                                                    {{ isset($advertisement->realestateStatus->name_en) ? $advertisement->realestateStatus->name_en : null }}
                                                @endif
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            {{-- Extra features --}}
                            @if (isset($advertisement->extraFeatures) && $advertisement->extraFeatures->count() > 0)
                                <div class="leftBox details">
                                    <h2 class="title"> @lang('front.Features')</h2>
                                    <ul>
                                        @foreach ($advertisement->extraFeatures as $extraFeature)
                                            <li>
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span>
                                                        {{ isset($extraFeature->title_ar) ? $extraFeature->title_ar : null }}
                                                    </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span>
                                                        {{ isset($extraFeature->title_en) ? $extraFeature->title_en : null }}
                                                    </span>
                                                @endif

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            {{-- footer links --}}
                            <div class="footerLinksState">
                                @if (isset($advertisement->expiry_date) &&
                                        $advertisement->expiry_date < date('Y-m-d H:i:s') &&
                                        $advertisement->status != 'Pending')
                                    <a href="{{ route('owner-editAdvertisement', isset($advertisement->id) ? $advertisement->id : -1) }}"
                                        class="mainBg btn">
                                        @lang('front.RePublishAd')
                                    </a>
                                @endif
                                @if (isset($advertisement->edit_balance) &&
                                        isset($advertisement->expiry_date) &&
                                        $advertisement->edit_balance > 0 &&
                                        $advertisement->expiry_date > date('Y-m-d H:i:s') &&
                                        $advertisement->status != 'Pending')
                                    <a
                                        href="{{ route('owner-editAdvertisement', isset($advertisement->id) ? $advertisement->id : -1) }}">
                                        @lang('front.Edit') </a>
                                @elseif($advertisement->advertisementEditRequests->count() == 0)
                                    @if ($advertisement->status != 'Pending' && $advertisement->expiry_date > date('Y-m-d H:i:s'))
                                        <a
                                            href="{{ route('owner-advertisementEditRequest', isset($advertisement->id) ? $advertisement->id : -1) }}">
                                            طلب تعديل
                                        </a>
                                    @endif
                                @endif
                                @if (isset($advertisement->status) && ($advertisement->status == 'Active' || $advertisement->status == 'Inactive'))
                                    <a
                                        href="{{ route('owner-activeInactiveAdvertisement', isset($advertisement->id) ? $advertisement->id : -1) }}">
                                        @if (isset($advertisement->status))
                                            @if ($advertisement->status == 'Active')
                                                @lang('front.Stop')
                                            @elseif($advertisement->status == 'Inactive')
                                                @lang('front.Active')
                                            @endif
                                        @endif
                                    </a>
                                @endif
                                <a
                                    href="{{ route('owner-deleteAdvertisement', isset($advertisement->id) ? $advertisement->id : -1) }}">
                                    @lang('front.Delete')</a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
