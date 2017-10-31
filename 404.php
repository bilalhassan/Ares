<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Ares
 */

get_header(); ?>

<div id="primary" class="content-area">

    <main id="main" class="site-main">

        <section class="error-404 not-found">
        
            <header class="page-header">

                <div class="container">

                    <div class="row">

                        <div class="col-sm-12">

                            <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ares' ); ?></h1>

                        </div>

                    </div>

                </div>

            </header><!-- .page-header -->

            <div class="container">

                <div class="frontpage row">

                    <div class="col-sm-12">
                        
                        <div class="page-content">
                            
                            <article>
                                
                                <div class="widget widget_categories">
                                    
                                    <h2 class="widgettitle center">
                                        <i class="fa fa-exclamation-triangle icon404"></i>
                                        <h3 class="center"><?php _e("Sorry the page you're looking for is not available", "ares"); ?></h3>
                                        <div class="center mt20">
                                            <?php get_search_form(); ?>
                                        </div>
                                    </h2>

                                </div><!-- .widget -->
                                
                            </article>
                            
                        </div><!-- .page-content -->
                        
                    </div>
                    
                </div>
                
            </div>
            
        </section><!-- .error-404 -->

    </main><!-- #main -->
    
</div><!-- #primary -->

<?php
get_footer();
