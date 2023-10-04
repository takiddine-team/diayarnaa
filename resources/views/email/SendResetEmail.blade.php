<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Soalkom</title>
    <link rel="shortcut icon" href="{{ asset('front_end_style/images/slfon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inner.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end_style/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end_style/css/background.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end_style/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end_style/css/bootstrap-rtl.min.css') }}">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- L.A.L Custom : -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Sweet Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/geodatasource-cr.js') }}"></script>
    <script src="{{ asset('js/Gettext.js') }}"></script>
    <link rel="gettext" type="application/x-po" href="{{ asset('languages/ar/LC_MESSAGES/ar.po') }}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    @yield('frontend_javascript_head')
</head>

<body>
    {{-- =========================================================== --}}
    {{-- ================== Sweet Alert Section ==================== --}}
    {{-- =========================================================== --}}
      <!-- ================================================================================================== -->
    <!-- ======================================== inner-top =============================================== -->
    <!-- ================================================================================================== -->

    <!-- ================================================================================================== -->
    <!-- ======================================== inner-top =============================================== -->
    <!-- ================================================================================================== -->


    <div class="c_page_thankPayment c_page_resetPassword c_inner_body">

        <div class="c_mainContent">

            <div class="c_box" style="margin: 0 auto; min-width: 320px;  max-width: 640px; padding: 60px 40px; text-align: center;">

                <div class="c_image" style="text-align: center;">
                            <img src="https://diyarnaa.com/style_files/frontend/img/logo.png">
                </div>

                <div class="c_body">
                    <h3 style="
                    font-size: 30px;
                    text-align: center;"
                 >
                 {{-- Welcome {{ $user->name_en }} --}}
            </h3>
                    <h4 style="
                            font-size: 25px;
                            text-align: left;"
                         >
                         الرجاء النقر فوق الزر التالي لإنشاء كلمة المرور الجديدة الخاصة بك
                    </h4>
                </div>

                <div class="c_buttn" style="text-align: center; ">
                     <table border="0" cellspacing="0" cellpadding="0" ;>
                         <tr>
                             <td align="center" style="border-radius: 3px; font-size: 19px;
                             color: #fff;
                             background: #74bc1f;
                             border: 1px solid #74bc1f;
                             transition: 0.5s;
                             padding: 6px 30px;
                             border-radius: 30px;" ><a style="color: #fff;
                             text-decoration:none"
                                     href="{{ route('validation',$tokenData->token) }}" target="_blank"
                                     >
                                     إنشاء كلمة المرور</a>
                            </td>
                         </tr>
                     </table>
                </div>

            </div>



        </div>

    </div>

</body>
<script src="{{ asset('front_end_style/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('front_end_style/js/popper.min.js') }}"></script>
<script src="{{ asset('front_end_style/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front_end_style/js/custom.js') }}"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper_department_pc.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 25,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


    var swiper = new Swiper('.swiper_expert_pc.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 45,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


    var swiper = new Swiper('.swiper_spons_pc.swiper-container', {
        slidesPerView: 6,
        spaceBetween: 45,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });



    var swiper = new Swiper('.swiper_mannews_pc.swiper-container', {
        slidesPerView: 1,
        centeredSlides: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

</script>

</html>
