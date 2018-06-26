<?php
/**
 * @package builder lite
 */


/**
 * Builder Lite Header Style 1
 */
if (!function_exists('builder_lite_header_style')) :
    function builder_lite_header_style()
    {
        $class = '';
        if (!is_front_page() || is_home()) {

            $class = 'no-banner';
        }
        ?>
        <header id="home-inner" class="menu-wrapper elementor-menu-anchor <?php echo $class; ?>">
            <div class="container">
                <!-- ============================ Theme Menu ========================= -->
                <div class="navbar-header">
                    <?php
                    if (has_custom_logo()) {
                        builder_lite_the_custom_logo();
                    }
                    ?>
                    <?php
                    $alt_logo = esc_url(get_theme_mod('bul_alt_log_for_mobile'));
                    if (!empty($alt_logo)) {
                        ?>
                        <a id="logo-alt" class="logo-alt" href="<?php echo esc_url(home_url()); ?>"><img
                                    src="<?php echo esc_url(get_theme_mod('bul_alt_log_for_mobile')); ?>"
                                    alt="logo"></a>
                        <?php
                    }
                    ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>"
                           rel="home"><?php bloginfo('name'); ?></a>
                    </h1>
                    <?php
                    $description = esc_attr(get_bloginfo('description', 'display'));
                    if (($description || is_customize_preview()) && !(has_custom_logo())) {

                        ?>
                        <p class="site-description"><?php echo $description; ?></p>
                        <?php
                    }
                    ?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only"><?php _e('Toggle navigation', 'builder-lite'); ?></span>
                        <i class="fa fa-bars fa-1x"></i>
                    </button>
                </div>
                <div class="res-menu hidden-sm hidden-md hidden-lg">
                    <div class="navbar-collapse collapse">
                        <?php
                        wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'depth' => 2,
                                'container' => 'ul',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_class' => 'nav',
                                'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                                'walker' => new wp_bootstrap_navwalker()
                            )
                        );
                        ?>
                    </div>
                </div>
                <nav class="main-menu hidden-xs">
                    <?php
                    wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'depth' => 3,
                            'container' => 'ul',
                            'container_class' => '',
                            'container_id' => '',
                            'menu_class' => 'nav',
                            'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                            'walker' => new wp_bootstrap_navwalker()
                        )
                    );
                    ?>
                </nav>
            </div>
        </header>
        <?php
    }
endif;


add_action('builder_lite_action_header', 'builder_lite_header_style');



