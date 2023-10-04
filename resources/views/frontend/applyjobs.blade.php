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
            @if (isset($about_us->background_aboutus_image) &&
                $about_us->background_aboutus_image &&
                file_exists($about_us->background_aboutus_image))
                <img src="{{ asset($about_us->background_aboutus_image) }}" class="img-fluid" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif
            <div class="pageTitle">
                <h2> @lang('front.Jobs') </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                <span class="enflip"> >> </span> <span> @lang('front.Jobs')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== aboutCompany  section =============== --}}
            {{-- =========================================================== --}}
            <section class="jobsForms py-5 ">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">


                            {{--   التقديم على وظيفة --}}
                            <form action="{{ route('jobRequest', isset($job->id) ? $job->id : -1) }}" enctype="multipart/form-data">
                                @csrf
                                <h2> التقديم على وظيفة</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">
                                             @lang('front.FirstName')
                                            <strong class="text-danger">*
                                                @error('first_name')
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="text" class="form-control" placeholder="@lang('front.FirstName')"
                                            name="first_name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">
                                             @lang('front.LastName')
                                            <strong class="text-danger">*
                                                @error('last_name')
                                                    {{ $message }}
                                                @enderror
                                        </label>
                                        <input type="text" class="form-control" placeholder="@lang('front.LastName')"
                                            name="last_name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">
                                            @lang('front.Email')
                                            <strong class="text-danger">*
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                        </label>
                                        <input type="email" class="form-control" placeholder="@lang('front.Email')"
                                            name="email">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone">
                                             @lang('front.ContactNumber')
                                            <strong class="text-danger">*
                                                @error('phone')
                                                    {{ $message }}
                                                @enderror
                                        </label>
                                        <input type="text" class="form-control" placeholder="@lang('front.ContactNumber')" name="phone">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cv">
                                             @lang('front.CV')
                                            <strong class="text-danger">*
                                                @error('cv')
                                                    {{ $message }}
                                                @enderror
                                        </label>
                                        <input type="file" class="form-control" placeholder=" @lang('front.CV') Word/pdf"
                                            name="cv">
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
