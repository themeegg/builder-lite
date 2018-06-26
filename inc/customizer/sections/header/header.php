<?php
//Header Settings
$wp_customize->add_section(
    'builder_lite_sticky_header_settings',
    array(
        'priority' => 25,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Header Settings', 'builder-lite')
    )
);
$wp_customize->add_setting(
    'bul_sticky_menu',
    array(
        'type' => 'theme_mod',
        'default' => true,
        'sanitize_callback' => 'builder_lite_sanitize_checkbox_selection'
    )
);

$wp_customize->add_control(
    'bul_sticky_menu',
    array(
        'settings' => 'bul_sticky_menu',
        'section' => 'builder_lite_sticky_header_settings',
        'type' => 'checkbox',
        'label' => __('Enable Sticky Header Feature:', 'builder-lite'),
        'description' => __('Choose whether to enable a sticky header feature for the site', 'builder-lite'),
    )
);

// Mobile logo
$wp_customize->add_setting(
    'bul_alt_log_for_mobile',
    array(
        'type' => 'theme_mod',
        'sanitize_callback' => 'builder_lite_sanitize_image'
    )
);

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'bul_alt_log_for_mobile',
        array(
            'settings' => 'bul_alt_log_for_mobile',
            'section' => 'builder_lite_sticky_header_settings',
            'label' => __('Logo for Sticky Header', 'builder-lite'),
            'description' => __('Upload logo for Sticky Header. This will used for mobile version of the theme. Recommended height is 45px', 'builder-lite')
        )
    )
);
