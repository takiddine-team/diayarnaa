<!DOCTYPE html>
<html lang="ar" dir='rtl'>

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Sleek لوحه التحكم - Free Bootstrap 4 Admin لوحه التحكم Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
    <title>diyarnaa | Admin لوحه التحكم</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('style_files/backend/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    {{-- Button CSS --}}
    {{-- <link href="{{ asset('resources/style_files/backend/plugins/ladda/ladda.min.css') }}" rel="stylesheet" /> --}}


    <!-- No Extra plugin used -->
    {{-- <link href="{{ asset('style_files/backend/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('style_files/backend/plugins/daterangepicker/daterangepicker.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('style_files/backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet" /> --}}


    {{-- ================================================================== --}}
    {{-- =============== Start Code Mirror (Editor) Section =============== --}}
    {{-- ================================================================== --}}
    <link id="sleek-css" rel="stylesheet"
        href="{{ asset('style_files/shared/plugin/codemirror-5.62.2/lib/codemirror.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('style_files/shared/plugin/codemirror-5.62.2/addon/display/fullscreen.css') }}">
    <link id="sleek-css" rel="stylesheet"
        href="{{ asset('style_files/shared/plugin/codemirror-5.62.2/theme/night.css') }}" />
    {{-- ================================================================== --}}
    {{-- ================ End Code Mirror (Editor) Section ================ --}}
    {{-- ================================================================== --}}

    <!-- SLEEK CSS LTR (EN): -->

    <link id="sleek-css" rel="stylesheet" href="{{ asset('style_files/backend/css/sleek.rtl.css') }}" />




    {{-- Data Table --}}
    <link href="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">

    {{-- custome Table --}}
    {{-- <link href="{{ asset('style_files/backend/css/customStyle.css') }}" rel="stylesheet"> --}}

    <!-- FAVICON -->
    <link href="{{ asset('style_files/backend/img/favicon.png') }}" rel="shortcut icon" />

    {{-- Sweet Alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>

    {{-- <!-- Sweet Alert 2 -->
    <script src="{{ asset('style_files/backend/js/sweetalert2.all.min.js') }}"></script> --}}

    <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="{{ asset('style_files/backend/plugins/nprogress/nprogress.js') }}"></script>
    <!-- L.A.L Custom : -->

    @yield('admin_css')


    {{-- ========================================================== --}}
    {{-- =============== Live Select Search Section =============== --}}
    {{-- ========================================================== --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    {{-- ========================================================== --}}
    {{-- =============== Live Select Search Section =============== --}}
    {{-- ========================================================== --}}
</head>

<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();
    </script>
    <div id="toaster"></div>
    <div class="wrapper">
