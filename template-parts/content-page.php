<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package builder lite
 */

?>

<div class="content-page">
    <div class="content-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-content-area">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <?php
                                the_content();

                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . __('Pages:', 'builder-lite'),
                                    'after' => '</div>',
                                ));
                                ?>
                            </div><!-- .entry-content -->


                            <?php if (get_edit_post_link()) : ?>
                                <footer class="entry-footer">
                                    <?php
                                    edit_post_link(
                                        sprintf(
                                        /* translators: %s: Name of current post */
                                            __('Edit %s', 'builder-lite'),
                                            the_title('<span class="screen-reader-text">"', '"</span>', false)
                                        ),
                                        '<span class="edit-link">',
                                        '</span>'
                                    );
                                    ?>
                                </footer><!-- .entry-footer -->
                            <?php endif; ?>
                        </article><!-- #post-## -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


