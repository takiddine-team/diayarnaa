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
                <h2>@lang('front.PasswordRecovery')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                >> <span>@lang('front.PasswordRecovery')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== login section =============== --}}
            {{-- =========================================================== --}}
            <section class="login mt-5 pt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">

                            <form action="{{ route('validatePasswordRequest') }}" class="loginForm" method="POST">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-6 mx-auto mb-5">
                                        <img src="{{ asset('style_files/frontend/img/logo.png') }}" class="img-fluid"
                                            alt="logo">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="email"> @lang('front.Email') </label>
                                        <strong class="text-danger">
                                            *
                                            @error('email')
                                                -
                                                {{ $message }}
                                            @enderror
                                        </strong>
                                        </label>
                                        <input type="email" name="email" class="form-control" required
                                            placeholder="@lang('front.Email')"
                                            value="{{ old('email') ? old('email') : null }}">
                                    </div>



                                    <div class="col-md-12 mb-3">
                                        <input class="btn lightBtn" value="@lang('front.PasswordRecovery')" type="submit">
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
