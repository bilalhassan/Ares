<?php

// ---------------------------------------------
// Frontpage - Customizer Panel
// ---------------------------------------------
$wp_customize->add_panel( 'ares_frontpage_panel', array(
    'title'                 => __( 'Frontpage', 'ares' ),
    'description'           => __( 'Customize the appearance of your site homepage', 'ares' ),
    'priority'              => 10
) );
