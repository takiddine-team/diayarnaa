<!DOCTYPE html>
@if (Config::get('app.locale') == 'ar')
    <html lang="{{ Config::get('app.locale') }}" dir="rtl">
@elseif (Config::get('app.locale') == 'en')
    <html lang="{{ Config::get('app.locale') }}" dir="ltr">
@endif

<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dyarnaa | Home</title>
    <link rel="shortcut icon" href="{{ asset('/style_files/frontend/img/logo.png') }}" type="image/x-icon">





    <meta property="og:image" content="@yield('meta_image_to_site', asset('/style_files/frontend/img/logo.png'))">
    <meta property="og:image:secure_url" content="@yield('meta_image_to_site', asset('/style_files/frontend/img/logo.png'))">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta name="title" content="@yield('meta_title', '')">
    <meta name="description" content="@yield('meta_description', '')">





    {{-- ========================================================== --}}
    {{-- =============== Social Media Share Section =============== --}}
    {{-- ========================================================== --}}
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-606aaa29219f1def"></script>
    {{-- ========================================================== --}}
    {{-- =============== Social Media Share Section =============== --}}
    {{-- ========================================================== --}}


    {{-- <!-- Fonts Awesome Icons --> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Sweet Alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>

    <!-- Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('style_files/frontend/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style_files/frontend/css/slick-theme.css') }}">

    <!-- Ui modal CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('style_files/frontend/css/uiModal.min.css') }}">

    <!-- Ui init tel CSS -->
    <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/front_end_style/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/front_end_style/css/bootstrap-rtl.min.css') }}">

    {{-- Animate On Scroll Library --}}
    {{-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ asset('/style_files/frontend/css/lightSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/style_files/frontend/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('/front_end_style/css/fonts.css') }}">

    <!-- gsap -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <!-- gsap -->


    <link rel="stylesheet" href="{{ asset('style_files/frontend/css/style.css') }}">



    <!-- jQuery first, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>





    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.3.2/css/lightgallery.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.3.2/js/lightgallery.js"></script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    {{-- 
    <!-- Slick Slider JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script> --}}

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-00LDPDE0QB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-00LDPDE0QB');
    </script>
</head>

<body>
