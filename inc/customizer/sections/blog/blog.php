<?php

//Blog Settings
$wp_customize->add_section(
    'builder_lite_blog_settings',
    array(
        'priority' => 25,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Blog Settings', 'builder-lite')
    )
);

// Blog Sidebar
$wp_customize->add_setting(
    'bul_blog_sidebar',
    array(
        'type' => 'theme_mod',
        'default' => 'right',
        'sanitize_callback' => 'builder_lite_sanitize_blog_sidebar_radio_selection'
    )
);

$wp_customize->add_control(
    'bul_blog_sidebar',
    array(
        'settings' => 'bul_blog_sidebar',
        'section' => 'builder_lite_blog_settings',
        'type' => 'radio',
        'label' => __('Select sidebar position:', 'builder-lite'),
        'description' => '',
        'choices' => array(
            'right' => __('Right', 'builder-lite'),
            'left' => __('Left', 'builder-lite'),
            'no-sidebar' => __('No Sidebar', 'builder-lite'),

        ),
    )
);
/**
 * post listing style
 *
 * @since 1.1.0
 */
$wp_customize->add_setting(
    'bul_blog_listing_style',
    array(
        'type' => 'theme_mod',
        'default' => 'list',
        'sanitize_callback' => 'builder_lite_sanitize_blog_sidebar_radio_selection'
    )
);

$wp_customize->add_control(
    'bul_blog_listing_style',
    array(
        'settings' => 'bul_blog_listing_style',
        'section' => 'builder_lite_blog_settings',
        'type' => 'radio',
        'label' => __('Select Post Listing Style in Blog Page', 'builder-lite'),
        'description' => '',
        'choices' => array(
            'list' => __('List', 'builder-lite'),
            'grid' => __('Grid', 'builder-lite'),
        ),
    )
);