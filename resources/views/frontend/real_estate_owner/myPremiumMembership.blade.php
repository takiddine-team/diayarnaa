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
                <h2>@lang('front.PremiumMembership')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.PremiumMembership')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== User menu section =============== --}}
            {{-- =========================================================== --}}

            @include('layouts.sideBar')

            {{-- =========================================================== --}}
            {{-- =================== dashboard content section =============== --}}
            {{-- =========================================================== --}}
            <section class="dashboardContent ">
                <div class="container">
                    <div class="row">
                        <div class="col-12 bShadow offersPage">

                            <h2>@lang('front.PremiumMembership')</h2>
                            <section class="PremiumMembership mt-5 pt-5">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 text-center heading">


                                            @if (Config::get('app.locale') == 'ar')
                                                <h2>خطة أسعار مرنة تناسب احتياجاتك</h2>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <h2> Flexible Pricing Plan To Suit Your Needs </h2>
                                            @endif



                                        </div>
                                    </div>
                                    <div class="row">
                                        <ul class="PremiumMembershipListTwo">
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
                                                                href="{{ route('processTransaction', ['premium_membership_id' => isset($premium_membership->id) ? $premium_membership->id : -1]) }}">
                                                                @if (Config::get('app.locale') == 'ar')
                                                                    <span class="realState_Location">
                                                                        طلب اشتراك </span>
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    <span class="realState_Location">
                                                                        Request Subscription
                                                                    </span>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="bottom">
                                                            <span>
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="{{ $premium_membership->featured_type == 'True' ? ' color: #3b3b3b;' : null }}"></i>

                                                                @if (Config::get('app.locale') == 'ar')
                                                                    <span class="realState_Location">
                                                                        اعلان</span>
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    <span class="realState_Location">
                                                                        Ad
                                                                    </span>
                                                                @endif
                                                                ({{ isset($premium_membership->number_of_ads) ? $premium_membership->number_of_ads : @trans('front.Unlimited') }})
                                                            </span>
                                                            <span>
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="{{ $premium_membership->featured_type == 'True' ? ' color: #3b3b3b;' : null }}"></i>
                                                                ({{ isset($premium_membership->number_days_membership) ? $premium_membership->number_days_membership : @trans('front.Unlimited') }}
                                                                @if (Config::get('app.locale') == 'ar')
                                                                    <span class="realState_Location">
                                                                        يوم</span>
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    <span class="realState_Location">
                                                                        day/s
                                                                    </span>
                                                                @endif)
                                                                @if (Config::get('app.locale') == 'ar')
                                                                    <span class="realState_Location">
                                                                        صلاحية الباقة</span>
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    <span class="realState_Location">
                                                                        Membership Validity
                                                                    </span>
                                                                @endif

                                                            </span>
                                                            <span>
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="{{ $premium_membership->featured_type == 'True' ? ' color: #3b3b3b;' : null }}"></i>
                                                                ({{ isset($premium_membership->number_days_ad) ? $premium_membership->number_days_ad : @trans('front.Unlimited') }}
                                                                @if (Config::get('app.locale') == 'ar')
                                                                    <span class="realState_Location">يوم</span>
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    <span class="realState_Location">day/s</span>
                                                                @endif)


                                                                @if (Config::get('app.locale') == 'ar')
                                                                    <span class="realState_Location">
                                                                        صلاحية الاعلان</span>
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    <span class="realState_Location">
                                                                        Ad validity
                                                                    </span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </section>
                            <div class="row">



                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        اسم المالك</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Office Name
                                                    </span>
                                                @endif
                                            </th>
                                            <th scope="col">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        العضوية المميزة</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Premium Membership
                                                    </span>
                                                @endif
                                            </th>
                                            <th scope="col">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        تاريخ الاشتراك </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Subscription Date
                                                    </span>
                                                @endif
                                            </th>
                                            <th scope="col">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        تاريخ الانتهاء </span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Expiration Date
                                                    </span>
                                                @endif
                                            </th>
                                            <th scope="col">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        باقي المدة</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Remaining Time
                                                    </span>
                                                @endif
                                            </th>
                                            <th scope="col">
                                                @if (Config::get('app.locale') == 'ar')
                                                    <span class="realState_Location">
                                                        عدد الاعلانات المتبقيه</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <span class="realState_Location">
                                                        Number of Remaining Ads
                                                    </span>
                                                @endif
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($user_premium_memberships) && $user_premium_memberships->count() > 0)
                                            @foreach ($user_premium_memberships as $user_premium_membership)
                                                <tr>
                                                    <td>{{ $user_premium_membership->user->name }}</td>


                                                    @if (Config::get('app.locale') == 'ar')
                                                        <td>{{ $user_premium_membership->premiumMembership->name_ar }}</td>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <td>{{ $user_premium_membership->premiumMembership->name_en }}</td>
                                                    @endif

                                                    <td>{!! isset($user_premium_membership->created_at)
                                                        ? date('Y-m-d', strtotime($user_premium_membership->created_at))
                                                        : '<span style="color:blue;">----------</span>' !!}</td>
                                                    <td>
                                                        {!! isset($user_premium_membership->expiry_date)
                                                            ? date('Y-m-d', strtotime($user_premium_membership->expiry_date))
                                                            : '<span style="color:blue;">----------</span>' !!}

                                                    </td>
                                                    <td>

                                                        @if ($user_premium_membership->expiry_date > now())
                                                            {{ now()->diffInDays($user_premium_membership->expiry_date) }}

                                                            @if (Config::get('app.locale') == 'ar')
                                                                يوم
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                Days
                                                            @endif
                                                        @else
                                                            @if (Config::get('app.locale') == 'ar')
                                                                انتهت
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                Expired
                                                            @endif
                                                        @endif


                                                    </td>
                                                    <td>
                                                        @if ($user_premium_membership->number_of_ads > 100)
                                                            @lang('front.Unlimited')
                                                        @else
                                                            {{ $user_premium_membership->number_of_ads }}
                                                            @lang('front.Ad')
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </section>
        </div>

    </div>
@endsection
