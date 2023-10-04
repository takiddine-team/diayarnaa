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
            @if (isset($premium_membership_page->image) &&
                    $premium_membership_page->image &&
                    file_exists($premium_membership_page->image))
                <img src="{{ asset($premium_membership_page->image) }}" class="img-fluid" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif
            <div class="pageTitle">
                <h2>@lang('front.PremiumMembership')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                >> <span>@lang('front.PremiumMembership')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== Premium membership  section =============== --}}
            {{-- =========================================================== --}}

            <section class="PremiumMembership mt-5 pt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center heading">


                            @if (Config::get('app.locale') == 'ar')
                                <h2>خطة أسعار مرنة تناسب احتياجاتك</h2>
                            @elseif (Config::get('app.locale') == 'en')
                                <h2> Flexible Pricing Plan To Suit Your Needs </h2>
                            @endif


                            {{-- <p> --}}
                            @if (Config::get('app.locale') == 'ar')
                                <span class="realState_Location">
                                    {!! isset($premium_membership_page->description_ar) ? $premium_membership_page->description_ar : null !!}
                                </span>
                            @elseif (Config::get('app.locale') == 'en')
                                <span class="realState_Location">
                                    {!! isset($premium_membership_page->description_en) ? $premium_membership_page->description_en : null !!}
                                </span>
                            @endif
                            {{-- </p> --}}
                        </div>
                    </div>
                    <div class="row">
                        <ul class="PremiumMembershipList">

                            @if (isset($premium_memberships) && $premium_memberships->count() > 0)
                                @foreach ($premium_memberships as $premium_membership)
                                    <li>
                                        <div class="top">
                                            <label
                                                style="{{ $premium_membership->featured_type == 'True' ? 'background-color: #f9da43; color: #3b3b3b;' : null }}">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        {{ isset($premium_membership->name_ar) ? $premium_membership->name_ar : null }}
                                                    </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        {{ isset($premium_membership->name_en) ? $premium_membership->name_en : null }}
                                                    </span>
                                                @endif

                                            </label>
                                            <p>
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        {{ isset($premium_membership->description_ar) ? $premium_membership->description_ar : null }}
                                                    </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        {{ isset($premium_membership->description_en) ? $premium_membership->description_en : null }}
                                                    </span>
                                                @endif
                                            </p>
                                            <span class="price">

                                                {{ isset($premium_membership->price) ? number_format((float) $premium_membership->price, 2, '.', '') : null }}
                                                $

                                            </span>

                                            <a style="{{ $premium_membership->featured_type == 'True' ? 'background-color: #f9da43; color: #3b3b3b;' : null }}"
                                                href="{{ route('processTransaction', ['premium_membership_id' => isset($premium_membership->id) ? $premium_membership->id : -1]) }}">@lang('front.SubscriptionRequest')
                                                </a>

                                        </div>
                                        <div class="bottom">
                                            <span>
                                                <i class="fa-solid fa-circle-check"
                                                    style="{{ $premium_membership->featured_type == 'True' ? ' color: #3b3b3b;' : null }}"></i>
                                                @lang('front.Ad')
                                                ({{ isset($premium_membership->number_of_ads) ? $premium_membership->number_of_ads : @trans('front.Unlimited') }})
                                            </span>
                                            <span>
                                                <i class="fa-solid fa-circle-check"
                                                    style="{{ $premium_membership->featured_type == 'True' ? ' color: #3b3b3b;' : null }}"></i>
                                                ({{ isset($premium_membership->number_days_membership) ? $premium_membership->number_days_membership : @trans('front.Unlimited') }}
                                                @lang('front.Days'))
                                                @lang('front.PackageValidation') </span>
                                            <span>
                                                <i class="fa-solid fa-circle-check"
                                                    style="{{ $premium_membership->featured_type == 'True' ? ' color: #3b3b3b;' : null }}"></i>
                                                ({{ isset($premium_membership->number_days_ad) ? $premium_membership->number_days_ad : @trans('front.Unlimited') }}
                                                @lang('front.Days') )

                                                @lang('front.AdValidation') </span>
                                        </div>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
