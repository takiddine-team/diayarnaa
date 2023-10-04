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
                <h2> @lang('front.GiveYourOpinion')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                >> <span>@lang('front.GiveYourOpinion')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== تفاصيل الوظيفة section =============== --}}
            {{-- =========================================================== --}}
            <section class="py-5 mt-5 realStateDetails">
                <div class="container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="allLeft">

                                <section class="jobsForms py-5 ">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10">



                                                {{--   أعطي رأيك --}}
                                                <form action="{{ route('storeOpinion') }}" method="POST" class="jobForm"
                                                    id="jobForm" enctype="multipart/form-data">
                                                    <h2>@lang('front.GiveYourOpinion')</h2>
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label for="first_name">
                                                                @lang('front.GiveYourOpinion')
                                                                <strong class="text-danger">
                                                                    *
                                                                    @error('opinion')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </strong>
                                                            </label>
                                                            <textarea name="opinion" id="opinion	" cols="30" rows="5" class="form-control">{{ old('opinion') ? old('opinion') : null }}
                                                            </textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <input type="submit" class="btn lightBtn"
                                                                value="@lang('front.Send')">
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
            </section>
        </div>

    </div>
@endsection
