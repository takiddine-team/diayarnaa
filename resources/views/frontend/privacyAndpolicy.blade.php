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

            @if (isset($background_image->privacy_policy) &&
                    $background_image->getRawOriginal('privacy_policy') &&
                    file_exists($background_image->getRawOriginal('privacy_policy')))
                <img src="{{ asset($background_image->privacy_policy) }}" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif

            <div class="pageTitle">
                <h2>
                    @if (Config::get('app.locale') == 'ar')
                        سياسة الخصوصية
                    @elseif (Config::get('app.locale') == 'en')
                        Privacy Policy
                    @endif
                </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">
                    @if (Config::get('app.locale') == 'ar')
                        الرئيسية
                    @elseif (Config::get('app.locale') == 'en')
                        Welcome
                    @endif
                </a>
                <span class="enflip"> >> </span> <span>
                    @if (Config::get('app.locale') == 'ar')
                        سياسة الخصوصية
                    @elseif (Config::get('app.locale') == 'en')
                        Privacy Policy
                    @endif
                </span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== terms and condition  section =============== --}}
            {{-- =========================================================== --}}
            <section class="termCondition">
                <div class="container">
                    <div class="row">
                        @if (isset($privacy_policies) && $privacy_policies->count() > 0)
                            @foreach ($privacy_policies as $privacy_policy)
                                <div class="col-12 mb-5 bShadow">
                                    <h2>
                                        @if (Config::get('app.locale') == 'ar')
                                            {{ isset($privacy_policy->privacy_title_ar) ? $privacy_policy->privacy_title_ar : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            {{ isset($privacy_policy->privacy_title_en) ? $privacy_policy->privacy_title_en : null }}
                                        @endif
                                    </h2>
                                    <div class="termConditionList">
                                        @if (Config::get('app.locale') == 'ar')
                                            {!! isset($privacy_policy->privacy_description_ar) ? $privacy_policy->privacy_description_ar : null !!}
                                        @elseif (Config::get('app.locale') == 'en')
                                            {!! isset($privacy_policy->privacy_description_en) ? $privacy_policy->privacy_description_en : null !!}
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
