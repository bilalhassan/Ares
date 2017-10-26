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

    </main>
</div>

<?php get_footer();
