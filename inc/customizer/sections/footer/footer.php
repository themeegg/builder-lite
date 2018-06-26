<?php
//Footer Settings
$wp_customize->add_section(
    'builder_lite_footer_settings',
    array(
        'priority' => 25,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Footer Settings', 'builder-lite')
    )
);

// Copyright text
$wp_customize->add_setting(
    'bul_copyright_text',
    array(
        'type' => 'theme_mod',
        'default' => __('Copyrights 2017 builder lite. All Rights Reserved', 'builder-lite'),
        'sanitize_callback' => 'builder_lite_sanitize_textarea'
    )
);

$wp_customize->add_control(
    'bul_copyright_text',
    array(
        'settings' => 'bul_copyright_text',
        'section' => 'builder_lite_footer_settings',
        'type' => 'textarea',
        'label' => __('Footer copyright text', 'builder-lite'),
        'description' => __('Copyright text to be displayed in the footer. HTML allowed.', 'builder-lite')
    )
);

// Footer widgets
$wp_customize->add_setting(
    'bul_footer_widgets',
    array(
        'type' => 'theme_mod',
        'default' => '4',
        'sanitize_callback' => 'builder_lite_sanitize_footer_widgets_radio_selection'
    )
);

$wp_customize->add_control(
    'bul_footer_widgets',
    array(
        'settings' => 'bul_footer_widgets',
        'section' => 'builder_lite_footer_settings',
        'type' => 'radio',
        'label' => __('Number of Footer Widgets:', 'builder-lite'),
        'description' => '',
        'choices' => array(
            '3' => __('3', 'builder-lite'),
            '4' => __('4', 'builder-lite'),
        ),
    )
);

