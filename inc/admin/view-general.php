<?php
/**
 * View General
 *
 * @package     Builder Lite
 * @author      Themeegg
 * @copyright   Copyright (c) 2018, Themeegg
 * @link        http://themeegg.com/
 * @since       Themeegg 1.0
 */

?>

<div class="bul-container bul-welcome">
    <div id="poststuff">
        <div id="post-body" class="columns-2">
            <div id="post-body-content">
                <!-- All WordPress Notices below header -->
                <h1 class="screen-reader-text"> <?php esc_html_e( 'Builder Lite', 'builder-lite' ); ?> </h1>
                <?php do_action( 'builder_lite_welcome_page_content_before' ); ?>

                <?php do_action( 'builder_lite_welcome_page_content' ); ?>

                <?php do_action( 'builder_lite_welcome_page_content_after' ); ?>
            </div>
            <div class="postbox-container bul-sidebar" id="postbox-container-1">
                <div id="side-sortables">
                    <?php do_action( 'builder_lite_welcome_page_right_sidebar_before' ); ?>

                    <?php do_action( 'builder_lite_welcome_page_right_sidebar_content' ); ?>

                    <?php do_action( 'builder_lite_welcome_page_right_sidebar_after' ); ?>
                </div>
            </div>
        </div>
        <!-- /post-body -->
        <br class="clear">
    </div>


</div>
