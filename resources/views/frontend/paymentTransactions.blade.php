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
                <h2> @lang('front.PaymentsTransactions')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.PaymentsTransactions')</span>
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
                            <h2>@lang('front.PaymentsTransactions')</h2>
                            <div class="row">


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">@lang('front.PremiumMembership')</th>
                                            <th style="text-align: center"> @lang('front.TheAmount') </th>
                                            <th style="text-align: center">@lang('front.PaymentNumber')</th>
                                            <th style="text-align: center">@lang('front.PaymentStatus')</th>
                                            <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i>
                                                @lang('front.Time') </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset(auth()->guard('user')->user()->paymentTransactions) &&
                                                count(auth()->guard('user')->user()->paymentTransactions) > 0)
                                            @foreach (auth()->guard('user')->user()->paymentTransactions as $payment_transaction)
                                                <tr>
                                                    {{--  <td style="text-align: center">{!! isset($payment_transaction->premiumMembership->name_ar)
                                                        ? $payment_transaction->premiumMembership->name_ar
                                                        : "<span style='color:blue;'>----------</span>" !!} </td>  --}}

                                                    @if (Config::get('app.locale') == 'ar')
                                                        <td style="text-align: center">{!! isset($payment_transaction->premiumMembership->name_ar)
                                                            ? $payment_transaction->premiumMembership->name_ar
                                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <td style="text-align: center">{!! isset($payment_transaction->premiumMembership->name_en)
                                                            ? $payment_transaction->premiumMembership->name_en
                                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                                    @endif
                                                    <td style="text-align: center">


                                                        {{ isset($payment_transaction->amount) ? number_format((float) $payment_transaction->amount, 2, '.', '') : null }}

                                                        <span> $</span>
                                                    </td>
                                                    <td style="text-align: center">{!! isset($payment_transaction->payment_id)
                                                        ? $payment_transaction->payment_id
                                                        : "<span style='color:red;'>Undefined</span>" !!} </td>

                                                    <td style="text-align: center">{!! isset($payment_transaction->payment_status)
                                                        ? $payment_transaction->payment_status
                                                        : "<span style='color:red;'>Undefined</span>" !!}
                                                    </td>
                                                    <td style="text-align: center"> {!! isset($payment_transaction->created_at)
                                                        ? $payment_transaction->created_at
                                                        : "<span style='color:red;'>Undefined</span>" !!} </td>
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
