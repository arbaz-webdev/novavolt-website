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

/* ==========================================================================
 * Milestone 4 — performance, security and accessibility hardening
 * ========================================================================== */

/**
 * Inter as a single variable font instead of five static weights.
 * One file covers 400-800, so it is a smaller download and one less request.
 */
function novavolt_variable_font( $src, $handle ) {
	if ( 'novavolt-fonts' === $handle ) {
		return 'https://fonts.googleapis.com/css2?family=Inter:wght@400..800&display=swap';
	}
	return $src;
}
add_filter( 'style_loader_src', 'novavolt_variable_font', 10, 2 );

/** Drop the emoji polyfill: a script, a stylesheet and a third-party DNS lookup. */
function novavolt_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'emoji_svg_url', '__return_false' );
	add_filter( 'tiny_mce_plugins', function( $plugins ) {
		return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
	} );
}
add_action( 'init', 'novavolt_disable_emojis' );

/** Defer the theme's enhancement script so it never blocks rendering. */
function novavolt_defer_scripts( $tag, $handle ) {
	if ( 'novavolt-reveal' === $handle ) {
		return str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'novavolt_defer_scripts', 10, 2 );

/** Remove version fingerprinting (makes targeted attacks easier). */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

/** Disable XML-RPC: unused here and a common brute-force and DDoS vector. */
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_headers', function( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
} );

/** Sensible security headers. */
function novavolt_security_headers( $headers ) {
	$headers['X-Content-Type-Options'] = 'nosniff';
	$headers['X-Frame-Options']        = 'SAMEORIGIN';
	$headers['Referrer-Policy']        = 'strict-origin-when-cross-origin';
	$headers['Permissions-Policy']     = 'camera=(), microphone=(), geolocation=()';
	return $headers;
}
add_filter( 'wp_headers', 'novavolt_security_headers' );

/** Generic login error message so failures do not confirm valid usernames. */
add_filter( 'login_errors', function() {
	return __( 'Login failed. Please check your details and try again.', 'novavolt' );
} );

/**
 * Accessibility: name each navigation region.
 * A check for "aria-label" anywhere in the block is not enough, because the
 * mobile toggle button already carries one. This inspects the opening <nav>
 * tag only, and names regions in render order.
 */
function novavolt_nav_aria( $block_content, $block ) {
	if ( 'core/navigation' !== $block['blockName'] ) {
		return $block_content;
	}
	static $index = 0;
	$labels = array( 'Primary', 'Footer: company', 'Footer: services' );
	$label  = isset( $labels[ $index ] ) ? $labels[ $index ] : 'Secondary';
	$index++;

	return preg_replace_callback(
		'/<nav\b([^>]*)>/',
		function ( $m ) use ( $label ) {
			$attrs = preg_replace( '/\s*aria-label="[^"]*"/', '', $m[1] );
			return '<nav' . $attrs . ' aria-label="' . esc_attr( $label ) . '">';
		},
		$block_content,
		1
	);
}
add_filter( 'render_block', 'novavolt_nav_aria', 10, 2 );

/**
 * Username disclosure hardening.
 * /?author=1 resolved to /author/<username>/ because WordPress's canonical
 * redirect runs first, so this hooks in earlier and disables author archives.
 */
function novavolt_no_author_archives() {
	if ( is_admin() || is_user_logged_in() ) {
		return;
	}
	if ( is_author() || isset( $_GET['author'] ) ) {
		wp_safe_redirect( home_url(), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'novavolt_no_author_archives', 0 );
add_action( 'parse_request', function ( $wp ) {
	if ( ! is_admin() && ! is_user_logged_in() && isset( $wp->query_vars['author'] ) ) {
		wp_safe_redirect( home_url(), 301 );
		exit;
	}
} );

/** Hide the user list from anonymous REST requests (it leaks usernames). */
function novavolt_restrict_user_endpoints( $endpoints ) {
	if ( is_user_logged_in() ) {
		return $endpoints;
	}
	unset( $endpoints['/wp/v2/users'] );
	unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
	return $endpoints;
}
add_filter( 'rest_endpoints', 'novavolt_restrict_user_endpoints' );

/** Turn off every XML-RPC method rather than just the authenticated ones. */
add_filter( 'xmlrpc_methods', '__return_empty_array' );

/** Strip the WordPress version from asset URLs for anonymous visitors. */
function novavolt_strip_version( $src ) {
	if ( ! is_user_logged_in() && strpos( $src, 'ver=' ) !== false && strpos( $src, 'novavolt' ) === false ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'novavolt_strip_version', 20 );
add_filter( 'script_loader_src', 'novavolt_strip_version', 20 );

/**
 * Block xmlrpc.php outright. Filtering the method list still left the core
 * system.* methods callable, and nothing on this site uses XML-RPC.
 */
function novavolt_block_xmlrpc() {
	if ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) {
		status_header( 403 );
		exit( 'XML-RPC services are disabled on this site.' );
	}
}
add_action( 'init', 'novavolt_block_xmlrpc', 0 );
