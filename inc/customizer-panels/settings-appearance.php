<?php

// ---------------------------------------------
// Appearance - Customizer Panel
// ---------------------------------------------
$wp_customize->add_panel( 'ares_appearance_panel', array(
    'title'                 => __( 'Appearance', 'ares' ),
    'description'           => __( 'Customize the appearance of your site', 'ares' ),
    'priority'              => 10
) );

// ---------------------------------------------
// Colors Section
// ---------------------------------------------
$wp_customize->add_section( 'ares_colors_section', array(
    'title'                 => __( 'Colors', 'ares'),
    'description'           => __( 'Customize the colors of your site', 'ares' ),
    'panel'                 => 'ares_appearance_panel'
) );

    // Theme Color
    $wp_customize->add_setting( 'ares[ares_theme_color]', array(
        'default'               => 'aqua',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'sanitize_text_field',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_theme_color]', array(
        'label'   => __( 'Select the theme color', 'ares' ),
        'section' => 'ares_colors_section',
        'type'    => 'radio',
        'choices'    => array(
            'aqua'      => __( 'Aqua', 'ares' ),
            'green'     => __( 'Green', 'ares' ),
            'red'       => __( 'Red', 'ares' ),
        )
    ));

// ---------------------------------------------
// Background Section
// ---------------------------------------------
$wp_customize->add_section( 'ares_background_section', array(
    'title'                 => __( 'Background Pattern', 'ares'),
    'description'           => __( 'Customize the site\'s textured background pattern', 'ares' ),
    'panel'                 => 'ares_appearance_panel'
) );
    
    // Theme Background Pattern
    $wp_customize->add_setting( 'ares[ares_theme_background_pattern]', array(
        'default'               => 'crossword',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'sanitize_text_field',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_theme_background_pattern]', array(
        'label'   => __( 'Select the background pattern', 'ares' ),
        'section' => 'ares_background_section',
        'type'    => 'radio',
        'choices'    => array(
            'witewall_3'    => __( 'White Wall', 'ares' ),
            'brickwall'     => __( 'White Brick', 'ares' ),
            'skulls'        => __( 'Illustrations', 'ares' ),
            'crossword'     => __( 'Crossword', 'ares' ),
            'food'          => __( 'Food', 'ares' ),
        )
    ));

// ---------------------------------------------
// Fonts Section
// ---------------------------------------------
$wp_customize->add_section( 'ares_fonts_section', array(
    'title'                 => __( 'Fonts', 'ares'),
    'description'           => __( 'Customize the site\'s fonts', 'ares' ),
    'panel'                 => 'ares_appearance_panel'
) );

    // Primary Font Family
    $wp_customize->add_setting( 'ares[ares_font_family]', array(
        'default'               => 'Josefin Sans, sans-serif',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'sanitize_text_field',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_font_family]', array(
        'label'   => __( 'Select the primary font family', 'ares' ),
        'section' => 'ares_fonts_section',
        'type'    => 'select',
        'choices' => ares_fonts()
    ));

    //  Secondary Font Family
    //    $wp_customize->add_setting( 'ares[ares_font_family_secondary]', array(
    //        'default'               => 'Josefin Sans, sans-serif',
    //        'transport'             => 'refresh',
    //        'sanitize_callback'     => 'sanitize_text_field',
    //        'type'                  => 'option'
    //    ) );
    //    $wp_customize->add_control( 'ares[ares_font_family_secondary]', array(
    //        'label'   => __( 'Select the secondary font family', 'ares' ),
    //        'section' => 'ares_fonts_section',
    //        'type'    => 'select',
    //        'choices' => ares_fonts()
    //    ));