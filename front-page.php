<?php
/*
 * Theme homepage
 * @author bilal hassan <info@smartcatdesign.net>
 *
 */
get_header(); ?>

<div id="primary" class="content-area">

    <main id="main" class="site-main">

        <?php if ( get_theme_mod( 'ares_slider_bool', 'show' ) == 'show' ) : ?>
            <?php do_action( 'ares_slider' ); ?>
        <?php endif; ?>

        <?php if ( get_theme_mod( 'ares_cta_header_bool', 'show' ) == 'show' ) : ?>

            <div id="post-slider-cta">

                <?php if ( get_theme_mod( 'ares_cta_heading', __( 'Modern design with a responsive layout', 'ares' ) ) ) : ?>
                    <h3 class="main-heading animated fadeInLeft">
                        <?php esc_html_e( get_theme_mod( 'ares_cta_heading', __( 'Modern design with a responsive layout', 'ares' ) ) ); ?>
                    </h3>
                <?php endif; ?>

                <?php if ( get_theme_mod( 'ares_cta_subheading', __( 'User-friendly & Easily Customizable', 'ares' ) ) ) : ?>
                    <h4 class="secondary-heading animated fadeInRight">
                        <?php esc_html_e( get_theme_mod( 'ares_cta_subheading', __( 'User-friendly & Easily Customizable', 'ares' ) ) ); ?>
                    </h4>
                <?php endif; ?>

            </div>

        <?php endif; ?>
        
        <?php if ( get_theme_mod( 'ares_cta_trio_bool', 'show' ) == 'show' ) : ?>
            <?php do_action( 'ares_cta_trio' ); ?>
        <?php endif; ?>
        
        <?php if( is_active_sidebar('sidebar-banner') ) : ?>
            <?php // echo ares_banner(); ?>
        <?php endif; ?>
        
        <?php if(is_active_sidebar('sidebar-homepage-widget')) :?>
            <?php // echo ares_homepage_widget(); ?>
        <?php endif; ?>
        
        <?php if ( get_theme_mod( 'ares_frontpage_content_bool', 'show' ) == 'show' ) : ?> 
        
            <div class="container">

                <div class="frontpage row">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php

                        if ( 'posts' == get_option( 'show_on_front' ) ) {
                            get_template_part('template-parts/content', 'posts');
                        } else {
                            get_template_part('template-parts/content', 'page');
                        }                

                        // If comments are open or we have at least one comment, load up the comment template
                        if (comments_open() || '0' != get_comments_number()) :
                            comments_template();
                        endif;

                        ?>

                    <?php endwhile; // end of the loop.   ?>

                </div>

            </div>

        <?php endif; ?>
        
    </main>
    
</div>

<?php get_footer();
