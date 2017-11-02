jQuery(document).ready( function( $ ) {


    //¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯
    //  Wow.js Init
    //__________________________________________________________________________
    
    function delayedWow() {
        wowTimeoutID = window.setTimeout( callWow, 200);
    }

    function callWow() {
        $('div#mobile-menu-wrap nav#menu').fadeIn();
        smartcat_animate = new WOW({
            boxClass        :   'smartcat-animate',
            
        });
        smartcat_animate.init();
        clearWowTimeout();
    }

    function clearWowTimeout() {
        window.clearTimeout(wowTimeoutID);
    }
    
    delayedWow();

    //¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯
    //  Mobile Menu - bigSlide.js
    //__________________________________________________________________________

    $( '#mobile-menu-trigger, #mobile-menu-close, #mobile-overlay' ).bigSlide({
        menu: ( '#mobile-menu-wrap' ),
        side: 'left',
        afterOpen: function() {
            $('#mobile-overlay').fadeIn();
            $('#mobile-menu-close').fadeIn();
        },
        beforeClose: function() {
            $('#mobile-menu-close').fadeOut();
            $('#mobile-overlay').fadeOut();
        }
    });

    //¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯
    //  Camera Slider
    //__________________________________________________________________________

    if ( $('#ares_slider_wrap').length > 0 ) {

        $('#ares_slider_wrap').camera({
            height: aresSlider.desktop_height + '%',
            pagination: ( aresSlider.pagination == 'on' ) ? true : false,
            navigation: ( aresSlider.navigation == 'on' ) ? true : false,
            fx: aresSlider.animation.toString(),
            time: parseInt(aresSlider.slide_timer),
            transPeriod: parseInt(aresSlider.animation_speed),
            hover: ( aresSlider.hover == 'on' ) ? true : false,
            thumbnails: false,
            overlayer: true,
            playPause : false,
            loader: 'pie',
        });

    }

    //¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯
    //  Mobile Menu Collapse/Expand
    //__________________________________________________________________________

    $( 'div#mobile-menu-wrap ul#mobile-menu > li.menu-item-has-children' ).prepend( '<div class="submenu-button-wrap"><span class="fa fa-plus"></span></div>' );

    $( 'div#mobile-menu-wrap ul#mobile-menu > li.menu-item-has-children span' ).on( 'click', function() {
        $(this).parent().stop().toggleClass('submenu-rotated').find('span').toggleClass('fa-plus fa-minus');
        $(this).parent().parent().find( '> ul.sub-menu' ).stop().slideToggle( 400 );
    });

    //¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯
    //  Match CTA Heights
    //__________________________________________________________________________

    matchColHeights('.site-cta');
    function matchColHeights(selector) {
        var maxHeight = 0;
        $(selector).each(function() {
            var height = $(this).height();
            if (height > maxHeight) {
                maxHeight = height;
            }
        });
        $(selector).height(maxHeight);
    }

    //¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯
    //  Scroll to Top Button
    //__________________________________________________________________________

    $('.scroll-top').click(function() {
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });

});
