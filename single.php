<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Ares
 */

$ares_options = ares_get_options();

get_header(); ?>

<div id="content" class="site-content-wrapper">
    
    <?php while ( have_posts() ) : the_post(); ?>
    
        <div class="page-content row ">
            
            <article class="col-md-<?php echo $ares_options['ares_single_layout'] == 'col1' ? '12' : '9'; ?> item-page">
                
                <h2 class="post-title">
                    <?php the_title(); ?>
                </h2>
                
                <div class="avenue-underline"></div>
                
                <?php $ares_options['ares_single_featured'] == 'on' ? the_post_thumbnail( 'medium' ) : ''; ?>
                
                <?php the_content(); ?>
                
                <?php $ares_options['ares_single_date'] == 'on' ? __( 'Posted on: ', 'ares' ) . esc_html( get_the_date() ) : ''; ?>
                <?php $ares_options['ares_single_author'] == 'on' ? __( ', by : ', 'ares' ) . esc_html( get_the_author() ) : ''; ?>
                
                <?php 
                
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'ares' ),
                    'after' => '</div>',
                ));
                
                if (comments_open() || '0' != get_comments_number()) :
                    comments_template();
                endif;
                
                ?>
                
            </article>
            
            <?php if ( $ares_options['ares_single_layout'] == 'col2r' ) : ?>
                
                <div class="col-md-3 avenue-sidebar">
                    <?php get_sidebar(); ?>
                </div>
            
            <?php endif; ?>
            
        </div>
    
    <?php endwhile; // end of the loop. ?>

</div><!-- #primary -->

<?php get_footer();
