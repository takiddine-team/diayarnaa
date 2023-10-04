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
            @if (isset($background_image->advertisement_details) &&
                    $background_image->getRawOriginal('advertisement_details') &&
                    file_exists($background_image->getRawOriginal('advertisement_details')))
                <img src="{{ asset($background_image->advertisement_details) }}" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif
            <div class="pageTitle">
                <h2>@lang('front.Property')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Welcome')</a>
                <span class="enflip"> >> </span> <span> @lang('front.Property') </span>
            </div>


            {{-- =========================================================== --}}
            {{-- =================== تفاصيل العقار section =============== --}}
            {{-- =========================================================== --}}
            <section class="py-5 mt-5 realStateDetails det">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="allRight">
                                @if (auth()->guard('user')->user())
                                    <div class="box">
                                        <h2 class="title">
                                            {{ isset($advertisement->user->name) ? $advertisement->user->name : null }}
                                        </h2>
                                    </div>
                                    <div class="box">
                                        <div class="titleImage">
                                            @if (isset($advertisement->user->profile_image) &&
                                                    $advertisement->user->profile_image &&
                                                    file_exists($advertisement->user->profile_image))
                                                <img src="{{ asset($advertisement->user->profile_image) }}"
                                                    class="img-fluid" alt="img">
                                            @else
                                                <img src="{{ asset('style_files/frontend/img/user.png') }}"
                                                    class="img-fluid" alt="img">
                                            @endif

                                            <div class="text">
                                                <h2> {{ isset($advertisement->user->name) ? $advertisement->user->name : null }}
                                                </h2>
                                                <span>
                                                    @if ($advertisement->user->user_type == 'Real Estate Office')
                                                        @lang('front.RealEstateOffice')
                                                    @elseif($advertisement->user->user_type == 'Real Estate Owner')
                                                        @lang('front.RealEstateOwner')
                                                    @endif
                                                </span>
                                                @if (isset($advertisement->user->diyarnaCountry->flag) &&
                                                        $advertisement->user->diyarnaCountry->flag &&
                                                        file_exists($advertisement->user->diyarnaCountry->flag))
                                                    <img src="{{ asset($advertisement->user->diyarnaCountry->flag) }}"
                                                        class="img-fluid" alt="img">
                                                @else
                                                    <img src="{{ asset('style_files/frontend/img/jo.png') }}"
                                                        class="img-fluid" alt="img">
                                                @endif

                                            </div>
                                        </div>
                                    </div>


                                    @if ($advertisement->user->user_type == 'Real Estate Office')

                                        <div class="box">
                                            <div class="contactInfo">
                                                @if (isset($advertisement->user->office_phone))
                                                    <a href="tel:009627755559">
                                                        <i class="fas fa-briefcase"></i>
                                                        {{ isset($advertisement->user->office_phone) ? $advertisement->user->office_phone : null }}</a>
                                                @endif
                                                <a href="mailto:test@gmail.com">
                                                    <i class="fa-solid fa-envelope"></i>
                                                    {{ isset($advertisement->user->email) ? $advertisement->user->email : null }}</a>
                                                <a href="tel:009627755559">
                                                    <i class="fa-solid fa-phone"></i>
                                                    {{ isset($advertisement->user->phone) ? $advertisement->user->phone : null }}</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="box">
                                            <div class="contactInfo">

                                                <span>
                                                    @lang('front.ContactMethod') :
                                                    {{ isset($advertisement->contact_method) ? $advertisement->contact_method : null }}
                                                </span>



                                                @if (isset($advertisement->contact_method) && $advertisement->contact_method == 'Email')
                                                    <a href="mailto:test@gmail.com">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        {{ isset($advertisement->user->email) ? $advertisement->user->email : null }}</a>
                                                @elseif (isset($advertisement->contact_method) &&
                                                        ($advertisement->contact_method == 'Whatsapp' || $advertisement->contact_method == 'Mobile'))
                                                    <a href="tel:009627755559">
                                                        <i class="fa-solid fa-phone"></i>
                                                        {{ isset($advertisement->user->phone) ? $advertisement->user->phone : null }}</a>
                                                @else
                                                    <a href="mailto:test@gmail.com">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        {{ isset($advertisement->user->email) ? $advertisement->user->email : null }}</a>
                                                    <a href="tel:009627755559">
                                                        <i class="fa-solid fa-phone"></i>
                                                        {{ isset($advertisement->user->phone) ? $advertisement->user->phone : null }}</a>
                                                @endif


                                            </div>
                                        </div>



                                    @endif

                                @endif
                                @if (isset(auth()->guard('user')->user()->id) &&
                                        $advertisement->user_id !=
                                            auth()->guard('user')->user()->id)
                                    {{-- طلب استفسار --}}
                                    <div class="box anInquiry">
                                        <h2 class="title">@lang('front.InqueryRequest')</h2>
                                        <form
                                            action="{{ route('sendEnquiry', isset($advertisement->id) ? $advertisement->id : -1) }}"
                                            class="formInquiry" method="POST">
                                            @csrf

                                            {{-- Name --}}
                                            <div class="form-group">
                                                <label for="country">@lang('front.Name')
                                                    <strong class="text-danger">
                                                        *
                                                        @error('name')
                                                            -
                                                            ({{ $message }})
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <input type="text" class="form-control" placeholder="@lang('front.Name')"
                                                    name="name">
                                            </div>

                                            {{-- Phone --}}

                                            <div class="form-group">
                                                <label for="country">@lang('front.Phone')- @lang('front.AdvFormNote')

                                                    <strong class="text-danger">
                                                        *
                                                        @error('phone')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <input type="tel" class="form-control text-right"
                                                    placeholder="@lang('front.Phone')" name="phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="country">@lang('front.Email')

                                                    <strong class="text-danger">
                                                        *
                                                        @error('email')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <input type="email" class="form-control" placeholder="@lang('front.Email')"
                                                    name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="country">@lang('front.InqueryMessage')

                                                    <strong class="text-danger">
                                                        *
                                                        @error('message')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <textarea rows="5" class="form-control" placeholder="@lang('front.Message')" name="message"></textarea>
                                            </div>
                                            <input type="submit" class="submit mainBg" value="@lang('front.Send')">

                                            {{-- share --}}
                                            {{-- <a href="#" class="shareBtn">
                                        <i class="fa-solid fa-square-share-nodes mainColor "></i>
                                        مشاركة
                                    </a> --}}
                                        </form>
                                    </div>
                                @elseif(!auth()->guard('user')->user())
                                    {{-- طلب استفسار --}}
                                    <div class="box anInquiry">
                                        <h2 class="title">@lang('front.InqueryRequest')</h2>
                                        <form
                                            action="{{ route('sendEnquiry', isset($advertisement->id) ? $advertisement->id : -1) }}"
                                            class="formInquiry" method="POST">
                                            @csrf
                                            {{-- Name --}}
                                            <div class="form-group">
                                                <label for="country">@lang('front.Name')

                                                    <strong class="text-danger">
                                                        *
                                                        @error('name')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <input type="text" class="form-control" placeholder="@lang('front.Name')"
                                                    name="name">

                                            </div>

                                            {{-- Country --}}
                                            <div class="form-group">
                                                <label for="country">@lang('front.CountryName')
                                                    <strong class="text-danger">
                                                        *
                                                        @error('diyarnaa_country_id')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <select class="form-control" name="diyarnaa_country_id"
                                                    id="diyarnaa_country_id" onchange="getDiyarnaaCities()">
                                                    @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                                        <option value="" selected>@lang('front.InqueryRequestCountry')</option>
                                                        @foreach ($diyarnaa_countries as $diyarnaa_country)
                                                            <option value="{{ $diyarnaa_country->id }}"
                                                                @if (old('diyarnaa_country_id') != null) @if (old('diyarnaa_country_id') == $diyarnaa_country->id) selected @endif
                                                            @else @if ($diyarnaa_country->diyarnaa_country_id == $diyarnaa_country->id) selected @endif
                                                                @endif>

                                                                @if (Config::get('app.locale') == 'ar')
                                                                    <span>
                                                                        {{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : null }}</span>
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    <span>{{ isset($diyarnaa_country->name_en) ? $diyarnaa_country->name_en : null }}</span>
                                                                @endif

                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>


                                            {{-- Phone --}}

                                            <div class="form-group">
                                                <label for="country">@lang('front.Phone') - @lang('front.AdvFormNote')

                                                    <strong class="text-danger">
                                                        *
                                                        @error('phone')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <input type="tel" class="form-control text-right"
                                                    placeholder="@lang('front.Phone')" name="phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="country">@lang('front.Email')

                                                    <strong class="text-danger">
                                                        *
                                                        @error('email')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <input type="email" class="form-control"
                                                    placeholder="@lang('front.Email')" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="country">@lang('front.InqueryMessage')

                                                    <strong class="text-danger">
                                                        *
                                                        @error('message')
                                                            -
                                                            {{ $message }}
                                                        @enderror
                                                    </strong>
                                                </label>
                                                <textarea rows="5" class="form-control" placeholder="@lang('front.Message')" name="message"></textarea>
                                            </div>
                                            <input type="submit" class="submit mainBg" value="@lang('front.Send')">

                                            {{-- share --}}
                                            {{-- <a href="#" class="shareBtn">
                                        <i class="fa-solid fa-square-share-nodes mainColor "></i>
                                        مشاركة
                                    </a> --}}
                                        </form>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="allLeft">
                                {{-- slider --}}
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
                                                    <source src="{{ URL::asset($advertisement->video) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif

                                        </div>
                                    </div>
                                @endif
                                {{-- text --}}
                                <div class="leftBox">
                                    <h2 class="title">@lang('front.PropertInfo')</h2>

                                    <p>
                                        @if (Config::get('app.locale') == 'ar')
                                            <span class="realState_Location">
                                                {!! isset($advertisement->description_ar) ? $advertisement->description_ar : null !!}</span>
                                        @elseif (Config::get('app.locale') == 'en')
                                            <span class="realState_Location">
                                                {!! isset($advertisement->description_en) ? $advertisement->description_en : null !!}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                {{-- تفاصيل --}}
                                <div class="leftBox details">
                                    <h2 class="title">@lang('front.PropertDetails')</h2>
                                    <ul>
                                        {{-- الدولة و المحافظة --}}
                                        <li>
                                            <img src="{{ asset('style_files/frontend/img/icons/1.png') }}"
                                                alt="img">

                                            <span class="realState_Location">
                                                @if (Config::get('app.locale') == 'ar')
                                                    {{ isset($advertisement->diyarnaaCountry->name_ar) ? $advertisement->diyarnaaCountry->name_ar : null }}
                                                    -
                                                    {{ isset($advertisement->diyarnaaCity->name_ar) ? $advertisement->diyarnaaCity->name_ar : null }}
                                                @elseif (Config::get('app.locale') == 'en')
                                                    {{ isset($advertisement->diyarnaaCountry->name_en) ? $advertisement->diyarnaaCountry->name_en : null }}
                                                    {{ isset($advertisement->diyarnaaCity->name_en) ? $advertisement->diyarnaaCity->name_en : null }}
                                                @endif
                                            </span>
                                        </li>


                                        {{-- كود الاعلان --}}
                                        <li>
                                            <img src="{{ asset('style_files/frontend/img/icons/9.png') }}"
                                                alt="img">
                                            @lang('front.AdCode'):
                                            <span>
                                                {{ isset($advertisement->code) ? $advertisement->code : null }}

                                            </span>
                                        </li>
                                        {{-- المساحه --}}
                                        <li>
                                            <img src="{{ asset('style_files/frontend/img/icons/3.png') }}"
                                                alt="img">
                                            @lang('front.PropertArea'):
                                            {{--  <span> {{ isset($advertisement->area) ? $advertisement->area : null }}</span>

                                            <span>{{ isset($advertisement->feature) ? $advertisement->feature->name_ar : '------' }}
                                            </span>  --}}

                                            @if (Config::get('app.locale') == 'ar')
                                                <span>
                                                    {{ isset($advertisement->area) ? $advertisement->area : null }}</span>

                                                <span>{{ isset($advertisement->feature) ? $advertisement->feature->name_ar : '------' }}
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span>
                                                    {{ isset($advertisement->area) ? $advertisement->area : null }}</span>

                                                <span>{{ isset($advertisement->feature) ? $advertisement->feature->name_en : '------' }}
                                                </span>
                                            @endif
                                        </li>

                                        @if (isset($advertisement->number_of_rooms))
                                            <li>
                                                <span>


                                                    @if (Config::get('app.locale') == 'ar')
                                                        عدد الغرف :
                                                        {{ isset($advertisement->numberOfRoom->name_ar) ? $advertisement->numberOfRoom->name_ar : null }}
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        Number of rooms :
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
                                                        Construction age :
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
                                                        Real estate status :
                                                        {{ isset($advertisement->realestateStatus->name_en) ? $advertisement->realestateStatus->name_en : null }}
                                                    @endif
                                                </span>
                                            </li>
                                        @endif
                                        {{-- السعر --}}
                                        <li>
                                            <img src="{{ asset('style_files/frontend/img/icons/2.png') }}"
                                                alt="img">
                                            @lang('front.PropertPrice'):
                                            <span>
                                                {{ isset($advertisement->price) ? number_format(round($advertisement->price)) : null }}</span>
                                            <span>
                                                $</span>
                                        </li>
                                    </ul>
                                </div>
                                {{-- text --}}
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

                                {{-- social media --}}

                                <div class="c_inmages col-md-12 col-xs-12">
                                    <div class="c_item">
                                        <h4>@lang('front.ShareAd')</h4>
                                        <hr>
                                        <!-- أزرار المشاركة -->
                                        <div class="share-buttons">
                                            <a style="color: blue;border: 2px solid #e7d9d9;" href="https://www.facebook.com/sharer.php?u={{ url()->current() }}"
                                                target="_blank" class="btn "><i class="fa-brands fa-facebook fa-xl"></i></a>
                                            <a style="color: blue;border: 2px solid #e7d9d9;" href="https://twitter.com/intent/tweet?url={{ url()->current() }}"
                                                target="_blank" class="btn "><i class="fa-brands fa-twitter fa-xl"></i></a>
                                            <a style="color: blue;border: 2px solid #e7d9d9;" href="https://www.linkedin.com/shareArticle?url={{ url()->current() }}"
                                                target="_blank" class="btn "><i class="fa-brands fa-linkedin fa-xl"></i></a>
                                            <a style="color: blue;border: 2px solid #e7d9d9;" href="https://api.whatsapp.com/send?text={{ url()->current() }}"
                                                target="_blank" class="btn "><i class="fa-brands fa-whatsapp fa-xl"></i> </a>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>

    </div>
@endsection
