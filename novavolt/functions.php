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
	// Inter is self-hosted via novavolt_self_hosted_font() — no external request.
	wp_enqueue_style(
		'novavolt-style',
		get_stylesheet_uri(),
		array(),
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
// Preconnect no longer needed: the font is served from this domain.
// add_filter( 'wp_resource_hints', 'novavolt_resource_hints', 10, 2 );

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
 * Fallback registration for patterns that may not exist as files
 * (integrations, security). Skips any pattern already registered
 * from the /patterns directory.
 */
function novavolt_register_inline_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) || ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
		return;
	}
	$registry = WP_Block_Patterns_Registry::get_instance();

	if ( ! $registry->is_registered( 'novavolt/integrations' ) ) {
		$integrations_content = <<<'NVHTML'
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
<!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem","margin":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--40)">
<!-- wp:paragraph {"align":"center","className":"nv-kicker"} --><p class="has-text-align-center nv-kicker">Integrations</p><!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","level":2} --><h2 class="wp-block-heading has-text-align-center">Works with the tools you already use</h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#5B6A7F"},"typography":{"fontSize":"1.05rem"}}} --><p class="has-text-align-center" style="color:#5B6A7F;font-size:1.05rem">Connect NovaVolt to the systems your team already works in.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:buttons {"className":"nv-pillgrid","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"0.8rem"}}} -->
<div class="wp-block-buttons nv-pillgrid">
<!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Microsoft Teams</a></div><!-- /wp:button -->
<!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">ConnectWise</a></div><!-- /wp:button -->
<!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">QuickBooks Online</a></div><!-- /wp:button -->
<!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Google Contacts</a></div><!-- /wp:button -->
<!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Outlook</a></div><!-- /wp:button -->
<!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">CRM integrations available</a></div><!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</section>
<!-- /wp:group -->
NVHTML;
		register_block_pattern(
			'novavolt/integrations',
			array(
				'title'       => __( 'Integrations', 'novavolt' ),
				'description' => __( 'Integration pills built from editable buttons.', 'novavolt' ),
				'categories'  => array( 'novavolt' ),
				'content'     => $integrations_content,
			)
		);
	}

	if ( ! $registry->is_registered( 'novavolt/security' ) ) {
		$security_content = <<<'NVHTML'
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"navy-deep","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-navy-deep-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
<!-- wp:group {"style":{"spacing":{"blockGap":"0.5rem","margin":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--40)">
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.82rem","fontWeight":"700","letterSpacing":"0.12em","textTransform":"uppercase"},"color":{"text":"#86CDEA"}}} --><p class="has-text-align-center" style="color:#86CDEA;font-size:0.82rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase">Security &amp; Reliability</p><!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","level":2,"style":{"color":{"text":"#ffffff"}}} --><h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff">Enterprise-grade by default</h2><!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"1.25rem"}}}} -->
<div class="wp-block-columns alignwide">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"nv-sec-card2","style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group nv-sec-card2">
<!-- wp:html --><span class="nv-sec-icon"><svg class="nv-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="4.5" y="10.5" width="15" height="9.5" rx="2"/><path d="M8 10.5V7.5a4 4 0 0 1 8 0v3"/><circle cx="12" cy="15" r="1.2"/></svg></span><!-- /wp:html -->
<!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Secure by design</h3><!-- /wp:heading -->
<!-- wp:paragraph --><p>Secure communications with encrypted signaling and industry-standard security practices.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"nv-sec-card2","style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group nv-sec-card2">
<!-- wp:html --><span class="nv-sec-icon"><svg class="nv-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><polygon points="13,2.5 4.5,13.5 11,13.5 10.5,21.5 19.5,10.5 13,10.5"/></svg></span><!-- /wp:html -->
<!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Reliable by design</h3><!-- /wp:heading -->
<!-- wp:paragraph --><p>Redundant infrastructure monitored around the clock.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"nv-sec-card2","style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group nv-sec-card2">
<!-- wp:html --><span class="nv-sec-icon"><svg class="nv-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3.5" y="4" width="17" height="6.5" rx="1.8"/><rect x="3.5" y="13.5" width="17" height="6.5" rx="1.8"/><path d="M7 7.2h.01M7 16.7h.01"/></svg></span><!-- /wp:html -->
<!-- wp:heading {"level":3} --><h3 class="wp-block-heading">U.S.-based infrastructure</h3><!-- /wp:heading -->
<!-- wp:paragraph --><p>Your communications run on redundant U.S.-based infrastructure.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"nv-sec-card2","style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group nv-sec-card2">
<!-- wp:html --><span class="nv-sec-icon"><svg class="nv-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="9.5" cy="8.5" r="3.2"/><path d="M3.5 19.5a6 6 0 0 1 12 0"/><path d="M16.5 6.2a3.2 3.2 0 0 1 0 6.1M17.5 14.2a5.6 5.6 0 0 1 3.2 5.3"/></svg></span><!-- /wp:html -->
<!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Role-based access</h3><!-- /wp:heading -->
<!-- wp:paragraph --><p>Granular permissions keep the right people in control of your system.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</section>
<!-- /wp:group -->
NVHTML;
		register_block_pattern(
			'novavolt/security',
			array(
				'title'       => __( 'Security & Reliability', 'novavolt' ),
				'description' => __( 'Dark band with four editable security cards.', 'novavolt' ),
				'categories'  => array( 'novavolt' ),
				'content'     => $security_content,
			)
		);
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

/** Block author enumeration (/?author=1 reveals usernames for brute forcing). */
function novavolt_block_author_enumeration() {
	if ( is_admin() ) {
		return;
	}
	if ( isset( $_GET['author'] ) && ! is_user_logged_in() ) {
		wp_safe_redirect( home_url(), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'novavolt_block_author_enumeration' );

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
 * The earlier check looked for "aria-label" anywhere in the block, but the
 * mobile toggle button already carries one, so the <nav> itself was skipped.
 * This inspects the opening <nav> tag only, and names regions in render order.
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
 * /?author=1 was still resolving to /author/hearbaz/ because WordPress's own
 * canonical redirect ran first, so this hooks in earlier and also disables the
 * author archive entirely (the site has no author pages by design).
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


/** Block xmlrpc.php outright. Filtering the method list still left the core
 *  system.* methods callable, and nothing on this site uses XML-RPC. */
function novavolt_block_xmlrpc() {
	if ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) {
		status_header( 403 );
		exit( 'XML-RPC services are disabled on this site.' );
	}
}
add_action( 'init', 'novavolt_block_xmlrpc', 0 );


/** Allow woff2 uploads so the webfont can be self-hosted (admins only). */
add_filter( 'upload_mimes', function ( $mimes ) {
	if ( current_user_can( 'manage_options' ) ) {
		$mimes['woff2'] = 'font/woff2';
	}
	return $mimes;
} );
add_filter( 'wp_check_filetype_and_ext', function ( $data, $file, $filename, $mimes ) {
	if ( preg_match( '/\.woff2$/i', $filename ) ) {
		$data['ext']  = 'woff2';
		$data['type'] = 'font/woff2';
	}
	return $data;
}, 10, 4 );


/**
 * Self-hosted Inter variable font.
 * Removes two third-party round trips (fonts.googleapis.com + fonts.gstatic.com)
 * from the critical path, which is what held back FCP/LCP on mobile.
 * The metric-matched fallback stops the swap from shifting layout (CLS).
 */
function novavolt_self_hosted_font() {
	$font = 'https://lightyellow-kingfisher-780485.hostingersite.com/wp-content/uploads/2026/08/inter-variable-latin.woff2';
	?>
	<link rel="preload" href="<?php echo esc_url( $font ); ?>" as="font" type="font/woff2" crossorigin>
	<style id="novavolt-font">
	@font-face{font-family:'Inter';font-style:normal;font-weight:400 800;font-display:swap;src:url('<?php echo esc_url( $font ); ?>') format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
	@font-face{font-family:'Inter Fallback';src:local('Arial');ascent-override:90%;descent-override:22.43%;line-gap-override:0%;size-adjust:107%;}
	</style>
	<?php
}
add_action( 'wp_head', 'novavolt_self_hosted_font', 1 );

/* ==========================================================================
 * 4.0.0 — SEO metadata (Milestone 5, item 15)
 * Core WordPress emits no meta description and no social tags, which is what
 * the remaining Lighthouse SEO points were for. Rather than add a full SEO
 * plugin to a site tuned for Core Web Vitals in Milestone 4, the theme builds
 * them from a field the client can already edit: the page Excerpt, falling
 * back to the opening of the page content, then the site tagline.
 * ========================================================================== */

function novavolt_meta_description() {
	$desc = '';
	if ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			$desc = has_excerpt( $post ) ? get_the_excerpt( $post ) : '';
			if ( '' === $desc ) {
				$desc = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
			}
		}
	}
	if ( '' === trim( $desc ) ) {
		$desc = get_bloginfo( 'description' );
	}
	$desc = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $desc ) ) );
	if ( mb_strlen( $desc ) > 158 ) {
		$desc = rtrim( mb_substr( $desc, 0, 155 ) ) . '...';
	}
	return $desc;
}

function novavolt_seo_head() {
	if ( is_404() ) {
		return;
	}
	$desc  = novavolt_meta_description();
	$title = wp_get_document_title();
	$url   = is_singular() ? get_permalink() : home_url( '/' );
	$img   = function_exists( 'get_site_icon_url' ) ? get_site_icon_url( 512 ) : '';

	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	if ( $img ) {
		echo '<meta property="og:image" content="' . esc_url( $img ) . '">' . "\n";
		echo '<meta name="twitter:image" content="' . esc_url( $img ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'novavolt_seo_head', 1 );

/** Organization schema. Details per the client's Milestone 5 corrections. */
function novavolt_schema() {
	if ( ! is_front_page() ) {
		return;
	}
	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Organization',
		'name'        => 'NovaVolt Systems',
		'url'         => home_url( '/' ),
		'description' => wp_strip_all_tags( get_bloginfo( 'description' ) ),
		'email'       => 'contact@novavoltsystems.com',
		'telephone'   => '+1-800-430-3317',
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => '1910 Pacific Ave, Suite 2000',
			'addressLocality' => 'Dallas',
			'addressRegion'   => 'TX',
			'postalCode'      => '75201',
			'addressCountry'  => 'US',
		),
		'contactPoint' => array(
			'@type'       => 'ContactPoint',
			'contactType' => 'sales',
			'telephone'   => '+1-800-430-3317',
			'email'       => 'contact@novavoltsystems.com',
			'areaServed'  => 'US',
		),
	);
	$logo = function_exists( 'get_site_icon_url' ) ? get_site_icon_url( 512 ) : '';
	if ( $logo ) {
		$schema['logo'] = $logo;
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
}
add_action( 'wp_head', 'novavolt_schema', 2 );

/* ==========================================================================
 * 4.0.0 — Baza AI chatbot integration point (Milestone 5, item 17)
 * The chatbot does not exist yet. This gives it a permanent home so that
 * adding it later is a settings change rather than a redevelopment:
 *   - paste the vendor snippet at Settings > General > Chatbot embed code, or
 *   - return it from the 'novavolt_chatbot_embed' filter (for example from a
 *     future novavolt-core plugin, so the code lives outside the theme).
 * It prints in the footer, after content, so it cannot block rendering or
 * undo the Core Web Vitals work from Milestone 4.
 * ========================================================================== */

function novavolt_chatbot_setting() {
	register_setting( 'general', 'novavolt_chatbot_embed', array( 'type' => 'string', 'default' => '' ) );
	add_settings_field(
		'novavolt_chatbot_embed',
		__( 'Chatbot embed code', 'novavolt' ),
		function () {
			printf(
				'<textarea name="novavolt_chatbot_embed" rows="5" class="large-text code">%s</textarea><p class="description">%s</p>',
				esc_textarea( get_option( 'novavolt_chatbot_embed', '' ) ),
				esc_html__( 'Paste the Baza AI chat widget snippet. It is printed in the footer of every page. Leave empty to keep the chatbot switched off.', 'novavolt' )
			);
		},
		'general'
	);
}
add_action( 'admin_init', 'novavolt_chatbot_setting' );

function novavolt_chatbot_embed() {
	$embed = apply_filters( 'novavolt_chatbot_embed', get_option( 'novavolt_chatbot_embed', '' ) );
	if ( ! trim( (string) $embed ) ) {
		return;
	}
	// Admin-supplied vendor snippet; printed verbatim by design.
	echo '<div id="nv-chatbot" class="nv-chatbot-root">' . $embed . '</div>' . "\n";
}
add_action( 'wp_footer', 'novavolt_chatbot_embed', 99 );
