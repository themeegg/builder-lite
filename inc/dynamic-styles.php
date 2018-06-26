<?php
/**
 * Builder Lite: Dynamic CSS Stylesheet
 *
 */

function builder_lite_dynamic_css_stylesheet() {


	$footer_bg_color      = sanitize_hex_color( get_theme_mod( 'bul_footer_bg_color', '#191616' ) );
	$footer_content_color = sanitize_hex_color( get_theme_mod( 'bul_footer_content_color', '#ffffff' ) );
	$footer_links_color   = sanitize_hex_color( get_theme_mod( 'bul_footer_links_color', '#b3b3b3' ) );


	$pagetitle_hft = absint( get_theme_mod( 'bul_pagetitle_hft', '150' ) );
	$pagetitle_hfb = absint( get_theme_mod( 'bul_pagetitle_hfb', '125' ) );

	$preloader_image = esc_url( get_theme_mod( 'bul_preloader_image' ) );

	//contact form color


	$css = '
    footer#footer {        
        background: ' . $footer_bg_color . ';
        color: ' . $footer_content_color . ';
    }

    footer h4{
        color: ' . $footer_content_color . ';   
    }

    footer#footer a,
    footer#footer a:hover{
        color: ' . $footer_links_color . ';      
    }

    .section-title.page-title{
        padding-top: ' . $pagetitle_hft . 'px;
        padding-bottom: ' . $pagetitle_hfb . 'px;
    }

   

    header.menu-wrapper.fixed nav ul li a,
    header.menu-wrapper.style-2.fixed nav ul li a{
        color: #555;
    }
   
     
';

	if ( "" != esc_url( get_theme_mod( 'bul_preloader_image' ) ) ) {
		$css .= '        
        #pre-loader{
            background: url(' . $preloader_image . ') no-repeat !important;
        }
    ';
	}


	if ( false === get_theme_mod( 'bul_sticky_menu', true ) ) {
		$css .= '        
         header.menu-wrapper.fixed{ 
            display:none !important;
        }           
    ';
	}

	if ( false === get_theme_mod( 'bul_home_dark_overlay', true ) ) {
		$css .= '        
         #parallax-bg #slider-inner:before{            
            background: none !important;    
            opacity: 0.8;            
        }           
    ';
	}

	if ( true === get_theme_mod( 'bul_page_dark_overlay', false ) ) {
		$css .= '        
         .page-title .img-overlay{
            background: rgba(0,0,0,.5);
            color: #fff;
        }          
    ';
	}

	if ( true === get_theme_mod( 'bul_blog_homepage', false ) ) {
		$css .= '        
         #parallax-bg #slider-inner{
           height: 70vh;
        }

        section.home-color-section{
            height: 70vh;
        }

        .slide-bg-section{
            height: calc(70vh - 5px);
        } 

        body{
            background: #fbfbfb;
        }

        article{
            margin: 70px 0;
            background: #fff;
            padding: 1px 30px;            
            box-shadow: 0px 0px 3px 0px #c5c5c5;
            -moz-box-shadow: 0px 0px 3px 0px #c5c5c5;
            -webkit-box-shadow: 0px 0px 3px 0px #c5c5c5;
        }

        article .blog-wrapper{
            margin: 0;
            padding-top: 30px;
            padding-right: 0;
        }

        .widget-area .widget{
            margin: 5px 0;
            background: #fff;
            padding: 20px 20px;            
            box-shadow: 0px 0px 3px 0px #c5c5c5;
            -moz-box-shadow: 0px 0px 3px 0px #c5c5c5;
            -webkit-box-shadow: 0px 0px 3px 0px #c5c5c5;
        }

        aside h4.widget-title{
            font-size: 15px;
        }

        .widget li a{
            color: #555;
        }

        .widget-area{
            margin:70px 0;
        }

        body.page{
            background: #fff;
        }

        .page-content-area article{
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
        }
    ';
	}

	if ( is_active_sidebar( 'footer-column1' ) || is_active_sidebar( 'footer-column2' ) || is_active_sidebar( 'footer-column3' ) || is_active_sidebar( 'footer-column4' ) ) {
		$css .= '        
        footer#footer{
            padding-top: 50px;
        }
    ';
	}


	return apply_filters( 'builder_lite_dynamic_css_stylesheet', $css );
}


?>


