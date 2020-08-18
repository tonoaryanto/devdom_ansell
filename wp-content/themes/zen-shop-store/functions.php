<?php

/**
 * Zen shop store styles and scripts.
 * @return non
 */
function zen_shop_store_enqueue_style() {
	// Load main css file of parent theme.
    wp_enqueue_style( 'di-ecommerce-style-default', get_template_directory_uri() . '/style.css' );

    if( class_exists( 'WooCommerce' ) ) {
		// Load this child theme css after parent css files.
		wp_enqueue_style( 'zen-shop-store-style',  trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'bootstrap', 'font-awesome', 'di-ecommerce-style-default', 'di-ecommerce-style-core', 'di-ecommerce-style-woo' ), wp_get_theme()->get('Version'), 'all');
    } else {
		// Load this child theme css after parent css files.
		wp_enqueue_style( 'zen-shop-store-style',  trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'bootstrap', 'font-awesome', 'di-ecommerce-style-default', 'di-ecommerce-style-core' ), wp_get_theme()->get('Version'), 'all');
    }

    if( class_exists( 'WooCommerce' ) ) {

    	// Load owl.carousel css.
		wp_enqueue_style( 'owl-carousel', trailingslashit( get_stylesheet_directory_uri() ) . 'css/owl.carousel.css', array( 'di-ecommerce-style-core' ), '2.2.1', 'all' );

		// Load owl.carousel default css.
		wp_enqueue_style( 'owl-theme-default', trailingslashit( get_stylesheet_directory_uri() ) . 'css/owl.theme.default.css', array( 'owl-carousel', 'di-ecommerce-style-core' ), '2.2.1', 'all' );

		wp_enqueue_script( 'owl-carousel', trailingslashit( get_stylesheet_directory_uri() ) . 'js/owl.carousel.js', array( 'jquery' ), '2.2.1', true );

		wp_enqueue_script( 'zen-shop-store-owl-carousel', trailingslashit( get_stylesheet_directory_uri() ) . 'js/owl.carousel.zss.js', array( 'jquery', 'owl-carousel' ), wp_get_theme()->get('Version'), true );
    }
}
add_action( 'wp_enqueue_scripts', 'zen_shop_store_enqueue_style' );

/**
 * Zen shop store theme setup
 * @return non
 */
function zen_shop_store_theme_setup() {
	add_image_size( 'zen-shop-store-featured-product', 360, 360 );
}
add_action( 'after_setup_theme', 'zen_shop_store_theme_setup' );


// Featured product custom widget addition.
require_once get_stylesheet_directory() . '/inc/custom-widget-featured-product.php';

// Recent products carousel custom widget addition.
require_once get_stylesheet_directory() . '/inc/custom-widget-recent-products-carousel.php';
