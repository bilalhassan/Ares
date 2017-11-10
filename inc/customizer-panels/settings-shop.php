<?php

// ---------------------------------------------
// Shop / WooCommerce Section
// ---------------------------------------------
$wp_customize->add_section( 'ares_shop_section', array(
    'title'                 => __( 'WooCommerce Shop', 'ares'),
    'description'           => __( 'Customize the your WooCommerce Shop', 'ares' ),
    'priority'              => 10
) );

    // Show / Hide the Cart?
    $wp_customize->add_setting( 'ares[cart_icon_toggle]', array(
         'default'               => 'on',
         'transport'             => 'refresh',
         'sanitize_callback'     => 'ares_sanitize_on_off',
         'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[cart_icon_toggle]', array(
        'label'   => __( 'Show or Hide the WooCommerce Cart icon in the site branding bar?', 'ares' ),
        'section' => 'ares_shop_section',
        'type'    => 'radio',
        'choices'    => array(
            'on'    => __( 'Show', 'ares' ),
            'off'   => __( 'Hide', 'ares' ),
        )
    ));
    
    // Show / Hide Shop Sidebar on Shop Page?
    $wp_customize->add_setting( 'ares[shop_sidebar_on_archive]', array(
         'default'               => 'on',
         'transport'             => 'refresh',
         'sanitize_callback'     => 'ares_sanitize_on_off',
         'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[shop_sidebar_on_archive]', array(
        'label'   => __( 'Show or Hide the Shop sidebar on the Shop page?', 'ares' ),
        'section' => 'ares_shop_section',
        'type'    => 'radio',
        'choices'    => array(
            'on'    => __( 'Show', 'ares' ),
            'off'   => __( 'Hide', 'ares' ),
        )
    ));

    // Show / Hide Shop Sidebar on Single Product Page?
    $wp_customize->add_setting( 'ares[shop_sidebar_on_product]', array(
         'default'               => 'on',
         'transport'             => 'refresh',
         'sanitize_callback'     => 'ares_sanitize_on_off',
         'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[shop_sidebar_on_product]', array(
        'label'   => __( 'Show or Hide the Shop sidebar on the Single Product page?', 'ares' ),
        'section' => 'ares_shop_section',
        'type'    => 'radio',
        'choices'    => array(
            'on'    => __( 'Show', 'ares' ),
            'off'   => __( 'Hide', 'ares' ),
        )
    ));

