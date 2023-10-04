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
            @if (isset($contact_us->background_image) && $contact_us->background_image && file_exists($contact_us->background_image))
                <img src="{{ asset($contact_us->background_image) }}" class="img-fluid" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif
            <div class="pageTitle">
                <h2> @lang('front.ContactUs')</h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.WelcomePage')</a>
                <span class="enflip"> >> </span> <span>@lang('front.ContactUs')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== contact us  section =============== --}}
            {{-- =========================================================== --}}
            <section class="contactUs py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <ul class="contactInfo">
                                <li>
                                    <div class="image">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div class="text">
                                        <h2>@lang('front.ContactUs')</h2>
                                        <a href="tel:{{ isset($contact_us->phone) ? $contact_us->phone : '00962787878787' }}"
                                            target="_blank"
                                            class="tel">{{ isset($contact_us->phone) ? $contact_us->phone : '+962 787878787' }}</a>
                                        <a href="tel:{{ isset($contact_us->phone_two) ? $contact_us->phone_two : '00962787878787' }}"
                                            target="_blank"
                                            class="tel">{{ isset($contact_us->phone_two) ? $contact_us->phone_two : '+962 787878787' }}</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="image">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div class="text">
                                        <h2>@lang('front.Email') </h2>
                                        <a href="mailto:{{ isset($contact_us->email) ? $contact_us->email : -1 }}"
                                            target="_blank" class="tel">
                                            {{ isset($contact_us->email) ? $contact_us->email : 'info@diyarna.com' }}
                                        </a>

                                    </div>
                                </li>
                                <li>
                                    <div class="image">
                                        <i class="fa-brands fa-facebook-messenger"></i>
                                    </div>
                                    <div class="text">
                                        <h2>@lang('front.ContactUsMessage') </h2>
                                        <a href="{{ isset($contact_us->messanger) ? $contact_us->messanger : -1 }}"
                                            target="_blank">
                                            <i class="fa-brands fa-facebook-messenger"></i>
                                        </a>

                                    </div>
                                </li>
                                <li>
                                    <div class="image">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="text">
                                        <h2>@lang('front.ContactUsLocation')</h2>
                                        <a href=" {{ isset($contact_us->url_map) ? $contact_us->url_map : -1 }}"
                                            target="_blank">
                                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                        </a>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('ContactUsRequest') }}" class="contactForm" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 text-center mb-5">
                                        <h2>@lang('front.ContatcUsInquiry')</h2>

                                    </div>
                                    <div class="col-md-6 mb-4" style="text-align: initial">
                                        <strong class="text-danger"> *
                                            @error('name')
                                                -
                                                {{ $message }}
                                            @enderror
                                        </strong>
                                        <input type="text" class="form-control" placeholder="@lang('front.ContatcUsName')" name="name">

                                    </div>
                                    <div class="col-md-6 mb-4" style="text-align: initial">
                                        <strong class="text-danger"> *
                                            @error('email')
                                                -
                                                {{ $message }}
                                            @enderror
                                        </strong>
                                        <input type="email" class="form-control" placeholder="@lang('front.Email') "
                                            name="email">
                                    </div>
                                    <div class="col-md-6 mb-4" style="text-align: initial">
                                        <strong class="text-danger"> *
                                            @error('phone')
                                                -
                                                {{ $message }}
                                            @enderror
                                        </strong>
                                        <input type="text" class="form-control" placeholder="@lang('front.Phone')" name="phone">
                                    </div>
                                    <div class="col-md-6 mb-4" style="text-align: initial">
                                        <strong class="text-danger"> *
                                            @error('subject')
                                                -
                                                {{ $message }}
                                            @enderror
                                        </strong>
                                        <input type="text" class="form-control" placeholder="@lang('front.Subject')" name="subject">
                                    </div>
                                    <div class="col-12 mb-4" style="text-align: initial">
                                        <strong class="text-danger"> *
                                            @error('message')
                                                -
                                                {{ $message }}
                                            @enderror
                                        </strong>
                                        <textarea rows="3" class="form-control" placeholder="@lang('front.Message')" name="message">{{ old('message') ? old('message') : '' }}</textarea>
                                    </div>
                                    <div class="col-12 mb-5 text-center">
                                        <input type="submit" class="btn submit" value="@lang('front.Send')">
                                    </div>
                                    <div class="col-12  text-center">
                                        <ul class="d-flex justify-content-center">
                                            <li>
                                                <a href="{{ isset($contact_us->twitter) ? $contact_us->twitter : -1 }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ isset($contact_us->instagram) ? $contact_us->instagram : -1 }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ isset($contact_us->linkedin) ? $contact_us->linkedin : -1 }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-linkedin"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ isset($contact_us->facebook) ? $contact_us->facebook : -1 }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ isset($contact_us->youtube) ? $contact_us->youtube : -1 }}"
                                                    target="_blank">
                                                    <i class="fa-brands fa-youtube"></i>
                                                </a>
                                            </li>
                                        </ul>
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
