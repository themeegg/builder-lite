<?php
// Banner Settings
if(!function_exists('bul_enable_banner')){
    function bul_enable_banner(){
        $disable_banner = get_theme_mod('bul_disable_banner');
        $is_enable_banner = ($disable_banner) ? false : true;
        return $is_enable_banner;
    }
}
if(!function_exists('bul_enable_navigation_color')){
    function bul_enable_navigation_color(){
        $enable_banner_color = get_theme_mod('bul_disable_banner');
        $is_enable_banner_color = ($enable_banner_color) ? true : false;
        return $is_enable_banner_color;
    }
}

$wp_customize->add_section(
    'builder_lite_general_settings',
    array(
        'priority' => 25,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Banner Settings', 'builder-lite')
    )
);
$wp_customize->add_setting(
    'bul_disable_banner',
    array(
        'type' => 'theme_mod',
        'default' => false,
        'sanitize_callback' => 'builder_lite_sanitize_checkbox_selection'
    )
);
/**
 * banner enable/disable
 *
 * @since 1.1.0
 */
$wp_customize->add_control(
    'bul_disable_banner',
    array(
        'settings' => 'bul_disable_banner',
        'section' => 'builder_lite_general_settings',
        'type' => 'checkbox',
        'label' => __('Disable Banner', 'builder-lite'),
        'description' => __('Disable the banner section for builder lite', 'builder-lite'),
    )
);
$wp_customize->add_setting(
    'bul_navigation_background_color',
    array(
        'type' => 'theme_mod',
        'default' => '#274bad',
        'sanitize_callback' => 'sanitize_hex_color'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'bul_navigation_background_color',
        array(
            'label' => __('Select Background Color', 'builder-lite'),
            'description' => __('This setting will add background color for navigatoin bar while banner is disabled', 'builder-lite'),
            'section' => 'builder_lite_general_settings',
            'settings' => 'bul_navigation_background_color',
            'active_callback' => 'bul_enable_navigation_color',
        ))
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
        'label' => __('Choose Home Background Color, Background Image or js particles:', 'builder-lite'),
        'description' => __('This setting will change the Home background area.', 'builder-lite'),
        'choices' => array(
            'color' => __('Background Color', 'builder-lite'),
            'image' => __('Background Image', 'builder-lite'),
            'jsparticles' => __('Banner Animation', 'builder-lite'),

        ),
        'active_callback' => 'bul_enable_banner',

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
            'description' => __('This setting will add background color for both background color and banner animation option.', 'builder-lite'),
            'section' => 'builder_lite_general_settings',
            'settings' => 'bul_home_background_color',
            'active_callback' => 'bul_enable_banner',

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
            'description' => __('This setting will add background image if Background Image was selected above.', 'builder-lite'),
            'active_callback' => 'bul_enable_banner',
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
        'active_callback' => 'bul_enable_banner',
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
        'active_callback' => 'bul_enable_banner',
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
        'active_callback' => 'bul_enable_banner',
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
        'active_callback' => 'bul_enable_banner',
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
        'active_callback' => 'bul_enable_banner',
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
        'active_callback' => 'bul_enable_banner',
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
        'active_callback' => 'bul_enable_banner',
    )
);
