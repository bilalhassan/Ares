<?php

/**
 * Enqueue scripts and styles.
 */
function ares_scripts() {

	wp_enqueue_style( 'ares-style', get_stylesheet_uri() );

    // Load Fonts from array
    $fonts = ares_fonts();

    // Primary Font Enqueue
    if( array_key_exists ( get_theme_mod( 'ares_font_primary', 'Josefin Sans, sans-serif'), $fonts ) ) :
        wp_enqueue_style('google-font-primary', '//fonts.googleapis.com/css?family=' . esc_attr( $fonts[ get_theme_mod( 'ares_font_primary', 'Josefin Sans, sans-serif' ) ] ), array(), ARES_VERSION );
    endif;

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css', array(), ARES_VERSION );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/inc/css/animate.css', array(), ARES_VERSION );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css', array(), ARES_VERSION );
    wp_enqueue_style( 'camera', get_template_directory_uri() . '/inc/css/camera.css', array(), ARES_VERSION );
    wp_enqueue_style( 'ares-main-style', get_template_directory_uri() . '/inc/css/ares.css', array(), ARES_VERSION );

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

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ares' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'ares' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Toolbar', 'ares' ),
		'id'            => 'toolbar',
		'description'   => esc_html__( 'Add widgets here (Only one-line Text / Custom Menu recommended).', 'ares' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

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
function ares_custom_css() { ?>

    <style>

        body {
            font-family: <?php echo esc_attr( get_theme_mod( 'ares_font_primary', 'Josefin Sans, sans-serif' ) ); ?>;
        }

        #site-toolbar .social-bar a:hover {
            background-color: <?php echo esc_attr( get_theme_mod( 'ares_skin_color_primary', '#83CBDC' ) ); ?>;
            border-color: <?php echo esc_attr( get_theme_mod( 'ares_skin_color_primary', '#83CBDC' ) ); ?>;
        }

        #site-branding .site-title a,
        #site-navigation.main-navigation li a:hover {
            color: <?php echo esc_attr( get_theme_mod( 'ares_skin_color_primary', '#83CBDC' ) ); ?>;
        }

        /*
        ----- Header Heights ---------------------------------------------------------
        */

        @media (min-width:992px) {
            #site-branding {
               height: <?php echo intval( get_theme_mod( 'ares_branding_bar_height', 80 ) ); ?>px;
            }
            #site-branding img {
               max-height: <?php echo intval( get_theme_mod( 'ares_branding_bar_height', 80 ) ); ?>px;
            }
        }

        div#content {
            margin-top: <?php echo esc_attr( get_theme_mod( 'ares_branding_bar_height', '80' ) + 40 ); ?>px;
        }

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
function ares_render_toolbar() { ?>

    <div id="site-toolbar">

        <div class="container">

            <div class="row">

                <div class="col-xs-<?php echo is_active_sidebar( 'toolbar' ) ? '6' : '12'; ?> social-bar">

                    <?php if ( get_theme_mod( 'ares_facebook_url', '' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'ares_facebook_url', '' ) ); ?>" target="_blank" class="icon-facebook animated fadeInDown">
                            <i class="fa fa-facebook"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'ares_twitter_url', '' ) ) : ?>
                    <a href="<?php echo esc_url( get_theme_mod( 'ares_twitter_url', '' ) ); ?>" target="_blank" class="icon-twitter animated fadeInDown">
                            <i class="fa fa-twitter"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'ares_linkedin_url', '' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'ares_linkedin_url', '' ) ); ?>" target="_blank" class="icon-linkedin animated fadeInDown">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'ares_gplus_url', '' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'ares_gplus_url', '' ) ); ?>" target="_blank" class="icon-gplus animated fadeInDown">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'ares_instagram_url', '' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'ares_instagram_url', '' ) ); ?>" target="_blank" class="icon-instagram animated fadeInDown">
                            <i class="fa fa-instagram"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( get_theme_mod( 'ares_youtube_url', '' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'ares_youtube_url', '' ) ); ?>" target="_blank" class="icon-youtube animated fadeInDown">
                            <i class="fa fa-youtube"></i>
                        </a>
                    <?php endif; ?>

                </div>

				<?php if ( is_active_sidebar( 'toolbar' ) ) : ?>

	                <div class="col-xs-6 contact-bar">

	                    <?php echo dynamic_sidebar( 'toolbar' ); ?>

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
function ares_render_slider() { ?>

	<?php if ( get_theme_mod( 'ares_slide1_image',  get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ||
		get_theme_mod( 'ares_slide2_image',  get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ||
		get_theme_mod( 'ares_slide3_image',  get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ) : ?>

	    <div class="sc-slider-wrapper">

			<div class="fluid_container">

				<div class="camera_wrap" id="ares_slider_wrap">

					<?php if ( get_theme_mod( 'ares_slide1_image',  get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ) : ?>

	                    <div data-thumb="<?php echo esc_attr( get_theme_mod( 'ares_slide1_image', get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ); ?>" data-src="<?php echo esc_attr( get_theme_mod( 'ares_slide1_image', get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ); ?>">

	                        <div class="camera_caption fadeFromBottom">
	                            <span>
									<?php echo esc_attr( get_theme_mod( 'ares_slide1_text', __( 'Ares: Responsive Multi-purpose WordPress Theme', 'ares' ) ) ); ?>
								</span>
	                        </div>

	                    </div>

	                <?php endif; ?>

					<?php if ( get_theme_mod( 'ares_slide2_image',  get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ) : ?>

						<div data-thumb="<?php echo esc_attr( get_theme_mod( 'ares_slide2_image', get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ); ?>" data-src="<?php echo esc_attr( get_theme_mod( 'ares_slide2_image', get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ); ?>">

							<div class="camera_caption fadeFromBottom">
								<span>
									<?php echo esc_attr( get_theme_mod( 'ares_slide2_text', __( 'Ares: Responsive Multi-purpose WordPress Theme', 'ares' ) ) ); ?>
								</span>
							</div>

						</div>

					<?php endif; ?>

					<?php if ( get_theme_mod( 'ares_slide3_image',  get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ) : ?>

						<div data-thumb="<?php echo esc_attr( get_theme_mod( 'ares_slide3_image', get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ); ?>" data-src="<?php echo esc_attr( get_theme_mod( 'ares_slide3_image', get_template_directory_uri() . '/inc/images/ares_demo.jpg' ) ); ?>">

							<div class="camera_caption fadeFromBottom">
								<span>
									<?php echo esc_attr( get_theme_mod( 'ares_slide3_text', __( 'Ares: Responsive Multi-purpose WordPress Theme', 'ares' ) ) ); ?>
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
