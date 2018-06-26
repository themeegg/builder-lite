<?php

if ( ! function_exists( 'builder_lite_get_page_title' ) ) :
	function builder_lite_get_page_title( $blogtitle = false, $archivetitle = false, $searchtitle = false, $pagenotfoundtitle = false ) {
		if ( ! is_front_page() ) {
			if ( 'color' === esc_attr( get_theme_mod( 'bul_page_bg_radio', 'color' ) ) ) {
				?>
                <div class="page-title" style="background:<?php echo sanitize_hex_color( get_theme_mod( 'bul_page_bg_color', '#555555' ) ); ?>;">
				<?php
			} else if ( 'image' === esc_attr( get_theme_mod( 'bul_page_bg_radio', 'color' ) ) ) {
				?>
				<?php
				if ( true === get_theme_mod( 'bul_page_bg_parallax', true ) ) {
					?>
                    <div class="page-title" data-parallax="scroll" data-image-src="<?php echo esc_url( get_theme_mod( 'bul_page_bg_image', get_template_directory_uri() . '/assets/images/default-banner.jpg' ) ); ?>">
					<?php
				} else {
					?>
                    <div class="page-title"  style="background:url('<?php echo esc_url( get_theme_mod( 'bul_page_bg_image', get_template_directory_uri() . '/assets/images/default-banner.jpg' ) ); ?>') no-repeat scroll center center / cover">
					<?php
				}
				?>

				<?php
			} else {
				?>
                <div class="page-title title-color">
				<?php
			}

			?>

            <div class="content-section img-overlay">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <div class="section-title page-title">
								<?php
								if ( $blogtitle ) {
									?><h1 class="main-title"><?php single_post_title(); ?></h1><?php
								}
								if ( $archivetitle ) {
									?><h1 class="main-title"><?php the_archive_title(); ?></h1><?php
								}
								if ( $searchtitle ) {
									?><h1 class="main-title"><?php _e( 'SEARCH RESULTS', 'builder-lite' ) ?></h1><?php
								}
								if ( $pagenotfoundtitle ) {
									?><h1 class="main-title"><?php _e( 'PAGE NOT FOUND', 'builder-lite' ) ?></h1><?php
								}
								if ( $blogtitle == false && $archivetitle == false && $searchtitle == false && $pagenotfoundtitle == false ) {
									?><h1 class="main-title"><?php the_title(); ?></h1><?php
								}
								?>
                                <div class="bread-crumb" typeof="BreadcrumbList" vocab="http://schema.org/">
									<?php
									if ( function_exists( 'bcn_display' ) ) {
										bcn_display();
									}
									?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>    <!-- End page-title -->
			<?php
		}
	}
endif;