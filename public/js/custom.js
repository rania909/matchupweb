/*
Copyright (c) 2017 
------------------------------------------------------------------
[Master Javascript]

Project:  SPORT BAZAAR  - Responsive HTML Template

-------------------------------------------------------------------*/
(function($) {
    "use strict";
    var sportbazaar = {
        initialised: false,
        version: 1.0,
        mobile: false,
        init: function() {
            if (!this.initialised) {
                this.initialised = true;
            } else {
                return;
            }
            /*-------------- sport bazaar ---------------------------------------------------
            ------------------------------------------------------------------------------------------------*/
  
            this.search_bar();
            this.delete_button();
            this.navigation_opener();
            this.nav_opener();
            this.banner_slider();
            this.arrival_slider();
            this.hot_deal();
            this.countdown();
            this.isotop_filter();
            this.product_slider();
            this.trendy_collection_slider();
            this.client_comment_slider1();
            this.bst_slider();
            this.treadmil_slider();
            this.treadmil_slick_slider();
            this.hotdeal_slider();
            this.client_comment_slider2();
            this.slider_special_product();
            this.banner_slider2();
            this.banner_slider3();
            this.banner_jarallax();
            this.client_comment_slider3();
            this.banner_slider4();
            this.banner_slider5();
            this.best_selling_filter();
            this.product_single_slider();
            this.zoom();
            this.select_product_single_slider();
            this.map();
            this.parallax();
            this.nice_select();
            this.select_option();

        },

        /*-------------- Sport Bazaar Functions definition ---------------------------------------------------
       ---------------------------------------------------------------------------------------------------*/


/*===========  search_bar ===========*/
    search_bar: function() {
         if ($("#search-opener").length) {
            $("#search-opener, .close-btn").on("click", function(e) {
                  $("#search-item").toggleClass('active');
            });
          };

      },

/*===========  delete_button ===========*/

   delete_button: function() {
    if ($(".remove-it").length) {
          $('.remove-it').on("click", function(){  
              $(this).parent().hide();
          });
        }
      },


/*=========== navigation_opener ===========*/

    navigation_opener: function() {
          if ($(".list-navigation-menu").length) {
                $('.list-navigation-menu').on('click', function(){
                    $('.list-unstyled.align-right.home').toggleClass('active');
                });
            };

         if ($(window).width() < 992 ) {
            $(".menu-1").on("click", function(e) {
                $(this).parent().children(".list-navigation").slideToggle();
            });
         };
    },

/*=========== nav_opener ===========*/   

    
    nav_opener: function() {
        if ($(".list-nav-menu").length) {
            $('.list-nav-menu').on('click', '.flaticon-menu-1',  function(){
                $('.list-nav').toggleClass('active');
                $('#header .drop-down').hide();
            });
        };


        if ($(".drop_down_nav").length) {
           $(".nav-opener").on("click", function(e) {
              $(this).toggleClass('active').find('i').toggleClass('fa-bars fa-times');
              $('.main-nav').toggleClass('nav-active');
              e.preventDefault();
           });
        };

        if ($(".c_nav").length) {
           
           $('c_nav').on("click", ".owl-next", function(e) {
            $('.treadmil-slider2').find('.slick-next').trigger("click");
              e.preventDefault();
           });

           $('.c_nav').on("click", ".owl-prev", function(e) {
            $('.treadmil-slider2').find('.slick-prev').trigger("click");
              e.preventDefault();
           });
           
        };

        if ($(window).width() < 992 ) {
          $('.drop').find('.drop-down').css("display", "none");
          $(".drop").append('<i class="fa fa-angle-down"></i>');
          $(".drop i").on("click", function(e) {
              $(this).parent().children("ul.drop-down").slideToggle();
          });
          $('.drop-megamenu').find('.mega-menu-content').css("display", "none");
          $(".drop-megamenu").append('<i class="fa fa-angle-down"></i>');
          $(".drop-megamenu i").on("click", function(e) {
              $(this).parent().children(".mega-menu-content").slideToggle();
          });
        };
  },


/*=========== banner_slider ===========*/

    banner_slider: function() {
       if ($('.slider1').length > 0) {
             var slider = $('.slider1');

               slider.owlCarousel({
                margin:0,
          loop:true,
          nav:true,
                    center: true,
          dots: false,
          autoplay:true,
                    autoplayTimeout: 8000,
                    mouseDrag: false,
          autoplayHoverPause:false,
          navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
      ],
          items:1
        });

               // add animate.css class(es) to the elements to be animated
                  function setAnimation ( _elem, _InOut ) {
                    // Store all animationend event name in a string.
                    // cf animate.css documentation
                    var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

                    _elem.each ( function () {
                      var $elem = $(this);
                      var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );

                      $elem.addClass($animationType).one(animationEndEvent, function () {
                        $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
                      });
                    });
                  }

                // Fired before current slide change
                  slider.on('change.owl.carousel', function(event) {
                      var $currentItem = $('.owl-item', slider).eq(event.item.index);
                      var $elemsToanim = $currentItem.find("[data-animation-out]");
                      setAnimation ($elemsToanim, 'out');
                  });

                // Fired after current slide has been changed
                  var round = 0;
                  slider.on('changed.owl.carousel', function(event) {

                      var $currentItem = $('.owl-item', slider).eq(event.item.index);
                      var $elemsToanim = $currentItem.find("[data-animation-in]");
                    
                      setAnimation ($elemsToanim, 'in');
                  })
                  
                  slider.on('translated.owl.carousel', function(event) {
                    // console.log (event.item.index, event.page.count);
                    
                      if (event.item.index == (event.page.count - 1))  {
                        if (round < 1) {
                          round++
                          // console.log (round);
                        } else {
                          slider.trigger('stop.owl.autoplay');
                          var owlData = slider.data('owl.carousel');
                          owlData.settings.autoplay = false; //don't know if both are necessary
                          owlData.options.autoplay = false;
                          slider.trigger('refresh.owl.carousel');
                        }
                      }
                  });
            
          }
         
            },


 /*=========== arrival_slider ===========*/       
        
    arrival_slider: function() {
            if ($('.owl-carousel-slider-arrival').length) {
                 $('.owl-carousel-slider-arrival').owlCarousel({
                        loop: true,
                        margin: 30,
                        nav: true,
                        dots:false,
                        

                        navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
                        ],
                        autoplay: false,
                        autoplayHoverPause: true,
                        responsive: {
                          0: {
                            items: 1
                          },
                          576:{
                            items:2
                          },
                          768:{
                            items:2
                          },
                          992: {
                            items: 3
                          },
                          1200: {
                            items:4
                          }

                        }
                      });
                   };      
              },

 /*=========== hot_deal ===========*/       
 
    hot_deal: function() {
          if ($(".owl-carousel-hotdeal-slider").length) {
             $('.owl-carousel-hotdeal-slider').owlCarousel({
              loop: true,
              margin: 0,
              nav: true,
              dots:false,

              navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
              ],
              autoplay: false,
              autoplayHoverPause: false,
              responsive: {
                0: {
                  items: 1
                },
                600: {
                  items: 1
                },
                1000: {
                  items: 2
                }
              }
            });
             };
            },

/*=========== countdown ===========*/

    countdown: function() { 
          if ($(".countdown").length) {
                  var targetDate = new Date("2018/08/01 00:00:00");   
                  var days;
                  var hrs;
                  var min;
                  var sec;
                  $(function() {
                     timeToLaunch();
                    numberTransition('.days .number', days, 1000, 'easeOutQuad');
                    numberTransition('.hours .number', hrs, 1000, 'easeOutQuad');
                    numberTransition('.minutes .number', min, 1000, 'easeOutQuad');
                    numberTransition('.seconds .number', sec, 1000, 'easeOutQuad');
                    setTimeout(countDownTimer,1001);
                  });

                  function timeToLaunch(){
                      // Get the current date
                      var currentDate = new Date();

                      // Find the difference between dates
                      var diff = (currentDate - targetDate)/1000;
                      var diff = Math.abs(Math.floor(diff));  

                      // Check number of days until target
                      days = Math.floor(diff/(24*60*60));
                      sec = diff - days * 24*60*60;

                      // Check number of hours until target
                      hrs = Math.floor(sec/(60*60));
                      sec = sec - hrs * 60*60;

                      // Check number of minutes until target
                      min = Math.floor(sec/(60));
                      sec = sec - min * 60;
                  }

                  function countDownTimer(){ 
                      
                      timeToLaunch();
                      
                      $( ".days .number" ).text(days);
                      $( ".hours .number" ).text(hrs);
                      $( ".minutes .number" ).text(min);
                      $( ".seconds .number" ).text(sec);
                      
                      setTimeout(countDownTimer,1000);
                  }
                  function numberTransition(id, endPoint, transitionDuration, transitionEase){
                    // Transition numbers from 0 to the final number
                    $({numberCount: $(id).text()}).animate({numberCount: endPoint}, {
                        duration: transitionDuration,
                        easing:transitionEase,
                        step: function() {
                          $(id).text(Math.floor(this.numberCount));
                        },
                        complete: function() {
                          $(id).text(this.numberCount);
                        }
                     }); 
                  };
            
          }
      },



/*=========== isotop_filter ===========*/

    isotop_filter: function() {
              if ($(".menu").length) {
                  $('.menu').on('click',function(){
                    var selector = $(this).attr('data-filter');
                    
                      $('.grid').isotope({
                          filter:selector,
                        });
                      
                        $(this).closest('.filter-button-group').find('.is-checked').removeClass('is-checked');
                        $(this).addClass('is-checked');

                      });
                  };
              },

/*=========== product_slider ===========*/

    product_slider: function() {
        if ($(".owl-carousel-slider-product").length) {
            $('.owl-carousel-slider-product').owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots:false,

                navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
                ],
                autoplay: true,
                autoplayHoverPause: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  576: {
                    items: 3
                  },
                  768:{
                    items:4
                  },
                  992: {
                    items:5
                  },
                  1200: {
                    items:6
                  }


                }
          });
      }; 
    },



/*=========== trendy_collection_slider ===========*/


    trendy_collection_slider: function() {
       if ($(".owl-carousel-slider-trendy-collection").length) {
            $('.owl-carousel-slider-trendy-collection').owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots:false,

                navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
                ],
                autoplay: true,
                autoplayHoverPause: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  576:{
                    items:2
                  },
                  768:{
                    items:2
                  },
                  992: {
                    items: 3
                  },
                  1200: {
                    items:4
                  }
                }
              });
          }; 
    },


/*=========== client_comment_slider1 ===========*/

    client_comment_slider1: function() {
      if ($(".owl-carousel-slider-client").length) {
            $('.owl-carousel-slider-client').owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots:false,

                navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
                ],
                autoplay: true,
                autoplayHoverPause: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 1
                  },

                  1000: {
                    items: 1
                  }
                }
              });
          };
    },



/*home2*/

 /*=========== bst_slider ===========*/

    bst_slider: function() {
       if ($(".bst-slider").length) {
            $('.bst-slider').owlCarousel({
              loop: true,
              margin: 30,
              nav: true,
              dots:false,

              navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
              ],
              autoplay: true,
              autoplayHoverPause: true,
              responsive: {
                0: {
                  items: 1
                },
                600: {
                  items: 2
                },
                700: {
                  items: 3
                },
                1100: {
                  items:4
                }
              }
            });
          };
    },


/*=========== treadmil_slider ===========*/


    treadmil_slider: function() {
        if ($(".treadmil-slider").length) {
          $('.treadmil-slider').slick({
          dots: false,
          arrows:true,
          autoplay: true,
          autoplaySpeed: 2000,
          infinite:true,
          slidesToShow: 1,
          speed: 300,
          vertical: true,
          verticalSwiping: true,
          verticalReverse: false,
          draggable: false,
          responsive: [{
          breakpoint: 1024,
          settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          vertical:false,
          draggable: true,
          verticalSwiping: false,

            }
        }]
      });
      };
  },


/*=========== treadmil_slick_slider ===========*/

    treadmil_slick_slider: function() {
        if ($(".treadmil-slider2").length) {
            $('.treadmil-slider2').slick({
                dots: false,
                arrows:true,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite:true,
                slidesToShow: 1,
                speed: 300,
                vertical: true,
                verticalSwiping: true,
                verticalReverse: true,
                draggable: false,
                responsive: [{
                breakpoint: 1024,
                settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                vertical:false,
                draggable: true,
                verticalSwiping: false,
                verticalReverse: false,

                  }
              }]
            });
    };
    },

/*=========== hotdeal_slider ===========*/


    hotdeal_slider: function() {
          if ($(".slider-hotdeal").length) {
             $('.slider-hotdeal').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                dots:false,

                navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
                ],
                autoplay: false,
                autoplayHoverPause: false,
                responsive: {
                   0: {
                      items: 1
                    },
                    600: {
                      items: 1
                    },
                    1000: {
                      items: 2
                    }
                }
              });
           };
    },


 /*=========== client_comment_slider2 ===========*/  


    client_comment_slider2: function() {
          if ($(".slider-client-block").length) {
            $('.slider-client-block').owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots:false,

                navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
                ],
                autoplay: true,
                autoplayHoverPause: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 1
                  },

                  1000: {
                    items: 1
                  }
                }
              });
        }; 
    },


/*=========== slider_special_product ===========*/

    slider_special_product: function() {
     if ($(".slider-special-product").length) {
          $('.slider-special-product').owlCarousel({
          loop: true,
          margin: 0,
          nav: true,
          dots:false,
          margin: 30,

          navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
          ],
          autoplay: true,
          autoplayHoverPause: true,
          responsive: {
          0: {
              items: 1
            },
            400:{
              items:2
            },
            600: {
              items: 3
            },
            800:{
              items:4
            },
            900: {
              items:4
            },
            1000: {
              items:4
             },
            1100: {
              items:5
             },
             1200: {
              items:5
             },

            1300: {
              items:6
            }


          }
        });
  }; 
  },
/*=========== banner_slider2 ===========*/

    banner_slider2: function() {
        if ($('.slider2').length > 0) {
                   var slider = $('.slider2');

                     slider.owlCarousel({
                      margin:0,
                loop:true,
                nav:true,
                          center: true,
                dots: false,
                autoplay:true,
                          autoplayTimeout: 8000,
                          mouseDrag: false,
                autoplayHoverPause:false,
                navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
            ],
                items:1
              });

                     // add animate.css class(es) to the elements to be animated
                        function setAnimation ( _elem, _InOut ) {
                          // Store all animationend event name in a string.
                          // cf animate.css documentation
                          var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

                          _elem.each ( function () {
                            var $elem = $(this);
                            var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );

                            $elem.addClass($animationType).one(animationEndEvent, function () {
                              $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
                            });
                          });
                        }

                      // Fired before current slide change
                        slider.on('change.owl.carousel', function(event) {
                            var $currentItem = $('.owl-item', slider).eq(event.item.index);
                            var $elemsToanim = $currentItem.find("[data-animation-out]");
                            setAnimation ($elemsToanim, 'out');
                        });

                      // Fired after current slide has been changed
                        var round = 0;
                        slider.on('changed.owl.carousel', function(event) {

                            var $currentItem = $('.owl-item', slider).eq(event.item.index);
                            var $elemsToanim = $currentItem.find("[data-animation-in]");
                          
                            setAnimation ($elemsToanim, 'in');
                        })
                        
                        slider.on('translated.owl.carousel', function(event) {
                          // console.log (event.item.index, event.page.count);
                          
                            if (event.item.index == (event.page.count - 1))  {
                              if (round < 1) {
                                round++
                                // console.log (round);
                              } else {
                                slider.trigger('stop.owl.autoplay');
                                var owlData = slider.data('owl.carousel');
                                owlData.settings.autoplay = false; //don't know if both are necessary
                                owlData.options.autoplay = false;
                                slider.trigger('refresh.owl.carousel');
                              }
                            }
                        });
                  
                }
          },


/*=========== banner_slider3 ===========*/

    banner_slider3: function() {
      if ($('.slider3').length > 0) {
             var slider = $('.slider3');

               slider.owlCarousel({
                margin:0,
          loop:true,
          nav:true,
                    center: true,
          dots: false,
          autoplay:true,
                    autoplayTimeout: 8000,
                    mouseDrag: false,
          autoplayHoverPause:false,
          navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
      ],
          items:1
        });

               // add animate.css class(es) to the elements to be animated
                  function setAnimation ( _elem, _InOut ) {
                    // Store all animationend event name in a string.
                    // cf animate.css documentation
                    var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

                    _elem.each ( function () {
                      var $elem = $(this);
                      var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );

                      $elem.addClass($animationType).one(animationEndEvent, function () {
                        $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
                      });
                    });
                  }

                // Fired before current slide change
                  slider.on('change.owl.carousel', function(event) {
                      var $currentItem = $('.owl-item', slider).eq(event.item.index);
                      var $elemsToanim = $currentItem.find("[data-animation-out]");
                      setAnimation ($elemsToanim, 'out');
                  });

                // Fired after current slide has been changed
                  var round = 0;
                  slider.on('changed.owl.carousel', function(event) {

                      var $currentItem = $('.owl-item', slider).eq(event.item.index);
                      var $elemsToanim = $currentItem.find("[data-animation-in]");
                    
                      setAnimation ($elemsToanim, 'in');
                  })
                  
                  slider.on('translated.owl.carousel', function(event) {
                    // console.log (event.item.index, event.page.count);
                    
                      if (event.item.index == (event.page.count - 1))  {
                        if (round < 1) {
                          round++
                          // console.log (round);
                        } else {
                          slider.trigger('stop.owl.autoplay');
                          var owlData = slider.data('owl.carousel');
                          owlData.settings.autoplay = false; //don't know if both are necessary
                          owlData.options.autoplay = false;
                          slider.trigger('refresh.owl.carousel');
                        }
                      }
                  });
            
          }
          },

/*=========== banner_jarallax ===========*/

    banner_jarallax:function(){
           if ($('.jarallax').length) {

                objectFitImages();

                jarallax(document.querySelectorAll('.jarallax'));

                jarallax(document.querySelectorAll('.jarallax-keep-img'), {
                    keepImg: true,
                });

            }
  },




/*===========   client_comment_slider3 ===========*/

    client_comment_slider3: function() {
          if ($(".slider-client3").length) {
            $('.slider-client3').owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots:false,

                navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
                ],
                autoplay: true,
                autoplayHoverPause: true,
                responsive: {
                   0: {
                    items: 1
                  },
                  600: {
                    items: 1
                  },

                  1000: {
                    items: 1
                  }
                }
            });
        }; 
    },


/*===========   banner_slider4 ===========*/


    banner_slider4: function() {
         if ($('.slider4').length > 0) {
             var slider = $('.slider4');

               slider.owlCarousel({
                margin:0,
          loop:true,
          nav:true,
                    center: true,
          dots: false,
          autoplay:true,
                    autoplayTimeout: 8000,
                    mouseDrag: false,
          autoplayHoverPause:false,
          navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
      ],
          items:1
        });

               // add animate.css class(es) to the elements to be animated
                  function setAnimation ( _elem, _InOut ) {
                    // Store all animationend event name in a string.
                    // cf animate.css documentation
                    var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

                    _elem.each ( function () {
                      var $elem = $(this);
                      var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );

                      $elem.addClass($animationType).one(animationEndEvent, function () {
                        $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
                      });
                    });
                  }

                // Fired before current slide change
                  slider.on('change.owl.carousel', function(event) {
                      var $currentItem = $('.owl-item', slider).eq(event.item.index);
                      var $elemsToanim = $currentItem.find("[data-animation-out]");
                      setAnimation ($elemsToanim, 'out');
                  });

                // Fired after current slide has been changed
                  var round = 0;
                  slider.on('changed.owl.carousel', function(event) {

                      var $currentItem = $('.owl-item', slider).eq(event.item.index);
                      var $elemsToanim = $currentItem.find("[data-animation-in]");
                    
                      setAnimation ($elemsToanim, 'in');
                  })
                  
                  slider.on('translated.owl.carousel', function(event) {
                    // console.log (event.item.index, event.page.count);
                    
                      if (event.item.index == (event.page.count - 1))  {
                        if (round < 1) {
                          round++
                          // console.log (round);
                        } else {
                          slider.trigger('stop.owl.autoplay');
                          var owlData = slider.data('owl.carousel');
                          owlData.settings.autoplay = false; //don't know if both are necessary
                          owlData.options.autoplay = false;
                          slider.trigger('refresh.owl.carousel');
                        }
                      }
                  });
            
          }
       
          },

 

/*===========  banner_slider5 ===========*/

    banner_slider5: function() {
          if ($('.slider5').length > 0) {
             var slider = $('.slider5');

               slider.owlCarousel({
                margin:0,
          loop:true,
          nav:true,
                    center: true,
          dots: false,
          autoplay:true,
                    autoplayTimeout: 8000,
                    mouseDrag: false,
          autoplayHoverPause:false,
          navText: [ "<i class='flaticon-left'></i><span class='np-btn'>Prev</span>","<span class='np-btn'>Next</span><i class='flaticon-right'></i>"
      ],
          items:1
        });

               // add animate.css class(es) to the elements to be animated
                  function setAnimation ( _elem, _InOut ) {
                    // Store all animationend event name in a string.
                    // cf animate.css documentation
                    var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

                    _elem.each ( function () {
                      var $elem = $(this);
                      var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );

                      $elem.addClass($animationType).one(animationEndEvent, function () {
                        $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
                      });
                    });
                  }

                // Fired before current slide change
                  slider.on('change.owl.carousel', function(event) {
                      var $currentItem = $('.owl-item', slider).eq(event.item.index);
                      var $elemsToanim = $currentItem.find("[data-animation-out]");
                      setAnimation ($elemsToanim, 'out');
                  });

                // Fired after current slide has been changed
                  var round = 0;
                  slider.on('changed.owl.carousel', function(event) {

                      var $currentItem = $('.owl-item', slider).eq(event.item.index);
                      var $elemsToanim = $currentItem.find("[data-animation-in]");
                    
                      setAnimation ($elemsToanim, 'in');
                  })
                  
                  slider.on('translated.owl.carousel', function(event) {
                    // console.log (event.item.index, event.page.count);
                    
                      if (event.item.index == (event.page.count - 1))  {
                        if (round < 1) {
                          round++
                          // console.log (round);
                        } else {
                          slider.trigger('stop.owl.autoplay');
                          var owlData = slider.data('owl.carousel');
                          owlData.settings.autoplay = false; //don't know if both are necessary
                          owlData.options.autoplay = false;
                          slider.trigger('refresh.owl.carousel');
                        }
                      }
                  });
            
          }
        },

  /*=========== best_selling_filter ===========*/

   best_selling_filter: function(){
       if ($("#Container").length) {
          var $filterSelect = $('#FilterSelect'),
              $sortSelect = $('#SortSelect'),
              $container = $('#Container');
          
          $container.mixItUp();
          
          $filterSelect.on('change', function(){
            $container.mixItUp('filter', this.value);
          });
          
          $sortSelect.on('change', function(){
            $container.mixItUp('sort', this.value);
          });


            var  v1 = $('.list-btn');
            var  v2 = $('.custom-container');
            var  v3 = $('.grid-btn');
                
              v1.on("click", function(e) {
                 v2.addClass('l-view');
                 v3.removeClass('active');
                 $(this).addClass('active');
                 e.preventDefault();
                });

              v3.on("click", function(e) {
                 v2.removeClass('l-view');
                 v1.removeClass('active');
                 $(this).addClass('active');
                 e.preventDefault();
                 
                });

            };
      },


    /*=========== product_single_slider ===========*/

    product_single_slider: function(){
          if ($(".slider-single").length) {
              
        $('.slider-single').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          fade: false,
          adaptiveHeight: true,
          infinite: false,
          useTransform: true,
          speed: 400,
          cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
         });

         $('.slider-nav').on('init', function(event, slick) {
            $('.slider-nav .slick-slide.slick-current').addClass('is-active');
          })
          .slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            dots: false,
            focusOnSelect: false,
            infinite: false,
            responsive: [{
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,

              }
            }, {
              breakpoint:992,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
              }
            }, {
              breakpoint: 420,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
            }]
          });

         $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
            $('.slider-nav').slick('slickGoTo', currentSlide);
            var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
            $('.slider-nav .slick-slide.is-active').removeClass('is-active');
            $(currrentNavSlideElem).addClass('is-active');
         });

         $('.slider-nav').on('click', '.slick-slide', function(event) {
            event.preventDefault();
            var goToSingleSlide = $(this).data('slick-index');

            $('.slider-single').slick('slickGoTo', goToSingleSlide);
         });

         $('.slider-single').on('mouseover', function() {
            $("#preview").css("overflow", "hidden");
          });

         $('.slider-single').on('mouseout', function() {
            $("#preview").css("overflow", "visible");
          });
        };


        },


/*=========== jzoom  ===========*/

   zoom:function(){
    if ($(".thumb").length) {
      if ($(window).width() > 1199 ) {
              var evt = new Event(),
                m = new Magnifier(evt, {
                });
                m.attach({
                    thumb: '.thumb',
                    zoomable: false,
                    largeWrapper: 'preview'
                });
          };
        }
   },


/*=========== select_product_single_slider ===========*/

    select_product_single_slider: function(){
       if ($(".slider-single-product").length) {
         $('.slider-single-product').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          fade: false,
          adaptiveHeight: true,
          infinite: false,
          useTransform: true, 
          speed: 400,
          cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
          
         });

         $('.slider-nav2')
          .on('init', function(event, slick) {
            $('.slider-nav2 .slick-slide.slick-current').addClass('is-active');
          }).slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            dots: false,
            focusOnSelect: false,
            infinite: false,
            vertical: true,
            responsive: [{
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                
              }
            }, {
              breakpoint:992,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                vertical:true,

              }
            }, {
               breakpoint:768,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                vertical:false,

              }
            }, {
              breakpoint: 420,
              settings: {
                vertical: false,
                slidesToShow: 3,
                slidesToScroll: 3,
            }
            }]

          });

         $('.slider-single-product').on('afterChange', function(event, slick, currentSlide) {
          $('.slider-nav2').slick('slickGoTo', currentSlide);
          var currrentNavSlideElem = '.slider-nav2 .slick-slide[data-slick-index="' + currentSlide + '"]';
          $('.slider-nav2 .slick-slide.is-active').removeClass('is-active');
          $(currrentNavSlideElem).addClass('is-active');
         });

         $('.slider-nav2').on('click', '.slick-slide', function(event) {
          event.preventDefault();
          var goToSingleSlide = $(this).data('slick-index');

          $('.slider-single-product').slick('slickGoTo', goToSingleSlide);
         });
      };
},



/*=========== map ===========*/

    map:function(){
       if ($("#map").length) {
            var myLatLng =  {lat:42.398866, lng:-83.135405};
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 18,
              center: myLatLng
            });

            var contentString = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h1 id="firstHeading" class="firstHeading">Lorem ipsum</h1>'+
                '<div id="bodyContent">'+
                '<p><b>Lorem ipsum</b>, dolor sit amet, consectetur adipiscing elit. Quisque congue risus arcu. Pellentesque maximus dapibus ex ac aliquet. Sed sodales blandit eros, eget faucibus elit. Integer nisl erat, hendrerit eu varius in, tincidunt sit amet diam. Nulla cursus tincidunt consequat.</p>'+
                '<p><a href="#">'+
                '121 King Street, Melbourne VIC 3000, Lorem ipsum</a></p>'+
                '</div>'+
                '</div>';

            var infowindow = new google.maps.InfoWindow({
              content: contentString
            });


            var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              title: 'Hello World!'
            });
            
            
            
            marker.addListener('click', function() {
              infowindow.open(map, marker);
            });
        
       }; 
    
      },


/*=========== parallax ===========*/

    parallax:function(){
        if ($('.parallax-container').length) {
            $('.parallax-container').parallax();
          }

},


/*=========== nice_select ===========*/

    nice_select: function() {
          if ($('.nice_select').length) {
               $('.nice_select').niceSelect();
          }
      },
/*=========== select_option ===========*/
    select_option: function() {
       if ($('.quantity').length) {
            $('.quantity').each(function() {
                var spinner = $(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

                btnUp.on("click", function() {
                 var oldValue = parseFloat(input.val());
                 if (oldValue >= max) {
                   var newVal = oldValue;
                 } else {
                   var newVal = oldValue + 1;
                 }
                 spinner.find("input").val(newVal);
                 spinner.find("input").trigger("change");
                });
                btnDown.on("click", function() {
                 var oldValue = parseFloat(input.val());
                 if (oldValue <= min) {
                  var newVal = oldValue;
                 } else {
                 var newVal = oldValue - 1;
                 }
                 spinner.find("input").val(newVal);
                 spinner.find("input").trigger("change");
                });

               });
       }
       
}
        
    };
    $(document).ready(function() {
        sportbazaar.init();
    });

    //on load
     $(window).on('load', function() {
         var load;
         setTimeout(function() {
             $('body').addClass('load');
         }, 500);

        // isotope
        if ($(".filtered-item-wrapper").length) {
           $('.filtered-item-wrapper').isotope({
              itemSelector:'.grid-item',
              filter: "*"
            });
        };

     });

        // theme switcher
    if ($(".theme-menu").length) {
        $('.btn-clr').on('click', function(){
            $(this).toggleClass('btn-clr-clicked');
            $('.theme-menu').toggleClass('show-sidebar hide-sidebar');
        });
        $('#style-switcher').on('click', 'li', function(){
            var path = $(this).data('path');
            $(this).closest('ul').find('.active').removeClass('active');
            $(this).addClass('active');
            $('#ui-theme-color').attr('href', path);
            var url = $(this).data('url');
                $(".btm-style img").each(function(index){
                    var src = $(this).attr("src")
                    // console.log(src);
                    var photoName = src.substr(src.lastIndexOf("http://rewebsotech.com/"));
                    $(this).attr("src", url + photoName)
                });
        });
    };         
      // on Scroll
      $(window).on("scroll", function() {
          //Go to top
          if ($(this).scrollTop() > 100) {
              $('#go_to_top').addClass('goto');
          } else {
              $('#go_to_top').removeClass('goto');
          }

      });

       $("#go_to_top").on("click", function() {
          $("html, body").animate({
              scrollTop: 0
          }, 600);
          return false
      });

  
})(jQuery);