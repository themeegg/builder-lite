<?php
require_once get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

/**
 *plugins Required
 */
add_action('tgmpa_register', 'builder_lite_register_required_plugins');

function builder_lite_register_required_plugins()
{

    $plugins = array(
        array(
            'name' => esc_html__('Contact Form 7', 'builder-lite'),
            'slug' => 'contact-form-7',
            'source' => '',
            'required' => false,
            'force_activation' => false,
        ),
        array(
            'name' => esc_html__('Elementor Page Builder', 'builder-lite'),
            'slug' => 'elementor',
            'source' => '',
            'required' => false,
            'force_activation' => false,
        ), array(
            'name' => esc_html__('Themeegg ToolKit', 'builder-lite'),
            'slug' => 'themeegg-toolkit',
            'source' => '',
            'required' => false,
            'force_activation' => false,
        ),

    );

    $config = array(
        'id' => 'builder-lite',
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => false,
        'message' => '',
        'strings' => array()
    );

    tgmpa($plugins, $config);

}