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
            @if (isset($background_image->user_login) &&
                    $background_image->getRawOriginal('user_login') &&
                    file_exists($background_image->getRawOriginal('user_login')))
                <img src="{{ asset($background_image->user_login) }}" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif
            <div class="pageTitle">
                <h2>@lang('front.UserLogin') </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.WelcomePage') </a>
                >> <span>@lang('front.UserLogin') </span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== login section =============== --}}
            {{-- =========================================================== --}}
            <section class="login mt-5 pt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">

                            <form action="{{ route('userLoginRequest') }}" class="loginForm" method="POST">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-6 mx-auto mb-5">
                                        <img src="{{ asset('style_files/frontend/img/logo.png') }}" class="img-fluid"
                                            alt="logo">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="email">@lang('front.Email')
                                            <strong class="text-danger">
                                                *
                                                @error('email')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="@lang('front.Email')" value="{{ old('email') ? old('email') : null }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="password">@lang('front.Password')
                                            <strong class="text-danger">
                                                *
                                                @error('password')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="@lang('front.Password') ">

                                        <div class="rememberAndforget">

                                            <div class="forget">
                                                <span>@lang('front.PasswordForget')</span>
                                                <a href="{{ route('forgotPassword') }}">@lang('front.GetYourPassword') </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="submit" class="btn mainBtn" value="@lang('front.UserLogin')">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <a href="{{ route('userSignup') }}" class="btn lightBtn">@lang('front.Register')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
