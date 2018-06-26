<?php
// Banner Settings
$wp_customize->add_section(
    'builder_lite_general_settings',
    array(
        'priority' => 25,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Banner Settings', 'builder-lite')
    )
);

// Background selection
$wp_customize->add_setting(
    'bul_home_background_radio',
    array(
        'type' => 'theme_mod',
        'default' => 'image',
        'sanitize_callback' => 'builder_lite_sanitize_radio_pagebg_selection'
    )
);

$wp_customize->add_control(
    'bul_home_background_radio',
    array(
        'settings' => 'bul_home_background_radio',
        'section' => 'builder_lite_general_settings',
        'type' => 'radio',
        'label' => __('Choose Home Background Color or Background Image:', 'builder-lite'),
        'description' => __('This setting will change the Home background area.', 'builder-lite'),
        'choices' => array(
            'color' => __('Background Color', 'builder-lite'),
            'image' => __('Background Image', 'builder-lite'),
        ),
    )
);

// Background color
$wp_customize->add_setting(
    'bul_home_background_color',
    array(
        'type' => 'theme_mod',
        'default' => '#555555',
        'sanitize_callback' => 'sanitize_hex_color'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'bul_home_background_color',
        array(
            'label' => __('Select Background Color', 'builder-lite'),
            'description' => __('This setting will add background color if Background Color was selected above.', 'builder-lite'),
            'section' => 'builder_lite_general_settings',
            'settings' => 'bul_home_background_color',
        ))
);

// Home Background Image
$wp_customize->add_setting(
    'bul_theme_home_background_image',
    array(
        'type' => 'theme_mod',
        'sanitize_callback' => 'builder_lite_sanitize_image'
    )
);

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'bul_theme_home_background_image',
        array(
            'settings' => 'bul_theme_home_background_image',
            'section' => 'builder_lite_general_settings',
            'label' => __('Home Background Image', 'builder-lite'),
            'description' => __('This setting will add background image if Background Image was selected above.', 'builder-lite')
        )
    )
);

// Home Section Heading text
$wp_customize->add_setting(
    'bul_home_heading_text',
    array(
        'default' => __('ENTER YOUR HEADING HERE', 'builder-lite'),
        'sanitize_callback' => 'builder_lite_sanitize_textarea',
        'transport' => 'postMessage',
    )
);

$wp_customize->add_control(
    'bul_home_heading_text',
    array(
        'settings' => 'bul_home_heading_text',
        'section' => 'builder_lite_general_settings',
        'type' => 'textarea',
        'label' => __('Heading Text', 'builder-lite'),
        'description' => __('heading for the home section', 'builder-lite'),
    )
);

$wp_customize->selective_refresh->add_partial('bul_home_heading_text', array(
    'selector' => '.slide-bg-section h1',
    'settings' => 'bul_home_heading_text',
    'render_callback' => 'builder_lite_home_heading_text_render_callback',
    'fallback_refresh' => false,
));

// Home Section SubHeading text
$wp_customize->add_setting(
    'bul_home_subheading_text',
    array(
        'default' => __('ENTER YOUR SUBHEADING HERE', 'builder-lite'),
        'sanitize_callback' => 'builder_lite_sanitize_textarea',
        'transport' => 'postMessage',
    )
);

$wp_customize->add_control(
    'bul_home_subheading_text',
    array(
        'settings' => 'bul_home_subheading_text',
        'section' => 'builder_lite_general_settings',
        'type' => 'textarea',
        'label' => __('SubHeading Text', 'builder-lite'),
        'description' => __('Subheading for the home section', 'builder-lite'),
    )
);

$wp_customize->selective_refresh->add_partial('bul_home_subheading_text', array(
    'selector' => '.slide-bg-section p',
    'settings' => 'bul_home_subheading_text',
    'render_callback' => 'builder_lite_home_subheading_text_render_callback',
    'fallback_refresh' => false,
));

// Home Section Button text
$wp_customize->add_setting(
    'bul_home_button_text',
    array(
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'builder_lite_sanitize_html',

    )
);

$wp_customize->add_control(
    'bul_home_button_text',
    array(
        'settings' => 'bul_home_button_text',
        'section' => 'builder_lite_general_settings',
        'type' => 'textbox',
        'label' => __('Button Text', 'builder-lite'),
        'description' => __('Button text for the home section', 'builder-lite'),
    )
);


// Home Section Button url
$wp_customize->add_setting(
    'bul_home_button_url',
    array(
        'type' => 'theme_mod',
        'default' => '',
        'sanitize_callback' => 'builder_lite_sanitize_url'
    )
);

$wp_customize->add_control(
    'bul_home_button_url',
    array(
        'settings' => 'bul_home_button_url',
        'section' => 'builder_lite_general_settings',
        'type' => 'textbox',
        'label' => __('Button URL', 'builder-lite'),
        'description' => __('Button URL for the home section, you can paste youtube or vimeo video url also', 'builder-lite'),
    )
);
// Parallax Scroll for background image
$wp_customize->add_setting(
    'bul_home_parallax',
    array(
        'type' => 'theme_mod',
        'default' => true,
        'sanitize_callback' => 'builder_lite_sanitize_checkbox_selection'
    )
);

$wp_customize->add_control(
    'bul_home_parallax',
    array(
        'settings' => 'bul_home_parallax',
        'section' => 'builder_lite_general_settings',
        'type' => 'checkbox',
        'label' => __('Enable Parallax Scroll:', 'builder-lite'),
        'description' => __('Choose whether to show a parallax scroll feature for the Home Background image', 'builder-lite'),
    )
);

// Enable Dark Overlay
$wp_customize->add_setting(
    'bul_home_dark_overlay',
    array(
        'type' => 'theme_mod',
        'default' => true,
        'sanitize_callback' => 'builder_lite_sanitize_checkbox_selection'
    )
);

$wp_customize->add_control(
    'bul_home_dark_overlay',
    array(
        'settings' => 'bul_home_dark_overlay',
        'section' => 'builder_lite_general_settings',
        'type' => 'checkbox',
        'label' => __('Enable Dark Overlay:', 'builder-lite'),
        'description' => __('Choose whether to show a dark overlay over background image', 'builder-lite'),
    )
);

// Blog Homepage
$wp_customize->add_setting(
    'bul_blog_homepage',
    array(
        'type' => 'theme_mod',
        'default' => false,
        'sanitize_callback' => 'builder_lite_sanitize_checkbox_selection'
    )
);

$wp_customize->add_control(
    'bul_blog_homepage',
    array(
        'settings' => 'bul_blog_homepage',
        'section' => 'builder_lite_general_settings',
        'type' => 'checkbox',
        'label' => __('Use this for Blog Homepage:', 'builder-lite'),
        'description' => __('Check this if you are having a Blog as front page', 'builder-lite'),
    )
);
