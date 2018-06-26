<?php
/**
 *
 * @package builder lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if (!function_exists('builder_lite_body_classes')) :
    function builder_lite_body_classes($classes)
    {
        // Adds a class of group-blog to blogs with more than 1 published author.
        if (is_multi_author()) {
            $classes[] = 'group-blog';
        }

        // Adds a class of hfeed to non-singular pages.
        if (!is_singular()) {
            $classes[] = 'hfeed';
        }

        return $classes;
    }
endif;
add_filter('body_class', 'builder_lite_body_classes');

/**
 * Builder Lite Color Palletes.
 */
if (!function_exists('builder_lite_color_palette')) :

    /**
     * Builder Lite Color Palletes.
     *
     * @return array Color Palletes.
     */
    function builder_lite_color_palette()
    {

        $color_palette = array(
            '#000000',
            '#ffffff',
            '#dd3333',
            '#dd9933',
            '#eeee22',
            '#81d742',
            '#1e73be',
            '#8224e3',
        );

        return apply_filters('builder_lite_color_palettes', $color_palette);
    }

endif;

