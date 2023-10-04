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
                <h2> @lang('front.CustomerRequestAndOffer')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span> @lang('front.CustomerRequestAndOffer')</span>
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
                            @if (isset($offer->customerRequestAndOfferImages) && $offer->customerRequestAndOfferImages->count() > 0)
                                <div class="leftBox">
                                    <div class="innerDetailsSlider">
                                        <div id="wrap">
                                            <ul id="imageGallery">
                                                @foreach ($offer->customerRequestAndOfferImages as $offer_image)
                                                @if (isset($offer_image->image) &&
                                                        $offer_image->getRawOriginal('image') &&
                                                        file_exists($offer_image->getRawOriginal('image')))
                                                <li data-thumb="{{ asset($offer_image->image) }}" data-src="{{ asset($offer_image->image) }}">
                                                    <img src="{{ asset($offer_image->image) }}" />
                                                  </li>
                                                @endif
                                                @endforeach
                                                </ul>



                                            
                                           
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- video --}}
                            @if (isset($offer->video))
                                <div class="leftBox">

                                    <div class="videoBox">
                                        @if (isset($offer->video) && $offer->video && file_exists($offer->video))
                                            <video width="100%" height="240" controls>
                                                <source src="{{ URL::asset($offer->video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif

                                    </div>
                                </div>
                            @endif
                            {{-- الاعلان --}}
                            @if (isset($offer->advertising) && $offer->advertising != null)
                                <div class="leftBox details">
                                    <h2 class="title">
                                        @if (Config::get('app.locale') == 'ar')
                                            الاعلان
                                        @elseif (Config::get('app.locale') == 'en')
                                            Advertising
                                        @endif
                                    </h2>


                                    {{ isset($offer->advertising) ? $offer->advertising : null }}


                                </div>
                            @endif
                            {{-- تفاصيل --}}
                            <div class="leftBox details">
                                <h2 class="title">
                                    @if (Config::get('app.locale') == 'ar')
                                        التفاصيل
                                    @elseif (Config::get('app.locale') == 'en')
                                        Details
                                    @endif
                                </h2>
                                <ul>

                                    {{--   النوع --}}
                                    <li>

                                        @if (Config::get('app.locale') == 'ar')
                                            النوع :
                                            {{ isset($offer->type) ? $offer->type : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Type:
                                            {{ isset($offer->type) ? $offer->type : null }}
                                        @endif



                                    </li>
                                    <li>


                                        @if (Config::get('app.locale') == 'ar')
                                            الغرض :
                                            {{ isset($offer->target) ? $offer->target->name_ar : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Target:
                                            {{ isset($offer->target) ? $offer->target->name_en : null }}
                                        @endif



                                    </li>

                                    {{-- اسم وكيل العقار --}}
                                    <li>

                                        @if (Config::get('app.locale') == 'ar')
                                            اسم الوكيل :
                                            {{ isset($offer->name) ? $offer->name : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Agent Name:
                                            {{ isset($offer->name) ? $offer->name : null }}
                                        @endif

                                    </li>
                                    {{-- الدولة --}}
                                    <li>
                                        <span>
                                            @if (Config::get('app.locale') == 'ar')
                                                الدولة :
                                                {{ isset($offer->diyarnaaCountry->name_ar) ? $offer->diyarnaaCountry->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Country :
                                                {{ isset($offer->diyarnaaCountry->name_en) ? $offer->diyarnaaCountry->name_en : null }}
                                            @endif
                                        </span>
                                    </li>

                                    {{-- المحافظة --}}
                                    <li>
                                        <span>
                                            @if (Config::get('app.locale') == 'ar')
                                                المدينة :
                                                {{ isset($offer->diyarnaaCity->name_ar) ? $offer->diyarnaaCity->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                City :
                                                {{ isset($offer->diyarnaaCity->name_en) ? $offer->diyarnaaCity->name_en : null }}
                                            @endif
                                        </span>
                                    </li>


                                    {{-- المنطقة --}}
                                    <li>

                                        <span>
                                            @if (Config::get('app.locale') == 'ar')
                                                المنطقة:
                                                {{ isset($offer->diyarnaaRegion->name_ar) ? $offer->diyarnaaRegion->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Region:
                                                {{ isset($offer->diyarnaaRegion->name_en) ? $offer->diyarnaaRegion->name_en : null }}
                                            @endif

                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            @if (Config::get('app.locale') == 'ar')
                                                التصنيف الرئيسي:
                                                {{ isset($offer->mainCategory->name_ar) ? $offer->mainCategory->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Main Category:
                                                {{ isset($offer->mainCategory->name_en) ? $offer->mainCategory->name_en : null }}
                                            @endif

                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            @if (Config::get('app.locale') == 'ar')
                                                التصنيف الفرعي:
                                                {{ isset($offer->subCategory->name_ar) ? $offer->subCategory->name_ar : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Main Category:
                                                {{ isset($offer->subCategory->name_en) ? $offer->subCategory->name_en : null }}
                                            @endif

                                        </span>
                                    </li>



                                    <li>
                                        <span>
                                            @if (Config::get('app.locale') == 'ar')
                                                السعر :
                                                {{ isset($offer->price) ? $offer->price : null }}
                                            @elseif (Config::get('app.locale') == 'en')
                                                Price:
                                                {{ isset($offer->price) ? $offer->price : null }}
                                            @endif

                                        </span>
                                    </li>

                                    {{-- المساحه --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            المساحه :
                                            {{ isset($offer->area) ? $offer->area : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Area:
                                            {{ isset($offer->area) ? $offer->area : null }}
                                        @endif

                                    </li>


                                    {{-- >هاتف العميل --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            هاتف العميل:
                                            {{ isset($offer->phone) ? $offer->phone : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Customer phone:
                                            {{ isset($offer->phone) ? $offer->phone : null }}
                                        @endif

                                    </li>




                                    {{-- >العنوان  --}}
                                    <li>
                                        @if (Config::get('app.locale') == 'ar')
                                            العنوان:
                                            {{ isset($offer->address) ? $offer->address : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            Address :
                                            {{ isset($offer->address) ? $offer->address : null }}
                                        @endif

                                    </li>






                            </div>
                        </div>
                    </div>
            </section>
        </div>

    </div>
@endsection
