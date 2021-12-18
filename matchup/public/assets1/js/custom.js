(function ($) {
    "use strict";

    $(document).ready(function () {

        /*---------------------------------------------------
            calendr carousel
        ----------------------------------------------------*/
        $('.calendr-carousel').owlCarousel({
            loop: true,
            navText: ['<i class="icofont-simple-left"></i>', '<i class="icofont-simple-right"></i>'],
            nav: true,
            autoplay: true,
            autoplayTimeout: 5000,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            smartSpeed: 450,
            margin: 20,
            responsive: {
                0: {
                    items: 2
                },
                768: {
                    items: 4
                },
                991: {
                    items: 5
                },
                1200: {
                    items: 8
                },
                1920: {
                    items: 8
                }
            }
        });


        /*---------------------------------------------------
            calendr carousel
        ----------------------------------------------------*/
        // $('.platform-slider').owlCarousel({
        //     loop: true,
        //     navText: ['<i class="icofont-simple-left"></i>', '<i class="icofont-simple-right"></i>'],
        //     nav: true,
        //     autoplay: false,
        //     autoplayTimeout: 5000,
        //     animateOut: 'fadeOut',
        //     animateIn: 'fadeIn',
        //     smartSpeed: 450,
        //     margin: 20,
        //     responsive: {
        //         0: {
        //             items: 2
        //         },
        //         768: {
        //             items: 2
        //         },
        //         991: {
        //             items: 2
        //         },
        //         1200: {
        //             items: 4
        //         },
        //         1920: {
        //             items: 4
        //         }
        //     }
        // });

        // slider
        var swiper = new Swiper('.platform-slider', {
            slidesPerView: 4,
            spaceBetween: 0,
            loop: true,
            autoplay: {
            speeds: 1000,
            delay: 2000,
            },
            speeds: 2000,
            breakpoints: {
            991: {
                slidesPerView: 2,
            },
            767: {
                slidesPerView: 1,
            },
            575: {
                slidesPerView: 1,
            },
            }
        });

        // slider
        var swiper = new Swiper('.add-slider', {
            slidesPerView: 6,
            spaceBetween: 0,
            loop: true,
            autoplay: {
            speeds: 1000,
            delay: 2000,
            },
            speeds: 2000,
            breakpoints: {
            991: {
                slidesPerView: 2,
            },
            767: {
                slidesPerView: 1,
            },
            575: {
                slidesPerView: 1,
            },
            }
        });

        // slider
        var swiper = new Swiper('.client-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
            speeds: 0,
            delay: 4000,
            },
            speeds: 2000,
            breakpoints: {
            991: {
                slidesPerView: 1,
            },
            767: {
                slidesPerView: 1,
            },
            575: {
                slidesPerView: 1,
            },
            }
        });

        /*---------------------------------------------------
            counter
        ----------------------------------------------------*/
        $('.counter-single h2').counterUp({
            delay: 10, // the delay time in ms
            time: 1000 // the speed time in ms
        });

        /*---------------------------------------------------
            magnific popUp
        ----------------------------------------------------*/
        $('.popup-video').magnificPopup({
            type: 'video'
        });

        /*---------------------------------------------------
            ripple effect
        ----------------------------------------------------*/
        $('.ripple-effect').ripples({
            resolution: 512,
            dropRadius: 20,
            perturbance: 0.04
        });

        // banner image tilt effect
        $('.feat-img--style').tilt({
            reset: true
        });

        // wow js init
        new WOW().init();

        // automatic drops
        setInterval(function () {
            var $el = $('.ripple-effect');
            var x = Math.random() * $el.outerWidth();
            var y = Math.random() * $el.outerHeight();
            var dropRadius = 20;
            var strength = 0.04 + Math.random() * 0.04;

            $el.ripples('drop', x, y, dropRadius, strength);
        }, 1000);

        /*---------------------------------------------------
                type text
        ----------------------------------------------------*/
        $(".text-typed").each(function () {
            var $this = $(this);
            $this.typed({
                strings: $this.attr('data-elements').split(','),
                typeSpeed: 100, // typing speed
                backDelay: 3000 // pause before backspacing
            });
        });
        /*---------------------------------------------------
            scrollIt plugin activation
        ----------------------------------------------------*/
        $.scrollIt();

    });

    /*---------------------------------------------------
        sticky header
    ----------------------------------------------------*/
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $("#header").removeClass("sticky");
        } else {
            $("#header").addClass("sticky");
        }
    });
    
    
    /*---------------------------------------------------
        smooth scroll
    ----------------------------------------------------*/
    $('a[href*="#"]:not([href="#"]):not([data-toggle])').on('click', function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });

    /*---------------------------------------------------
        accordian
    ----------------------------------------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    /*---------------------------------------------------
        preloader
    ----------------------------------------------------*/
    $(window).on('load', function () {
        $('.preloader').fadeOut(500);
    });


}(jQuery));
