<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ares
 */

$ares_options = ares_get_options();

get_header(); ?>

<div id="primary" class="content-area">

    <main id="main" class="site-main">

        <header class="page-header">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12">

                        <?php
                            the_archive_title( '<h1 class="page-title">', '</h1>' );
                            the_archive_description( '<div class="archive-description">', '</div>' );
                        ?>
                        
                    </div>

                </div>

            </div>

        </header><!-- .page-header -->

        <div class="container">

            <div class="frontpage row">

                <div class="col-sm-12">
                    
                    <?php if ( have_posts() ) : ?>
            
                        <?php

                        /* Start the Loop */
                        while ( have_posts() ) : the_post();

                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content', 'posts' );

                        endwhile;

                        the_posts_navigation();

                    else :

                        get_template_part( 'template-parts/content', 'none' );

                    endif; ?>
                
                </div>
                
            </div>
        
        </div>

    </main><!-- #main -->

</div><!-- #primary -->

<?php
get_footer();
