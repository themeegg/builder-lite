(function ($) {

    $(window).load(function () {
        $("#pre-loader").delay(500).fadeOut();
        $(".loader-wrapper").delay(1000).fadeOut("slow");
    });

    $('.navbar-toggle').on('click', function () {
        if (!$('header').hasClass('fixed')) {
            /* navbar toggle click */
        }
    });

    /* menu hover */
    var limit = 767;
    var window_width = window.innerWidth;
    if (window_width > limit) {
        $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeIn("slow");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            },
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeOut("slow");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            });
    }

    $(document).ready(function () {

        $('.contact-section form input[type="submit"]').wrap('<div class="contact-button"></div>');

        $('ul.nav a').each(function () {
            $(this).attr('data-scroll', '');
        });

        /*-- resize parallax size --*/
        $('ul#filter li a').click(function (e) {
            $(window).trigger('resize.px.parallax');
        });

        /*-- Magnific Popup --*/
        $('.image-popup-link').magnificPopup({
            type: 'image',
            closeOnBgClick: true,
            fixedContentPos: false,
        });

        $('.video-popup-link').magnificPopup({
            type: 'iframe',
            closeOnBgClick: true,
            fixedContentPos: false,
        });

        /*-- Button Up --*/
        var btnUp = $('<div/>', {'class': 'btntoTop'});
        btnUp.appendTo('body');
        $(document).on('click', '.btntoTop', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 700);
        });

        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 200)
                $('.btntoTop').addClass('active');
            else
                $('.btntoTop').removeClass('active');
        });

        if ($('a').hasClass('custom-logo-link') && $('a.custom-logo-link img').attr('src') != '') {
            $('h1.site-title').css({'display': 'none'});
        }
        else {
            $('h1.site-title').css({'display': 'block'});
        }

        /*-- Window scroll function --*/
        $(window).on('scroll', function () {

            /* sticky header */
            var sticky = $('header'),
                scroll = $(window).scrollTop();
            var scroll_top_num = 90;
            if ($('body').hasClass('admin-bar')) {

                scroll_top_num = scroll_top_num + 32;
            }

            if (scroll >= 90) {
                sticky.addClass('fixed');
                $('#logo-alt').css({'display': 'block'});
                $('a.custom-logo-link').css({'display': 'none'});
                $(window).trigger('resize.px.parallax');
                if ($('a').hasClass('logo-alt') && $('#logo-alt img').attr('src') != '') {
                    $('h1.site-title').css({'display': 'none'});
                }
                else {
                    $('h1.site-title').css({'display': 'block'});
                }
            }
            else {
                sticky.removeClass('fixed');
                $('#logo-alt').css({'display': 'none'});
                $('a.custom-logo-link').css({'display': 'block'});
                $(window).trigger('resize.px.parallax');
                if ($('a').hasClass('custom-logo-link') && $('a.custom-logo-link img').attr('src') != '') {
                    $('h1.site-title').css({'display': 'none'});
                }
                else {
                    $('h1.site-title').css({'display': 'block'});
                }
            }

        });
    });

    /**
     * particle js
     *
     * @since 1.1.0
     */
    particlesJS("particles-js", {
    "particles": {
    "number": {
      "value": 100,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 2,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 140,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
})(this.jQuery);