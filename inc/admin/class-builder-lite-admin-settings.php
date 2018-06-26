<?php
/**
 * Admin settings helper
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     BuilderLite
 * @author      Themeegg
 * @copyright   Copyright (c) 2018, Themeegg
 * @link        https://themeegg.com/
 * @since       Builder Lite 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Builder_Lite_Admin_Settings')) {

    /**
     * Builder Lite Admin Settings
     */
    class Builder_Lite_Admin_Settings
    {

        /**
         * View all actions
         *
         * @since 1.0
         * @var array $view_actions
         */
        static public $view_actions = array();

        /**
         * Menu page title
         *
         * @since 1.0.0
         * @var array $menu_page_title
         */
        static public $menu_page_title = 'Builder Lite Theme';

        /**
         * Page title
         *
         * @since 1.0.0
         * @var array $page_title
         */
        static public $page_title = 'Builder Lite';

        /**
         * Plugin slug
         *
         * @since 1.0.0
         * @var array $plugin_slug
         */
        static public $plugin_slug = 'builder-lite';

        /**
         * Default Menu position
         *
         * @since 1.0.0
         * @var array $default_menu_position
         */
        static public $default_menu_position = 'themes.php';

        /**
         * Parent Page Slug
         *
         * @since 1.0.0
         * @var array $parent_page_slug
         */
        static public $parent_page_slug = 'general';

        /**
         * Current Slug
         *
         * @since 1.0
         * @var array $current_slug
         */
        static public $current_slug = 'general';

        /**
         * Constructor
         */
        function __construct()
        {

            if (!is_admin()) {
                return;
            }

            add_action('after_setup_theme', __CLASS__ . '::init_admin_settings', 99);
        }

        /**
         * Admin settings init
         */
        static public function init_admin_settings()
        {
            self::$menu_page_title = apply_filters('builder_lite_menu_page_title', __('Builder Lite Options', 'builder-lite'));

            self::$page_title = apply_filters('builder_lite_page_title', __('Builder Lite', 'builder-lite'));

            if (isset($_REQUEST['page']) && strpos($_REQUEST['page'], self::$plugin_slug) !== false) {

                add_action('admin_enqueue_scripts', __CLASS__ . '::styles_scripts');

                // Let extensions hook into saving.
                do_action('builder_lite_admin_settings_scripts');

                self::save_settings();
            }

            add_action('admin_enqueue_scripts', __CLASS__ . '::admin_scripts');

            add_action('customize_controls_enqueue_scripts', __CLASS__ . '::customizer_scripts');

            add_action('admin_menu', __CLASS__ . '::add_admin_menu', 99);

            add_action('builder_lite_menu_general_action', __CLASS__ . '::general_page');

            add_action('builder_lite_header_right_section', __CLASS__ . '::top_header_right_section');

            add_filter('admin_title', __CLASS__ . '::builder_lite_admin_title', 10, 2);

            add_action('builder_lite_welcome_page_right_sidebar_content', __CLASS__ . '::builder_lite_welcome_page_starter_sites_section', 10);

            add_action('builder_lite_welcome_page_right_sidebar_content', __CLASS__ . '::builder_lite_welcome_page_documentation_section', 11);

            add_action('builder_lite_welcome_page_right_sidebar_content', __CLASS__ . '::builder_lite_welcome_page_community_section', 12);

            add_action('builder_lite_welcome_page_right_sidebar_content', __CLASS__ . '::builder_lite_welcome_page_support_forum_section', 13);

            add_action('builder_lite_welcome_page_right_sidebar_content', __CLASS__ . '::builder_lite_welcome_page_rate_theme_section', 14);

            add_action('builder_lite_welcome_page_content', __CLASS__ . '::builder_lite_welcome_page_content');

            // AJAX.
            add_action('wp_ajax_themeegg-toolkit-plugin-activate', __CLASS__ . '::required_plugin_activate');
        }

        /**
         * View actions
         */
        static public function get_view_actions()
        {

            if (empty(self::$view_actions)) {

                $actions = array(
                    'general' => array(
                        'label' => __('Welcome', 'builder-lite'),
                        'show' => !is_network_admin(),
                    ),
                );
                self::$view_actions = apply_filters('builder_lite_menu_options', $actions);
            }

            return self::$view_actions;
        }

        /**
         * Save All admin settings here
         */
        static public function save_settings()
        {

            // Only admins can save settings.
            if (!current_user_can('manage_options')) {
                return;
            }

            // Let extensions hook into saving.
            do_action('builder_lite_admin_settings_save');
        }

        /**
         * Load the scripts and styles in the customizer controls.
         *
         * @since 1.2.1
         */
        static public function customizer_scripts()
        {
            $color_palettes = json_encode(builder_lite_color_palette());
            wp_add_inline_script('wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $color_palettes . ';');
        }

        /**
         * Enqueues the needed CSS/JS for Backend.
         *
         * @since 1.0
         */
        static public function admin_scripts($hook)
        {

            if ($hook !== 'appearance_page_builder-lite') {
                return;
            }
            // Styles.
            wp_enqueue_style('builder-lite-admin', BUILDER_LITE_THEME_URI . 'inc/admin/assets/css/builder-lite-admin.css', array(), BUILDER_LITE_THEME_VERSION);

            /* Directory and Extension */
            $file_prefix = (SCRIPT_DEBUG) ? '' : '.min';
            $dir_name = (SCRIPT_DEBUG) ? 'unminified' : 'minified';

            $assets_js_uri = BUILDER_LITE_THEME_URI . 'assets/js/' . $dir_name . '/';

            wp_enqueue_script('builder-lite-color-alpha', $assets_js_uri . 'wp-color-picker-alpha' . $file_prefix . '.js', array('jquery', 'customize-base', 'wp-color-picker'), BUILDER_LITE_THEME_VERSION, true);
        }

        /**
         * Enqueues the needed CSS/JS for the builder's admin settings page.
         *
         * @since 1.0
         */
        static public function styles_scripts()
        {

            // Styles.
            wp_enqueue_style('builder-lite-admin-settings', BUILDER_LITE_THEME_URI . 'inc/admin/assets/css/builder-lite-admin-menu-settings.css', array(), BUILDER_LITE_THEME_VERSION);
            // Script.
            wp_enqueue_script('builder-lite-admin-settings', BUILDER_LITE_THEME_URI . 'inc/admin/assets/js/builder-lite-admin-menu-settings.js', array('jquery', 'wp-util', 'updates'), BUILDER_LITE_THEME_VERSION);

            $localize = array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'btnActivating' => __('Activating Importer Plugin ', 'builder-lite') . '&hellip;',
                'builderLiteSitesLink' => admin_url('themes.php?page=themeegg-toolkit'),
                'builderLiteSitesLinkTitle' => __('See Library', 'builder-lite'),
            );
            wp_localize_script('builder-lite-admin-settings', 'builder_lite', apply_filters('builder_lite_theme_js_localize', $localize));
        }

        /**
         * Update Admin Title.
         *
         * @since 1.0.19
         *
         * @param string $admin_title Admin Title.
         * @param string $title Title.
         * @return string
         */
        static public function builder_lite_admin_title($admin_title, $title)
        {

            $screen = get_current_screen();
            if ('appearance_page_builder_lite' == $screen->id) {

                $view_actions = self::get_view_actions();

                $current_slug = isset($_GET['action']) ? esc_attr($_GET['action']) : self::$current_slug;
                $active_tab = str_replace('_', '-', $current_slug);

                if ('general' != $active_tab && isset($view_actions[$active_tab]['label'])) {
                    $admin_title = str_replace($title, $view_actions[$active_tab]['label'], $admin_title);
                }
            }

            return $admin_title;
        }


        /**
         * Get and return page URL
         *
         * @param string $menu_slug Menu name.
         * @since 1.0
         * @return  string page url
         */
        static public function get_page_url($menu_slug)
        {

            $parent_page = self::$default_menu_position;

            if (strpos($parent_page, '?') !== false) {
                $query_var = '&page=' . self::$plugin_slug;
            } else {
                $query_var = '?page=' . self::$plugin_slug;
            }

            $parent_page_url = admin_url($parent_page . $query_var);

            $url = $parent_page_url . '&action=' . $menu_slug;

            return esc_url($url);
        }

        /**
         * Add main menu
         *
         * @since 1.0
         */
        static public function add_admin_menu()
        {

            $parent_page = self::$default_menu_position;
            $page_title = self::$menu_page_title;
            $capability = 'manage_options';
            $page_menu_slug = self::$plugin_slug;
            $page_menu_func = __CLASS__ . '::menu_callback';

            if (apply_filters('builder_lite_dashboard_admin_menu', true)) {
                add_theme_page($page_title, $page_title, $capability, $page_menu_slug, $page_menu_func);
            } else {
                do_action('builder_lite_register_admin_menu', $parent_page, $page_title, $capability, $page_menu_slug, $page_menu_func);
            }
        }

        /**
         * Menu callback
         *
         * @since 1.0
         */
        static public function menu_callback()
        {

            $current_slug = isset($_GET['action']) ? esc_attr($_GET['action']) : self::$current_slug;

            $active_tab = str_replace('_', '-', $current_slug);
            $current_slug = str_replace('-', '_', $current_slug);

            $ast_icon = apply_filters('builder_lite_page_top_icon', true);
            $ast_visit_site_url = apply_filters('builder_lite_site_url', 'https://themeegg.com');
            $ast_wrapper_class = apply_filters('builder_lite_welcome_wrapper_class', array($current_slug));

            ?>
            <div class="bul-menu-page-wrapper wrap bul-clear <?php echo esc_attr(implode(' ', $ast_wrapper_class)); ?>">
                <div class="bul-theme-page-header">
                    <div class="bul-container bul-flex">
                        <div class="bul-theme-title">
                            <a href="<?php echo esc_url($ast_visit_site_url); ?>" target="_blank" rel="noopener">
                                <?php if ($ast_icon) { ?>
                                    <img src="<?php echo esc_url(BUILDER_LITE_THEME_URI . 'inc/admin/assets/images/builder-lite.png'); ?>"
                                         class="bul-theme-icon" alt="<?php echo esc_attr(self::$page_title); ?> ">
                                <?php } ?>
                                <?php do_action('builder_lite_welcome_page_header_title'); ?>
                            </a>
                        </div>

                        <?php do_action('builder_lite_header_right_section'); ?>

                    </div>
                </div>

                <?php do_action('builder_lite_menu_' . esc_attr($current_slug) . '_action'); ?>
            </div>
            <?php
        }

        /**
         * Include general page
         *
         * @since 1.0
         */
        static public function general_page()
        {
            require_once BUILDER_LITE_THEME_DIR . 'inc/admin/view-general.php';
        }

        /**
         * Include Welcome page right starter sites content
         *
         * @since 1.2.4
         */
        static public function builder_lite_welcome_page_starter_sites_section()
        {
            ?>

            <div class="postbox">
                <h2 class="hndle bul-normal-cusror">
                    <span class="dashicons dashicons-admin-customizer"></span>
                    <span><?php echo esc_html(apply_filters('builder_lite_sites_menu_page_title', __('Import Starter Site', 'builder-lite'))); ?></span>
                </h2>
                <div class="inside">
                    <p>
                        <?php
                        esc_html_e('Import your favorite site one click and start your project in style!', 'builder-lite');
                        ?>
                    </p>
                    <?php
                    // Builder Lite Sites - Installed but Inactive.
                    // Builder Lite Premium Sites - Inactive.
                    if (file_exists(WP_PLUGIN_DIR . '/themeegg-toolkit/themeegg-toolkit.php') && is_plugin_inactive('themeegg-toolkit/themeegg-toolkit.php')) {
                        $class = 'button bul-sites-inactive';
                        $button_text = __('Activate Importer Plugin', 'builder-lite');
                        $data_slug = 'themeegg-toolkit';
                        $data_init = '/themeegg-toolkit/themeegg-toolkit.php';

                        // Builder Lite Sites - Not Installed.
                        // Builder Lite Premium Sites - Inactive.
                    } elseif (!file_exists(WP_PLUGIN_DIR . '/themeegg-toolkit/themeegg-toolkit.php')) {

                        $class = 'button bul-sites-notinstalled';
                        $button_text = __('Install Importer Plugin', 'builder-lite');
                        $data_slug = 'themeegg-toolkit';
                        $data_init = '/themeegg-toolkit/themeegg-toolkit.php';

                        // Builder Lite Premium Sites - Active.
                    } else {
                        $class = 'active';
                        $button_text = __('See Demos', 'builder-lite');
                        $link = admin_url('themes.php?page=themeegg-toolkit');
                    }

                    printf(
                        '<a class="%1$s" %2$s %3$s %4$s> %5$s </a>',
                        esc_attr($class),
                        isset($link) ? 'href="' . esc_url($link) . '"' : '',
                        isset($data_slug) ? 'data-slug="' . esc_attr($data_slug) . '"' : '',
                        isset($data_init) ? 'data-init="' . esc_attr($data_init) . '"' : '',
                        esc_html($button_text)
                    );
                    ?>
                    <div>
                    </div>
                </div>
            </div>

            <?php
        }

        /**
         * Include Welcome page right side Documentation content
         *
         * @since 1.0.0
         */
        static public function builder_lite_welcome_page_documentation_section()
        {
            ?>

            <div class="postbox">
                <h2 class="hndle bul-normal-cusror">
                    <span class="dashicons dashicons-book"></span>
                    <span><?php esc_html_e('Documentation', 'builder-lite'); ?></span>
                </h2>
                <div class="inside">
                    <p>
                        <?php esc_html_e('Not sure how something works? Take a peek at the knowledge base and learn.', 'builder-lite'); ?>
                    </p>
                    <?php
                    $builder_lite_knowledge_base_doc_link = apply_filters('builder_lite_knowledge_base_documentation_link', builder_lite_get_pro_url('https://docs.themeegg.com/docs/builder-lite/', 'builder-lite-dashboard', 'visit-documentation', 'welcome-page'));
                    $builder_lite_knowledge_base_doc_link_text = apply_filters('builder_lite_knowledge_base_documentation_link_text', __('View Documentation', 'builder-lite'));

                    printf(
                    /* translators: %1$s: Builder Lite Knowledge doc link. */
                        '%1$s',
                        !empty($builder_lite_knowledge_base_doc_link) ? '<a href=' . esc_url($builder_lite_knowledge_base_doc_link) . ' target="_blank" rel="noopener">' . esc_html($builder_lite_knowledge_base_doc_link_text) . '</a>' :
                            esc_html($builder_lite_knowledge_base_doc_link_text)
                    );
                    ?>
                </div>
            </div>
            <?php
        }

        /**
         * Include Welcome page right side Builder Lite community content
         *
         * @since 1.2.4
         */
        static public function builder_lite_welcome_page_community_section()
        {
            ?>

            <div class="postbox">
                <h2 class="hndle bul-normal-cusror">
                    <span class="dashicons dashicons-groups"></span>
                    <span>
						<?php
                        printf(
                        /* translators: %1$s: Builder Lite Theme name. */
                            esc_html__('%1$s Community', 'builder-lite'),
                            self::$page_title
                        );
                        ?>
                </h2>
                <div class="inside">
                    <p>
                        <?php
                        printf(
                        /* translators: %1$s: Builder Lite Theme name. */
                            esc_html__('Join the community of super helpful %1$s users. Say hello, ask questions, give feedback and help each other!', 'builder-lite'),
                            self::$page_title
                        );
                        ?>
                    </p>
                    <?php
                    $builder_lite_community_group_link = apply_filters('builder_lite_community_group_link', 'https://www.facebook.com/groups/builderlite');
                    $builder_lite_community_group_link_text = apply_filters('builder_lite_community_group_link_text', __('Join Our Facebook Group', 'builder-lite'));

                    printf(
                    /* translators: %1$s: Builder Lite Knowledge doc link. */
                        '%1$s',
                        !empty($builder_lite_community_group_link) ? '<a href=' . esc_url($builder_lite_community_group_link) . ' target="_blank" rel="noopener">' . esc_html($builder_lite_community_group_link_text) . '</a>' :
                            esc_html($builder_lite_community_group_link_text)
                    );
                    ?>
                </div>
            </div>
            <?php
        }

        /**
         * Include Welcome page right side Support Forum
         *
         * @since 1.0.0
         */
        static public function builder_lite_welcome_page_support_forum_section()
        {
            ?>

            <div class="postbox">
                <h2 class="hndle bul-normal-cusror">
                    <span class="dashicons dashicons-sos"></span>
                    <span><?php esc_html_e('Support Forum', 'builder-lite'); ?></span>
                </h2>
                <div class="inside">
                    <p>
                        <?php
                        printf(
                        /* translators: %1$s: Builder Lite Theme name. */
                            esc_html__('Got a question? Get in touch with %1$s developers. We\'re happy to help!', 'builder-lite'),
                            self::$page_title
                        );
                        ?>
                    </p>
                    <?php
                    $builder_lite_support_link = apply_filters('builder_lite_support_link', builder_lite_get_pro_url('https://themeegg.com/support-forum/', 'builder-lite-dashboard', 'support-forum', 'welcome-page'));
                    $builder_lite_support_link_text = apply_filters('builder_lite_support_link_text', __('Support Forum', 'builder-lite'));

                    printf(
                    /* translators: %1$s: Builder Lite Knowledge doc link. */
                        '%1$s',
                        !empty($builder_lite_support_link) ? '<a href=' . esc_url($builder_lite_support_link) . ' target="_blank" rel="noopener">' . esc_html($builder_lite_support_link_text) . '</a>' :
                            esc_html($builder_lite_support_link_text)
                    );
                    ?>
                </div>
            </div>
            <?php
        }

        /**
         * Include Welcome page right side Support Forum
         *
         * @since 1.0.0
         */
        static public function builder_lite_welcome_page_rate_theme_section()
        {
            ?>

            <div class="postbox">
                <h2 class="hndle bul-normal-cusror">
                    <span class="dashicons dashicons-sos"></span>
                    <span><?php esc_html_e('Rate Builder Lite', 'builder-lite'); ?></span>
                </h2>
                <div class="inside">
                    <p>
                        <?php
                        printf(
                        /* translators: %1$s: Builder Lite Theme name. */
                            esc_html__('Like our theme? Do not forget to rate our theme!', 'builder-lite'),
                            self::$page_title
                        );
                        ?>
                    </p>
                    <?php
                    $builder_lite_rating = apply_filters('builder_lite_rating_link', 'https://wordpress.org/support/theme/builder-lite/reviews/?filter=5');
                    $builder_lite_rating_text = apply_filters('builder_lite_rating_link_text', __('Rate Builder Lite', 'builder-lite'));

                    printf(
                    /* translators: %1$s: Builder Lite Knowledge doc link. */
                        '%1$s',
                        !empty($builder_lite_rating) ? '<a href=' . esc_url($builder_lite_rating) . ' target="_blank" rel="noopener">' . esc_html($builder_lite_rating_text) . '</a>' :
                            esc_html($builder_lite_rating_text)
                    );
                    ?>
                </div>
            </div>
            <?php
        }


        /**
         * Include Welcome page content
         *
         * @since 1.0.0
         */
        static public function builder_lite_welcome_page_content()
        {

            $builder_lite_addon_tagline = apply_filters('builder_lite_addon_list_tagline', __('More Options Available with Builder Lite Pro!', 'builder-lite'));

            // Quick settings.
            $quick_settings = apply_filters(
                'builder_lite_quick_settings', array(
                    'logo-favicon' => array(
                        'title' => __('Logo, Title & Tagline', 'builder-lite'),
                        'dashicon' => 'dashicons-format-image',
                        'quick_url' => admin_url('customize.php?autofocus[control]=custom_logo'),
                    ),
                    'colors' => array(
                        'title' => __('Theme Colors', 'builder-lite'),
                        'dashicon' => 'dashicons-admin-customizer',
                        'quick_url' => admin_url('customize.php?autofocus[control]=background_color'),
                    ),
                    'banner' => array(
                        'title' => __('Add Banner', 'builder-lite'),
                        'dashicon' => 'dashicons-images-alt',
                        'quick_url' => admin_url('customize.php?autofocus[control]=bul_home_background_radio'),
                    ),
                    'preloader' => array(
                        'title' => __('Pre Loader', 'builder-lite'),
                        'dashicon' => 'dashicons-marker',
                        'quick_url' => admin_url('customize.php?autofocus[control]=bul_preloader_display'),
                    ),
                    'header' => array(
                        'title' => __('Header Options', 'builder-lite'),
                        'dashicon' => 'dashicons-align-center',
                        'quick_url' => admin_url('customize.php?autofocus[control]=bul_sticky_menu'),
                    ),
                    'blog-layout' => array(
                        'title' => __('Blog Settings', 'builder-lite'),
                        'dashicon' => 'dashicons-welcome-write-blog',
                        'quick_url' => admin_url('customize.php?autofocus[control]=bul_blog_sidebar'),
                    ),
                    'footer' => array(
                        'title' => __('Footer Settings', 'builder-lite'),
                        'dashicon' => 'dashicons-admin-generic',
                        'quick_url' => admin_url('customize.php?autofocus[control]=bul_copyright_text'),
                    ),
                    'sidebars' => array(
                        'title' => __('Page Settings', 'builder-lite'),
                        'dashicon' => 'dashicons-media-text',
                        'quick_url' => admin_url('customize.php?autofocus[control]=bul_page_bg_radio'),
                    ),
                )
            );

            $extensions = apply_filters(
                'builder_lite_addon_list', array(
                    'colors-and-background' => array(
                        'title' => __('Colors & Background', 'builder-lite'),
                        'class' => 'bul-addon',
                        'title_url' => builder_lite_get_pro_url('https://themeegg.com/', 'builder-lite-dashboard', 'learn-more', 'welcome-page'),
                        'links' => array(
                            array(
                                'link_class' => 'bul-learn-more',
                                'link_url' => builder_lite_get_pro_url('https://themeegg.com/', 'builder-lite-dashboard', 'learn-more', 'welcome-page'),
                                'link_text' => __('Learn More', 'builder-lite'),
                                'target_blank' => true,
                            ),
                        ),
                    ),
                )
            );
            ?>
            <div class="postbox">
                <h2 class="hndle bul-normal-cusror">
                    <span><?php esc_html_e('Links to Customizer Settings:', 'builder-lite'); ?></span></h2>
                <div class="bul-quick-setting-section">
                    <?php
                    if (!empty($quick_settings)) :
                        ?>
                        <div class="bul-quick-links">
                            <ul class="bul-flex">
                                <?php
                                foreach ((array)$quick_settings as $key => $link) {
                                    echo '<li class=""><span class="dashicons ' . esc_attr($link['dashicon']) . '"></span><a class="bul-quick-setting-title" href="' . esc_url($link['quick_url']) . '" target="_blank" rel="noopener">' . esc_html($link['title']) . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Notice for Older version of Builder Lite Addon -->
            <?php self::min_addon_version_message(); ?>

            <div class="postbox">
                <h2 class="hndle bul-normal-cusror bul-addon-heading bul-flex">
                    <span><?php echo esc_html($builder_lite_addon_tagline); ?></span>
                    <?php do_action('builder_lite_addon_bulk_action'); ?>
                </h2>
                <div class="bul-addon-list-section">
                    <?php
                    if (!empty($extensions)) :
                        ?>
                        <div>
                            <ul class="bul-addon-list">
                                <?php
                                foreach ((array)$extensions as $addon => $info) {
                                    $title_url = (isset($info['title_url']) && !empty($info['title_url'])) ? 'href="' . esc_url($info['title_url']) . '"' : '';
                                    $anchor_target = (isset($info['title_url']) && !empty($info['title_url'])) ? "target='_blank' rel='noopener'" : '';

                                    echo '<li id="' . esc_attr($addon) . '"  class="' . esc_attr($info['class']) . '"><a class="bul-addon-title"' . $title_url . $anchor_target . ' >' . esc_html($info['title']) . '</a><div class="bul-addon-link-wrapper">';

                                    foreach ($info['links'] as $key => $link) {
                                        printf(
                                            '<a class="%1$s" %2$s %3$s> %4$s </a>',
                                            esc_attr($link['link_class']),
                                            isset($link['link_url']) ? 'href="' . esc_url($link['link_url']) . '"' : '',
                                            (isset($link['target_blank']) && $link['target_blank']) ? 'target="_blank" rel="noopener"' : '',
                                            esc_html($link['link_text'])
                                        );
                                    }
                                    echo '</div></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php
        }

        /**
         * Required Plugin Activate
         *
         * @since 1.2.4
         */
        static public function required_plugin_activate()
        {

            if (!current_user_can('install_plugins') || !isset($_POST['init']) || !$_POST['init']) {
                wp_send_json_error(
                    array(
                        'success' => false,
                        'message' => __('No plugin specified', 'builder-lite'),
                    )
                );
            }

            $plugin_init = (isset($_POST['init'])) ? esc_attr($_POST['init']) : '';

            $activate = activate_plugin($plugin_init, '', false, true);

            if (is_wp_error($activate)) {
                wp_send_json_error(
                    array(
                        'success' => false,
                        'message' => $activate->get_error_message(),
                    )
                );
            }

            wp_send_json_success(
                array(
                    'success' => true,
                    'message' => __('Plugin Successfully Activated', 'builder-lite'),
                )
            );

        }

        /**
         * Check compatible theme version.
         *
         * @since 1.2.4
         */
        static public function min_addon_version_message()
        {

            $builder_lite_global_options = get_option('builder-lite-settings');

            if (isset($builder_lite_global_options['builder-lite-addon-auto-version']) && defined('BUILDER_LITE_EXT_VER')) {

                if (version_compare($builder_lite_global_options['builder-lite-addon-auto-version'], '1.2.1') < 0) {

                    // If addon is not updated & White Label for Addon is added then show the white labelewd pro name.
                    $builder_lite_addon_name = builder_lite_get_addon_name();
                    $update_builder_lite_addon_link = builder_lite_get_pro_url('https://themeegg.com/?p=25258', 'builder-lite-dashboard', 'update-to-builder-lite-pro', 'welcome-page');
                    if (class_exists('Builder_Lite_Ext_White_Label_Markup')) {
                        $plugin_data = Builder_Lite_Ext_White_Label_Markup::$branding;
                        if (!empty($plugin_data['builder-lite-pro']['name'])) {
                            $update_builder_lite_addon_link = '';
                        }
                    }

                    $class = 'bul-notice bul-notice-error';
                    $message = sprintf(
                    /* translators: %1$1s: Addon Name, %2$2s: Minimum Required version of the Builder Lite Addon */
                        __('Update to the latest version of %1$2s to make changes in settings below.', 'builder-lite'),
                        (!empty($update_builder_lite_addon_link)) ? '<a href=' . esc_url($update_builder_lite_addon_link) . ' target="_blank" rel="noopener">' . $builder_lite_addon_name . '</a>' : $builder_lite_addon_name
                    );

                    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), $message);
                }
            }
        }

        /**
         * Builder Lite Header Right Section Links
         *
         * @since 1.2.4
         */
        static public function top_header_right_section()
        {

            $top_links = apply_filters(
                'builder_lite_header_top_links', array(
                    'builder-lite-theme-info' => array(
                        'title' => __('Next generation WordPress page builder theme.', 'builder-lite'),
                    ),
                )
            );

            if (!empty($top_links)) {
                ?>
                <div class="bul-top-links">
                    <ul>
                        <?php

                        foreach ((array)$top_links as $key => $info) {
                            /* translators: %1$s: Title */
                            printf(
                                '<li><span> %1$s </span>',
                                esc_html($info['title'])
                            );
                        }
                        ?>
                    </ul>
                </div>
                <?php
            }
        }
    }

    new Builder_Lite_Admin_Settings;
}
