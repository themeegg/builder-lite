<?php
/**
 * builder lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package builder lite
 */

define('BUILDER_LITE_THEME_VERSION', '1.0.4');
//define( 'BUILDER_LITE_THEME_SETTINGS', 'builder-lite-settings' );
define('BUILDER_LITE_THEME_DIR', get_template_directory() . '/');
define('BUILDER_LITE_THEME_URI', get_template_directory_uri() . '/');

// Register Custom Navigation Walker
require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');

if (!function_exists('builder_lite_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function builder_lite_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on builder lite, use a find and replace
         * to change 'builder-lite' to the name of your theme in all the template files.
         */
        load_theme_textdomain('builder-lite', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary', 'builder-lite'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('builder_litel_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');


    }
endif;
add_action('after_setup_theme', 'builder_lite_setup');


/**
 * Custom Logo
 *
 *
 */
function builder_lite_logo_setup()
{
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 180,
        'flex-height' => true,
        'flex-width' => true,
    ));
}

add_action('after_setup_theme', 'builder_lite_logo_setup');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function builder_lite_content_width()
{
    $GLOBALS['content_width'] = apply_filters('builder_lite_content_width', 640);
}

add_action('after_setup_theme', 'builder_lite_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function builder_lite_widgets_init()
{
    register_sidebar(array(
        'name' => __('Blog Sidebar', 'builder-lite'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'builder-lite'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column1', 'builder-lite'),
        'id' => 'footer-column1',
        'description' => __('Add widgets here.', 'builder-lite'),
        'before_widget' => '<div id="%1$s" class="section %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column2', 'builder-lite'),
        'id' => 'footer-column2',
        'description' => __('Add widgets here.', 'builder-lite'),
        'before_widget' => '<div id="%1$s" class="section %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column3', 'builder-lite'),
        'id' => 'footer-column3',
        'description' => __('Add widgets here.', 'builder-lite'),
        'before_widget' => '<div id="%1$s" class="section %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column4', 'builder-lite'),
        'id' => 'footer-column4',
        'description' => __('Add widgets here.', 'builder-lite'),
        'before_widget' => '<div id="%1$s" class="section %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

}

add_action('widgets_init', 'builder_lite_widgets_init');

if (!function_exists('bul_asset_suffix')) :

    function bul_asset_suffix()
    {
        $suffix = '.min';
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $suffix = '';
        }
        return $suffix;
    }
endif;
/**
 * Admin Scripts
 */
if (!function_exists('builder_lite_admin_scripts')) :
    function builder_lite_admin_scripts($hook)
    {


        if ('appearance_page_builder-lite-theme-info' != $hook && 'themes.php' != $hook) {
            return;
        }

        wp_enqueue_style('builder-lite-info-css', get_template_directory_uri() . '/assets/css/builder-lite-theme-info.css', false);
    }
endif;
add_action('admin_enqueue_scripts', 'builder_lite_admin_scripts');


/**
 * Display Dynamic CSS.
 */
function builder_lite_dynamic_css_wrap()
{

    require_once(get_parent_theme_file_path('/inc/dynamic-styles.php'));
    ?>
    <style type="text/css" id="custom-theme-dynamic-style">
        <?php echo builder_lite_dynamic_css_stylesheet(); ?>
    </style>
<?php }

add_action('wp_head', 'builder_lite_dynamic_css_wrap');


function builder_lite_scripts()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.css', array(), '3.3.7');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/vendor/font-awesome/css/font-awesome.css', array(), '4.6.3');

    wp_enqueue_style('builder-lite-google-font', esc_url(builder_lite_google_fonts()), array(), null);

    wp_enqueue_style('magnific-popup-css', get_template_directory_uri() . '/assets/vendor/magnific-popup/magnific-popup.css', array(), '1.1.0');
    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/vendor/animate/animate.css', array(), '1.0');
    wp_enqueue_style('m-customscrollbar-css', get_template_directory_uri() . '/assets/css/jquery.mCustomScrollbar.css', array(), '1.0');
    wp_enqueue_style('builder-lite-style', get_template_directory_uri() . '/assets/css/builder-lite.css', array(), '1.0.0');
    wp_enqueue_style('builder-lite-responsive', get_template_directory_uri() . '/assets/css/builder-lite-responsive.css', array(), '1.0.0');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.js', array(), '3.3.7', true);
    wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/assets/js/jquery.easing.1.3.js', array('jquery'), '1.3', true);
    wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array(), '2.6.2', true);
    wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/js/parallax.js', array(), '1.4.2', true);
    wp_enqueue_script('jquery-magnific', get_template_directory_uri() . '/assets/vendor/magnific-popup/jquery.magnific-popup.js', array(), '1.1.0', true);
    wp_enqueue_script('builder-lite-script', get_template_directory_uri() . '/assets/js/builder-lite-main.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.js', array(), '3.7.3');
    /**
     * particle js
     *
     * @since 1.1.0
     */
    wp_register_script('particlejs', 'https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js', true);
    $background_type = esc_attr(get_theme_mod('bul_home_background_radio', 'image'));
    if ($background_type == 'jsparticles'){
        wp_enqueue_script('particlejs'); 
    }
    wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');

    wp_enqueue_script('respond', get_template_directory_uri() . '/assets/js/respond.js');
    wp_script_add_data('respond', 'conditional', 'lt IE 9');

}

add_action('wp_enqueue_scripts', 'builder_lite_scripts');


function builder_lite_google_fonts()
{
    $body_font = get_theme_mod('body_font_name', 'Playfair Display:300,400,700,900');
    $paragraph_font = get_theme_mod('paragraph_font_name', 'Poppins:300,400,700,900');


    $fonts = array();
    $fonts[] = esc_attr(str_replace('+', ' ', $body_font));
    $fonts[] = esc_attr(str_replace('+', ' ', $paragraph_font));

    $fonts_url = '';
    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts))
        ), 'https://fonts.googleapis.com/css');
    }

    return $fonts_url;
}

/**
 * Custom excerpt length.
 */
function builder_lite_my_excerpt_length($length)
{
    if (is_admin()) {
        return $length;
    }

    return 25;
}

add_filter('excerpt_length', 'builder_lite_my_excerpt_length');


/**
 * Registers an editor stylesheet for the theme.
 */
function builder_lite_theme_add_editor_styles()
{
    add_editor_style(get_template_directory_uri() . '/assets/css/custom-editor-style.css');
}

add_action('admin_init', 'builder_lite_theme_add_editor_styles');


/**
 * Custom search form
 */
function builder_lite_search_form($form)
{
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url(home_url('/')) . '" >
    <div class="search">
      <input type="text" value="' . get_search_query() . '" class="blog-search" name="s" id="s" placeholder="' . esc_attr__('Search here', 'builder-lite') . '">
      <label for="searchsubmit" class="search-icon"><i class="fa fa-search"></i></label>
      <input type="submit" id="searchsubmit" value="' . esc_attr__('Search', 'builder-lite') . '" />
    </div>
    </form>';

    return $form;
}

add_filter('get_search_form', 'builder_lite_search_form', 100);


/**
 *Excerpt More
 */
function builder_lite_excerpt_more($more)
{
    if (is_admin()) {
        return $more;
    }

    return '&hellip;';
}

add_filter('excerpt_more', 'builder_lite_excerpt_more');


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function builder_lite_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", get_bloginfo('pingback_url'));
    }
}

add_action('wp_head', 'builder_lite_pingback_header');


/**
 * Using home page title instead of site name
 */


if (!function_exists('builder_lite_breadcrumb_title')) :
    function builder_lite_breadcrumb_title($title, $type, $id)
    {
        if ($type[0] === 'home') {
            $title = get_the_title(get_option('page_on_front'));
        }

        return $title;
    }
endif;
add_filter('bcn_breadcrumb_title', 'builder_lite_breadcrumb_title', 42, 3);


if (!function_exists('builder_lite_get_pro_url')) :
    /**
     * Returns an URL with utm tags
     * the admin settings page.
     *
     * @param string $url URL fo the site.
     * @param string $source utm source.
     * @param string $medium utm medium.
     * @param string $campaign utm campaign.
     * @return mixed
     */
    function builder_lite_get_pro_url($url, $source = '', $medium = '', $campaign = '')
    {

        $url = trailingslashit($url);

        // Set up our URL if we have a source.
        if (isset($source)) {
            $url = add_query_arg('utm_source', sanitize_text_field($source), $url);
        }
        // Set up our URL if we have a medium.
        if (isset($medium)) {
            $url = add_query_arg('utm_medium', sanitize_text_field($medium), $url);
        }
        // Set up our URL if we have a campaign.
        if (isset($campaign)) {
            $url = add_query_arg('utm_campaign', sanitize_text_field($campaign), $url);
        }

        return esc_url($url);
    }

endif;
/**
 *  Set homepage and blog page after demo import
 */

function builder_lite_after_import_setup()
{

    //Assign menus to their locations
    $main_menu = get_term_by('name', 'Primary', 'nav_menu');
    set_theme_mod('nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    //Assign front page
    $front_page = get_page_by_title('Home');
    $blog_page = get_page_by_title('Blog');

    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page->ID);
    update_option('page_for_posts', $blog_page->ID);

}

add_action('pt-ocdi/after_import', 'builder_lite_after_import_setup');

require_once get_template_directory() . '/inc/tgm-plugin-activation/builder-lite-tgm-plugin-activation.php';


if (is_admin()) {
    /**
     * Admin Menu Settings
     */
    require_once get_template_directory() . '/inc/admin/class-builder-lite-admin-settings.php';
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/*
 * Header hooks
 */
require get_template_directory() . '/inc/hooks/header-hooks.php';

/*
 * Footer hooks
 */
require get_template_directory() . '/inc/hooks/footer-hooks.php';

/**
 * Template functions
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Extra classes for this theme.
 */
require get_template_directory() . '/inc/extras.php';

