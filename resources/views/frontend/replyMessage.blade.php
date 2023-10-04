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
                <h2>@lang('front.EstateOffice') </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.EstateOffice')</span>
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

                            <div class="col-md-4 mb-3 ">
                                <div class="bShadow  p-3">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        {{-- ارسل رسالة --}}
                                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                                            data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                                            <i class="fa-solid fa-pen-to-square ml-2"></i>
                                            @lang('front.SendMessage')
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
                                            <form action="{{ route('sendEmail') }}" class="p-3" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <h6> @lang('front.SendMessage') </h6>

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
                                                        </label>
                                                        <textarea name="details" id="" rows="5" class="form-control h-auto"></textarea>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <input type="submit" class="btn submit" value="@lang('front.Send')">
                                                    </div>
                                                </div>
                                            </form>
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
