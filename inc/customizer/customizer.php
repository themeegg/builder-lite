<?php
/**
 * Builder Lite Theme Customizer
 *
 * @package builder lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

if (!function_exists('builder_lite_customize_register')) :

    function builder_lite_customize_register($wp_customize)
    {
        require get_template_directory() . '/inc/customizer/sections/colors/colors.php';

        require get_template_directory() . '/inc/customizer/sections/banner/banner.php';

        require get_template_directory() . '/inc/customizer/sections/header/header.php';

        require get_template_directory() . '/inc/customizer/sections/page/page.php';

        require get_template_directory() . '/inc/customizer/sections/blog/blog.php';

        require get_template_directory() . '/inc/customizer/sections/footer/footer.php';

        require get_template_directory() . '/inc/customizer/sections/preloader/preloader.php';


    }
endif;

add_action('customize_register', 'builder_lite_customize_register');

require get_template_directory() . '/inc/customizer/customizer-sanatize.php';