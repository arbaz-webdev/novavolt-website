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

function novavolt_enqueue_assets() {
	wp_enqueue_style(
		'novavolt-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'novavolt-style',
		get_stylesheet_uri(),
		array( 'novavolt-fonts' ),
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_script(
		'novavolt-reveal',
		get_theme_file_uri( 'assets/js/reveal.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'novavolt_enqueue_assets' );

function novavolt_resource_hints( $hints, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$hints[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'novavolt_resource_hints', 10, 2 );

function novavolt_register_pattern_category() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'novavolt',
			array( 'label' => __( 'NovaVolt', 'novavolt' ) )
		);
	}
}
add_action( 'init', 'novavolt_register_pattern_category' );

/**
 * Fallback registration for the integrations & security patterns.
 * Skipped automatically when the /patterns directory files are present
 * (file-based patterns register earlier and win).
 */
function novavolt_register_inline_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) || ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
		return;
	}
	$registry = WP_Block_Patterns_Registry::get_instance();

	if ( ! $registry->is_registered( 'novavolt/integrations' ) ) {
		$file = get_theme_file_path( 'patterns/integrations.php' );
		if ( file_exists( $file ) ) {
			ob_start();
			include $file;
			register_block_pattern(
				'novavolt/integrations',
				array(
					'title'       => __( 'Integrations', 'novavolt' ),
					'description' => __( 'Integration pills built from editable buttons.', 'novavolt' ),
					'categories'  => array( 'novavolt' ),
					'content'     => ob_get_clean(),
				)
			);
		}
	}

	if ( ! $registry->is_registered( 'novavolt/security' ) ) {
		$file = get_theme_file_path( 'patterns/security.php' );
		if ( file_exists( $file ) ) {
			ob_start();
			include $file;
			register_block_pattern(
				'novavolt/security',
				array(
					'title'       => __( 'Security & Reliability', 'novavolt' ),
					'description' => __( 'Dark band with four editable security cards.', 'novavolt' ),
					'categories'  => array( 'novavolt' ),
					'content'     => ob_get_clean(),
				)
			);
		}
	}
}
add_action( 'init', 'novavolt_register_inline_patterns', 20 );
