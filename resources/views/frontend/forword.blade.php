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
                <h2>@lang('front.Email')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.Email')</span>
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

                            <div class="col-md-6 mb-3 ">
                                <div class="bShadow  p-3">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        {{-- ارسل رسالة --}}
                                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                                            data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                                            <i class="fa-solid fa-pen-to-square ml-2"></i>
                                             @lang('front.CreateAMessage')
                                        </a>
                                        {{-- البريد الوارد --}}
                                        <a class="list-group-item list-group-item-action" id="list-profile-list"
                                            data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
                                            <i class="fa-solid fa-envelope ml-2"></i>
                                             @lang('front.Inbox')
                                        </a>

                                        {{-- البريد الصادر --}}
                                        <a class="list-group-item list-group-item-action" id="list-messages-list"
                                            data-toggle="list" href="#list-messages" role="tab"
                                            aria-controls="messages">
                                            <i class="fa-solid fa-paper-plane ml-2"></i>
                                             @lang('front.OutGoingMail')
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-8 mb-3 ">
                                <div class="bShadow p-3">
                                    <div class="tab-content" id="nav-tabContent">
                                        {{-- ارسل رسالة --}}
                                        <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                                            aria-labelledby="list-home-list">
                                            <form action="{{ route('sendEmail') }}" class="p-3" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <h6>@lang('front.SendMessage')</h6>

                                                    </div>

                                                    <div class="col-12 mb-3">
                                                        <label for="">@lang('front.Message')
                                                            <strong class="text-danger">
                                                                *
                                                                @error('details')
                                                                    -
                                                                    {{ $message }}
                                                                @enderror
                                                            </strong>


                                                            <label>
                                                                <strong class="text-danger">
                                                                    @error('file')
                                                                        -
                                                                        {{ $message }}
                                                                    @enderror
                                                                </strong>

                                                                <label for="actualBtn" id="img" class="uploadImage"
                                                                    style="float: left;
                                                                padding-bottom: 16px;
                                                                padding-top: 13px;">
                                                                    <i class="fa-solid fa-paperclip fa-xl"></i> <span
                                                                        style="color: red" id="nameFile"></span> </label>


                                                            </label>
                                                            <!-- actual upload which is hidden -->
                                                            <input type="file" id="actualBtn" onchange="loadFile(event)"
                                                                hidden name="file" />
                                                            <!-- our custom upload button -->
                                                        </label>
                                                        <textarea name="details" id="" rows="5" class="form-control h-auto">{!! isset($message_details->details) ? $message_details->details : '' !!}</textarea>
                                                    </div>





                                                    <div class="col-12 mb-3">
                                                        <input type="submit" class="btn submit" value="@lang('front.Send')">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- البريد الوارد --}}
                                        <div class="tab-pane fade" id="list-profile" role="tabpanel"
                                            aria-labelledby="list-profile-list">
                                            <ul class="allMail">
                                                @if (isset(auth()->guard('user')->user()->receivedMails) &&
                                                    auth()->guard('user')->user()->receivedMails->count() > 0)
                                                    @foreach (auth()->guard('user')->user()->receivedMails as $mail)
                                                        @if ($mail->deleter_type != 'Receiver')
                                                            <li>

                                                                <a href="{{ route('messageDetails', isset($mail->id) ? $mail->id : -1) }}"
                                                                    target="_blank">
                                                                    @if (isset($mail->sender_type) && $mail->sender_type == 'Admin')
                                                                        <div class="img">
                                                                            <img src="{{ asset('style_files/frontend/img/logo.png') }}"
                                                                                class="img-fluid" alt="img">
                                                                        </div>
                                                                    @else
                                                                        @if (isset($mail->userSender->profile_image) &&
                                                                            $mail->userSender->getRawOriginal('profile_image') &&
                                                                            file_exists($mail->userSender->getRawOriginal('profile_image')))
                                                                            <img src="{{ asset($mail->userSender->profile_image) }}"
                                                                                class="img-fluid">
                                                                        @else
                                                                            <img src="{{ asset('style_files/frontend/img/logo.png') }}"
                                                                                class="img-fluid" alt="img">
                                                                        @endif
                                                                    @endif

                                                                    <div class="textInfo">

                                                                        @if (isset($mail->sender_type) && $mail->sender_type == 'Admin')
                                                                            <h6> @lang('front.Management') </h6>
                                                                        @else
                                                                            <h6> {{ $mail->userSender->name }}</h6>
                                                                        @endif

                                                                        @if (isset($mail->advertisement_id) && $mail->advertisement_id != null && isset($mail->advertisement->title_ar))
                                                                            <h6>
                                                                                {{ $mail->advertisement->title_ar }}</h6>
                                                                        @endif
                                                                        <p>
                                                                            {!! Str::limit($mail->details, 50) !!}

                                                                        </p>
                                                                        <span class="date"
                                                                            style="padding: 4px;
                                                                    border-radius: 6px;
                                                                    background-color: #f8f8f8;
                                                                    font-size: 10px;
                                                                    letter-spacing: 0px;
                                                                    color: #494949;
                                                                    width: fit-content;">{{ $mail->created_at }}</span>
                                                                    </div>

                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <li>
                                                        <div class="text-center alert alert-danger">
                                                            <h6>@lang('front.NoInboxMessages')</h6>
                                                        </div>
                                                    </li>
                                                @endif

                                            </ul>
                                        </div>

                                        {{-- البريد الصادر --}}
                                        <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                            aria-labelledby="list-messages-list">
                                            <ul class="allMail">
                                                @if (isset(auth()->guard('user')->user()->sentMails) &&
                                                    auth()->guard('user')->user()->sentMails->count() > 0)
                                                    @foreach (auth()->guard('user')->user()->sentMails as $mail)
                                                        @if ($mail->deleter_type != 'Sender')
                                                            <li>

                                                                <a href="{{ route('messageDetails', isset($mail->id) ? $mail->id : -1) }}"
                                                                    target="_blank">

                                                                    @if (isset($mail->userReceiver->profile_image) &&
                                                                        $mail->userReceiver->getRawOriginal('profile_image') &&
                                                                        file_exists($mail->userReceiver->getRawOriginal('profile_image')))
                                                                        <img src="{{ asset($mail->userReceiver->profile_image) }}"
                                                                            class="img-fluid">
                                                                    @else
                                                                        <img src="{{ asset('style_files/frontend/img/logo.png') }}"
                                                                            class="img-fluid" alt="img">
                                                                    @endif


                                                                    <div class="textInfo">


                                                                        <h6>{{ $mail->userReceiver->name }}</h6>

                                                                        <p>

                                                                            {!! Str::limit($mail->details, 50) !!}

                                                                        </p>
                                                                        <span class="date"
                                                                            style="padding: 4px;
                                                                    border-radius: 6px;
                                                                    background-color: #f8f8f8;
                                                                    font-size: 10px;
                                                                    letter-spacing: 0px;
                                                                    color: #494949;
                                                                    width: fit-content;">{{ $mail->created_at }}</span>
                                                                    </div>

                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="text-center alert alert-danger">
                                                        <h6>@lang('front.OutGoingMail')</h6>
                                                    </div>
                                                @endif

                                            </ul>
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


    <script>
        var loadFile = function(event) {


            var file = $('#actualBtn')[0].files[0]
            if (file) {

                $("#nameFile").text(file.name);

            }
        };
    </script>
@endsection
