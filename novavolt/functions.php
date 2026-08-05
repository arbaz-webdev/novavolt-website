<?php
/**
 * NovaVolt theme functions.
 *
 * @package NovaVolt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'novavolt_setup' ) ) {
	/**
	 * Theme support.
	 */
	function novavolt_setup() {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
		add_editor_style( 'style.css' );

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'novavolt' ),
				'footer'  => __( 'Footer Menu', 'novavolt' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'novavolt_setup' );

/**
 * Enqueue front-end assets: Inter webfont + the custom polish stylesheet.
 */
function novavolt_enqueue_assets() {
	// Google Fonts — Inter.
	wp_enqueue_style(
		'novavolt-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	// Main theme stylesheet (contains the /* Theme Name */ header + polish layer).
	wp_enqueue_style(
		'novavolt-style',
		get_stylesheet_uri(),
		array( 'novavolt-fonts' ),
		wp_get_theme()->get( 'Version' )
	);

	// Tiny scroll-reveal enhancement (no dependencies).
	wp_enqueue_script(
		'novavolt-reveal',
		get_theme_file_uri( 'assets/js/reveal.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'novavolt_enqueue_assets' );

/**
 * Preconnect to Google Fonts for faster loading.
 */
function novavolt_resource_hints( $hints, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$hints[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'novavolt_resource_hints', 10, 2 );

/**
 * Register a block pattern category so NovaVolt sections group together.
 */
function novavolt_register_pattern_category() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'novavolt',
			array( 'label' => __( 'NovaVolt', 'novavolt' ) )
		);
	}
}
add_action( 'init', 'novavolt_register_pattern_category' );
