<?php

// ---------------------------------------------
// Frontpage - Customizer Panel
// ---------------------------------------------
$wp_customize->add_panel( 'ares_frontpage_panel', array(
    'title'                 => __( 'Frontpage', 'ares' ),
    'description'           => __( 'Customize the appearance of your site homepage', 'ares' ),
    'priority'              => 10
) );

    // ---------------------------------------------
    // CTA Header Section
    // ---------------------------------------------
    $wp_customize->add_section( 'ares_cta_header_section', array(
        'title'                 => __( 'CTA Header', 'ares'),
        'description'           => __( 'Customize the CTA banner that appears below the Slider', 'ares' ),
        'panel'                 => 'ares_frontpage_panel'
    ) );

        // Show / Hide the CTA Header?
        $wp_customize->add_setting( 'ares_cta_header_bool', array(
            'default'               => 'show',
            'transport'             => 'refresh',
            'sanitize_callback'     => 'ares_sanitize_show_hide'
        ) );
        $wp_customize->add_control( 'ares_cta_header_bool', array(
            'label'   => __( 'Show or hide the CTA banner below the Slider?', 'zeal' ),
            'section' => 'ares_cta_header_section',
            'type'    => 'radio',
            'choices'    => array(
                'show'  => __( 'Show', 'ares' ),
                'hide'  => __( 'Hide', 'ares' ),
            )
        ));
    
        // Main Heading 
        $wp_customize->add_setting( 'ares_cta_heading', array(
            'default'               => __( 'Modern design with a responsive layout', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta_heading', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_header_section',
            'label'                 => __( 'Main Heading', 'juno' ),
        ) );
        
        // Secondary Heading 
        $wp_customize->add_setting( 'ares_cta_subheading', array(
            'default'               => __( 'User-friendly & Easily Customizable', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta_subheading', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_header_section',
            'label'                 => __( 'Secondary Heading', 'juno' ),
        ) );
    
    // ---------------------------------------------
    // CTA Trio Section
    // ---------------------------------------------
    $wp_customize->add_section( 'ares_cta_trio_section', array(
        'title'                 => __( 'CTA Trio Section', 'ares'),
        'description'           => __( 'Customize the trio of icon CTAs on the frontpage', 'ares' ),
        'panel'                 => 'ares_frontpage_panel'
    ) );

        // Show / Hide the CTA Trio Section?
        $wp_customize->add_setting( 'ares_cta_trio_bool', array(
            'default'               => 'show',
            'transport'             => 'refresh',
            'sanitize_callback'     => 'ares_sanitize_show_hide'
        ) );
        $wp_customize->add_control( 'ares_cta_trio_bool', array(
            'label'   => __( 'Show or hide the CTA Trio section?', 'zeal' ),
            'section' => 'ares_cta_trio_section',
            'type'    => 'radio',
            'choices'    => array(
                'show'  => __( 'Show', 'ares' ),
                'hide'  => __( 'Hide', 'ares' ),
            )
        ));
    
        // CTA 1 - Icon
        $wp_customize->add_setting( 'ares_cta1_icon', array(
            'default' => 'fa fa-gears',
            'transport' => 'refresh',
            'sanitize_callback' => 'ares_sanitize_icon'
        ));
        $wp_customize->add_control( 'ares_cta1_icon', array(
            'label' => __('CTA 1 - Icon', 'athena'),
            'section' => 'ares_cta_trio_section',
            'type' => 'select',
            'choices' => ares_icons()
        ));
        
        // CTA 1 - Title
        $wp_customize->add_setting( 'ares_cta1_title', array(
            'default'               => __( 'Theme Options', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta1_title', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 1 - Title', 'juno' ),
        ) );
        
        // CTA 1 - Tagline
        $wp_customize->add_setting( 'ares_cta1_text', array(
            'default'               => __( 'Change typography, colors, layouts...', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta1_text', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 1 - Tagline', 'juno' ),
        ) );
        
        // CTA 1 - URL
        $wp_customize->add_setting( 'ares_cta1_url', array(
            'default'               => '',
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta1_url', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 1 - Link/URL', 'juno' ),
        ) );

        // CTA 1 - Link Text
        $wp_customize->add_setting( 'ares_cta1_button_text', array(
            'default'               => __( 'Click Here', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta1_button_text', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 1 - Link Text', 'juno' ),
        ) );
    
        // CTA 2 - Icon
        $wp_customize->add_setting( 'ares_cta2_icon', array(
            'default' => 'fa fa-mobile',
            'transport' => 'refresh',
            'sanitize_callback' => 'ares_sanitize_icon'
        ));
        $wp_customize->add_control( 'ares_cta2_icon', array(
            'label' => __('CTA 2 - Icon', 'athena'),
            'section' => 'ares_cta_trio_section',
            'type' => 'select',
            'choices' => ares_icons()
        ));
        
        // CTA 2 - Title
        $wp_customize->add_setting( 'ares_cta2_title', array(
            'default'               => __( 'Responsive Layout', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta2_title', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 2 - Title', 'juno' ),
        ) );
        
        // CTA 2 - Tagline
        $wp_customize->add_setting( 'ares_cta2_text', array(
            'default'               => __( 'Looks great on different devices', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta2_text', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 2 - Tagline', 'juno' ),
        ) );
        
        // CTA 2 - URL
        $wp_customize->add_setting( 'ares_cta2_url', array(
            'default'               => '',
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta2_url', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 2 - Link/URL', 'juno' ),
        ) );

        // CTA 2 - Link Text
        $wp_customize->add_setting( 'ares_cta2_button_text', array(
            'default'               => __( 'Click Here', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta2_button_text', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 2 - Link Text', 'juno' ),
        ) );
    
        // CTA 3 - Icon
        $wp_customize->add_setting( 'ares_cta3_icon', array(
            'default' => 'fa fa-leaf',
            'transport' => 'refresh',
            'sanitize_callback' => 'ares_sanitize_icon'
        ));
        $wp_customize->add_control( 'ares_cta3_icon', array(
            'label' => __('CTA 3 - Icon', 'athena'),
            'section' => 'ares_cta_trio_section',
            'type' => 'select',
            'choices' => ares_icons()
        ));
        
        // CTA 3 - Title
        $wp_customize->add_setting( 'ares_cta3_title', array(
            'default'               => __( 'Elegant Design', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta3_title', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 3 - Title', 'juno' ),
        ) );
        
        // CTA 3 - Tagline
        $wp_customize->add_setting( 'ares_cta3_text', array(
            'default'               => __( 'Beautiful design to give your site an elegant look', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta3_text', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 3 - Tagline', 'juno' ),
        ) );
        
        // CTA 3 - URL
        $wp_customize->add_setting( 'ares_cta3_url', array(
            'default'               => '',
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta3_url', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 3 - Link/URL', 'juno' ),
        ) );

        // CTA 3 - Link Text
        $wp_customize->add_setting( 'ares_cta3_button_text', array(
            'default'               => __( 'Click Here', 'ares' ),
            'transport'             => 'refresh',
            'sanitize_callback'     => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'ares_cta3_button_text', array(
            'type'                  => 'text',
            'section'               => 'ares_cta_trio_section',
            'label'                 => __( 'CTA 3 - Link Text', 'juno' ),
        ) );
    
    // ---------------------------------------------
    // Frontpage Content
    // ---------------------------------------------
    $wp_customize->add_section( 'ares_frontpage_content_section', array(
        'title'                 => __( 'Frontpage Content', 'ares'),
        'description'           => __( 'Customize visibility of the content (latest posts/static page) for the frontpage', 'ares' ),
        'panel'                 => 'ares_frontpage_panel'
    ) );
    
        // Show / Hide the Homepage Content?
        $wp_customize->add_setting( 'ares_frontpage_content_bool', array(
            'default'               => 'show',
            'transport'             => 'refresh',
            'sanitize_callback'     => 'ares_sanitize_show_hide'
        ) );
        $wp_customize->add_control( 'ares_frontpage_content_bool', array(
            'label'   => __( 'Show or hide the homepage content?', 'zeal' ),
            'section' => 'ares_frontpage_content_section',
            'type'    => 'radio',
            'choices'    => array(
                'show'  => __( 'Show', 'ares' ),
                'hide'  => __( 'Hide', 'ares' ),
            )
        ));