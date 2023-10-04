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
            @if (isset($background_image->website_broker) &&
                    $background_image->getRawOriginal('website_broker') &&
                    file_exists($background_image->getRawOriginal('website_broker')))
                <img src="{{ asset($background_image->website_broker) }}" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif





            <div class="pageTitle">
                <h2>@lang('front.BrokerPage') </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.WelcomePage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.BrokerPage')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== site Mediation us section =============== --}}
            {{-- =========================================================== --}}
            <section class="siteMediation mt-5 pt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <p class="flanP">@lang('front.BrokerParagraphSections')"</p>
                        </div>
                        <div class="col-md-10">
                            @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                                <ul class="siteMediationTabs">

                                    @foreach ($diyarnaa_countries as $key => $diyarnaa_country)
                                        <li class="tablinks" onclick="openCity(event, '{{ $diyarnaa_country->name_en }}')"
                                            id="{{ $key == 0 ? 'defaultOpen' : '' }}">
                                            <a href="#{{ $diyarnaa_country->id }}" class="siteMediationTabLink">
                                                <img src="{{ asset($diyarnaa_country->flag) }}" class="img-fluid"
                                                    alt="img">
                                                    @if (Config::get('app.locale') == 'ar')
                                                      <span>  {{ isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : null }}</span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                       <span>{{ isset($diyarnaa_country->name_en) ? $diyarnaa_country->name_en : null }}</span>
                                                    @endif
                                            </a>
                                        </li>
                                    @endforeach


                                </ul>
                            @else
                                <h2 style="text-align: center">
                                    @lang('front.WebsiteBrokerWillBeAdded') </h2>
                            @endif
                        </div>
                    </div>
                </div>
            </section>


            <!--content 1 -->
            @if (isset($diyarnaa_countries) && $diyarnaa_countries->count() > 0)
                @foreach ($diyarnaa_countries as $key => $diyarnaa_country)
                    <section id="{{ $diyarnaa_country->name_en }}" class="tabcontent">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="siteMediationContent">
                                        @if (isset($diyarnaa_country->websiteBrokers) && $diyarnaa_country->websiteBrokers->count() > 0)
                                            @foreach ($diyarnaa_country->websiteBrokers as $websiteBroker)
                                                <li>
                                                    <button type="button" class="btn btn-primary popbtn"
                                                        data-toggle="modal"
                                                        data-target="#popimage{{ $websiteBroker->id }}">
                                                        <img src="{{ asset($websiteBroker->image) }}" class="img-fluid"
                                                            alt="img">
                                                    </button>

                                                    <div class="modal fade" id="popimage{{ $websiteBroker->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img src="{{ asset($websiteBroker->image) }}"
                                                                        class="img-fluid" alt="img">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                @endforeach
            @endif



            <!-- bottom link -->
            <section class="bottomSiteMediationLink my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="text">
                                <p> @lang('front.BrokerContact') </p>
                                <a href="{{ route('WebsiteBrokerRequestForm') }}">@lang('front.PressHere')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
@endsection
