<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package builder lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if (true === get_theme_mod('bul_preloader_display', true)) {
    ?>
    <!-- Begin Preloader -->
    <div class="loader-wrapper">
        <div id="pre-loader"></div>
    </div>
    <!-- End Preloader -->
    <?php
}
/**
 * Hook - builder_lite_action_header.
 *
 * @hooked builder_lite_header_style_1 - 10
 * @hooked builder_lite_header_style_2 - 10
 */
do_action('builder_lite_action_header');
if (is_front_page() && !is_home()) {
    $background_type = esc_attr(get_theme_mod('bul_home_background_radio', 'image'));
    $background_color = sanitize_hex_color(get_theme_mod('bul_home_background_color', '#555555'));
    $background_image_url = esc_url(get_theme_mod('bul_theme_home_background_image', get_template_directory_uri() . '/assets/images/default-banner.jpg'));
    /* background selection */
    $hide_banner = get_theme_mod('bul_disable_banner');
    $custom_css = 'background-color:' . $background_color;
    $section_class = 'home-color-section';
    $section_id = '';
    if ($background_type != 'color') {
        $custom_css = '';
        $section_class = 'style1';
        $section_id = 'parallax-bg';
    }
    ?>
    <div id="home" class="elementor-menu-anchor"></div>
    <?php if(!$hide_banner){?>
        <section
            <?php
            // echo ($background_type = 'Jsparticles') ? 'id= "particles-js" ' : ' ';
            echo !empty($section_id) ? 'id="' . esc_attr($section_id) . '" ' : ' ';
            echo !empty($section_class) ? 'class="' . esc_attr($section_class) . '" ' : ' ';
            echo !empty($custom_css) ? 'style="' . esc_html($custom_css) . '"' : ' ';
            ?>>
            <?php
            /**
             * banner particle js
             *
             * @since 1.1.0
             */
            if ($background_type == 'jsparticles'){
                ?>
                <div id="particles-js" style="background-color: <?php echo $background_color;?>; "></div><?php            
            }
            ?>
            <div id="slider-inner" class="home-bg-item"<?php 

                if (true === get_theme_mod('bul_home_parallax', true)) { ?>
                    data-parallax="scroll"
                    data-image-src="<?php echo esc_url(get_theme_mod('bul_theme_home_background_image', get_template_directory_uri() . '/assets/images/default-banner.jpg')); ?>" style = "<?php echo ($background_type == 'jsparticles') ? 'pointer-events: none;': ''; ?>"<?php 
                }else {
                    ?>
                    style="background:url('<?php echo esc_url(get_theme_mod('bul_theme_home_background_image')); ?>') no-repeat; "<?php 
                }?>>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" style ="<?php echo ($background_type == 'jsparticles') ? 'pointer-events: none;': ''; ?>">
                            <div class="slide-bg-section">
                                <div class="slide-bg-text">
                                    <h1 class="wow fadeInDow center"
                                        data-wow-duration="2s" data-wow-delay="1s">
                                        <?php
                                        $home_heading_text = esc_attr(get_theme_mod('bul_home_heading_text'));
                                        if (!empty($home_heading_text)) {
                                            echo $home_heading_text;
                                        } else {
                                            bloginfo('name');
                                        }
                                        ?>
                                    </h1>
                                    <p class="wow fadeInUp center"
                                       data-wow-duration="2s"
                                       data-wow-delay="1s"><?php echo esc_attr(get_theme_mod('bul_home_subheading_text', get_bloginfo('description', 'display'))); ?>
                                    </p>
                                    <div class="slide-buttons center" style ="<?php echo ($background_type == 'jsparticles') ? 'pointer-events: auto;': ''; ?>">
                                        <?php
                                        $home_button_text = esc_attr(get_theme_mod('bul_home_button_text'));
                                        if (!empty($home_button_text)) {
                                            if (false !== strpos(esc_url(get_theme_mod('bul_home_button_url')), 'youtube') || false !== strpos(esc_url(get_theme_mod('bul_home_button_url')), 'vimeo')) {?>
                                                <a class="builder-btn video-popup-link"
                                                   href="<?php echo esc_url(get_theme_mod('bul_home_button_url')); ?>"><?php echo esc_attr(get_theme_mod('bul_home_button_text')); ?>
                                                </a><?php
                                            }else {?>
                                                <a class="builder-btn"
                                                   href="<?php echo esc_url(get_theme_mod('bul_home_button_url')); ?>"><?php echo esc_attr(get_theme_mod('bul_home_button_text')); ?>
                                                    <i class="fa fa-angle-double-right"></i>
                                                </a><?php
                                            }
                                        }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section><?php  
    } 
}?>