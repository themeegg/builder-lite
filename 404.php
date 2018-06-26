<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package builder lite
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
			<?php builder_lite_get_page_title(false,false,false,true); ?>
            <div class="content-page">
                <div class="content-inner">
                    <div class="container">
                        <div class="row">
							<?php
							if('right'===esc_attr(get_theme_mod('bul_blog_sidebar','right'))) {
								?>
                                <div class="col-md-8">
                                    <div class="page-content-area">
                                        <h1 class="page-error"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'builder-lite' ); ?></h1>
                                        <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links on right or a search?', 'builder-lite' ); ?></p>
										<?php get_search_form(); ?>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-1">
									<?php get_sidebar('sidebar-1'); ?>
                                </div>
								<?php
							}
							else{
								?>
                                <div class="col-md-3">
									<?php get_sidebar('sidebar-1'); ?>
                                </div>
                                <div class="col-md-8 col-md-offset-1">
                                    <div class="page-content-area">
                                        <h1 class="page-error"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'builder-lite' ); ?></h1>
                                        <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links on right or a search?', 'builder-lite' ); ?></p>
										<?php get_search_form(); ?>
                                    </div>
                                </div>

								<?php
							}
							?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?php
get_footer();