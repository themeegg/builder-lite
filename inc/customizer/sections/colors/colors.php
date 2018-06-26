<?php
// Footer background color
$wp_customize->add_setting(
    'bul_footer_bg_color',
    array(
        'type' => 'theme_mod',
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'bul_footer_bg_color',
        array(
            'label' => __('Footer Background Color', 'builder-lite'),
            'section' => 'colors',
            'settings' => 'bul_footer_bg_color',
        ))
);


// Footer Content Color
$wp_customize->add_setting(
    'bul_footer_content_color',
    array(
        'type' => 'theme_mod',
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'bul_footer_content_color',
        array(
            'label' => __('Footer Content Color', 'builder-lite'),
            'section' => 'colors',
            'settings' => 'bul_footer_content_color',
        ))
);

// Footer links Color
$wp_customize->add_setting(
    'bul_footer_links_color',
    array(
        'type' => 'theme_mod',
        'default' => '#b3b3b3',
        'sanitize_callback' => 'sanitize_hex_color'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'bul_footer_links_color',
        array(
            'label' => __('Footer Links Color', 'builder-lite'),
            'section' => 'colors',
            'settings' => 'bul_footer_links_color',
        ))
);