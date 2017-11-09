<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ares
 */

$ares_options = ares_get_options();

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>

</head>

<?php 

if ( $ares_options['ares_theme_background_pattern'] == 'witewall_3' || 
    $ares_options['ares_theme_background_pattern'] == 'brickwall' || 
    $ares_options['ares_theme_background_pattern'] == 'skulls' || 
    $ares_options['ares_theme_background_pattern'] == 'crossword' || 
    $ares_options['ares_theme_background_pattern'] == 'food' ) :

    $bg_image_src = get_template_directory_uri() . '/inc/images/' . esc_attr( $ares_options['ares_theme_background_pattern'] ) . '.png';
    
elseif ( !defined( 'ARES_PRO_URL' ) ) : 
    
    $bg_image_src = get_template_directory_uri() . '/inc/images/crossword.png';
    
else :
    
    $bg_image_src = ARES_PRO_URL . 'assets/images/' . esc_attr( $ares_options['ares_theme_background_pattern'] ) . '.png';

endif;

?>

<body <?php body_class(); ?> style="background-image: url(<?php echo esc_url( $bg_image_src ); ?>);">

    <div id="page" class="site">

        <header id="masthead" class="site-header" role="banner">

            <?php if ( $ares_options['ares_headerbar_bool'] == 'yes' ) : ?>

                <?php do_action( 'ares_toolbar' ); ?>

            <?php endif; ?>

            <div id="site-branding" class="container">

                <div class="branding">

                    <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>

                        <?php the_custom_logo(); ?>

                    <?php else : ?>

                        <?php if ( get_bloginfo( 'name' ) ) : ?>

                            <h2 class="site-title">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <?php bloginfo( 'name' );?>
                                </a>
                            </h2>

                        <?php endif; ?>

                        <?php if ( get_bloginfo( 'description' ) ) : ?>

                            <h5 class="site-description">
                                <?php echo get_bloginfo( 'description' ); ?>
                            </h5>

                        <?php endif; ?>

                    <?php endif; ?>

                </div>

                <div class="navigation">

                    <nav id="site-navigation" class="main-navigation" role="navigation">

                        <?php wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                        ) ); ?>

                    </nav><!-- #site-navigation -->

                </div>

                <div class="mobile-trigger-wrap">
                    <span id="mobile-menu-trigger"><span class="fa fa-bars"></span></span>
                </div>

                <div id="mobile-overlay"></div>

                <div id="mobile-menu-wrap">

                    <nav id="menu" role="navigation">

                        <img id="mobile-menu-close" src="<?php echo esc_url( get_template_directory_uri() . '/inc/images/close-mobile.png' ); ?>" alt="<?php _e( 'Close Menu', 'ares' ); ?>">

                        <?php if ( has_nav_menu( 'primary' ) ) : ?>

                            <?php wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'mobile-menu',
                            ) ); ?>

                        <?php else : ?>

                            <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>

                                <ul id="mobile-menu" class="menu">

                                    <li class="menu-item menu-item-type-custom menu-item-object-custom">

                                        <a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">
                                           <?php _e( 'Add a Primary Menu?', 'ares' ); ?>
                                        </a>

                                    </li>

                                </ul>
                        
                            <?php endif; ?>
                        
                        <?php endif; ?>
                        
                    </nav>

                </div>

            </div>

        </header><!-- #masthead -->

        <div id="content" class="site-content">
