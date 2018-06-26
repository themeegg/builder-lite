<?php
// Page settings
$wp_customize->add_section(
    'builder_lite_page_settings',
    array(
        'priority' => 25,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Page Settings', 'builder-lite')
    )
);

// Background selection
$wp_customize->add_setting(
    'bul_page_bg_radio',
    array(
        'type' => 'theme_mod',
        'default' => 'color',
        'sanitize_callback' => 'builder_lite_sanitize_radio_pagebg_selection'
    )
);

$wp_customize->add_control(
    'bul_page_bg_radio',
    array(
        'settings' => 'bul_page_bg_radio',
        'section' => 'builder_lite_page_settings',
        'type' => 'radio',
        'label' => __('Choose Page Title Background Color or Background Image:', 'builder-lite'),
        'description' => __('This setting will change the background of the page title area.', 'builder-lite'),
        'choices' => array(
            'color' => __('Background Color', 'builder-lite'),
            'image' => __('Background Image', 'builder-lite'),
        ),
    )
);

// Background color
$wp_customize->add_setting(
    'bul_page_bg_color',
    array(
        'type' => 'theme_mod',
        'default' => '#555555',
        'sanitize_callback' => 'sanitize_hex_color'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'bul_page_bg_color',
        array(
            'label' => __('Select Background Color', 'builder-lite'),
            'description' => __('This setting will add background color to the page title area if Background Color was selected above.', 'builder-lite'),
            'section' => 'builder_lite_page_settings',
            'settings' => 'bul_page_bg_color',
        ))
);

// Background Image
$wp_customize->add_setting(
    'bul_page_bg_image',
    array(
        'type' => 'theme_mod',
        'sanitize_callback' => 'builder_lite_sanitize_image'
    )
);

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'bul_page_bg_image',
        array(
            'settings' => 'bul_page_bg_image',
            'section' => 'builder_lite_page_settings',
            'label' => __('Select Background Image for Page', 'builder-lite'),
            'description' => __('This setting will add background image to the page title area if Background Image was selected above.', 'builder-lite'),
        )
    )
);

// Parallax Scroll for background image
$wp_customize->add_setting(
    'bul_page_bg_parallax',
    array(
        'type' => 'theme_mod',
        'default' => true,
        'sanitize_callback' => 'builder_lite_sanitize_checkbox_selection'
    )
);

$wp_customize->add_control(
    'bul_page_bg_parallax',
    array(
        'settings' => 'bul_page_bg_parallax',
        'section' => 'builder_lite_page_settings',
        'type' => 'checkbox',
        'label' => __('Enable Parallax Scroll:', 'builder-lite'),
        'description' => __('Choose whether to show a parallax scroll feature for the Page Background image', 'builder-lite'),
    )
);

// Enable Dark Overlay
$wp_customize->add_setting(
    'bul_page_dark_overlay',
    array(
        'type' => 'theme_mod',
        'default' => false,
        'sanitize_callback' => 'builder_lite_sanitize_checkbox_selection'
    )
);

$wp_customize->add_control(
    'bul_page_dark_overlay',
    array(
        'settings' => 'bul_page_dark_overlay',
        'section' => 'builder_lite_page_settings',
        'type' => 'checkbox',
        'label' => __('Enable Dark Overlay:', 'builder-lite'),
        'description' => __('Choose whether to show a dark overlay over page header background', 'builder-lite'),
    )
);

// page title height from top //
$wp_customize->add_setting(
    'bul_pagetitle_hft',
    array(
        'type' => 'theme_mod',
        'default' => '125',
        'sanitize_callback' => 'absint'
    )
);

$wp_customize->add_control(
    'bul_pagetitle_hft',
    array(
        'settings' => 'bul_pagetitle_hft',
        'section' => 'builder_lite_page_settings',
        'type' => 'textbox',
        'label' => __('Page Title Height from Top(px)', 'builder-lite'),
        'description' => __('This will add top padding to the page title. Do not write px or em', 'builder-lite'),
    )
);

// page title height from bottom //
$wp_customize->add_setting(
    'bul_pagetitle_hfb',
    array(
        'type' => 'theme_mod',
        'default' => '125',
        'sanitize_callback' => 'absint'
    )
);

$wp_customize->add_control(
    'bul_pagetitle_hfb',
    array(
        'settings' => 'bul_pagetitle_hfb',
        'section' => 'builder_lite_page_settings',
        'type' => 'textbox',
        'label' => __('Page Title Height from Bottom(px)', 'builder-lite'),
        'description' => __('This will add bottom padding to the page title. Do not write px or em', 'builder-lite'),
    )
);
