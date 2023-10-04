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
                <h2>@lang('front.EstateOwnerAccount')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper dashboard">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.EstateOwnerAccount')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== User menu section =============== --}}
            {{-- =========================================================== --}}

            @include('layouts.sideBar')

            {{-- =========================================================== --}}
            {{-- =================== dashboard content section =============== --}}
            {{-- =========================================================== --}}
            <section class="dashboardContent enquiryDetails">
                <div class="container">
                    <div class="row">
                        <div class="col-12 bShadow">
                            <form action="{{ route('owner-sendEnquiryReplay', isset($enquery->id) ? $enquery->id : -1) }}"
                                class="editUserForm" method="POST">
                                @csrf
                                <h2>@lang('front.InqueryRequest')</h2>
                                <div class="row">
                                    {{-- old pass --}}
                                    <div class="col-md-3 detailslabel ">
                                        <div class="form-group">
                                            <div class="form-group ">
                                                <label class="text-center" for="oldPass">@lang('front.SerialNumber')</label>
                                                <label type="password"
                                                    class="label-control text-center lableStyle">{{ isset($enquery->id) ? $enquery->id : '' }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group ">
                                                <label class="text-center" for="oldPass"> @lang('front.CountryName')</label>
                                                {{--  <label type="password"
                                                    class="label-control text-center lableStyle">{{ isset($enquery->diyarnaaCountry->name_ar) ? $enquery->diyarnaaCountry->name_ar : '-----' }}</label>  --}}

                                                @if (Config::get('app.locale') == 'ar')
                                                    <label type="password"
                                                        class="label-control text-center lableStyle">{{ isset($enquery->diyarnaaCountry->name_ar) ? $enquery->diyarnaaCountry->name_ar : '-----' }}</label>
                                                @elseif (Config::get('app.locale') == 'en')
                                                    <label type="password"
                                                        class="label-control text-center lableStyle">{{ isset($enquery->diyarnaaCountry->name_en) ? $enquery->diyarnaaCountry->name_en : '-----' }}</label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group ">
                                                <label class="text-center" for="oldPass">@lang('front.Name') </label>
                                                <label type="password"
                                                    class="label-control text-center lableStyle">{{ isset($enquery->name) ? $enquery->name : '' }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- new pass --}}
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <div class="form-group text-center">
                                                <label class="text-center" for="newPass">@lang('front.TheDateTheInquiryWasSent')</label>
                                                <label type="password"
                                                    class="label-control text-center lableStyle">{{ isset($enquery->created_at) ? $enquery->created_at : '' }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group text-center">
                                                <label class="text-center" for="newPass">@lang('front.Phone')</label>
                                                <label type="password"
                                                    class="label-control text-center lableStyle">{{ isset($enquery->phone) ? $enquery->phone : '' }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="text-center" for="newPass">@lang('front.InqueryMessage')</label>

                                        <p>{{ isset($enquery->message) ? $enquery->message : '' }}</p>
                                    </div>

                                    {{-- رسالة الرد --}}
                                    <div class="col-md-12 mb-3">
                                        <label for="info">
                                            @lang('front.Reply')
                                            <strong class="text-danger">
                                                * @error('replay')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="replay" id="replay" class="form-control" name='replay'>{{ old('replay') ? old('replay') : '' }}</textarea>
                                    </div>

                                    <div class="twoBtn">
                                        {{-- Save --}}
                                        <div class="col-6 mb-3">
                                            <input type="submit" class="submit" value="@lang('front.Reply')">
                                        </div>

                                        {{-- Cancel --}}
                                        <div class="col-6 mb-3">

                                            <a href="{{ route('owner-viewEnquiry') }}"> <input type="button"
                                                    class="cancel" value="@lang('front.Cancel')"></a>
                                        </div>
                                        {{-- حذف --}}
                                        <div class="col-6 mb-3">

                                            <a
                                                href="{{ route('owner-destroyEnquiry', isset($enquery->id) ? $enquery->id : -1) }}">
                                                <input type="button" class="cancel" value="@lang('front.Delete')"></a>
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
