<!DOCTYPE html>

<html>


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Diyarnaa    | Admin Login </title>
    {{-- <link rel="shortcut icon" href="{{ asset('style_files/shared/images_default/fivicon_0.png') }}" type="image/png"> --}}

    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- L.A.L Custom : -->
</head>

<body>

    <div class="page_landingPage">

        <div class="c_bloc">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                    
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <h1 class="text-center" style="font-size: 30pt;">Diyarnaa  System</h1>
                    <h1 class="text-center" style="font-size: 20pt;">Super Admin Portal</h1>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <x-jet-validation-errors class="mb-4" />
                    @if (session('status'))
                        <h4 class="alert "></h4>
                        <div class="mb-4 font-medium text-sm text-green-600">
                            <h1>dgfd</h1>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('super_admin.login.submit') }}">
                        @csrf
                        <div>
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="current-password" />
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-jet-button class="ml-4">
                                {{ __('Log in') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>

            </div>


            <div class="c_copRight">
                <p>Copyright © 2021 <a href="#">BlueRay</a> All rights reserved. </p>
            </div>
        </div>


    </div>
</body>
<script src="{{ asset('style_files/frontend/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('style_files/frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('style_files/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('style_files/frontend/js/custom.js') }}"></script>
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
</html>
