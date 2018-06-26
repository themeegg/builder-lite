<?php
/**
 * @package builder lite
 */


/**
 * Builder Lite Footer
 */

if ( ! function_exists( 'builder_lite_footer_copyrights' ) ) :
	function builder_lite_footer_copyrights() {
		?>
        <div class="row">
            <div class="copyrights">
                <p><?php echo esc_attr( get_theme_mod( 'bul_copyright_text', __( 'Copyrights builder lite. All Rights Reserved', 'builder-lite' ) ) ); ?>
                    <span><?php

	                    $builder_lite_theme_author = esc_url( 'http://themeegg.com/' );

	                    _e( ' | Theme by ', 'builder-lite' ) ?><a href="<?php echo $builder_lite_theme_author; ?>"
                                                                          target="_blank"><?php _e( 'Themeegg', 'builder-lite' ) ?></a></span>
                </p>
            </div>
        </div>
		<?php
	}
endif;


if ( ! function_exists( 'builder_lite_action_footer_hook' ) ) :
	function builder_lite_action_footer_hook() {
		add_action( 'builder_lite_action_footer', 'builder_lite_footer_copyrights' );
	}
endif;
add_action( 'wp', 'builder_lite_action_footer_hook' );
