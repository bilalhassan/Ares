<?php

// ---------------------------------------------
// Header - Customizer Panel
// ---------------------------------------------
$wp_customize->add_panel( 'ares_header_panel', array(
    'title'                 => __( 'Header', 'ares' ),
    'description'           => __( 'Customize the appearance of your Header', 'ares' ),
    'priority'              => 10
) );

// ---------------------------------------------
// Toolbar Section
// ---------------------------------------------
$wp_customize->add_section( 'ares_toolbar_section', array(
    'title'                 => __( 'Toolbar & Social Links', 'ares'),
    'description'           => __( 'Customize the Toolbar in the Header and the Social Links it contains', 'ares' ),
    'panel'                 => 'ares_header_panel'
) );

    // Show / Hide the Toolbar?
    $wp_customize->add_setting( 'ares[ares_headerbar_bool]', array(
        'default'               => 'show',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'ares_sanitize_show_hide',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_headerbar_bool]', array(
        'label'   => __( 'Show or hide the Toolbar section?', 'zeal' ),
        'section' => 'ares_toolbar_section',
        'type'    => 'radio',
        'choices'    => array(
            'show'  => __( 'Show', 'ares' ),
            'hide'  => __( 'Hide', 'ares' ),
        )
    ));

    // Facebook URL
    $wp_customize->add_setting( 'ares[ares_facebook_url]', array(
        'default'               => '',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_facebook_url]', array(
        'type'                  => 'text',
        'section'               => 'ares_toolbar_section',
        'label'                 => __( 'Facebook URL', 'juno' ),
    ) );

    // Twitter URL
    $wp_customize->add_setting( 'ares[ares_twitter_url]', array(
        'default'               => '',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_twitter_url]', array(
        'type'                  => 'text',
        'section'               => 'ares_toolbar_section',
        'label'                 => __( 'Twitter URL', 'juno' ),
    ) );

    // LinkedIn URL
    $wp_customize->add_setting( 'ares[ares_linkedin_url]', array(
        'default'               => '',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_linkedin_url]', array(
        'type'                  => 'text',
        'section'               => 'ares_toolbar_section',
        'label'                 => __( 'LinkedIn URL', 'juno' ),
    ) );

    // Google+ URL
    $wp_customize->add_setting( 'ares[ares_gplus_url]', array(
        'default'               => '',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_gplus_url]', array(
        'type'                  => 'text',
        'section'               => 'ares_toolbar_section',
        'label'                 => __( 'Google+ URL', 'juno' ),
    ) );

    // Instagram URL
    $wp_customize->add_setting( 'ares[ares_instagram_url]', array(
        'default'               => '',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_instagram_url]', array(
        'type'                  => 'text',
        'section'               => 'ares_toolbar_section',
        'label'                 => __( 'Instagram URL', 'juno' ),
    ) );

    // YouTube URL
    $wp_customize->add_setting( 'ares[ares_youtube_url]', array(
        'default'               => '',
        'transport'             => 'refresh',
        'sanitize_callback'     => 'esc_url_raw',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_youtube_url]', array(
        'type'                  => 'text',
        'section'               => 'ares_toolbar_section',
        'label'                 => __( 'YouTube URL', 'juno' ),
    ) );

// ---------------------------------------------
// Header Height Section
// ---------------------------------------------
$wp_customize->add_section( 'ares_header_height_section', array(
    'title'                 => __( 'Branding Bar', 'ares'),
    'description'           => __( 'Customize the Branding Bar in the Header', 'ares' ),
    'panel'                 => 'ares_header_panel'
) );

    // Branding Bar Height
    $wp_customize->add_setting( 'ares[ares_branding_bar_height]', array (
        'default'               => 80,
        'transport'             => 'refresh',
        'sanitize_callback'     => 'ares_sanitize_integer',
        'type'                  => 'option'
    ) );
    $wp_customize->add_control( 'ares[ares_branding_bar_height]', array(
        'type'                  => 'number',
        'section'               => 'ares_header_height_section',
        'label'                 => __( 'Branding Bar Height', 'kenza' ),
        'description'           => __( 'Adjust the height of the branding bar in the Header', 'kenza' ),
        'input_attrs'           => array(
            'min' => 80,
            'max' => 400,
            'step' => 1,
    ) ) );
