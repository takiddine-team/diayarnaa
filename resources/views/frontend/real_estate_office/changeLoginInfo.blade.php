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
                <h2> حساب المكتب العقاري </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">الرئيسية</a>
                <span class="enflip"> >> </span> <span> حساب المكتب العقاري</span>
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
                                <h2>تغيير كلمة السر</h2>
                                <div class="row">
                                    {{-- old pass --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="oldPass"> كلمة السر القديمة</label>
                                                <input type="password" class="form-control" placeholder="**********">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- new pass --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="newPass"> كلمة السر الجديدة</label>
                                                <input type="password" class="form-control" placeholder=" ********** ">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- rewrite pass --}}
                                    <div class="col-md-6 mb-3" id="office_phone">
                                        <label for="office_phone"> اعادة كتابة كلمة السر</label>
                                        <input type="password" class="form-control" id="rewritePass" name="rewritePass"
                                            placeholder="**********">
                                    </div>

                                </div>
                                <div class="twoBtn">
                                    {{-- Save --}}
                                    <div class="col-3 mb-3">
                                        <input type="submit" class="submit" value="حفظ">
                                    </div>

                                    {{-- Cancel --}}
                                    <div class="col-12 mb-3">
                                        <input type="button" class="cancel" value="الغاء">
                                    </div>
                                </div>

                            </form>
                            <form action="#" class="editUserForm">
                                @csrf
                                <h2>تغيير البريد الالكتروني</h2>
                                <div class="row">
                                    {{-- old email --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="oldEmail"> كلمة السر القديمة</label>
                                                <input type="Email" class="form-control" placeholder="Test@diyarnaa.com">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- new email --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="newEmail"> كلمة السر الجديدة</label>
                                                <input type="Email" class="form-control"
                                                    placeholder=" Test@diyarnaa.com ">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="twoBtn">
                                    {{-- Save --}}
                                    <div class="col-3 mb-3">
                                        <input type="submit" class="submit" value="حفظ">
                                    </div>

                                    {{-- Cancel --}}
                                    <div class="col-12 mb-3">
                                        <input type="button" class="cancel" value="الغاء">
                                    </div>
                                </div>
                            </form>

                            <form action="#" class="editUserForm">
                                @csrf

                                <h2>تغيير رقم الموبايل </h2>
                                <div class="row">
                                    {{-- old mobile num --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="oldMobileNum">رقم الموبايل القديم</label>
                                                <input type="number" min="0" class="form-control" placeholder="***********">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- new Mobile num --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="newMobileNum"> رقم الموبايل الجديد </label>
                                                <input type="number" min="0" class="form-control" placeholder="  ">
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
                                        <input type="submit" class="submit" value="حفظ">
                                    </div>

                                    {{-- Cancel --}}
                                    <div class="col-12 mb-3">
                                        <input type="button" class="cancel" value="الغاء">
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
