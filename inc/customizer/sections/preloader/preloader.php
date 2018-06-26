<?php

// Preloader Settings
$wp_customize->add_section(
    'builder_lite_preloader_settings',
    array(
        'priority' => 25,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Preloader Settings', 'builder-lite')
    )
);

// Preloader Enable radio button
$wp_customize->add_setting(
    'bul_preloader_display',
    array(
        'type' => 'theme_mod',
        'default' => true,
        'sanitize_callback' => 'builder_lite_sanitize_checkbox_selection'
    )
);

$wp_customize->add_control(
    'bul_preloader_display',
    array(
        'settings' => 'bul_preloader_display',
        'section' => 'builder_lite_preloader_settings',
        'type' => 'checkbox',
        'label' => __('Enable Preloader for site:', 'builder-lite'),
        'description' => __('Choose whether to show a preloader before a site opens', 'builder-lite'),
    )
);

// Image for preloader
$wp_customize->add_setting(
    'bul_preloader_image',
    array(
        'type' => 'theme_mod',
        'sanitize_callback' => 'builder_lite_sanitize_image'
    )
);

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'bul_preloader_image',
        array(
            'settings' => 'bul_preloader_image',
            'section' => 'builder_lite_preloader_settings',
            'label' => __('Preloader Image', 'builder-lite'),
            'description' => __('Upload image for preloader', 'builder-lite')
        )
    )
);