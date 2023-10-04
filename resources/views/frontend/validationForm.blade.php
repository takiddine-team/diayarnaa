

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
                <h2> استعادة كلمة السر </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">الرئيسية</a>
                <span class="enflip"> >> </span> <span> استعادة كلمة السر </span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== login section =============== --}}
            {{-- =========================================================== --}}
            <section class="login mt-5 pt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">

                            <form action="{{ route('resetNewPassword') }}" class="loginForm" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="row justify-content-center">
                                    <div class="col-md-6 mx-auto mb-5">
                                        <img src="{{ asset('style_files/frontend/img/logo.png') }}" class="img-fluid"
                                            alt="logo">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="email">البريد الالكتروني
                                            <strong class="text-danger">
                                                *
                                                @error('email')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="email" name="email" class="form-control"  required autofocus
                                            placeholder="البريد الالكتروني" readonly
                                            value="{{ $email }}">
                                    </div>



                                    <div class="col-md-12 mb-3">
                                        <label for="email">كلمة المرور 
                                            <strong class="text-danger">
                                                *
                                                @error('email')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="password" name="password" class="form-control"  required autocomplete="new-password"
                                            placeholder=" كلمة المرور"
                                           >
                                    </div>


                                    <div class="col-md-12 mb-3">
                                        <label for="email">تاكيد كلمة المرور 
                                            <strong class="text-danger">
                                                *
                                                @error('email')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="password" name="password_confirmation" class="form-control"  required autocomplete="new-password"
                                            placeholder=" تاكيد كلمة المرور"
                                           >
                                    </div>

                                    



                                    <div class="col-md-12 mb-3">
                                        <input class="btn lightBtn" value=" تغيير كلمة السر" type="submit">
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

