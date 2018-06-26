<?php



/**
 * Render callback for bul_home_heading_text
 *
 *
 * @return mixed
 */
if ( ! function_exists( 'builder_lite_home_heading_text_render_callback' ) ) :
	function builder_lite_home_heading_text_render_callback() {
		return wp_kses_post( get_theme_mod( 'bul_home_heading_text' ) );
	}
endif;

/**
 * Render callback for bul_home_subheading_text
 *
 *
 * @return mixed
 */
if ( ! function_exists( 'builder_lite_home_subheading_text_render_callback' ) ) :
	function builder_lite_home_subheading_text_render_callback() {
		return wp_kses_post( get_theme_mod( 'bul_home_subheading_text' ) );
	}
endif;

/**
 * Sanitize text box.
 *
 * @param string $input
 *
 * @return string
 */
if ( ! function_exists( 'builder_lite_sanitize_text' ) ) :
	function builder_lite_sanitize_text( $input ) {
		return esc_html( $input );
	}
endif;
/**
 * Sanitize checkbox option buttons
 *
 * @param string $input
 *
 * @return bool
 */
if ( ! function_exists( 'builder_lite_sanitize_checkbox_selection' ) ) :
	function builder_lite_sanitize_checkbox_selection( $input ) {
		return ( ( isset( $input ) && true == $input ) ? true : false );
	}
endif;

/**
 * Sanitize blog sidebar radio option
 *
 * @param string $input
 *
 * @return string
 */
if ( ! function_exists( 'builder_lite_sanitize_blog_sidebar_radio_selection' ) ) :
	function builder_lite_sanitize_blog_sidebar_radio_selection( $input ) {
		$valid = array(
			'right' => __( 'Right', 'builder-lite' ),
			'left'  => __( 'Left', 'builder-lite' ),
		);

		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';
		}
	}
endif;

/**
 * Sanitize Footer Widgets Number select
 *
 * @param string $input
 *
 * @return string
 */
if ( ! function_exists( 'builder_lite_sanitize_footer_widgets_radio_selection' ) ) :
	function builder_lite_sanitize_footer_widgets_radio_selection( $input ) {
		$valid = array(
			'3' => __( '3', 'builder-lite' ),
			'4' => __( '4', 'builder-lite' ),
		);

		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';
		}
	}
endif;

/**
 * Sanitize radio pagebg option buttons
 *
 * @param string $input
 *
 * @return string
 */
if ( ! function_exists( 'builder_lite_sanitize_radio_pagebg_selection' ) ) :
	function builder_lite_sanitize_radio_pagebg_selection( $input ) {
		$valid = array(
			'color' => __( 'Background Color', 'builder-lite' ),
			'image' => __( 'Background Image', 'builder-lite' ),
		);

		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';
		}
	}
endif;


/**
 * Sanitize Footer Widget radio option
 *
 * @param string $input
 *
 * @return string
 */
if ( ! function_exists( 'builder_lite_sanitize_footer_widgets_radio_selection' ) ) :
	function builder_lite_sanitize_footer_widgets_radio_selection( $input ) {
		$valid = array(
			'3' => __( '3', 'builder-lite' ),
			'4' => __( '4', 'builder-lite' ),
		);

		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';
		}
	}
endif;

/**
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 *
 * @return bool Whether the checkbox is checked.
 */
if ( ! function_exists( 'builder_lite_sanitize_checkbox' ) ) :
	function builder_lite_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif;

/**
 * URL sanitization.
 *
 * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
 *
 * @param string $url URL to sanitize.
 *
 * @return string Sanitized URL.
 */
if ( ! function_exists( 'builder_lite_sanitize_url' ) ) :
	function builder_lite_sanitize_url( $url ) {
		return esc_url_raw( $url );
	}
endif;

/**
 * Select sanitization
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string $input Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 *
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
if ( ! function_exists( 'builder_lite_sanitize_select' ) ) :
	function builder_lite_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
endif;

/**
 * Sanitize textarea.
 *
 * @param string $input
 *
 * @return string
 */
if ( ! function_exists( 'builder_lite_sanitize_textarea' ) ) :
	function builder_lite_sanitize_textarea( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
	}
endif;

/**
 * Sanitize image.
 *
 * @param string $image Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 *
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
if ( ! function_exists( 'builder_lite_sanitize_image' ) ) :
	function builder_lite_sanitize_image( $image, $setting ) {
		/*
		 * Array of valid image file types.
		 *
		 * The array includes image mime types that are included in wp_get_mime_types()
		 */
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon'
		);
		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );

		// If $image has a valid mime_type, return it; otherwise, return the default.
		return ( $file['ext'] ? $image : $setting->default );
	}
endif;



/**
 * HTML sanitization
 *
 * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 *
 * @param string $html HTML to sanitize.
 *
 * @return string Sanitized HTML.
 */
if ( ! function_exists( 'builder_lite_sanitize_html' ) ) :
	function builder_lite_sanitize_html( $html ) {
		return wp_filter_post_kses( $html );
	}
endif;

/**
 * CSS sanitization.
 *
 * @see wp_strip_all_tags() https://developer.wordpress.org/reference/functions/wp_strip_all_tags/
 *
 * @param string $css CSS to sanitize.
 *
 * @return string Sanitized CSS.
 */
if ( ! function_exists( 'builder_lite_sanitize_css' ) ) :
	function builder_lite_sanitize_css( $css ) {
		return wp_strip_all_tags( $css );
	}
endif;

/**
 * Enqueue the customizer stylesheet.
 */
if ( ! function_exists( 'builder_lite_enqueue_customizer_stylesheets' ) ) :
	function builder_lite_enqueue_customizer_stylesheets() {
		wp_register_style( 'builder-lite-customizer-css', get_template_directory_uri() . '/inc/customizer/assets/customizer.css', null, null, 'all' );
		wp_enqueue_style( 'builder-lite-customizer-css' );
	}
endif;

add_action( 'customize_controls_print_styles', 'builder_lite_enqueue_customizer_stylesheets' );
