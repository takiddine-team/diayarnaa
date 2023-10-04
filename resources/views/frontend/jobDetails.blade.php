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
                <h2>@lang('front.JobDetails')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                >> <span>@lang('front.JobDetails')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== تفاصيل الوظيفة section =============== --}}
            {{-- =========================================================== --}}
            <section class="py-5 mt-5 realStateDetails">
                <div class="container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="allLeft">

                                @if (isset($job))
                                    <div class="leftBox mt-4">
                                        <div class="innerDetailsSlider">
                                            <div id="wrap">
                                                <ul>


                                                    @if (isset($job->image) && $job->image && file_exists($job->image))
                                                        <li class="slide-item"><img src="{{ asset($job->image) }}"
                                                                alt="img" style="height: 400px"></li>
                                                    @endif


                                                </ul>
                                                @if (isset($job->file))
                                                    <ul>




                                                    </ul>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- text --}}
                                <div class="leftBox">
                                    <h2 class="title">@lang('front.JobTitle')</h2>
                                    <p>
                                        @if (Config::get('app.locale') == 'ar')
                                            <span class="realState_Location">
                                                {!! isset($job->title_ar) ? $job->title_ar : null !!}</span>
                                        @elseif (Config::get('app.locale') == 'en')
                                            <span class="realState_Location">
                                                {!! isset($job->title_en) ? $job->title_en : null !!}
                                            </span>
                                        @endif
                                    </p>
                                </div>


                                {{-- text --}}
                                <div class="leftBox">
                                    <h2 class="title">@lang('front.JobDetails')</h2>

                                    <p>
                                        @if (Config::get('app.locale') == 'ar')
                                            <span class="realState_Location">
                                                {!! isset($job->description_ar) ? $job->description_ar : null !!}</span>
                                        @elseif (Config::get('app.locale') == 'en')
                                            <span class="realState_Location">
                                                {!! isset($job->description_en) ? $job->description_en : null !!}
                                            </span>
                                        @endif
                                    </p>


                                    @if (isset($job->file) && $job->getRawOriginal('file') && file_exists($job->getRawOriginal('file')))
                                        <a href="{{ asset($job->file) }}" target="_blank" data-fancybox="gallery"
                                            style="padding-bottom: 10px">
                                            <i class="fa-solid fa-file" style="color: #6598ca"> </i> <span
                                                style="color: #6598ca">@lang('front.SeeAttachment')</span>

                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>


                        <section class="jobsForms py-5 ">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-sm-12 col-xs-12">
                                        {{-- إرسال شكوى --}}


                                        {{--   التقديم على وظيفة --}}
                                        <form action="{{ route('jobRequest', isset($job->id) ? $job->id : -1) }}"
                                            method="POST" class="jobForm" id="jobForm" enctype="multipart/form-data">
                                            <h2>@lang('front.ApplyForJob')</h2>
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="first_name">
                                                        @lang('front.FirstName')
                                                        <strong class="text-danger">
                                                            *
                                                            @error('first_name')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="@lang('front.FirstName')" name="first_name"
                                                        value="{{ old('first_name') ? old('first_name') : null }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="second_name">
                                                        @lang('front.LastName') <strong class="text-danger">
                                                            *
                                                            @error('last_name')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="@lang('front.LastName')" name="last_name"
                                                        value="{{ old('last_name') ? old('last_name') : null }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email">
                                                        @lang('front.Email') <strong class="text-danger">
                                                            *
                                                            @error('email')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="email" class="form-control"
                                                        placeholder="@lang('front.Email')" name="email"
                                                        value="{{ old('email') ? old('email') : null }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone">
                                                        @lang('front.ContactNumber') <strong class="text-danger">
                                                            *
                                                            @error('phone')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="@lang('front.ContactNumber')"
                                                        name="phone" value="{{ old('phone') ? old('phone') : null }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="cv">
                                                        @lang('front.CV') -Word/pdf
                                                        <strong class="text-danger">
                                                            *
                                                            @error('file')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="file" class="form-control"
                                                        placeholder="@lang('front.CV')-Word/pdf" name="file" required>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <input type="submit" class="btn lightBtn" value="@lang('front.Send')">
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>
                </div>
            </section>


        </div>

    </div>
@endsection
