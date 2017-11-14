jQuery(document).ready(function () {

    jQuery("html").niceScroll({
        cursorwidth: "6px",
        cursorborder: "0",
        railpadding: {right: 2},
        zindex: 999999
    });

    // Toggle Menu
    jQuery('.dt-menu-trigger').on('click', function () {
        jQuery('.dt-main-menu').toggleClass('dt-main-menu-open');
        //jQuery(this).find( '.fa' ).toggleClass( 'fa-bars fa-close' );
    });

    jQuery(document).on('click', function (e) {
        if (jQuery(e.target).closest('.dt-menu-trigger, .dt-main-menu-open').length === 0) {
            jQuery('.dt-main-menu').removeClass('dt-main-menu-open');
            //jQuery(this).find( '.fa' ).toggleClass( 'fa-close fa-bars' );
        }
    });

    // Initialize post slider
    var dt_banner_slider = new Swiper('.dt-image-slider', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: 3000,
        speed: 800,
        threshold: 20,
        effect: 'fade'
    });

    // Back to Top
    if (jQuery('#back-to-top').length) {
        var scrollTrigger = 500, // px
            backToTop = function () {
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    jQuery('#back-to-top').addClass('show');
                } else {
                    jQuery('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        jQuery(window).on('scroll', function () {
            backToTop();
        });
        jQuery('#back-to-top').on('click', function (e) {
            e.preventDefault();
            jQuery('html,body').animate({
                scrollTop: 0
            }, 600);
        });
    }

    // Colorbox Lightbox
    //Settings for lightbox
    var cbSettings = {
        rel: 'gallery',
        width: '80%',
        height: 'auto',
        maxWidth: '1000',
        maxHeight: 'auto',
        scrolling: 'false',
        title: function () {
            return jQuery(this).find('img').attr('alt');
        }
    }

    //Initialize jQuery Colorbox
    jQuery('.gallery a[href$=".jpg"], .gallery a[href$=".jpeg"], .gallery a[href$=".png"], .gallery a[href$=".gif"]').colorbox(cbSettings);

    // Keep lightbox responsive on screen resize
    jQuery(window).on('resize', function () {
        jQuery.colorbox.resize({
            width: window.innerWidth > parseInt(cbSettings.maxWidth) ? cbSettings.maxWidth : cbSettings.width
        });
    });

});
