<?php
/**
 * The template for displaying the home pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ares
 */

$ares_options = ares_get_options();

get_header(); ?>

<div id="primary" class="content-area">

    <main id="main" class="site-main">

        <?php if ( $ares_options['ares_slider_bool'] == 'yes' ) : ?>

            <?php do_action( 'ares_slider' ); ?>
        
        <?php endif; ?>

        <?php if ( $ares_options['ares_post_slider_cta_bool'] == 'yes' ) : ?>

            <div id="post-slider-cta">

                <?php if ( $ares_options['ares_cta_header_one'] ) : ?>
                    <h3 class="main-heading smartcat-animate fadeInLeft">
                        <?php echo esc_html( $ares_options['ares_cta_header_one'] ); ?>
                    </h3>
                <?php endif; ?>

                <?php if ( $ares_options['ares_cta_header_two'] ) : ?>
                    <h4 class="secondary-heading smartcat-animate fadeInRight">
                        <?php echo esc_html( $ares_options['ares_cta_header_two'] ); ?>
                    </h4>
                <?php endif; ?>

            </div>

        <?php endif; ?>
        
        <?php if ( $ares_options['ares_cta_bool'] == 'yes' ) : ?>
            <?php do_action( 'ares_cta_trio' ); ?>
        <?php endif; ?>
        
        <?php do_action( 'ares_pro_widget_areas' ); ?>
        
        <?php if( is_active_sidebar('sidebar-banner' ) ) : ?>
            
            <div id="top-banner" class="full-banner">
                
                <div class="container">
        
                    <div class="row">

                        <div class="col-md-12">

                            <div class="top-banner-text">
                                <?php dynamic_sidebar( 'sidebar-banner' ); ?>
                            </div>

                        </div>

                    </div>
                    
                </div>
 
            </div>
        
            <div class="clear"></div>

        <?php endif; ?>
        
        <?php if( is_active_sidebar('sidebar-homepage-widget' ) ) :?>
            
            <div id="homepage-widget" class="">
                
                <div class="container">
                
                    <div class="row">

                        <div class="col-md-12">
                        
                            <div class="top-banner-text">
                                <?php dynamic_sidebar( 'sidebar-homepage-widget' ); ?>
                            </div>            

                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
        <?php endif; ?>
        
        <?php if ( $ares_options['ares_frontpage_content_bool'] == 'yes' ) : ?>
        
            <div class="container">

                <div class="frontpage row">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php

                        if ( 'posts' == get_option( 'show_on_front' ) ) {
                            get_template_part('template-parts/content', 'posts');
                        } else {
                            get_template_part('template-parts/content', 'home');
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
