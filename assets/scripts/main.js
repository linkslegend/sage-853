/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {

        $(document).ready(function () {
        const observer = lozad('.lozad', {
              loaded: function(el) {
            // Custom implementation on a loaded element
              el.classList.add('loaded');
            }
          }); // lazy loads elements with default selector as '.lozad'
        observer.observe();
      });

        $('#menu-menu-2 .dropdown-menu').on({
        	"click":function(e){
              e.stopPropagation();
            }
        });

        $(".hamburger").click(function(){
            $(this).toggleClass("is-active");
        });

        $('.yamm .dropdown').hover(function() {
              $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
            }, function() {
              $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105);
        });

        //Alert & Cookies
        $('#cookie-message-close').click(function(){
            $('#myAlert').addClass("slide-out");
            Cookies.set('cookie-message-bar', true, { expires: 7 });
        });
        if (Cookies.get("cookie-message-bar"))
        {
          $('#myAlert').css({"visibility":"hidden", "z-index":"-1"});
        }
        else{
          $('#myAlert').css({"visibility":"visible", "z-index":"3"});
        }

        $('body').popover({
          selector: '[data-popover]',
          trigger: 'hover focus',
          html: true,
          placement: 'bottom',
          delay: {show: 50, hide: 50}
        });

        jQuery(function($){
          if ( $('#owl-blog-posts').length > 0 ) {
            var slider1 = tns({
              container: '#owl-blog-posts',
              items: 1,
              controlsText: ['zurück', 'weiter'],
              slideBy: 'page',
              mouseDrag: true,
              gutter: 10,
              lazyload: true,
              disable: false,
              autoplay: false,
              responsive: {
                300: {
                    items: 1,
                    disable: true
                },
                700: {
                    items: 2,
                    disable: false
                },
                900: {
                    items: 3,
                    disable: false
                }
              }
            });
          }

          if ( $('#owl-blog-posts-2').length > 0 ) {
            var slider5 = tns({
              container: '#owl-blog-posts-2',
              items: 1,
              controlsText: ['zurück', 'weiter'],
              slideBy: 'page',
              mouseDrag: true,
              gutter: 10,
              lazyload: true,
              disable: false,
              autoplay: false,
              responsive: {
                300: {
                    items: 1,
                    disable: true
                },
                700: {
                    items: 2,
                    disable: false
                },
                900: {
                    items: 2,
                    disable: false
                }
              }
            });
          }

          if ( $('#owl-youtube').length > 0 ) {
            var slider2 = tns({
              container: '#owl-youtube',
              items: 1,
              controlsText: ['zurück', 'weiter'],
              slideBy: 'page',
              mouseDrag: true,
              gutter: 10,
              lazyload: true,
              autoplay: false,
              disable: false,
              responsive: {
                300: {
                    items: 1,
                    disable: true
                },
                700: {
                    items: 2,
                    disable: false
                },
                900: {
                    items: 3,
                    disable: false
                }
              }
            });
          }

          if ( $('#owl-messen').length > 0 ) {
            var slider3 = tns({
              container: '#owl-messen',
              controlsText: ['zurück', 'weiter'],
              items: 1,
              slideBy: 'page',
              mouseDrag: true,
              gutter: 10,
              lazyload: true,
              autoplay: false,
              disable: false,
              responsive: {
                300: {
                    items: 1,
                    disable: true
                },
                700: {
                    items: 2,
                    disable: false
                },
                900: {
                    items: 3,
                    disable: false
                }
              }
            });
          }

          if ($('#owl-product-posts').length > 0 ) {
            var slider4 = tns({
              container: '#owl-product-posts',
              controlsText: ['zurück', 'weiter'],
              items: 1,
              slideBy: 'page',
              mouseDrag: true,
              gutter: 10,
              lazyload: true,
              autoplay: false,
              disable: false,
              responsive: {
                300: {
                    items: 1,
                    disable: true
                },
                600: {
                    items: 2,
                    disable: false
                },
                900: {
                    items: 3,
                    disable: false
                }
              },
            });
          }
          
        });

        jQuery(function($){
            //  SEE-ALSO BANNERS
            //  on-hover changing
            jQuery('.see-also').hover( function() { // hover

                jQuery(this).find('img').stop().clearQueue().delay(0);
                jQuery(this).addClass('hover');
                jQuery(this).find('img').animate(
                    { right:-$(this).innerWidth() },
                    300,  // speed
                    ''
                );

            }, function() { // hover-out

                jQuery(this).find('img').stop().clearQueue().delay(0);
                jQuery(this).find('img').animate(
                    { right:0 },
                    300, // speed
                    '',
                    function() {
                        jQuery(this).parent().parent().removeClass('hover');
                    }
                );

            }); // see-also hover end
        });

        /*Lazy Load Youtube*/
        ( function() {
        	var youtube = document.querySelectorAll( ".youtube" );
        	for (var i = 0; i < youtube.length; i++) {
        		/*var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/sddefault.jpg";
        		var image = new Image();
        				image.src = source;
        /*jshint loopfunc:true */
        /*image.addEventListener( "load", (function() {
        					youtube[ i ].appendChild( image );
        				}( i )) );*/
        /*jshint loopfunc:true */
        youtube[i].addEventListener( "click", function() {
        					var iframe = document.createElement( "iframe" );
        							iframe.setAttribute( "frameborder", "0" );
        							iframe.setAttribute( "allowfullscreen", "" );
        							iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );
        							this.innerHTML = "";
        							this.appendChild( iframe );
        				} );
        	}
        } )();

        $(".keyword-list a").click(function(e){
           e.preventDefault();
           slideIndex = $(this).index();
           $( '.single-featured2' ).slick('slickGoTo', parseInt(slideIndex) );
        });

        $(document).ready(function () {
          var trigger = $('.hamburger'),
              overlay = $('.overlay'),
             isClosed = false;

            function hamburger_cross() {

              if (isClosed === true) {
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
              } else {
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
              }
          }

            trigger.click(function () {
              hamburger_cross();
            });

        $('[data-toggle="offcanvas"]').click(function () {
             $('#wrapper').toggleClass('toggled');
          });


        });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.