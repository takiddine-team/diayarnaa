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
            <h2>@lang('front.changeRealEstateOfficeLoginInfo')</h2>
        </div>
    </section>


    {{-- =========================================================== --}}
    {{-- =================== page wrapper =============== --}}
    {{-- =========================================================== --}}
    <div class="page_wrapper dashboard">
        <div class="bredCramb">
            <a href="{{ route('welcome') }}">
                @if (Config::get('app.locale') == 'ar')
                <span>
                    الرئيسية </span>
                @elseif (Config::get('app.locale') == 'en')
                <span>
                    Home
                </span>
                @endif
            </a>
            >>
            @if (Config::get('app.locale') == 'ar')
            <span> تغيير معلومات المكتب العقاري</span>
            @elseif (Config::get('app.locale') == 'en')
            Change Real Estate Office Info
            </span>
            @endif
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
                        <form action="{{ route('office-changeRealEstateOfficePassword') }}" method="POST"
                            class="editUserForm">
                            @csrf
                            <h2>@lang('front.ChangePassword')</h2>
                            <div class="row">
                                {{-- old pass --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">

                                            <label for="old_password">
                                                @if (Config::get('app.locale') == 'ar')
                                                كلمة السر القديمة</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                Old Password
                                                </span>
                                                @endif
                                                <strong class="text-danger">
                                                    * @error('old_password')
                                                    - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="password" class="form-control" name="old_password">
                                        </div>
                                    </div>
                                </div>

                                {{-- new pass --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">

                                            <label for="password">
                                                @if (Config::get('app.locale') == 'ar')
                                                كلمة السر الجديدة</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                New Password
                                                </span>
                                                @endif
                                                <strong class="text-danger">
                                                    * @error('password')
                                                    - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>
                                {{-- rewrite pass --}}
                                <div class="col-md-6 mb-3" id="password">
                                    <label for="password_confirmation">
                                        @if (Config::get('app.locale') == 'ar')
                                        اعادة كتابة كلمة السر</span>
                                        @elseif (Config::get('app.locale') == 'en')
                                        Rewrite Password
                                        </span>
                                        @endif
                                    </label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                </div>

                            </div>
                            <div class="twoBtn">
                                {{-- Save --}}
                                <div class="col-3 mb-3">
                                    <input type="submit" class="submit" value="@lang('front.Save')">
                                </div>

                                {{-- Cancel --}}
                                <div class="col-3 mb-3">
                                    <a href="{{ route('office-userDashboard') }}"><input type="button" class="cancel"
                                            value="@lang('front.Cancel')"></a>
                                </div>
                            </div>

                        </form>
                        <form action="{{ route('office-changeRealEstateOfficeEmail') }}" class="editUserForm"
                            method="POST">
                            @csrf
                            <h2>@lang('front.ChangeEmail')</h2>
                            <div class="row">
                                {{-- old email --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="oldEmail">
                                                @if (Config::get('app.locale') == 'ar')
                                                البريد الالكتروني القديم</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                Old Email
                                                </span>
                                                @endif
                                                <strong class="text-danger">
                                                    * @error('old_email')
                                                    - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="email" class="form-control"
                                                value="{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}"
                                                name="old_email">
                                        </div>
                                    </div>
                                </div>

                                {{-- new email --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="newEmail">
                                                @if (Config::get('app.locale') == 'ar')
                                                البريد الالكتروني الجديد</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                New Email
                                                </span>
                                                @endif
                                                <strong class="text-danger">
                                                    * @error('email')
                                                    - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="email" class="form-control" placeholder="" name="email">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="twoBtn">
                                {{-- Save --}}
                                <div class="col-3 mb-3">
                                    <input type="submit" class="submit" value="@lang('front.Save')">
                                </div>

                                {{-- Cancel --}}
                                <div class="col-3 mb-3">
                                    <a href="{{ route('office-userDashboard') }}"><input type="button" class="cancel"
                                            value="@lang('front.Cancel')"></a>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('office-changeRealEstateOfficePhone') }}" class="editUserForm"
                            method="POST">
                            @csrf

                            <h2>@lang('front.ChangePhoneNumber')</h2>
                            <div class="row">
                                {{-- old mobile num --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="oldMobileNum">
                                                @if (Config::get('app.locale') == 'ar')
                                                رقم الهاتف القديم</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                Old Phone Number
                                                </span>
                                                @endif
                                                <strong class="text-danger">
                                                    * @error('old_phone')
                                                    - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="telephone" class="form-control" name="old_phone"
                                                value="{{ isset(Auth::user()->phone) ? Auth::user()->phone : '' }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- new Mobile num --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="oldMobileNum">
                                                @if (Config::get('app.locale') == 'ar')
                                                رقم الهاتف الجديد</span>
                                                @elseif (Config::get('app.locale') == 'en')
                                                New Phone Number
                                                </span>
                                                @endif
                                                <strong class="text-danger">
                                                    * @error('phone')
                                                    - {{ $message }}
                                                    @enderror
                                                </strong>
                                            </label>
                                            <input type="tel" class="form-control" name="phone">
                                        </div>
                                    </div>
                                </div>

                                {{-- new Mobile num --}}
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="newMobileNum"> ادخل الرمز الذي ارسلناه الى رقمك</label>
                                            <input type="tel" class="form-control-plus" placeholder=" ********** ">
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- activate --}}
                                {{-- <div class="col-3 mb-3 ">
                                    <input type="button" class="submit activate" value="تفعيل">
                                </div> --}}
                            </div>

                            <div class="twoBtn">
                                {{-- Save --}}
                                <div class="col-3 mb-3">
                                    <input type="submit" class="submit" value="@lang('front.Save')">
                                </div>

                                {{-- Cancel --}}
                                <div class="col-3 mb-3">
                                    <a href="{{ route('office-userDashboard') }}"><input type="button" class="cancel"
                                            value="@lang('front.Cancel')"></a>
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
