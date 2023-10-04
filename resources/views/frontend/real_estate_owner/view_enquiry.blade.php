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
                <h2>@lang('front.InqueryRequest')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.InqueryRequest')</span>
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
                            <form action="" class="editUserForm">
                                @csrf
                                <h2>@lang('front.InqueryRequest')</h2>
                                @if (isset($advertisements) && count($advertisements) > 0)
                                    @foreach ($advertisements as $advertisement)
                                        <h6 class="ask_heading">@lang('front.YouHave')
                                            {{ $advertisement->enqueryRequests->count() }}
                                            @lang('front.InquiriesAboutAnAdvertisementCode'){{ $advertisement->code }}
                                        </h6>
                                        @foreach ($advertisement->enqueryRequests as $ask)
                                            <div class="ask-page">
                                                <div class="col-8 mb-3">
                                                    <label>{{ Str::limit($ask->message, 175) }}</label>
                                                </div>
                                                {{-- reply --}}
                                                <div class="col-2 m-3 askbtn">
                                                    <a
                                                        href="{{ route('owner-enquiryDetails', isset($ask->id) ? $ask->id : -1) }}">@lang('front.View')</a>
                                                </div>
                                                <div class="col-2 m-3 askbtn">

                                                    <a class="confirm"
                                                        href="{{ route('owner-destroyEnquiry', isset($ask->id) ? $ask->id : -1) }}">@lang('front.Delete')</a>


                                                </div>

                                            </div>
                                        @endforeach
                                    @endforeach
                                @else
                                    <h6 class="ask_heading">
                                        @if (Config::get('app.locale') == 'ar')
                                            لا يوجد طلبات استفسار
                                            {{ isset($advertisement->real_estate_agent_name) ? $advertisement->real_estate_agent_name : null }}
                                        @elseif (Config::get('app.locale') == 'en')
                                            There is no enquery requests
                                            {{ isset($advertisement->real_estate_agent_name) ? $advertisement->real_estate_agent_name : null }}
                                        @endif
                                    </h6>
                                @endif


                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
