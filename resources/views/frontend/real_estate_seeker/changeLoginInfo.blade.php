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
                <h2>@lang('front.ChangeLoginInformation')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.ChangeLoginInformation')</span>
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
                            <form action="#" class="editUserForm">
                                @csrf
                                <h2>@lang('front.ChangePassword')</h2>
                                <div class="row">
                                    {{-- old pass --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="oldPass">@lang('front.OldPassword')</label>
                                                <input type="password" class="form-control" placeholder="**********">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- new pass --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="newPass">@lang('front.NewPassword')</label>
                                                <input type="password" class="form-control" placeholder=" ********** ">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- rewrite pass --}}
                                    <div class="col-md-6 mb-3" id="office_phone">
                                        <label for="office_phone"> @lang('front.PasswordConfirmation')</label>
                                        <input type="password" class="form-control" id="rewritePass" name="rewritePass"
                                            placeholder="**********">
                                    </div>

                                </div>
                                <div class="twoBtn">
                                    {{-- Save --}}
                                    <div class="col-3 mb-3">
                                        <input type="submit" class="submit" value="@lang('front.Save')">
                                    </div>

                                    {{-- Cancel --}}
                                    <div class="col-12 mb-3">
                                        <input type="button" class="cancel" value="@lang('front.Cancel')">
                                    </div>
                                </div>

                            </form>
                            <form action="#" class="editUserForm">
                                @csrf
                                <h2>@lang('front.ChangeEmail')</h2>
                                <div class="row">
                                    {{-- old email --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="oldEmail">@lang('front.OldEmail')</label>
                                                <input type="Email" class="form-control" placeholder="@lang('front.OldEmail')">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- new email --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="newEmail"> @lang('front.NewEmail') </label>
                                                <input type="Email" class="form-control"
                                                    placeholder="@lang('front.NewEmail')">
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
                                    <div class="col-12 mb-3">
                                        <input type="button" class="cancel" value="@lang('front.Cancel')">
                                    </div>
                                </div>
                            </form>

                            <form action="#" class="editUserForm">
                                @csrf

                                <h2>@lang('front.ChangePhoneNumber')</h2>
                                <div class="row">
                                    {{-- old mobile num --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="oldMobileNum">@lang('front.OldPhone')</label>
                                                <input type="number" min="0" class="form-control"
                                                    placeholder="@lang('front.OldPhone')">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- new Mobile num --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="newMobileNum">@lang('front.NewPhone')</label>
                                                <input type="number" min="0" class="form-control" placeholder="@lang('front.NewPhone')">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- new Mobile num --}}
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="newMobileNum"> ادخل الرمز الذي ارسلناه الى رقمك</label>
                                                <input type="number" min="0" class="form-control-plus" placeholder=" ********** ">
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
                                    <div class="col-12 mb-3">
                                        <input type="button" class="cancel" value="@lang('front.Cancel')">
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
