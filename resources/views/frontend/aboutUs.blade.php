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
            @if (isset($about_us->background_aboutus_image) &&
                    $about_us->background_aboutus_image &&
                    file_exists($about_us->background_aboutus_image))
                <img src="{{ asset($about_us->background_aboutus_image) }}" class="img-fluid" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif
            <div class="pageTitle">
                <h2>@lang('front.AboutUs')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.WelcomePage')</a> <span class="enflip"> >> </span>  <span>@lang('front.AboutUs')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== about us  section =============== --}}
            {{-- =========================================================== --}}
            <section class="aboutUs">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <ul>
                                <li>
                                    <div class="image">
                                        @if (isset($about_us->our_message_image) && $about_us->our_message_image && file_exists($about_us->our_message_image))
                                            <img src="{{ asset($about_us->our_message_image) }}" class="img-fluid"
                                                alt="img">
                                        @else
                                            <img src="{{ asset('style_files/frontend/img/ab1.png') }}" class="img-fluid"
                                                alt="icon">
                                        @endif

                                    </div>
                                    <div class="text" style="overflow: scroll;height: 200px;">
                                        <h2>@lang('front.AboutUsMessage')</h2>
                                        @if (Config::get('app.locale') == 'ar')
                                            <p>{!! isset($about_us->our_message_ar) ? $about_us->our_message_ar : null !!}</p>
                                        @elseif (Config::get('app.locale') == 'en')
                                            <p>{!! isset($about_us->our_message_en) ? $about_us->our_message_en : null !!}</p>
                                        @endif

                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="col-12">
                            <ul>

                                <li>
                                    <div class="image">
                                        @if (isset($about_us->our_vission_image) && $about_us->our_vission_image && file_exists($about_us->our_vission_image))
                                            <img src="{{ asset($about_us->our_vission_image) }}" class="img-fluid"
                                                alt="img">
                                        @else
                                            <img src="{{ asset('style_files/frontend/img/ab2.png') }}" class="img-fluid"
                                                alt="icon">
                                        @endif
                                    </div>

                                    <div class="text" style="overflow: scroll;height: 200px;">
                                        <h2>@lang('OurVision')</h2>
                                        @if (Config::get('app.locale') == 'ar')
                                            <p>{!! isset($about_us->our_vission_ar) ? $about_us->our_vission_ar : null !!}</p>
                                        @elseif (Config::get('app.locale') == 'en')
                                            <p>{!! isset($about_us->our_vission_en) ? $about_us->our_vission_en : null !!}</p>
                                        @endif


                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="col-12">
                            <ul>
                                <li>
                                    <div class="image">
                                        @if (isset($about_us->our_value_image) && $about_us->our_value_image && file_exists($about_us->our_value_image))
                                            <img src="{{ asset($about_us->our_value_image) }}" class="img-fluid"
                                                alt="img">
                                        @else
                                            <img src="{{ asset('style_files/frontend/img/ab3.png') }}" class="img-fluid"
                                                alt="icon">
                                        @endif
                                    </div>
                                    <div class="text" style="overflow: scroll;height: 200px;">
                                        <h2>@lang('front.OurValue')</h2>
                                        @if (Config::get('app.locale') == 'ar')
                                            <p>{!! isset($about_us->our_value_ar) ? $about_us->our_value_ar : null !!}</p>
                                        @elseif (Config::get('app.locale') == 'en')
                                            <p>{!! isset($about_us->our_value_en) ? $about_us->our_value_en : null !!}</p>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
