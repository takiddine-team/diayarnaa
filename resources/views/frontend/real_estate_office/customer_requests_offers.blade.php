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
                <h2>@lang('front.CustomerProposalRequests')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                >> <span>@lang('front.CustomerProposalRequests')</span>
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

                            <h2> @lang('front.Request') </h2>
                            <div class="row">

                                <div class="twoBtn">
                                    {{-- Save --}}
                                    <div class="col-3 mb-3 askbtn">
                                        <a href="{{ route('office-createCustomerRequestsOffer') }}">@lang('front.Add')</a>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">@lang('front.RequestorNumber')</th>
                                            <th scope="col">@lang('front.EmployeeName')</th>
                                            <th scope="col">@lang('front.CustomerPhone')</th>
                                            <th scope="col">@lang('front.TheItem')</th>
                                            <th scope="col">@lang('front.MainCategory')</th>
                                            <th scope="col">@lang('front.CountryName')</th>
                                            <th scope="col">@lang('front.State')</th>
                                            <th scope="col">@lang('front.Region')</th>
                                            <th scope="col">@lang('front.Area')</th>
                                            <th scope="col">@lang('front.Price')</th>
                                            <th scope="col">@lang('front.Dashboard')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($offers) && count($offers) > 0)
                                            @foreach ($offers as $offer)
                                                @if ($offer->type == 'Request')
                                                    <tr>

                                                        <td>{{ isset($offer->id) ? $offer->id : '' }}</td>

                                                        <td>{{ isset($offer->name) ? $offer->name : '' }}</td>

                                                        <td>{{ isset($offer->phone) ? $offer->phone : '' }}</td>

                                                        <td>{{ isset($offer->target->name_ar) ? $offer->target->name_ar : '' }}
                                                        </td>

                                                        <td>{{ isset($offer->mainCategory->name_ar) ? $offer->mainCategory->name_ar : '' }}
                                                        </td>

                                                        <td>{{ isset($offer->diyarnaaCountry->name_ar) ? $offer->diyarnaaCountry->name_ar : '' }}
                                                        </td>
                                                        <td>{{ isset($offer->diyarnaaCity->name_ar) ? $offer->diyarnaaCity->name_ar : '' }}
                                                        </td>
                                                        <td>{{ isset($offer->diyarnaaRegion->name_ar) ? $offer->diyarnaaRegion->name_ar : '' }}
                                                        </td>
                                                        <td>{{ isset($offer->area) ? $offer->area : '' }}</td>

                                                        <td>{{ isset($offer->price) ? $offer->price : '' }}</td>
                                                        <td>
                                                            <a target="_blank"
                                                                href="{{ route('office-showCustomerRequestsOffer', [isset($offer->id) ? $offer->id : -1]) }}"
                                                                class="mb-1 btn btn-sm btn-primary">@lang('front.View')</a>

                                                            <a href="{{ route('office-destroyCustomerRequestOffer', [isset($offer->id) ? $offer->id : -1]) }}"
                                                                class="confirm mb-1 btn btn-sm btn-danger">@lang('front.Delete')</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="col-12 bShadow offersPage">

                            <h2> @lang('front.View') </h2>
                            <div class="row">

                                <div class="twoBtn">

                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">@lang('front.RequestorNumber')</th>
                                            <th scope="col">@lang('front.EmployeeName')</th>
                                            <th scope="col">@lang('front.CustomerPhone')</th>
                                            <th scope="col">@lang('front.TheItem')</th>
                                            <th scope="col">@lang('front.MainCategory')</th>
                                            <th scope="col">@lang('front.CountryName')</th>
                                            <th scope="col">@lang('front.State')</th>
                                            <th scope="col">@lang('front.Region')</th>
                                            <th scope="col">@lang('front.Area')</th>
                                            <th scope="col">@lang('front.Price')</th>
                                            <th scope="col">@lang('front.Dashboard')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($offers) && count($offers) > 0)
                                            @foreach ($offers as $offer)
                                                @if ($offer->type == 'Offer')
                                                <tr>

                                                    <td>{{ isset($offer->id) ? $offer->id : '' }}</td>

                                                    <td>{{ isset($offer->name) ? $offer->name : '' }}</td>

                                                    <td>{{ isset($offer->phone) ? $offer->phone : '' }}</td>

                                                    <td>{{ isset($offer->target->name_ar) ? $offer->target->name_ar : '' }}
                                                    </td>

                                                    <td>{{ isset($offer->mainCategory->name_ar) ? $offer->mainCategory->name_ar : '' }}
                                                    </td>

                                                    <td>{{ isset($offer->diyarnaaCountry->name_ar) ? $offer->diyarnaaCountry->name_ar : '' }}
                                                    </td>
                                                    <td>{{ isset($offer->diyarnaaCity->name_ar) ? $offer->diyarnaaCity->name_ar : '' }}
                                                    </td>
                                                    <td>{{ isset($offer->diyarnaaRegion->name_ar) ? $offer->diyarnaaRegion->name_ar : '' }}
                                                    </td>
                                                    <td>{{ isset($offer->area) ? $offer->area : '' }}</td>

                                                    <td>{{ isset($offer->price) ? $offer->price : '' }}</td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="{{ route('office-showCustomerRequestsOffer', [isset($offer->id) ? $offer->id : -1]) }}"
                                                            class="mb-1 btn btn-sm btn-primary">@lang('front.View')</a>

                                                        <a href="{{ route('office-destroyCustomerRequestOffer', [isset($offer->id) ? $offer->id : -1]) }}"
                                                            class="confirm mb-1 btn btn-sm btn-danger">@lang('front.Delete')</a>
                                                    </td>
                                                </tr>
                                                @endif
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
