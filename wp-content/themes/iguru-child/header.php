<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="main">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package    WordPress
 * @subpackage iGuru
 * @since      1.0
 * @version    1.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <?php
    if ( is_singular() && pings_open() ) : ?>
        <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>">
        <?php
    endif;
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>
    <?php 
        iGuru_Theme_Helper::preloader();
        get_template_part('templates/header/section', 'header');
        get_template_part('templates/header/section', 'page_title');
    ?>
    
    <main id="main">
    
    <div class="mobile-footer-area">
        <ul>
            <li> <?php echo do_shortcode('[popup_anything id="5561"]
'); ?>
	        </li>
	        
            <li>
                 <a class="mobile-bottom-btn" href="tel:1800000000">    
                        <span class="enq-side-btn">Call now</span>  
            	</a>
            </li>
        </ul>
    </div>
    
   

	<div class="right-enq-button">
	   <?php echo do_shortcode('[popup_anything id="5248"]'); ?>
	</div>
			