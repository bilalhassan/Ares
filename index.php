<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ares
 */

$ares_options = ares_get_options();

get_header(); ?>

<div id="primary" class="content-area">

    <main id="main" class="site-main index">
  
        <div class="container">

            <div class="page-content row">

                <div class="col-md-<?php echo $ares_options['ares_blog_layout'] == 'col2r' && is_active_sidebar(1) ? '9' : '12'; ?> site-content item-page">

                    <?php if ( have_posts() ) : ?>
                    
                        <?php while ( have_posts() ) : the_post(); ?>

                            <div class="item-post">
                        
                                <?php if ( $ares_options['ares_blog_featured'] == 'on' && has_post_thumbnail() ) : ?>
                                
                                    <div class="post-thumb col-sm-4">
                                        
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large'); ?>
                                        </a>
                                        
                                    </div>
                                
                                <?php endif; ?>

                                <div class="col-sm-<?php echo $ares_options['ares_blog_featured'] == 'on' && has_post_thumbnail() ? '8' : '12'; ?> <?php echo has_post_thumbnail() ? '' : 'text-left'; ?>">
                                    
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    
                                    <div class="post-content">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    
                                    <div class="text-right">
                                        <a class="ares-button button-primary" href="<?php the_permalink(); ?>">
                                            <?php _e( 'Read More', 'ares' ); ?>
                                        </a>
                                    </div>  
                                    
                                </div>
                                
                            </div>

                        <?php endwhile; // end of the loop.   ?>

                        <div class="pagination-links">
                            <?php echo the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
                        </div>
                    
                    <?php else : ?>
                    
                        <?php get_template_part('template-parts/content', 'none'); ?>
                    
                    <?php endif; ?>
                    
                </div>
                
                <?php if ( $ares_options['ares_blog_layout'] == 'col2r' && is_active_sidebar(1) ) : ?>

                    <div class="col-md-3 avenue-sidebar">
                        <?php get_sidebar(); ?>
                    </div>

                <?php endif; ?>
                
            </div>
            
            <div class="clear"></div>
            
        </div>

    </main>
    
</div>

<?php get_footer();
