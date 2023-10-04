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
        @if (isset($about->background_company_image) &&
        $about->background_company_image &&
        file_exists($about->background_company_image))
        <img src="{{ asset($about->background_company_image) }}" class="img-fluid" alt="img">
        @else
        <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
        @endif
        <div class="pageTitle">
            <h2>@lang('front.AboutCompany')</h2>
        </div>
    </section>


    {{-- =========================================================== --}}
    {{-- =================== page wrapper =============== --}}
    {{-- =========================================================== --}}
    <div class="page_wrapper">
        <div class="bredCramb">
            <a href="{{ route('welcome') }}">@lang('front.WelcomePage')</a>
            <span class="enflip"> >> </span> <span>@lang('front.AboutCompany')</span>
        </div>

        {{-- =========================================================== --}}
        {{-- =================== aboutCompany  section =============== --}}
        {{-- =========================================================== --}}
        <section class="aboutCompany">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h2>

                            @if (Config::get('app.locale') == 'ar')
                            عن الشركة
                            @elseif (Config::get('app.locale') == 'en')
                            About Company
                            @endif

                        </h2>
                        <p>
                            @if (Config::get('app.locale') == 'ar')
                            {!! isset($about->about_description_ar) ? $about->about_description_ar : null !!}
                            @elseif (Config::get('app.locale') == 'en')
                            {!! isset($about->about_description_en) ? $about->about_description_en : null !!}
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        @if (isset($about->about_image) &&
                        $about->about_image &&
                        file_exists($about->about_image))
                        <img src="{{ asset($about->about_image) }}" class="img-fluid" alt="img">
                        @else
                        <img src="{{ asset('style_files/frontend/img/aboutCompany.png') }}" class="img-fluid" alt="img">
                        @endif

                    </div>
                </div>
            </div>
        </section>

        {{-- =========================================================== --}}
        {{-- =================== aboutCompany  section =============== --}}
        {{-- =========================================================== --}}
        <section class="counterSection">
            <div class="bg">
                <img src="{{ asset('style_files/frontend/img/count.png') }}" alt="img">
            </div>
            <div class="container">
                <div class="row counterRow">

                    {{-- 1 --}}
                    <div class="col-md-4 mb-3 text-center">
                        <div class="image">
                            <img src="{{ asset('style_files/frontend/img/icons/office.svg') }}" alt="img">
                        </div>
                        <span class="count counter" data-target=" {{ isset($number_of_office) ? $number_of_office : 100 }}">
                            {{ isset($number_of_office) ? $number_of_office : 100 }}
                        </span>
                        <span class="name">
                            @if (Config::get('app.locale') == 'ar')
                            مكتب عقاري
                            @elseif (Config::get('app.locale') == 'en')
                            Real estate Office
                            @endif
                        </span>
                    </div>

                    {{-- 2 --}}
                    <div class="col-md-4 mb-3 text-center">
                        <div class="image">
                            <img src="{{ asset('style_files/frontend/img/icons/owner.svg') }}" alt="img">
                        </div>
                        <span class="count counter" data-target="{{ isset($number_of_owners) ? $number_of_owners : 100 }}">
                            {{ isset($number_of_owners) ? $number_of_owners : 100 }}
                        </span>
                        <span class="name">
                            @if (Config::get('app.locale') == 'ar')
                            مالك عقار
                            @elseif (Config::get('app.locale') == 'en')
                            Real estate Owner
                            @endif
                        </span>
                    </div>

                    {{-- 3 --}}
                    <div class="col-md-4 mb-3 text-center">
                        <div class="image">
                            <img src="{{ asset('style_files/frontend/img/icons/researcher.svg') }}" alt="img">
                        </div>
                        <span class="count counter" data-target="{{ isset($number_of_seekers) ? $number_of_seekers : 100 }}">
                            {{ isset($number_of_seekers) ? $number_of_seekers : 100 }}
                        </span>
                        <span class="name">
                            @if (Config::get('app.locale') == 'ar')
                            باحث مميز
                            @elseif (Config::get('app.locale') == 'en')
                            Real estate Seeker
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>
@endsection