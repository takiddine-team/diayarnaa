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
            @if (isset($background_image->complaint) &&
                    $background_image->getRawOriginal('complaint') &&
                    file_exists($background_image->getRawOriginal('complaint')))
                <img src="{{ asset($background_image->complaint) }}" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif

            <div class="pageTitle">
                <h2> @lang('front.Complaints') </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span> @lang('front.Complaints')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== aboutCompany  section =============== --}}
            {{-- =========================================================== --}}
            <section class="jobsForms py-5 ">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            {{-- إرسال شكوى --}}
                            <form action="{{ route('sendComplaints') }}" method="POST">
                                <h2>@lang('front.SendComplaint')</h2>
                                @csrf
                                <div class="row">
                                    {{-- <div class="col-md-6 mb-3">
                                        <label for="diyarnaa_country_id">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الاسم الأول
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    First Name
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                *
                                                @error('first_name')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" placeholder="الاسم الاول"
                                            name="first_name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="diyarnaa_country_id">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    الاسم الثاني
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Second Name
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                *
                                                @error('last_name')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" placeholder="الاسم الثاني"
                                            name="last_name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    البريد الالكتروني
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Email
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                *
                                                @error('email')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>

                                        </label>
                                        <input type="email" class="form-control" placeholder="البريد الالكتروني"
                                            name="email">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="subject">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    موضوع الشكوى
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Subject
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                *
                                                @error('subject')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" placeholder="الاسم الاول" name="subject">
                                    </div> --}}
                                    <div class="col-md-12 mb-3">
                                        <label for="message">
                                            @if (Config::get('app.locale') == 'ar')
                                                <span class="realState_Location">
                                                    نص الشكوى
                                                </span>
                                            @elseif (Config::get('app.locale') == 'en')
                                                <span class="realState_Location">
                                                    Message
                                                </span>
                                            @endif
                                            <strong class="text-danger">
                                                *
                                                @error('description')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                        </label>
                                        <textarea class="form-control" placeholder=" @lang('front.ComplaintMessage')" name="description" rows="5">{{ old('description') ? old('description') : '' }}</textarea>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <input type="submit" class="btn lightBtn" value="@lang('front.Send')">
                                </div>
                            </form>
                        </div>



                    </div>
                </div>

            </section>
        </div>
    </div>

    </div>
@endsection
