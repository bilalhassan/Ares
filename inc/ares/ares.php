<?php

/**
 * Enqueue scripts and styles.
 */
function ares_scripts() {

    wp_enqueue_style( 'ares-style', get_stylesheet_uri() );

    // Load Fonts from array
    $fonts = ares_fonts();
    $ares_options = ares_get_options();
    
    // Primary Font Enqueue
    if( array_key_exists ( $ares_options['ares_font_family'], $fonts ) ) :
        wp_enqueue_style('google-font-primary', '//fonts.googleapis.com/css?family=' . esc_attr( $fonts[ $ares_options['ares_font_family'] ] ), array(), ARES_VERSION );
    endif;

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css', array(), ARES_VERSION );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/inc/css/animate.css', array(), ARES_VERSION );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css', array(), ARES_VERSION );
    wp_enqueue_style( 'camera', get_template_directory_uri() . '/inc/css/camera.css', array(), ARES_VERSION );
    wp_enqueue_style( 'ares-old-style', get_template_directory_uri() . '/inc/css/old_ares.css', array(), ARES_VERSION );
    wp_enqueue_style( 'ares-main-style', get_template_directory_uri() . '/inc/css/ares.css', array(), ARES_VERSION );
    wp_enqueue_style( 'ares-color-skin', get_template_directory_uri() . '/inc/css/temps/aqua.css', array(), ARES_VERSION );

    wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/inc/js/jquery.easing.1.3.js', array('jquery'), ARES_VERSION, true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/inc/js/bootstrap.min.js', array('jquery'), ARES_VERSION, true );
    wp_enqueue_script( 'bigSlide', get_template_directory_uri() . '/inc/js/bigSlide.min.js', array('jquery'), ARES_VERSION, true );
    wp_enqueue_script( 'camera-js', get_template_directory_uri() . '/inc/js/camera.min.js', array('jquery'), ARES_VERSION, true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/inc/js/wow.min.js', array('jquery'), ARES_VERSION, true );
    wp_enqueue_script( 'ares-main-script', get_template_directory_uri() . '/inc/js/ares.js', array('jquery', 'jquery-masonry'), ARES_VERSION, true );

    wp_enqueue_script( 'ares-navigation', get_template_directory_uri() . '/js/navigation.js', array(), ARES_VERSION, true );
    wp_enqueue_script( 'ares-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), ARES_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'ares_scripts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ares_widgets_init() {

    $ares_options = ares_get_options();
    
    register_sidebar(array(
        'name' => __('Header Right (Toolbar)', 'ares'),
        'id' => 'sidebar-header-right',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="hidden">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Homepage Full-width Widget', 'ares'),
        'id' => 'sidebar-banner',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s smartcat-animate fadeIn">',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Homepage Half-width Widget', 'ares'),
        'id' => 'sidebar-homepage-widget',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s col-sm-6 smartcat-animate fadeIn">',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Sidebar', 'ares'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2><div class="avenue-underline"></div>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer', 'ares'),
        'id' => 'sidebar-footer',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="' . esc_attr( $ares_options['ares_footer_columns'] ) . ' widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2><div class="avenue-underline"></div>',
    ));
        
}
add_action( 'widgets_init', 'ares_widgets_init' );

/**
 * Hex to rgb(a) converter function.
 */
function ares_hex2rgba( $color, $opacity = false ) {

    $default = 'rgb(0,0,0)';

    // Return default if no color provided
    if ( empty( $color ) ) { return $default; }

    // Sanitize $color if "#" is provided
    if ( $color[0] == '#' ) { $color = substr( $color, 1 ); }

    // Check if color has 6 or 3 characters and get values
    if ( strlen( $color ) == 6 ) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    // Convert hexadec to rgb
    $rgb =  array_map( 'hexdec', $hex );

    // Check if opacity is set(rgba or rgb)
    if( $opacity ) {

        if( abs( $opacity ) > 1 ) { $opacity = 1.0; }
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';

    } else {

        $output = 'rgb('.implode(",",$rgb).')';

    }

    // Return rgb(a) color string
    return $output;

}

/**
 * Inject dynamic CSS rules with wp_head.
 */
function ares_custom_css() { 

    $ares_options = ares_get_options(); ?>

    <style>

        body {
            font-family: <?php echo esc_attr( $ares_options['ares_font_family'] ); ?>;
        }

        /*
        
        #site-toolbar .social-bar a:hover {
            background-color: <?php echo esc_attr( $ares_options['ares_theme_color'] ); ?>;
            border-color: <?php echo esc_attr( $ares_options['ares_theme_color'] ); ?>;
        }

        #site-branding .site-title a,
        #site-navigation.main-navigation li a:hover {
            color: <?php echo esc_attr( $ares_options['ares_theme_color'] ); ?>;
        }

        */
        
        /*
        ----- Header Heights ---------------------------------------------------------
        */

        @media (min-width:992px) {
            #site-branding {
               height: <?php echo intval( $ares_options['ares_branding_bar_height'] ); ?>px;
            }
            #site-branding img {
               max-height: <?php echo intval( $ares_options['ares_branding_bar_height'] ); ?>px;
            }
        }

        div#content {
            margin-top: <?php echo esc_attr( $ares_options['ares_branding_bar_height'] + ( $ares_options['ares_headerbar_bool'] == 'show' ? 40 : 0 ) ); ?>px;
        }

        <?php if ( $ares_options['ares_headerbar_bool'] != 'show' ) : ?>
        
            div#content {
                margin-top: 80px !important;
            }
            
        <?php endif; ?>
        
    </style>

<?php }
add_action( 'wp_head', 'ares_custom_css' );

/**
 * Returns all posts as an array.
 * Pass true to include Pages.
 *
 * @param boolean $include_pages
 * @return array of posts
 */
function ares_all_posts_array( $include_pages = false ) {

    $posts = get_posts( array(
        'post_type'        => $include_pages ? array( 'post', 'page' ) : 'post',
        'posts_per_page'   => -1,
        'post_status'      => 'publish',
        'orderby'          => 'title',
        'order'            => 'ASC',
    ));

    $posts_array = array(
        'none'  => __( 'None', 'ares' ),
    );

    foreach ( $posts as $post ) :

        if ( ! empty( $post->ID ) ) :
            $posts_array[ $post->ID ] = $post->post_title;
        endif;

    endforeach;

    return $posts_array;

}

/**
 * Render the toolbar in the header.
 */
function ares_render_toolbar() {

    $ares_options = ares_get_options(); ?>
    
    <div id="site-toolbar">

        <div class="container">

            <div class="row">

                <div class="col-xs-<?php echo is_active_sidebar( 'sidebar-header-right' ) ? '6' : '12'; ?> social-bar">

                    <?php if ( $ares_options['ares_facebook_url'] ) : ?>
                        <a href="<?php echo esc_url( $ares_options['ares_facebook_url'] ); ?>" target="_blank" class="icon-facebook animated fadeInDown">
                            <i class="fa fa-facebook"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( $ares_options['ares_twitter_url'] ) : ?>
                    <a href="<?php echo esc_url( $ares_options['ares_twitter_url'] ); ?>" target="_blank" class="icon-twitter animated fadeInDown">
                            <i class="fa fa-twitter"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( $ares_options['ares_linkedin_url'] ) : ?>
                        <a href="<?php echo esc_url( $ares_options['ares_linkedin_url'] ); ?>" target="_blank" class="icon-linkedin animated fadeInDown">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( $ares_options['ares_gplus_url'] ) : ?>
                        <a href="<?php echo esc_url( $ares_options['ares_gplus_url'] ); ?>" target="_blank" class="icon-gplus animated fadeInDown">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( $ares_options['ares_instagram_url'] ) : ?>
                        <a href="<?php echo esc_url( $ares_options['ares_instagram_url'] ); ?>" target="_blank" class="icon-instagram animated fadeInDown">
                            <i class="fa fa-instagram"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( $ares_options['ares_youtube_url'] ) : ?>
                        <a href="<?php echo esc_url( $ares_options['ares_youtube_url'] ); ?>" target="_blank" class="icon-youtube animated fadeInDown">
                            <i class="fa fa-youtube"></i>
                        </a>
                    <?php endif; ?>

                </div>

                <?php if ( is_active_sidebar( 'sidebar-header-right' ) ) : ?>

                    <div class="col-xs-6 contact-bar">

                        <?php dynamic_sidebar( 'sidebar-header-right' ); ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

<?php }
add_action( 'ares_toolbar', 'ares_render_toolbar' );

/**
 * Render the slider on the frontpage.
 */
function ares_render_slider() {

$ares_options = ares_get_options(); ?>
    
<?php if ( $ares_options['ares_slide1_image'] || $ares_options['ares_slide2_image'] || $ares_options['ares_slide3_image'] ) : ?>

    <div class="sc-slider-wrapper">

        <div class="fluid_container">

            <div class="camera_wrap" id="ares_slider_wrap">

                <?php if ( $ares_options['ares_slide1_image'] ) : ?>

                    <div data-thumb="<?php echo esc_attr( $ares_options['ares_slide1_image'] ); ?>" data-src="<?php echo esc_attr( $ares_options['ares_slide1_image'] ); ?>">

                        <div class="camera_caption fadeFromBottom">
                            <span>
                                <?php echo esc_attr( $ares_options['ares_slide1_text'] ); ?>
                            </span>
                        </div>

                    </div>

                <?php endif; ?>

                <?php if ( $ares_options['ares_slide2_image'] ) : ?>

                    <div data-thumb="<?php echo esc_attr( $ares_options['ares_slide2_image'] ); ?>" data-src="<?php echo esc_attr( $ares_options['ares_slide2_image'] ); ?>">

                        <div class="camera_caption fadeFromBottom">
                            <span>
                                <?php echo esc_attr( $ares_options['ares_slide2_text'] ); ?>
                            </span>
                        </div>

                    </div>

                <?php endif; ?>

                <?php if ( $ares_options['ares_slide3_image'] ) : ?>

                    <div data-thumb="<?php echo esc_attr( $ares_options['ares_slide3_image'] ); ?>" data-src="<?php echo esc_attr( $ares_options['ares_slide3_image'] ); ?>">

                        <div class="camera_caption fadeFromBottom">
                            <span>
                                <?php echo esc_attr( $ares_options['ares_slide3_text'] ); ?>
                            </span>
                        </div>

                    </div>

                <?php endif; ?>

            </div><!-- #camera_wrap_1 -->

    </div>

    </div>

    <?php endif; ?>

<?php }
add_action( 'ares_slider', 'ares_render_slider' );

/**
 * Returns all available fonts as an array
 *
 * @return array of fonts
 */
if( !function_exists( 'ares_fonts' ) ) {

    function ares_fonts() {

        $font_family_array = array(
            'Abel, sans-serif'                                  => 'Abel',
            'Arvo, serif'                                       => 'Arvo:400,400i,700',
            'Bangers, cursive'                                  => 'Bangers',
            'Courgette, cursive'                                => 'Courgette',
            'Domine, serif'                                     => 'Domine',
            'Dosis, sans-serif'                                 => 'Dosis:200,300,400',
            'Droid Sans, sans-serif'                            => 'Droid+Sans:400,700',
            'Economica, sans-serif'                             => 'Economica:400,700',
            'Josefin Sans, sans-serif'                          => 'Josefin+Sans:300,400,600,700',
            'Itim, cursive'                                     => 'Itim',
            'Lato, sans-serif'                                  => 'Lato:100,300,400,700,900,300italic,400italic',
            'Lobster Two, cursive'                              => 'Lobster+Two',
            'Lora, serif'                                       => 'Lora',
            'Lilita One, cursive'                               => 'Lilita+One',
            'Montserrat, sans-serif'                            => 'Montserrat:400,700',
            'Noto Serif, serif'                                 => 'Noto+Serif',
            'Old Standard TT, serif'                            => 'Old+Standard+TT:400,400i,700',
            'Open Sans, sans-serif'                             => 'Open Sans',
            'Open Sans Condensed, sans-serif'                   => 'Open+Sans+Condensed:300,300i,700',
            'Orbitron, sans-serif'                              => 'Orbitron',
            'Oswald, sans-serif'                                => 'Oswald:300,400',
            'Poiret One, cursive'                               => 'Poiret+One',
            'PT Sans Narrow, sans-serif'                        => 'PT+Sans+Narrow',
            'Rajdhani, sans-serif'                              => 'Rajdhani:300,400,500,600',
            'Raleway, sans-serif'                               => 'Raleway:200,300,400,500,700',
            'Roboto, sans-serif'                                => 'Roboto:100,300,400,500',
            'Roboto Condensed, sans-serif'                      => 'Roboto+Condensed:400,300,700',
            'Shadows Into Light, cursive'                       => 'Shadows+Into+Light',
            'Shrikhand, cursive'                                => 'Shrikhand',
            'Source Sans Pro, sans-serif'                       => 'Source+Sans+Pro:200,400,600',
            'Teko, sans-serif'                                  => 'Teko:300,400,600',
            'Titillium Web, sans-serif'                         => 'Titillium+Web:400,200,300,600,700,200italic,300italic,400italic,600italic,700italic',
            'Trirong, serif'                                    => 'Trirong:400,700',
            'Ubuntu, sans-serif'                                => 'Ubuntu',
            'Vollkorn, serif'                                   => 'Vollkorn:400,400i,700',
            'Voltaire, sans-serif'                              => 'Voltaire',
        );

        return apply_filters( 'ares_fonts', $font_family_array );

    }

}

/**
 * Render the CTA Trio on the frontpage.
 */
function ares_render_cta_trio() {

    $ares_options = ares_get_options(); ?>
    
    <div id="site-cta-wrap">
    
        <div id="site-cta" class="container <?php echo $ares_options['ares_slider_bool'] == 'show' ? '' : 'no-slider'; ?>"><!-- #CTA boxes -->

            <div class="row">

                <div class="col-md-4 site-cta smartcat-animate fadeInUp">

                    <div class="icon-wrap center">
                        <a href="<?php echo esc_url( $ares_options['ares_cta1_url'] ) ?>">
                            <i class="<?php echo esc_attr( $ares_options['ares_cta1_icon'] ); ?> animated"></i>
                        </a>
                    </div>

                    <h3>
                        <?php echo esc_attr( $ares_options['ares_cta1_title'] ); ?>
                    </h3>

                    <p class="tagline">
                        <?php echo $ares_options['ares_cta1_text']; ?>
                    </p>

                    <p class="">
                        <a href="<?php echo esc_url( $ares_options['ares_cta1_url'] ) ?>">
                            <?php echo $ares_options['ares_cta1_button_text'];  ?>
                        </a>
                    </p>                                

                </div>

                <div class="col-md-4 site-cta smartcat-animate fadeInUp">

                    <div class="icon-wrap center">
                        <a href="<?php echo esc_url( $ares_options['ares_cta2_url'] ) ?>">
                            <i class="<?php echo esc_attr( $ares_options['ares_cta2_icon'] ); ?> animated"></i>
                        </a>
                    </div>

                    <h3>
                        <?php echo esc_attr( $ares_options['ares_cta2_title'] ); ?>
                    </h3>

                    <p class="tagline">
                        <?php echo $ares_options['ares_cta2_text']; ?>
                    </p>

                    <p class="">
                        <a href="<?php echo esc_url( $ares_options['ares_cta2_url'] ) ?>">
                            <?php echo $ares_options['ares_cta2_button_text'];  ?>
                        </a>
                    </p>                                

                </div>

                <div class="col-md-4 site-cta smartcat-animate fadeInUp">

                    <div class="icon-wrap center">
                        <a href="<?php echo esc_url( $ares_options['ares_cta3_url'] ) ?>">
                            <i class="<?php echo esc_attr( $ares_options['ares_cta3_icon'] ); ?> animated"></i>
                        </a>
                    </div>

                    <h3>
                        <?php echo esc_attr( $ares_options['ares_cta3_title'] ); ?>
                    </h3>

                    <p class="tagline">
                        <?php echo $ares_options['ares_cta3_text']; ?>
                    </p>

                    <p class="">
                        <a href="<?php echo esc_url( $ares_options['ares_cta3_url'] ) ?>">
                            <?php echo $ares_options['ares_cta3_button_text'];  ?>
                        </a>
                    </p>                                

                </div>

            </div>

        </div><!-- #CTA boxes -->
    
        <div class="clear"></div>
        
    </div>
    
<?php }
add_action( 'ares_cta_trio', 'ares_render_cta_trio' );


/**
 * Render the footer.
 */
function ares_render_footer() {
    
    $ares_options = ares_get_options(); ?>
    
    <i class="scroll-top fa fa-chevron-up"></i>
    
    <footer id="colophon" class="site-footer " role="contentinfo">
        
        <?php if( $ares_options['ares_footer_cta'] == 'show' ) : ?>
    
        <div id="footer-callout" class="container-fluid">
            
            <div class="row">
                
                <div class="col-sm-8 center">
                    <h3 class="smartcat-animate fadeInUp"><?php echo $ares_options['ares_footer_cta_text']; ?></h3>
                </div>
                
                <div class="col-sm-4 center">
                    <a class="button button-cta smartcat-animate fadeInUp" href="<?php echo $ares_options['ares_footer_button_url']; ?>">
                        <?php echo $ares_options['ares_footer_button_text']; ?>
                    </a>
                </div>
                
            </div>
            
        </div>
    
        <?php endif; ?>
        
        <div class="footer-boxes container">
            
            <div class="row ">
                
                <div class="col-md-12">
                    
                    <div id="secondary" class="widget-area" role="complementary">
                        <?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
                            <?php dynamic_sidebar( 'sidebar-footer' ); ?>
                        <?php endif; ?>
                        <div class="clear"></div>
                    </div>
                    
                </div>            
                
            </div>        
            
        </div>
        
        <div class="site-info">
            
            <div class="container">
            
                <div class="row ">

                    <div class="col-xs-6 text-left">
                        <?php echo $ares_options['ares_footer_text']; ?>
                    </div>

                    <div class="col-xs-6 text-right">

                        <a href="http://smartcatdesign.net/" rel="designer">
                            <img src="<?php echo get_template_directory_uri() . '/inc/images/cat_logo.png'?>" width="20px"/>
                            <?php _e('Design by SmartCat', 'ares'); ?>
                        </a>                     

                    </div>              
                    
                </div>
            
            </div>
            
        </div><!-- .site-info -->
        
    </footer><!-- #colophon -->
    
<?php }
add_action( 'ares_footer', 'ares_render_footer' );

function ares_icons() {

    return array( 'fa fa-clock' => __('Select One', 'zeal'), 'fa fa-500px' => __(' 500px', 'zeal'), 'fa fa-amazon' => __(' amazon', 'zeal'), 'fa fa-balance-scale' => __(' balance-scale', 'zeal'), 'fa fa-battery-0' => __(' battery-0', 'zeal'), 'fa fa-battery-1' => __(' battery-1', 'zeal'), 'fa fa-battery-2' => __(' battery-2', 'zeal'), 'fa fa-battery-3' => __(' battery-3', 'zeal'), 'fa fa-battery-4' => __(' battery-4', 'zeal'), 'fa fa-battery-empty' => __(' battery-empty', 'zeal'), 'fa fa-battery-full' => __(' battery-full', 'zeal'), 'fa fa-battery-half' => __(' battery-half', 'zeal'), 'fa fa-battery-quarter' => __(' battery-quarter', 'zeal'), 'fa fa-battery-three-quarters' => __(' battery-three-quarters', 'zeal'), 'fa fa-black-tie' => __(' black-tie', 'zeal'), 'fa fa-calendar-check-o' => __(' calendar-check-o', 'zeal'), 'fa fa-calendar-minus-o' => __(' calendar-minus-o', 'zeal'), 'fa fa-calendar-plus-o' => __(' calendar-plus-o', 'zeal'), 'fa fa-calendar-times-o' => __(' calendar-times-o', 'zeal'), 'fa fa-cc-diners-club' => __(' cc-diners-club', 'zeal'), 'fa fa-cc-jcb' => __(' cc-jcb', 'zeal'), 'fa fa-chrome' => __(' chrome', 'zeal'), 'fa fa-clone' => __(' clone', 'zeal'), 'fa fa-commenting' => __(' commenting', 'zeal'), 'fa fa-commenting-o' => __(' commenting-o', 'zeal'), 'fa fa-contao' => __(' contao', 'zeal'), 'fa fa-creative-commons' => __(' creative-commons', 'zeal'), 'fa fa-expeditedssl' => __(' expeditedssl', 'zeal'), 'fa fa-firefox' => __(' firefox', 'zeal'), 'fa fa-fonticons' => __(' fonticons', 'zeal'), 'fa fa-genderless' => __(' genderless', 'zeal'), 'fa fa-get-pocket' => __(' get-pocket', 'zeal'), 'fa fa-gg' => __(' gg', 'zeal'), 'fa fa-gg-circle' => __(' gg-circle', 'zeal'), 'fa fa-hand-grab-o' => __(' hand-grab-o', 'zeal'), 'fa fa-hand-lizard-o' => __(' hand-lizard-o', 'zeal'), 'fa fa-hand-paper-o' => __(' hand-paper-o', 'zeal'), 'fa fa-hand-peace-o' => __(' hand-peace-o', 'zeal'), 'fa fa-hand-pointer-o' => __(' hand-pointer-o', 'zeal'), 'fa fa-hand-rock-o' => __(' hand-rock-o', 'zeal'), 'fa fa-hand-scissors-o' => __(' hand-scissors-o', 'zeal'), 'fa fa-hand-spock-o' => __(' hand-spock-o', 'zeal'), 'fa fa-hand-stop-o' => __(' hand-stop-o', 'zeal'), 'fa fa-hourglass' => __(' hourglass', 'zeal'), 'fa fa-hourglass-1' => __(' hourglass-1', 'zeal'), 'fa fa-hourglass-2' => __(' hourglass-2', 'zeal'), 'fa fa-hourglass-3' => __(' hourglass-3', 'zeal'), 'fa fa-hourglass-end' => __(' hourglass-end', 'zeal'), 'fa fa-hourglass-half' => __(' hourglass-half', 'zeal'), 'fa fa-hourglass-o' => __(' hourglass-o', 'zeal'), 'fa fa-hourglass-start' => __(' hourglass-start', 'zeal'), 'fa fa-houzz' => __(' houzz', 'zeal'), 'fa fa-i-cursor' => __(' i-cursor', 'zeal'), 'fa fa-industry' => __(' industry', 'zeal'), 'fa fa-internet-explorer' => __(' internet-explorer', 'zeal'), 'fa fa-map' => __(' map', 'zeal'), 'fa fa-map-o' => __(' map-o', 'zeal'), 'fa fa-map-pin' => __(' map-pin', 'zeal'), 'fa fa-map-signs' => __(' map-signs', 'zeal'), 'fa fa-mouse-pointer' => __(' mouse-pointer', 'zeal'), 'fa fa-object-group' => __(' object-group', 'zeal'), 'fa fa-object-ungroup' => __(' object-ungroup', 'zeal'), 'fa fa-odnoklassniki' => __(' odnoklassniki', 'zeal'), 'fa fa-odnoklassniki-square' => __(' odnoklassniki-square', 'zeal'), 'fa fa-opencart' => __(' opencart', 'zeal'), 'fa fa-opera' => __(' opera', 'zeal'), 'fa fa-optin-monster' => __(' optin-monster', 'zeal'), 'fa fa-registered' => __(' registered', 'zeal'), 'fa fa-safari' => __(' safari', 'zeal'), 'fa fa-sticky-note' => __(' sticky-note', 'zeal'), 'fa fa-sticky-note-o' => __(' sticky-note-o', 'zeal'), 'fa fa-television' => __(' television', 'zeal'), 'fa fa-trademark' => __(' trademark', 'zeal'), 'fa fa-tripadvisor' => __(' tripadvisor', 'zeal'), 'fa fa-tv' => __(' tv', 'zeal'), 'fa fa-vimeo' => __(' vimeo', 'zeal'), 'fa fa-wikipedia-w' => __(' wikipedia-w', 'zeal'), 'fa fa-y-combinator' => __(' y-combinator', 'zeal'), 'fa fa-yc' => __(' yc', 'zeal'), 'fa fa-adjust' => __(' adjust', 'zeal'), 'fa fa-anchor' => __(' anchor', 'zeal'), 'fa fa-archive' => __(' archive', 'zeal'), 'fa fa-area-chart' => __(' area-chart', 'zeal'), 'fa fa-arrows' => __(' arrows', 'zeal'), 'fa fa-arrows-h' => __(' arrows-h', 'zeal'), 'fa fa-arrows-v' => __(' arrows-v', 'zeal'), 'fa fa-asterisk' => __(' asterisk', 'zeal'), 'fa fa-at' => __(' at', 'zeal'), 'fa fa-automobile' => __(' automobile', 'zeal'), 'fa fa-balance-scale' => __(' balance-scale', 'zeal'), 'fa fa-ban' => __(' ban', 'zeal'), 'fa fa-bank' => __(' bank', 'zeal'), 'fa fa-bar-chart' => __(' bar-chart', 'zeal'), 'fa fa-bar-chart-o' => __(' bar-chart-o', 'zeal'), 'fa fa-barcode' => __(' barcode', 'zeal'), 'fa fa-bars' => __(' bars', 'zeal'), 'fa fa-battery-0' => __(' battery-0', 'zeal'), 'fa fa-battery-1' => __(' battery-1', 'zeal'), 'fa fa-battery-2' => __(' battery-2', 'zeal'), 'fa fa-battery-3' => __(' battery-3', 'zeal'), 'fa fa-battery-4' => __(' battery-4', 'zeal'), 'fa fa-battery-empty' => __(' battery-empty', 'zeal'), 'fa fa-battery-full' => __(' battery-full', 'zeal'), 'fa fa-battery-half' => __(' battery-half', 'zeal'), 'fa fa-battery-quarter' => __(' battery-quarter', 'zeal'), 'fa fa-battery-three-quarters' => __(' battery-three-quarters', 'zeal'), 'fa fa-bed' => __(' bed', 'zeal'), 'fa fa-beer' => __(' beer', 'zeal'), 'fa fa-bell' => __(' bell', 'zeal'), 'fa fa-bell-o' => __(' bell-o', 'zeal'), 'fa fa-bell-slash' => __(' bell-slash', 'zeal'), 'fa fa-bell-slash-o' => __(' bell-slash-o', 'zeal'), 'fa fa-bicycle' => __(' bicycle', 'zeal'), 'fa fa-binoculars' => __(' binoculars', 'zeal'), 'fa fa-birthday-cake' => __(' birthday-cake', 'zeal'), 'fa fa-bolt' => __(' bolt', 'zeal'), 'fa fa-bomb' => __(' bomb', 'zeal'), 'fa fa-book' => __(' book', 'zeal'), 'fa fa-bookmark' => __(' bookmark', 'zeal'), 'fa fa-bookmark-o' => __(' bookmark-o', 'zeal'), 'fa fa-briefcase' => __(' briefcase', 'zeal'), 'fa fa-bug' => __(' bug', 'zeal'), 'fa fa-building' => __(' building', 'zeal'), 'fa fa-building-o' => __(' building-o', 'zeal'), 'fa fa-bullhorn' => __(' bullhorn', 'zeal'), 'fa fa-bullseye' => __(' bullseye', 'zeal'), 'fa fa-bus' => __(' bus', 'zeal'), 'fa fa-cab' => __(' cab', 'zeal'), 'fa fa-calculator' => __(' calculator', 'zeal'), 'fa fa-calendar' => __(' calendar', 'zeal'), 'fa fa-calendar-check-o' => __(' calendar-check-o', 'zeal'), 'fa fa-calendar-minus-o' => __(' calendar-minus-o', 'zeal'), 'fa fa-calendar-o' => __(' calendar-o', 'zeal'), 'fa fa-calendar-plus-o' => __(' calendar-plus-o', 'zeal'), 'fa fa-calendar-times-o' => __(' calendar-times-o', 'zeal'), 'fa fa-camera' => __(' camera', 'zeal'), 'fa fa-camera-retro' => __(' camera-retro', 'zeal'), 'fa fa-car' => __(' car', 'zeal'), 'fa fa-caret-square-o-down' => __(' caret-square-o-down', 'zeal'), 'fa fa-caret-square-o-left' => __(' caret-square-o-left', 'zeal'), 'fa fa-caret-square-o-right' => __(' caret-square-o-right', 'zeal'), 'fa fa-caret-square-o-up' => __(' caret-square-o-up', 'zeal'), 'fa fa-cart-arrow-down' => __(' cart-arrow-down', 'zeal'), 'fa fa-cart-plus' => __(' cart-plus', 'zeal'), 'fa fa-cc' => __(' cc', 'zeal'), 'fa fa-certificate' => __(' certificate', 'zeal'), 'fa fa-check' => __(' check', 'zeal'), 'fa fa-check-circle' => __(' check-circle', 'zeal'), 'fa fa-check-circle-o' => __(' check-circle-o', 'zeal'), 'fa fa-check-square' => __(' check-square', 'zeal'), 'fa fa-check-square-o' => __(' check-square-o', 'zeal'), 'fa fa-child' => __(' child', 'zeal'), 'fa fa-circle' => __(' circle', 'zeal'), 'fa fa-circle-o' => __(' circle-o', 'zeal'), 'fa fa-circle-o-notch' => __(' circle-o-notch', 'zeal'), 'fa fa-circle-thin' => __(' circle-thin', 'zeal'), 'fa fa-clock-o' => __(' clock-o', 'zeal'), 'fa fa-clone' => __(' clone', 'zeal'), 'fa fa-close' => __(' close', 'zeal'), 'fa fa-cloud' => __(' cloud', 'zeal'), 'fa fa-cloud-download' => __(' cloud-download', 'zeal'), 'fa fa-cloud-upload' => __(' cloud-upload', 'zeal'), 'fa fa-code' => __(' code', 'zeal'), 'fa fa-code-fork' => __(' code-fork', 'zeal'), 'fa fa-coffee' => __(' coffee', 'zeal'), 'fa fa-cog' => __(' cog', 'zeal'), 'fa fa-cogs' => __(' cogs', 'zeal'), 'fa fa-comment' => __(' comment', 'zeal'), 'fa fa-comment-o' => __(' comment-o', 'zeal'), 'fa fa-commenting' => __(' commenting', 'zeal'), 'fa fa-commenting-o' => __(' commenting-o', 'zeal'), 'fa fa-comments' => __(' comments', 'zeal'), 'fa fa-comments-o' => __(' comments-o', 'zeal'), 'fa fa-compass' => __(' compass', 'zeal'), 'fa fa-copyright' => __(' copyright', 'zeal'), 'fa fa-creative-commons' => __(' creative-commons', 'zeal'), 'fa fa-credit-card' => __(' credit-card', 'zeal'), 'fa fa-crop' => __(' crop', 'zeal'), 'fa fa-crosshairs' => __(' crosshairs', 'zeal'), 'fa fa-cube' => __(' cube', 'zeal'), 'fa fa-cubes' => __(' cubes', 'zeal'), 'fa fa-cutlery' => __(' cutlery', 'zeal'), 'fa fa-dashboard' => __(' dashboard', 'zeal'), 'fa fa-database' => __(' database', 'zeal'), 'fa fa-desktop' => __(' desktop', 'zeal'), 'fa fa-diamond' => __(' diamond', 'zeal'), 'fa fa-dot-circle-o' => __(' dot-circle-o', 'zeal'), 'fa fa-download' => __(' download', 'zeal'), 'fa fa-edit' => __(' edit', 'zeal'), 'fa fa-ellipsis-h' => __(' ellipsis-h', 'zeal'), 'fa fa-ellipsis-v' => __(' ellipsis-v', 'zeal'), 'fa fa-envelope' => __(' envelope', 'zeal'), 'fa fa-envelope-o' => __(' envelope-o', 'zeal'), 'fa fa-envelope-square' => __(' envelope-square', 'zeal'), 'fa fa-eraser' => __(' eraser', 'zeal'), 'fa fa-exchange' => __(' exchange', 'zeal'), 'fa fa-exclamation' => __(' exclamation', 'zeal'), 'fa fa-exclamation-circle' => __(' exclamation-circle', 'zeal'), 'fa fa-exclamation-triangle' => __(' exclamation-triangle', 'zeal'), 'fa fa-external-link' => __(' external-link', 'zeal'), 'fa fa-external-link-square' => __(' external-link-square', 'zeal'), 'fa fa-eye' => __(' eye', 'zeal'), 'fa fa-eye-slash' => __(' eye-slash', 'zeal'), 'fa fa-eyedropper' => __(' eyedropper', 'zeal'), 'fa fa-fax' => __(' fax', 'zeal'), 'fa fa-feed' => __(' feed', 'zeal'), 'fa fa-female' => __(' female', 'zeal'), 'fa fa-fighter-jet' => __(' fighter-jet', 'zeal'), 'fa fa-file-archive-o' => __(' file-archive-o', 'zeal'), 'fa fa-file-audio-o' => __(' file-audio-o', 'zeal'), 'fa fa-file-code-o' => __(' file-code-o', 'zeal'), 'fa fa-file-excel-o' => __(' file-excel-o', 'zeal'), 'fa fa-file-image-o' => __(' file-image-o', 'zeal'), 'fa fa-file-movie-o' => __(' file-movie-o', 'zeal'), 'fa fa-file-pdf-o' => __(' file-pdf-o', 'zeal'), 'fa fa-file-photo-o' => __(' file-photo-o', 'zeal'), 'fa fa-file-picture-o' => __(' file-picture-o', 'zeal'), 'fa fa-file-powerpoint-o' => __(' file-powerpoint-o', 'zeal'), 'fa fa-file-sound-o' => __(' file-sound-o', 'zeal'), 'fa fa-file-video-o' => __(' file-video-o', 'zeal'), 'fa fa-file-word-o' => __(' file-word-o', 'zeal'), 'fa fa-file-zip-o' => __(' file-zip-o', 'zeal'), 'fa fa-film' => __(' film', 'zeal'), 'fa fa-filter' => __(' filter', 'zeal'), 'fa fa-fire' => __(' fire', 'zeal'), 'fa fa-fire-extinguisher' => __(' fire-extinguisher', 'zeal'), 'fa fa-flag' => __(' flag', 'zeal'), 'fa fa-flag-checkered' => __(' flag-checkered', 'zeal'), 'fa fa-flag-o' => __(' flag-o', 'zeal'), 'fa fa-flash' => __(' flash', 'zeal'), 'fa fa-flask' => __(' flask', 'zeal'), 'fa fa-folder' => __(' folder', 'zeal'), 'fa fa-folder-o' => __(' folder-o', 'zeal'), 'fa fa-folder-open' => __(' folder-open', 'zeal'), 'fa fa-folder-open-o' => __(' folder-open-o', 'zeal'), 'fa fa-frown-o' => __(' frown-o', 'zeal'), 'fa fa-futbol-o' => __(' futbol-o', 'zeal'), 'fa fa-gamepad' => __(' gamepad', 'zeal'), 'fa fa-gavel' => __(' gavel', 'zeal'), 'fa fa-gear' => __(' gear', 'zeal'), 'fa fa-gears' => __(' gears', 'zeal'), 'fa fa-gift' => __(' gift', 'zeal'), 'fa fa-glass' => __(' glass', 'zeal'), 'fa fa-globe' => __(' globe', 'zeal'), 'fa fa-graduation-cap' => __(' graduation-cap', 'zeal'), 'fa fa-group' => __(' group', 'zeal'), 'fa fa-hand-grab-o' => __(' hand-grab-o', 'zeal'), 'fa fa-hand-lizard-o' => __(' hand-lizard-o', 'zeal'), 'fa fa-hand-paper-o' => __(' hand-paper-o', 'zeal'), 'fa fa-hand-peace-o' => __(' hand-peace-o', 'zeal'), 'fa fa-hand-pointer-o' => __(' hand-pointer-o', 'zeal'), 'fa fa-hand-rock-o' => __(' hand-rock-o', 'zeal'), 'fa fa-hand-scissors-o' => __(' hand-scissors-o', 'zeal'), 'fa fa-hand-spock-o' => __(' hand-spock-o', 'zeal'), 'fa fa-hand-stop-o' => __(' hand-stop-o', 'zeal'), 'fa fa-hdd-o' => __(' hdd-o', 'zeal'), 'fa fa-headphones' => __(' headphones', 'zeal'), 'fa fa-heart' => __(' heart', 'zeal'), 'fa fa-heart-o' => __(' heart-o', 'zeal'), 'fa fa-heartbeat' => __(' heartbeat', 'zeal'), 'fa fa-history' => __(' history', 'zeal'), 'fa fa-home' => __(' home', 'zeal'), 'fa fa-hotel' => __(' hotel', 'zeal'), 'fa fa-hourglass' => __(' hourglass', 'zeal'), 'fa fa-hourglass-1' => __(' hourglass-1', 'zeal'), 'fa fa-hourglass-2' => __(' hourglass-2', 'zeal'), 'fa fa-hourglass-3' => __(' hourglass-3', 'zeal'), 'fa fa-hourglass-end' => __(' hourglass-end', 'zeal'), 'fa fa-hourglass-half' => __(' hourglass-half', 'zeal'), 'fa fa-hourglass-o' => __(' hourglass-o', 'zeal'), 'fa fa-hourglass-start' => __(' hourglass-start', 'zeal'), 'fa fa-i-cursor' => __(' i-cursor', 'zeal'), 'fa fa-image' => __(' image', 'zeal'), 'fa fa-inbox' => __(' inbox', 'zeal'), 'fa fa-industry' => __(' industry', 'zeal'), 'fa fa-info' => __(' info', 'zeal'), 'fa fa-info-circle' => __(' info-circle', 'zeal'), 'fa fa-institution' => __(' institution', 'zeal'), 'fa fa-key' => __(' key', 'zeal'), 'fa fa-keyboard-o' => __(' keyboard-o', 'zeal'), 'fa fa-language' => __(' language', 'zeal'), 'fa fa-laptop' => __(' laptop', 'zeal'), 'fa fa-leaf' => __(' leaf', 'zeal'), 'fa fa-legal' => __(' legal', 'zeal'), 'fa fa-lemon-o' => __(' lemon-o', 'zeal'), 'fa fa-level-down' => __(' level-down', 'zeal'), 'fa fa-level-up' => __(' level-up', 'zeal'), 'fa fa-life-bouy' => __(' life-bouy', 'zeal'), 'fa fa-life-buoy' => __(' life-buoy', 'zeal'), 'fa fa-life-ring' => __(' life-ring', 'zeal'), 'fa fa-life-saver' => __(' life-saver', 'zeal'), 'fa fa-lightbulb-o' => __(' lightbulb-o', 'zeal'), 'fa fa-line-chart' => __(' line-chart', 'zeal'), 'fa fa-location-arrow' => __(' location-arrow', 'zeal'), 'fa fa-lock' => __(' lock', 'zeal'), 'fa fa-magic' => __(' magic', 'zeal'), 'fa fa-magnet' => __(' magnet', 'zeal'), 'fa fa-mail-forward' => __(' mail-forward', 'zeal'), 'fa fa-mail-reply' => __(' mail-reply', 'zeal'), 'fa fa-mail-reply-all' => __(' mail-reply-all', 'zeal'), 'fa fa-male' => __(' male', 'zeal'), 'fa fa-map' => __(' map', 'zeal'), 'fa fa-map-marker' => __(' map-marker', 'zeal'), 'fa fa-map-o' => __(' map-o', 'zeal'), 'fa fa-map-pin' => __(' map-pin', 'zeal'), 'fa fa-map-signs' => __(' map-signs', 'zeal'), 'fa fa-meh-o' => __(' meh-o', 'zeal'), 'fa fa-microphone' => __(' microphone', 'zeal'), 'fa fa-microphone-slash' => __(' microphone-slash', 'zeal'), 'fa fa-minus' => __(' minus', 'zeal'), 'fa fa-minus-circle' => __(' minus-circle', 'zeal'), 'fa fa-minus-square' => __(' minus-square', 'zeal'), 'fa fa-minus-square-o' => __(' minus-square-o', 'zeal'), 'fa fa-mobile' => __(' mobile', 'zeal'), 'fa fa-mobile-phone' => __(' mobile-phone', 'zeal'), 'fa fa-money' => __(' money', 'zeal'), 'fa fa-moon-o' => __(' moon-o', 'zeal'), 'fa fa-mortar-board' => __(' mortar-board', 'zeal'), 'fa fa-motorcycle' => __(' motorcycle', 'zeal'), 'fa fa-mouse-pointer' => __(' mouse-pointer', 'zeal'), 'fa fa-music' => __(' music', 'zeal'), 'fa fa-navicon' => __(' navicon', 'zeal'), 'fa fa-newspaper-o' => __(' newspaper-o', 'zeal'), 'fa fa-object-group' => __(' object-group', 'zeal'), 'fa fa-object-ungroup' => __(' object-ungroup', 'zeal'), 'fa fa-paint-brush' => __(' paint-brush', 'zeal'), 'fa fa-paper-plane' => __(' paper-plane', 'zeal'), 'fa fa-paper-plane-o' => __(' paper-plane-o', 'zeal'), 'fa fa-paw' => __(' paw', 'zeal'), 'fa fa-pencil' => __(' pencil', 'zeal'), 'fa fa-pencil-square' => __(' pencil-square', 'zeal'), 'fa fa-pencil-square-o' => __(' pencil-square-o', 'zeal'), 'fa fa-phone' => __(' phone', 'zeal'), 'fa fa-phone-square' => __(' phone-square', 'zeal'), 'fa fa-photo' => __(' photo', 'zeal'), 'fa fa-picture-o' => __(' picture-o', 'zeal'), 'fa fa-pie-chart' => __(' pie-chart', 'zeal'), 'fa fa-plane' => __(' plane', 'zeal'), 'fa fa-plug' => __(' plug', 'zeal'), 'fa fa-plus' => __(' plus', 'zeal'), 'fa fa-plus-circle' => __(' plus-circle', 'zeal'), 'fa fa-plus-square' => __(' plus-square', 'zeal'), 'fa fa-plus-square-o' => __(' plus-square-o', 'zeal'), 'fa fa-power-off' => __(' power-off', 'zeal'), 'fa fa-print' => __(' print', 'zeal'), 'fa fa-puzzle-piece' => __(' puzzle-piece', 'zeal'), 'fa fa-qrcode' => __(' qrcode', 'zeal'), 'fa fa-question' => __(' question', 'zeal'), 'fa fa-question-circle' => __(' question-circle', 'zeal'), 'fa fa-quote-left' => __(' quote-left', 'zeal'), 'fa fa-quote-right' => __(' quote-right', 'zeal'), 'fa fa-random' => __(' random', 'zeal'), 'fa fa-recycle' => __(' recycle', 'zeal'), 'fa fa-refresh' => __(' refresh', 'zeal'), 'fa fa-registered' => __(' registered', 'zeal'), 'fa fa-remove' => __(' remove', 'zeal'), 'fa fa-reorder' => __(' reorder', 'zeal'), 'fa fa-reply' => __(' reply', 'zeal'), 'fa fa-reply-all' => __(' reply-all', 'zeal'), 'fa fa-retweet' => __(' retweet', 'zeal'), 'fa fa-road' => __(' road', 'zeal'), 'fa fa-rocket' => __(' rocket', 'zeal'), 'fa fa-rss' => __(' rss', 'zeal'), 'fa fa-rss-square' => __(' rss-square', 'zeal'), 'fa fa-search' => __(' search', 'zeal'), 'fa fa-search-minus' => __(' search-minus', 'zeal'), 'fa fa-search-plus' => __(' search-plus', 'zeal'), 'fa fa-send' => __(' send', 'zeal'), 'fa fa-send-o' => __(' send-o', 'zeal'), 'fa fa-server' => __(' server', 'zeal'), 'fa fa-share' => __(' share', 'zeal'), 'fa fa-share-alt' => __(' share-alt', 'zeal'), 'fa fa-share-alt-square' => __(' share-alt-square', 'zeal'), 'fa fa-share-square' => __(' share-square', 'zeal'), 'fa fa-share-square-o' => __(' share-square-o', 'zeal'), 'fa fa-shield' => __(' shield', 'zeal'), 'fa fa-ship' => __(' ship', 'zeal'), 'fa fa-shopping-cart' => __(' shopping-cart', 'zeal'), 'fa fa-sign-in' => __(' sign-in', 'zeal'), 'fa fa-sign-out' => __(' sign-out', 'zeal'), 'fa fa-signal' => __(' signal', 'zeal'), 'fa fa-sitemap' => __(' sitemap', 'zeal'), 'fa fa-sliders' => __(' sliders', 'zeal'), 'fa fa-smile-o' => __(' smile-o', 'zeal'), 'fa fa-soccer-ball-o' => __(' soccer-ball-o', 'zeal'), 'fa fa-sort' => __(' sort', 'zeal'), 'fa fa-sort-alpha-asc' => __(' sort-alpha-asc', 'zeal'), 'fa fa-sort-alpha-desc' => __(' sort-alpha-desc', 'zeal'), 'fa fa-sort-amount-asc' => __(' sort-amount-asc', 'zeal'), 'fa fa-sort-amount-desc' => __(' sort-amount-desc', 'zeal'), 'fa fa-sort-asc' => __(' sort-asc', 'zeal'), 'fa fa-sort-desc' => __(' sort-desc', 'zeal'), 'fa fa-sort-down' => __(' sort-down', 'zeal'), 'fa fa-sort-numeric-asc' => __(' sort-numeric-asc', 'zeal'), 'fa fa-sort-numeric-desc' => __(' sort-numeric-desc', 'zeal'), 'fa fa-sort-up' => __(' sort-up', 'zeal'), 'fa fa-space-shuttle' => __(' space-shuttle', 'zeal'), 'fa fa-spinner' => __(' spinner', 'zeal'), 'fa fa-spoon' => __(' spoon', 'zeal'), 'fa fa-square' => __(' square', 'zeal'), 'fa fa-square-o' => __(' square-o', 'zeal'), 'fa fa-star' => __(' star', 'zeal'), 'fa fa-star-half' => __(' star-half', 'zeal'), 'fa fa-star-half-empty' => __(' star-half-empty', 'zeal'), 'fa fa-star-half-full' => __(' star-half-full', 'zeal'), 'fa fa-star-half-o' => __(' star-half-o', 'zeal'), 'fa fa-star-o' => __(' star-o', 'zeal'), 'fa fa-sticky-note' => __(' sticky-note', 'zeal'), 'fa fa-sticky-note-o' => __(' sticky-note-o', 'zeal'), 'fa fa-street-view' => __(' street-view', 'zeal'), 'fa fa-suitcase' => __(' suitcase', 'zeal'), 'fa fa-sun-o' => __(' sun-o', 'zeal'), 'fa fa-support' => __(' support', 'zeal'), 'fa fa-tablet' => __(' tablet', 'zeal'), 'fa fa-tachometer' => __(' tachometer', 'zeal'), 'fa fa-tag' => __(' tag', 'zeal'), 'fa fa-tags' => __(' tags', 'zeal'), 'fa fa-tasks' => __(' tasks', 'zeal'), 'fa fa-taxi' => __(' taxi', 'zeal'), 'fa fa-television' => __(' television', 'zeal'), 'fa fa-terminal' => __(' terminal', 'zeal'), 'fa fa-thumb-tack' => __(' thumb-tack', 'zeal'), 'fa fa-thumbs-down' => __(' thumbs-down', 'zeal'), 'fa fa-thumbs-o-down' => __(' thumbs-o-down', 'zeal'), 'fa fa-thumbs-o-up' => __(' thumbs-o-up', 'zeal'), 'fa fa-thumbs-up' => __(' thumbs-up', 'zeal'), 'fa fa-ticket' => __(' ticket', 'zeal'), 'fa fa-times' => __(' times', 'zeal'), 'fa fa-times-circle' => __(' times-circle', 'zeal'), 'fa fa-times-circle-o' => __(' times-circle-o', 'zeal'), 'fa fa-tint' => __(' tint', 'zeal'), 'fa fa-toggle-down' => __(' toggle-down', 'zeal'), 'fa fa-toggle-left' => __(' toggle-left', 'zeal'), 'fa fa-toggle-off' => __(' toggle-off', 'zeal'), 'fa fa-toggle-on' => __(' toggle-on', 'zeal'), 'fa fa-toggle-right' => __(' toggle-right', 'zeal'), 'fa fa-toggle-up' => __(' toggle-up', 'zeal'), 'fa fa-trademark' => __(' trademark', 'zeal'), 'fa fa-trash' => __(' trash', 'zeal'), 'fa fa-trash-o' => __(' trash-o', 'zeal'), 'fa fa-tree' => __(' tree', 'zeal'), 'fa fa-trophy' => __(' trophy', 'zeal'), 'fa fa-truck' => __(' truck', 'zeal'), 'fa fa-tty' => __(' tty', 'zeal'), 'fa fa-tv' => __(' tv', 'zeal'), 'fa fa-umbrella' => __(' umbrella', 'zeal'), 'fa fa-university' => __(' university', 'zeal'), 'fa fa-unlock' => __(' unlock', 'zeal'), 'fa fa-unlock-alt' => __(' unlock-alt', 'zeal'), 'fa fa-unsorted' => __(' unsorted', 'zeal'), 'fa fa-upload' => __(' upload', 'zeal'), 'fa fa-user' => __(' user', 'zeal'), 'fa fa-user-plus' => __(' user-plus', 'zeal'), 'fa fa-user-secret' => __(' user-secret', 'zeal'), 'fa fa-user-times' => __(' user-times', 'zeal'), 'fa fa-users' => __(' users', 'zeal'), 'fa fa-video-camera' => __(' video-camera', 'zeal'), 'fa fa-volume-down' => __(' volume-down', 'zeal'), 'fa fa-volume-off' => __(' volume-off', 'zeal'), 'fa fa-volume-up' => __(' volume-up', 'zeal'), 'fa fa-warning' => __(' warning', 'zeal'), 'fa fa-wheelchair' => __(' wheelchair', 'zeal'), 'fa fa-wifi' => __(' wifi', 'zeal'), 'fa fa-wrench' => __(' wrench', 'zeal'), 'fa fa-hand-grab-o' => __(' hand-grab-o', 'zeal'), 'fa fa-hand-lizard-o' => __(' hand-lizard-o', 'zeal'), 'fa fa-hand-o-down' => __(' hand-o-down', 'zeal'), 'fa fa-hand-o-left' => __(' hand-o-left', 'zeal'), 'fa fa-hand-o-right' => __(' hand-o-right', 'zeal'), 'fa fa-hand-o-up' => __(' hand-o-up', 'zeal'), 'fa fa-hand-paper-o' => __(' hand-paper-o', 'zeal'), 'fa fa-hand-peace-o' => __(' hand-peace-o', 'zeal'), 'fa fa-hand-pointer-o' => __(' hand-pointer-o', 'zeal'), 'fa fa-hand-rock-o' => __(' hand-rock-o', 'zeal'), 'fa fa-hand-scissors-o' => __(' hand-scissors-o', 'zeal'), 'fa fa-hand-spock-o' => __(' hand-spock-o', 'zeal'), 'fa fa-hand-stop-o' => __(' hand-stop-o', 'zeal'), 'fa fa-thumbs-down' => __(' thumbs-down', 'zeal'), 'fa fa-thumbs-o-down' => __(' thumbs-o-down', 'zeal'), 'fa fa-thumbs-o-up' => __(' thumbs-o-up', 'zeal'), 'fa fa-thumbs-up' => __(' thumbs-up', 'zeal'), 'fa fa-ambulance' => __(' ambulance', 'zeal'), 'fa fa-automobile' => __(' automobile', 'zeal'), 'fa fa-bicycle' => __(' bicycle', 'zeal'), 'fa fa-bus' => __(' bus', 'zeal'), 'fa fa-cab' => __(' cab', 'zeal'), 'fa fa-car' => __(' car', 'zeal'), 'fa fa-fighter-jet' => __(' fighter-jet', 'zeal'), 'fa fa-motorcycle' => __(' motorcycle', 'zeal'), 'fa fa-plane' => __(' plane', 'zeal'), 'fa fa-rocket' => __(' rocket', 'zeal'), 'fa fa-ship' => __(' ship', 'zeal'), 'fa fa-space-shuttle' => __(' space-shuttle', 'zeal'), 'fa fa-subway' => __(' subway', 'zeal'), 'fa fa-taxi' => __(' taxi', 'zeal'), 'fa fa-train' => __(' train', 'zeal'), 'fa fa-truck' => __(' truck', 'zeal'), 'fa fa-wheelchair' => __(' wheelchair', 'zeal'), 'fa fa-genderless' => __(' genderless', 'zeal'), 'fa fa-intersex' => __(' intersex', 'zeal'), 'fa fa-mars' => __(' mars', 'zeal'), 'fa fa-mars-double' => __(' mars-double', 'zeal'), 'fa fa-mars-stroke' => __(' mars-stroke', 'zeal'), 'fa fa-mars-stroke-h' => __(' mars-stroke-h', 'zeal'), 'fa fa-mars-stroke-v' => __(' mars-stroke-v', 'zeal'), 'fa fa-mercury' => __(' mercury', 'zeal'), 'fa fa-neuter' => __(' neuter', 'zeal'), 'fa fa-transgender' => __(' transgender', 'zeal'), 'fa fa-transgender-alt' => __(' transgender-alt', 'zeal'), 'fa fa-venus' => __(' venus', 'zeal'), 'fa fa-venus-double' => __(' venus-double', 'zeal'), 'fa fa-venus-mars' => __(' venus-mars', 'zeal'), 'fa fa-file' => __(' file', 'zeal'), 'fa fa-file-archive-o' => __(' file-archive-o', 'zeal'), 'fa fa-file-audio-o' => __(' file-audio-o', 'zeal'), 'fa fa-file-code-o' => __(' file-code-o', 'zeal'), 'fa fa-file-excel-o' => __(' file-excel-o', 'zeal'), 'fa fa-file-image-o' => __(' file-image-o', 'zeal'), 'fa fa-file-movie-o' => __(' file-movie-o', 'zeal'), 'fa fa-file-o' => __(' file-o', 'zeal'), 'fa fa-file-pdf-o' => __(' file-pdf-o', 'zeal'), 'fa fa-file-photo-o' => __(' file-photo-o', 'zeal'), 'fa fa-file-picture-o' => __(' file-picture-o', 'zeal'), 'fa fa-file-powerpoint-o' => __(' file-powerpoint-o', 'zeal'), 'fa fa-file-sound-o' => __(' file-sound-o', 'zeal'), 'fa fa-file-text' => __(' file-text', 'zeal'), 'fa fa-file-text-o' => __(' file-text-o', 'zeal'), 'fa fa-file-video-o' => __(' file-video-o', 'zeal'), 'fa fa-file-word-o' => __(' file-word-o', 'zeal'), 'fa fa-file-zip-o' => __(' file-zip-o', 'zeal'), 'fa fa-circle-o-notch' => __(' circle-o-notch', 'zeal'), 'fa fa-cog' => __(' cog', 'zeal'), 'fa fa-gear' => __(' gear', 'zeal'), 'fa fa-refresh' => __(' refresh', 'zeal'), 'fa fa-spinner' => __(' spinner', 'zeal'), 'fa fa-check-square' => __(' check-square', 'zeal'), 'fa fa-check-square-o' => __(' check-square-o', 'zeal'), 'fa fa-circle' => __(' circle', 'zeal'), 'fa fa-circle-o' => __(' circle-o', 'zeal'), 'fa fa-dot-circle-o' => __(' dot-circle-o', 'zeal'), 'fa fa-minus-square' => __(' minus-square', 'zeal'), 'fa fa-minus-square-o' => __(' minus-square-o', 'zeal'), 'fa fa-plus-square' => __(' plus-square', 'zeal'), 'fa fa-plus-square-o' => __(' plus-square-o', 'zeal'), 'fa fa-square' => __(' square', 'zeal'), 'fa fa-square-o' => __(' square-o', 'zeal'), 'fa fa-cc-amex' => __(' cc-amex', 'zeal'), 'fa fa-cc-diners-club' => __(' cc-diners-club', 'zeal'), 'fa fa-cc-discover' => __(' cc-discover', 'zeal'), 'fa fa-cc-jcb' => __(' cc-jcb', 'zeal'), 'fa fa-cc-mastercard' => __(' cc-mastercard', 'zeal'), 'fa fa-cc-paypal' => __(' cc-paypal', 'zeal'), 'fa fa-cc-stripe' => __(' cc-stripe', 'zeal'), 'fa fa-cc-visa' => __(' cc-visa', 'zeal'), 'fa fa-credit-card' => __(' credit-card', 'zeal'), 'fa fa-google-wallet' => __(' google-wallet', 'zeal'), 'fa fa-paypal' => __(' paypal', 'zeal'), 'fa fa-area-chart' => __(' area-chart', 'zeal'), 'fa fa-bar-chart' => __(' bar-chart', 'zeal'), 'fa fa-bar-chart-o' => __(' bar-chart-o', 'zeal'), 'fa fa-line-chart' => __(' line-chart', 'zeal'), 'fa fa-pie-chart' => __(' pie-chart', 'zeal'), 'fa fa-bitcoin' => __(' bitcoin', 'zeal'), 'fa fa-btc' => __(' btc', 'zeal'), 'fa fa-cny' => __(' cny', 'zeal'), 'fa fa-dollar' => __(' dollar', 'zeal'), 'fa fa-eur' => __(' eur', 'zeal'), 'fa fa-euro' => __(' euro', 'zeal'), 'fa fa-gbp' => __(' gbp', 'zeal'), 'fa fa-gg' => __(' gg', 'zeal'), 'fa fa-gg-circle' => __(' gg-circle', 'zeal'), 'fa fa-ils' => __(' ils', 'zeal'), 'fa fa-inr' => __(' inr', 'zeal'), 'fa fa-jpy' => __(' jpy', 'zeal'), 'fa fa-krw' => __(' krw', 'zeal'), 'fa fa-money' => __(' money', 'zeal'), 'fa fa-rmb' => __(' rmb', 'zeal'), 'fa fa-rouble' => __(' rouble', 'zeal'), 'fa fa-rub' => __(' rub', 'zeal'), 'fa fa-ruble' => __(' ruble', 'zeal'), 'fa fa-rupee' => __(' rupee', 'zeal'), 'fa fa-shekel' => __(' shekel', 'zeal'), 'fa fa-sheqel' => __(' sheqel', 'zeal'), 'fa fa-try' => __(' try', 'zeal'), 'fa fa-turkish-lira' => __(' turkish-lira', 'zeal'), 'fa fa-usd' => __(' usd', 'zeal'), 'fa fa-won' => __(' won', 'zeal'), 'fa fa-yen' => __(' yen', 'zeal'), 'fa fa-align-center' => __(' align-center', 'zeal'), 'fa fa-align-justify' => __(' align-justify', 'zeal'), 'fa fa-align-left' => __(' align-left', 'zeal'), 'fa fa-align-right' => __(' align-right', 'zeal'), 'fa fa-bold' => __(' bold', 'zeal'), 'fa fa-chain' => __(' chain', 'zeal'), 'fa fa-chain-broken' => __(' chain-broken', 'zeal'), 'fa fa-clipboard' => __(' clipboard', 'zeal'), 'fa fa-columns' => __(' columns', 'zeal'), 'fa fa-copy' => __(' copy', 'zeal'), 'fa fa-cut' => __(' cut', 'zeal'), 'fa fa-dedent' => __(' dedent', 'zeal'), 'fa fa-eraser' => __(' eraser', 'zeal'), 'fa fa-file' => __(' file', 'zeal'), 'fa fa-file-o' => __(' file-o', 'zeal'), 'fa fa-file-text' => __(' file-text', 'zeal'), 'fa fa-file-text-o' => __(' file-text-o', 'zeal'), 'fa fa-files-o' => __(' files-o', 'zeal'), 'fa fa-floppy-o' => __(' floppy-o', 'zeal'), 'fa fa-font' => __(' font', 'zeal'), 'fa fa-header' => __(' header', 'zeal'), 'fa fa-indent' => __(' indent', 'zeal'), 'fa fa-italic' => __(' italic', 'zeal'), 'fa fa-link' => __(' link', 'zeal'), 'fa fa-list' => __(' list', 'zeal'), 'fa fa-list-alt' => __(' list-alt', 'zeal'), 'fa fa-list-ol' => __(' list-ol', 'zeal'), 'fa fa-list-ul' => __(' list-ul', 'zeal'), 'fa fa-outdent' => __(' outdent', 'zeal'), 'fa fa-paperclip' => __(' paperclip', 'zeal'), 'fa fa-paragraph' => __(' paragraph', 'zeal'), 'fa fa-paste' => __(' paste', 'zeal'), 'fa fa-repeat' => __(' repeat', 'zeal'), 'fa fa-rotate-left' => __(' rotate-left', 'zeal'), 'fa fa-rotate-right' => __(' rotate-right', 'zeal'), 'fa fa-save' => __(' save', 'zeal'), 'fa fa-scissors' => __(' scissors', 'zeal'), 'fa fa-strikethrough' => __(' strikethrough', 'zeal'), 'fa fa-subscript' => __(' subscript', 'zeal'), 'fa fa-superscript' => __(' superscript', 'zeal'), 'fa fa-table' => __(' table', 'zeal'), 'fa fa-text-height' => __(' text-height', 'zeal'), 'fa fa-text-width' => __(' text-width', 'zeal'), 'fa fa-th' => __(' th', 'zeal'), 'fa fa-th-large' => __(' th-large', 'zeal'), 'fa fa-th-list' => __(' th-list', 'zeal'), 'fa fa-underline' => __(' underline', 'zeal'), 'fa fa-undo' => __(' undo', 'zeal'), 'fa fa-unlink' => __(' unlink', 'zeal'), 'fa fa-angle-double-down' => __(' angle-double-down', 'zeal'), 'fa fa-angle-double-left' => __(' angle-double-left', 'zeal'), 'fa fa-angle-double-right' => __(' angle-double-right', 'zeal'), 'fa fa-angle-double-up' => __(' angle-double-up', 'zeal'), 'fa fa-angle-down' => __(' angle-down', 'zeal'), 'fa fa-angle-left' => __(' angle-left', 'zeal'), 'fa fa-angle-right' => __(' angle-right', 'zeal'), 'fa fa-angle-up' => __(' angle-up', 'zeal'), 'fa fa-arrow-circle-down' => __(' arrow-circle-down', 'zeal'), 'fa fa-arrow-circle-left' => __(' arrow-circle-left', 'zeal'), 'fa fa-arrow-circle-o-down' => __(' arrow-circle-o-down', 'zeal'), 'fa fa-arrow-circle-o-left' => __(' arrow-circle-o-left', 'zeal'), 'fa fa-arrow-circle-o-right' => __(' arrow-circle-o-right', 'zeal'), 'fa fa-arrow-circle-o-up' => __(' arrow-circle-o-up', 'zeal'), 'fa fa-arrow-circle-right' => __(' arrow-circle-right', 'zeal'), 'fa fa-arrow-circle-up' => __(' arrow-circle-up', 'zeal'), 'fa fa-arrow-down' => __(' arrow-down', 'zeal'), 'fa fa-arrow-left' => __(' arrow-left', 'zeal'), 'fa fa-arrow-right' => __(' arrow-right', 'zeal'), 'fa fa-arrow-up' => __(' arrow-up', 'zeal'), 'fa fa-arrows' => __(' arrows', 'zeal'), 'fa fa-arrows-alt' => __(' arrows-alt', 'zeal'), 'fa fa-arrows-h' => __(' arrows-h', 'zeal'), 'fa fa-arrows-v' => __(' arrows-v', 'zeal'), 'fa fa-caret-down' => __(' caret-down', 'zeal'), 'fa fa-caret-left' => __(' caret-left', 'zeal'), 'fa fa-caret-right' => __(' caret-right', 'zeal'), 'fa fa-caret-square-o-down' => __(' caret-square-o-down', 'zeal'), 'fa fa-caret-square-o-left' => __(' caret-square-o-left', 'zeal'), 'fa fa-caret-square-o-right' => __(' caret-square-o-right', 'zeal'), 'fa fa-caret-square-o-up' => __(' caret-square-o-up', 'zeal'), 'fa fa-caret-up' => __(' caret-up', 'zeal'), 'fa fa-chevron-circle-down' => __(' chevron-circle-down', 'zeal'), 'fa fa-chevron-circle-left' => __(' chevron-circle-left', 'zeal'), 'fa fa-chevron-circle-right' => __(' chevron-circle-right', 'zeal'), 'fa fa-chevron-circle-up' => __(' chevron-circle-up', 'zeal'), 'fa fa-chevron-down' => __(' chevron-down', 'zeal'), 'fa fa-chevron-left' => __(' chevron-left', 'zeal'), 'fa fa-chevron-right' => __(' chevron-right', 'zeal'), 'fa fa-chevron-up' => __(' chevron-up', 'zeal'), 'fa fa-exchange' => __(' exchange', 'zeal'), 'fa fa-hand-o-down' => __(' hand-o-down', 'zeal'), 'fa fa-hand-o-left' => __(' hand-o-left', 'zeal'), 'fa fa-hand-o-right' => __(' hand-o-right', 'zeal'), 'fa fa-hand-o-up' => __(' hand-o-up', 'zeal'), 'fa fa-long-arrow-down' => __(' long-arrow-down', 'zeal'), 'fa fa-long-arrow-left' => __(' long-arrow-left', 'zeal'), 'fa fa-long-arrow-right' => __(' long-arrow-right', 'zeal'), 'fa fa-long-arrow-up' => __(' long-arrow-up', 'zeal'), 'fa fa-toggle-down' => __(' toggle-down', 'zeal'), 'fa fa-toggle-left' => __(' toggle-left', 'zeal'), 'fa fa-toggle-right' => __(' toggle-right', 'zeal'), 'fa fa-toggle-up' => __(' toggle-up', 'zeal'), 'fa fa-arrows-alt' => __(' arrows-alt', 'zeal'), 'fa fa-backward' => __(' backward', 'zeal'), 'fa fa-compress' => __(' compress', 'zeal'), 'fa fa-eject' => __(' eject', 'zeal'), 'fa fa-expand' => __(' expand', 'zeal'), 'fa fa-fast-backward' => __(' fast-backward', 'zeal'), 'fa fa-fast-forward' => __(' fast-forward', 'zeal'), 'fa fa-forward' => __(' forward', 'zeal'), 'fa fa-pause' => __(' pause', 'zeal'), 'fa fa-play' => __(' play', 'zeal'), 'fa fa-play-circle' => __(' play-circle', 'zeal'), 'fa fa-play-circle-o' => __(' play-circle-o', 'zeal'), 'fa fa-random' => __(' random', 'zeal'), 'fa fa-step-backward' => __(' step-backward', 'zeal'), 'fa fa-step-forward' => __(' step-forward', 'zeal'), 'fa fa-stop' => __(' stop', 'zeal'), 'fa fa-youtube-play' => __(' youtube-play', 'zeal'), 'fa fa-500px' => __(' 500px', 'zeal'), 'fa fa-adn' => __(' adn', 'zeal'), 'fa fa-amazon' => __(' amazon', 'zeal'), 'fa fa-android' => __(' android', 'zeal'), 'fa fa-angellist' => __(' angellist', 'zeal'), 'fa fa-apple' => __(' apple', 'zeal'), 'fa fa-behance' => __(' behance', 'zeal'), 'fa fa-behance-square' => __(' behance-square', 'zeal'), 'fa fa-bitbucket' => __(' bitbucket', 'zeal'), 'fa fa-bitbucket-square' => __(' bitbucket-square', 'zeal'), 'fa fa-bitcoin' => __(' bitcoin', 'zeal'), 'fa fa-black-tie' => __(' black-tie', 'zeal'), 'fa fa-btc' => __(' btc', 'zeal'), 'fa fa-buysellads' => __(' buysellads', 'zeal'), 'fa fa-cc-amex' => __(' cc-amex', 'zeal'), 'fa fa-cc-diners-club' => __(' cc-diners-club', 'zeal'), 'fa fa-cc-discover' => __(' cc-discover', 'zeal'), 'fa fa-cc-jcb' => __(' cc-jcb', 'zeal'), 'fa fa-cc-mastercard' => __(' cc-mastercard', 'zeal'), 'fa fa-cc-paypal' => __(' cc-paypal', 'zeal'), 'fa fa-cc-stripe' => __(' cc-stripe', 'zeal'), 'fa fa-cc-visa' => __(' cc-visa', 'zeal'), 'fa fa-chrome' => __(' chrome', 'zeal'), 'fa fa-codepen' => __(' codepen', 'zeal'), 'fa fa-connectdevelop' => __(' connectdevelop', 'zeal'), 'fa fa-contao' => __(' contao', 'zeal'), 'fa fa-css3' => __(' css3', 'zeal'), 'fa fa-dashcube' => __(' dashcube', 'zeal'), 'fa fa-delicious' => __(' delicious', 'zeal'), 'fa fa-deviantart' => __(' deviantart', 'zeal'), 'fa fa-digg' => __(' digg', 'zeal'), 'fa fa-dribbble' => __(' dribbble', 'zeal'), 'fa fa-dropbox' => __(' dropbox', 'zeal'), 'fa fa-drupal' => __(' drupal', 'zeal'), 'fa fa-empire' => __(' empire', 'zeal'), 'fa fa-expeditedssl' => __(' expeditedssl', 'zeal'), 'fa fa-facebook' => __(' facebook', 'zeal'), 'fa fa-facebook-f' => __(' facebook-f', 'zeal'), 'fa fa-facebook-official' => __(' facebook-official', 'zeal'), 'fa fa-facebook-square' => __(' facebook-square', 'zeal'), 'fa fa-firefox' => __(' firefox', 'zeal'), 'fa fa-flickr' => __(' flickr', 'zeal'), 'fa fa-fonticons' => __(' fonticons', 'zeal'), 'fa fa-forumbee' => __(' forumbee', 'zeal'), 'fa fa-foursquare' => __(' foursquare', 'zeal'), 'fa fa-ge' => __(' ge', 'zeal'), 'fa fa-get-pocket' => __(' get-pocket', 'zeal'), 'fa fa-gg' => __(' gg', 'zeal'), 'fa fa-gg-circle' => __(' gg-circle', 'zeal'), 'fa fa-git' => __(' git', 'zeal'), 'fa fa-git-square' => __(' git-square', 'zeal'), 'fa fa-github' => __(' github', 'zeal'), 'fa fa-github-alt' => __(' github-alt', 'zeal'), 'fa fa-github-square' => __(' github-square', 'zeal'), 'fa fa-gittip' => __(' gittip', 'zeal'), 'fa fa-google' => __(' google', 'zeal'), 'fa fa-google-plus' => __(' google-plus', 'zeal'), 'fa fa-google-plus-square' => __(' google-plus-square', 'zeal'), 'fa fa-google-wallet' => __(' google-wallet', 'zeal'), 'fa fa-gratipay' => __(' gratipay', 'zeal'), 'fa fa-hacker-news' => __(' hacker-news', 'zeal'), 'fa fa-houzz' => __(' houzz', 'zeal'), 'fa fa-html5' => __(' html5', 'zeal'), 'fa fa-instagram' => __(' instagram', 'zeal'), 'fa fa-internet-explorer' => __(' internet-explorer', 'zeal'), 'fa fa-ioxhost' => __(' ioxhost', 'zeal'), 'fa fa-joomla' => __(' joomla', 'zeal'), 'fa fa-jsfiddle' => __(' jsfiddle', 'zeal'), 'fa fa-lastfm' => __(' lastfm', 'zeal'), 'fa fa-lastfm-square' => __(' lastfm-square', 'zeal'), 'fa fa-leanpub' => __(' leanpub', 'zeal'), 'fa fa-linkedin' => __(' linkedin', 'zeal'), 'fa fa-linkedin-square' => __(' linkedin-square', 'zeal'), 'fa fa-linux' => __(' linux', 'zeal'), 'fa fa-maxcdn' => __(' maxcdn', 'zeal'), 'fa fa-meanpath' => __(' meanpath', 'zeal'), 'fa fa-medium' => __(' medium', 'zeal'), 'fa fa-odnoklassniki' => __(' odnoklassniki', 'zeal'), 'fa fa-odnoklassniki-square' => __(' odnoklassniki-square', 'zeal'), 'fa fa-opencart' => __(' opencart', 'zeal'), 'fa fa-openid' => __(' openid', 'zeal'), 'fa fa-opera' => __(' opera', 'zeal'), 'fa fa-optin-monster' => __(' optin-monster', 'zeal'), 'fa fa-pagelines' => __(' pagelines', 'zeal'), 'fa fa-paypal' => __(' paypal', 'zeal'), 'fa fa-pied-piper' => __(' pied-piper', 'zeal'), 'fa fa-pied-piper-alt' => __(' pied-piper-alt', 'zeal'), 'fa fa-pinterest' => __(' pinterest', 'zeal'), 'fa fa-pinterest-p' => __(' pinterest-p', 'zeal'), 'fa fa-pinterest-square' => __(' pinterest-square', 'zeal'), 'fa fa-qq' => __(' qq', 'zeal'), 'fa fa-ra' => __(' ra', 'zeal'), 'fa fa-rebel' => __(' rebel', 'zeal'), 'fa fa-reddit' => __(' reddit', 'zeal'), 'fa fa-reddit-square' => __(' reddit-square', 'zeal'), 'fa fa-renren' => __(' renren', 'zeal'), 'fa fa-safari' => __(' safari', 'zeal'), 'fa fa-sellsy' => __(' sellsy', 'zeal'), 'fa fa-share-alt' => __(' share-alt', 'zeal'), 'fa fa-share-alt-square' => __(' share-alt-square', 'zeal'), 'fa fa-shirtsinbulk' => __(' shirtsinbulk', 'zeal'), 'fa fa-simplybuilt' => __(' simplybuilt', 'zeal'), 'fa fa-skyatlas' => __(' skyatlas', 'zeal'), 'fa fa-skype' => __(' skype', 'zeal'), 'fa fa-slack' => __(' slack', 'zeal'), 'fa fa-slideshare' => __(' slideshare', 'zeal'), 'fa fa-soundcloud' => __(' soundcloud', 'zeal'), 'fa fa-spotify' => __(' spotify', 'zeal'), 'fa fa-stack-exchange' => __(' stack-exchange', 'zeal'), 'fa fa-stack-overflow' => __(' stack-overflow', 'zeal'), 'fa fa-steam' => __(' steam', 'zeal'), 'fa fa-steam-square' => __(' steam-square', 'zeal'), 'fa fa-stumbleupon' => __(' stumbleupon', 'zeal'), 'fa fa-stumbleupon-circle' => __(' stumbleupon-circle', 'zeal'), 'fa fa-tencent-weibo' => __(' tencent-weibo', 'zeal'), 'fa fa-trello' => __(' trello', 'zeal'), 'fa fa-tripadvisor' => __(' tripadvisor', 'zeal'), 'fa fa-tumblr' => __(' tumblr', 'zeal'), 'fa fa-tumblr-square' => __(' tumblr-square', 'zeal'), 'fa fa-twitch' => __(' twitch', 'zeal'), 'fa fa-twitter' => __(' twitter', 'zeal'), 'fa fa-twitter-square' => __(' twitter-square', 'zeal'), 'fa fa-viacoin' => __(' viacoin', 'zeal'), 'fa fa-vimeo' => __(' vimeo', 'zeal'), 'fa fa-vimeo-square' => __(' vimeo-square', 'zeal'), 'fa fa-vine' => __(' vine', 'zeal'), 'fa fa-vk' => __(' vk', 'zeal'), 'fa fa-wechat' => __(' wechat', 'zeal'), 'fa fa-weibo' => __(' weibo', 'zeal'), 'fa fa-weixin' => __(' weixin', 'zeal'), 'fa fa-whatsapp' => __(' whatsapp', 'zeal'), 'fa fa-wikipedia-w' => __(' wikipedia-w', 'zeal'), 'fa fa-windows' => __(' windows', 'zeal'), 'fa fa-wordpress' => __(' wordpress', 'zeal'), 'fa fa-xing' => __(' xing', 'zeal'), 'fa fa-xing-square' => __(' xing-square', 'zeal'), 'fa fa-y-combinator' => __(' y-combinator', 'zeal'), 'fa fa-y-combinator-square' => __(' y-combinator-square', 'zeal'), 'fa fa-yahoo' => __(' yahoo', 'zeal'), 'fa fa-yc' => __(' yc', 'zeal'), 'fa fa-yc-square' => __(' yc-square', 'zeal'), 'fa fa-yelp' => __(' yelp', 'zeal'), 'fa fa-youtube' => __(' youtube', 'zeal'), 'fa fa-youtube-play' => __(' youtube-play', 'zeal'), 'fa fa-youtube-square' => __(' youtube-square', 'zeal'), 'fa fa-ambulance' => __(' ambulance', 'zeal'), 'fa fa-h-square' => __(' h-square', 'zeal'), 'fa fa-heart' => __(' heart', 'zeal'), 'fa fa-heart-o' => __(' heart-o', 'zeal'), 'fa fa-heartbeat' => __(' heartbeat', 'zeal'), 'fa fa-hospital-o' => __(' hospital-o', 'zeal'), 'fa fa-medkit' => __(' medkit', 'zeal'), 'fa fa-plus-square' => __(' plus-square', 'zeal'), 'fa fa-stethoscope' => __(' stethoscope', 'zeal'), 'fa fa-user-md' => __(' user-md', 'zeal'), 'fa fa-wheelchair' => __(' wheelchair', 'zeal'));
    
}
