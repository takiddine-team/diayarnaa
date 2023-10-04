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
                <h2>@lang('front.InternalEmail')</h2>
            </div>
        </section>

        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                >> <span>@lang('front.InternalEmail')</span>

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
                    <div class="col-12 bShadow pt-5">
                        <h2 class="mailTitle">@lang('front.InternalEmail')</h2>
                        <div class="row">

                            <div class="col-md-12 mb-3 ">
                                <div class="bShadow p-3">
                                    <div class="tab-content" id="nav-tabContent">



                                        <div class="tab-pane fade show active" id="list-messages" role="tabpanel"
                                            aria-labelledby="list-messages-list">

                                            <div class="inside">
                                                <div class="top">
                                                    @if (isset($message_details->sender_type) && $message_details->sender_type == 'Admin')
                                                        <span class="name">
                                                            @lang('front.Sender') : @lang('front.Management')
                                                        </span>
                                                    @else
                                                        <span class="name">{{ $message_details->userSender->name }}</span>
                                                    @endif
                                                    @if (isset($message_details->advertisement_id) &&
                                                            $message_details->advertisement_id != null &&
                                                            isset($message_details->advertisement->title_ar))
                                                        <span>@lang('front.AdTitle')
                                                            {{ $message_details->advertisement->title_ar }} </span>
                                                    @endif

                                                    <span class="date"> @lang('front.Date'){{ isset($message_details->created_at) ? $message_details->created_at : '' }}</span>
                                                </div>
                                                <div class="body">
                                                    <p>{!! isset($message_details->details) ? $message_details->details : '' !!}</p>
                                                    @if (isset($message_details->file) &&
                                                            $message_details->getRawOriginal('file') &&
                                                            file_exists($message_details->getRawOriginal('file')))
                                                        <a href="{{ asset($message_details->file) }}" target="_blank"
                                                            data-fancybox="gallery" style="padding-bottom: 10px">
                                                            <i class="fa-solid fa-file" style="color: #6598ca"> </i> <span
                                                                style="color: #6598ca">@lang('front.SeeAttachment') </span>

                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="bottom" style="margin-top: 15px">

                                                    {{-- Real Estate Office --}}
                                                    @if (Auth::guard('user')->user()->user_type == 'Real Estate Office')
                                                        <a href="{{ route('internalMail') }}"
                                                            target="_blank">@lang('front.Reply')</a>
                                                        @if (isset($message_details->email_type) && $message_details->email_type != 'Chat')
                                                            <a
                                                                href="{{ route('office-myAdvertisementDetails', isset($message_details->advertisement_id) ? $message_details->advertisement_id : -1) }}">@lang('front.EditAd')
                                                            </a>
                                                        @endif
                                                        @if (isset($message_details->email_type) && $message_details->email_type == 'Update Request')
                                                            <a
                                                                href="{{ route('office-editAdvertisement', isset($message_details->advertisement_id) ? $message_details->advertisement_id : -1) }}">@lang('front.EditAd')
                                                            </a>
                                                        @endif
                                                        @if (isset($message_details->email_type) &&
                                                                $message_details->email_type == 'Accept with Conditions' &&
                                                                $message_details->advertisement->status == 'Accept with Conditions')
                                                            <a
                                                                href="{{ route('office-editAdvertisement', isset($message_details->advertisement_id) ? $message_details->advertisement_id : -1) }}">@lang('front.EditAd')
                                                            </a>
                                                        @endif
                                                        <a
                                                            href="{{ route('delete', isset($message_details->id) ? $message_details->id : -1) }}">@lang('front.Delete')</a>
                                                        {{-- Real Estate Owner --}}
                                                    @elseif (Auth::guard('user')->user()->user_type == 'Real Estate Owner')
                                                        <a href="{{ route('internalMail') }}"
                                                            target="_blank">@lang('front.Reply')</a>
                                                        @if (isset($message_details->email_type) && $message_details->email_type != 'Chat')
                                                            <a
                                                                href="{{ route('owner-myAdvertisementDetails', isset($message_details->advertisement_id) ? $message_details->advertisement_id : -1) }}">@lang('front.SeeAd')
                                                            </a>
                                                        @endif
                                                        @if (isset($message_details->email_type) && $message_details->email_type == 'Update Request')
                                                            <a
                                                                href="{{ route('owner-editAdvertisement', isset($message_details->advertisement_id) ? $message_details->advertisement_id : -1) }}">@lang('front.EditAd')
                                                            </a>
                                                        @endif
                                                        @if (isset($message_details->email_type) &&
                                                                $message_details->email_type == 'Accept with Conditions' &&
                                                                $message_details->advertisement->status == 'Accept with Conditions')
                                                            <a
                                                                href="{{ route('owner-editAdvertisement', isset($message_details->advertisement_id) ? $message_details->advertisement_id : -1) }}">@lang('front.EditAd')
                                                            </a>
                                                        @endif
                                                        <a
                                                            href="{{ route('delete', isset($message_details->id) ? $message_details->id : -1) }}">@lang('front.Delete')</a>
                                                        {{-- Real Estate Seeker --}}
                                                    @else
                                                        <a
                                                            href="{{ route('delete', isset($message_details->id) ? $message_details->id : -1) }}">@lang('front.Delete')</a>
                                                        @if (isset($message_details->email_type) && $message_details->email_type != 'Chat')
                                                            <a
                                                                href="{{ route('advertisementDetails', isset($message_details->advertisement_id) ? $message_details->advertisement_id : -1) }}">@lang('front.SeeAd')</a>
                                                        @else
                                                            <a href="{{ route('internalMail') }}"
                                                                target="_blank">@lang('front.Reply')</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
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


@section('javascript')
@endsection
