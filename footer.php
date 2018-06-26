<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package builder lite
 */

?>

	<!-- Begin Footer Section -->
	<footer id="footer">
        <div class="container">
            <div class="row">
                <?php
                    if(is_active_sidebar('footer-column1') || is_active_sidebar('footer-column2') || is_active_sidebar('footer-column3') || is_active_sidebar('footer-column4')){
                        ?>
                            <div class="footer-widgets-wrapper">
                                <?php
                                    if('3'===esc_attr(get_theme_mod( 'bul_footer_widgets' ))) {
                                        ?>
                                            <div class="col-md-4">
                                                <?php
                                                    if(is_active_sidebar('footer-column1')){
                                                        dynamic_sidebar( 'footer-column1' );
                                                    }
                                                ?>                    
                                            </div>
                                            <div class="col-md-4">
                                                <?php
                                                    if(is_active_sidebar('footer-column2')){
                                                        dynamic_sidebar( 'footer-column2' );
                                                    }
                                                ?>                    
                                            </div>
                                            <div class="col-md-4">
                                                <?php
                                                    if(is_active_sidebar('footer-column3')){
                                                        dynamic_sidebar( 'footer-column3' );
                                                    }
                                                ?>                    
                                            </div>            
                                        <?php
                                    }
                                    else{
                                        ?>
                                            <div class="col-md-3">
                                                <?php
                                                    if(is_active_sidebar('footer-column1')){
                                                        dynamic_sidebar( 'footer-column1' );
                                                    }
                                                ?>                    
                                            </div>
                                            <div class="col-md-3">
                                                <?php
                                                    if(is_active_sidebar('footer-column2')){
                                                        dynamic_sidebar( 'footer-column2' );
                                                    }
                                                ?>                    
                                            </div>
                                            <div class="col-md-3">
                                                <?php
                                                    if(is_active_sidebar('footer-column3')){
                                                        dynamic_sidebar( 'footer-column3' );
                                                    }
                                                ?>                    
                                            </div>
                                            <div class="col-md-3">
                                                <?php
                                                    if(is_active_sidebar('footer-column4')){
                                                        dynamic_sidebar( 'footer-column4' );
                                                    }
                                                ?>                    
                                            </div>            
                                        <?php
                                    }            
                                ?>
                            </div>
                        <?php                        
                    }
                ?>
            </div>

            <?php
              /**
               * Hook - builder_lite_action_footer.
               *
               * @hooked builder_lite_footer_copyrights - 10
               */
              do_action( 'builder_lite_action_footer' );
            ?>        	
            
        </div>
    </footer>
<?php wp_footer(); ?>

</body>
</html>