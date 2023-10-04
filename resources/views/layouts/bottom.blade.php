    <!-- JQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script> -->

    <!-- Slick Slider JS -->
    <script src="/style_files/frontend/js/slick.js" type="text/javascript" charset="utf-8"></script>
    <script src="/style_files/frontend/js/lightSlider.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.logo-carousel').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                prevArrow: "<img style='width:35px; height:35px;' class='a-left control-c prev slick-prev' src='style_files/frontend/img/arrow_left.png'>",
                nextArrow: "<img style='width:35px;  height:35px;' class='a-right control-c next slick-next' src='style_files/frontend/img/arrow_right.png'>",
                dots: false,
                pauseOnHover: false,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 2
                    }
                }]
            });

            $('.projects_slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                prevArrow: "<img style='width:35px; height:35px;' class='a-left control-c prev slick-prev' src='style_files/frontend/img/arrow_left.png'>",
                nextArrow: "<img style='width:35px;  height:35px;' class='a-right control-c next slick-next' src='style_files/frontend/img/arrow_right.png'>",
                dots: false,
                pauseOnHover: false,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 2
                    }
                }]
            });

            $('.brands_slider').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1000,
                arrows: false,
                // prevArrow:"<img style='width:35px; height:35px;' class='a-left control-c prev slick-prev' src='style_files/frontend/img/arrow_left.png'>",
                // nextArrow:"<img style='width:35px;  height:35px;' class='a-right control-c next slick-next' src='style_files/frontend/img/arrow_right.png'>",
                dots: false,
                pauseOnHover: false,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 2
                    }
                }]
            });
        });
    </script>

    {{-- Animate On Scroll Library --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="{{ asset('front_end_style/css/bootstrap.min.js') }}"></script>
    {{-- <script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script> --}}
    {{-- <script src="/style_files/frontend/js/uiModal.min.js"></script> --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        jQuery(".testemonialSlider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            centerMode: false,
            arrows: false,
            infinite: true,
            autoplay: true,
            // speed:400,
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                verticalHeight: 295,
                vThumbWidth: 50,
                thumbItem: 6,
                thumbMargin: 4,
                slideMargin: 0,
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
                //   vertical:true,
                //   gallery:true,
                //   item:1,
                //   loop:true,
                //   thumbItem:10,
                //   slideMargin:24,
                //   enableDrag: true,
                //   currentPagerPosition:'center',

            });
        });
    </script>
    <script src="/style_files/frontend/js/main.js" type="text/javascript" charset="utf-8"></script>

    @yield('javascript')


    </body>

    </html>
