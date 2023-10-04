/**************************** real state slider*************************************/
$(function () {
    $("#aniimated-thumbnials").lightGallery({
        thumbnail: true,
    });
    // Card's slider
    var $carousel = $(".slider-for");

    $carousel.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        adaptiveHeight: true,
        asNavFor: ".slider-nav",
    });
    $(".slider-nav").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: ".slider-for",
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        variableWidth: true,
    });
});
/**************************** testamonial home slider*************************************/

$(document).ready(function () {
    $("#mainSlider").lightSlider({
        item: 1,
        loop: true,
        slideMove: 1,
        easing: "cubic-bezier(0.25, 0, 0.25, 1)",
        speed: 1000,
        pager: false,
        control: true,
        auto: true,
        pause: 9000,
        prevHtml: '<i class="fa-solid fa-angle-left"></i>',
        nextHtml: '<i class="fa-solid fa-angle-right"></i>',
    });
    $(".testemonialSlider").lightSlider({
        item: 1,
        loop: true,
    });

    $("#slider").lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        slideMargin: 0,
        thumbItem: 5,
        speed: 400, //ms'
        auto: true,
        loop: true,
        slideEndAnimation: true,
        pause: 2500,
    });

    $(".topBottom svg").click(function () {
        $(this).toggleClass("show");
    });

    $("header.phoneHeader nav .btn-group.c_lang button").click(function () {
        $(".phoneHeader").toggleClass("active");
    });
});

// $(function () {
//     $("#slider").slick({
//         autoplay: true,
//         speed: 1000,
//         arrows: false,
//         dots:true,
//         asNavFor: "#thumbnail_slider",
//     });
//     $("#thumbnail_slider").slick({
//         slidesToShow: 3,
//         speed: 1000,
//         asNavFor: "#slider",
//     });
// });

// jQuery(function () {
//     jQuery("#slider").slick({
//         slidesToShow: 1,
//         slidesToScroll: 1,
//         autoplay: true,
//         speed: 2000,
//         arrows: false,
//         infinite: true,
//         focusOnSelect: true,
//         asNavFor: "#thumbnail_slider",
//     });
//     jQuery("#thumbnail_slider").slick({
//         slidesToShow: 5,
//         slidesToScroll: 1,
//         // focusOnSelect: true,
//         speed: 2000,
//         asNavFor: "#slider",
//         arrows: false,
//         infinite: true,
//         responsive: [
//             {
//                 breakpoint: 1024,
//                 settings: {
//                     slidesToShow: 3,
//                 },
//             },
//             {
//                 breakpoint: 480,
//                 settings: {
//                     slidesToShow: 2,
//                 },
//             },
//         ],
//     });
// });

// adding class active for account sidbar links
jQuery(function ($) {
    var path = window.location.href;
    // because the 'href' property of the DOM element is the absolute path
    jQuery(".userMenu ul li a").each(function () {
        if (this.href === path) {
            jQuery(this).addClass("active");
        }
    });
});

jQuery(".counter").each(function () {
    jQuery(this)
        .prop("Counter", 0)
        .animate(
            {
                Counter: jQuery(this).attr("data-target"),
            },
            {
                //chnage count up speed here
                duration: 4000,
                easing: "swing",
                step: function (now) {
                    jQuery(this).text(Math.ceil(now));
                },
            }
        );
});

jQuery(document).ready(function () {
    jQuery(".dashboard .menuIcon img.m").click(function () {
        jQuery(".dashboard .userMenu").toggleClass("active");
        $(".menuIcon img").addClass("menuRotate");
        setTimeout(function () {
            $(".menuIcon img ").toggleClass("hide");
        }, 1000);
    });

    jQuery(".dashboard .menuIcon img.x").click(function () {
        jQuery(".dashboard .userMenu").toggleClass("active");
        $(".menuIcon img").removeClass("menuRotate");
        setTimeout(function () {
            $(".menuIcon img").removeClass("menuRotate");
            $(".menuIcon img ").toggleClass("hide");
        }, 500);
    });
});
