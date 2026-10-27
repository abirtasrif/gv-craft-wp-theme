<?php
/**
 * GV Craft by JarvanIT — theme bootstrap.
 *
 * @package GV_Craft
 * @author  JarvanIT
 * @link    https://jarvan-it.top
 */

defined( 'ABSPATH' ) || exit;

define( 'GVC_VERSION', '1.0.0' );
define( 'GVC_DIR', trailingslashit( get_template_directory() ) );
define( 'GVC_URI', trailingslashit( get_template_directory_uri() ) );

/* -------------------------------------------------------------------------
 * 1. Theme setup
 * ---------------------------------------------------------------------- */
if ( ! function_exists( 'gvc_setup' ) ) {
	/**
	 * Register theme supports, menus and image sizes.
	 */
	function gvc_setup() {
		load_theme_textdomain( 'gv-craft', GVC_DIR . 'languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor.css' );

		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
		);

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 240,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		register_nav_menus(
			array(
				'primary' => __( 'Primary Navigation', 'gv-craft' ),
				'footer'  => __( 'Footer Navigation', 'gv-craft' ),
				'legal'   => __( 'Legal / Bottom Bar', 'gv-craft' ),
			)
		);

		set_post_thumbnail_size( 1024, 1024, true );
		add_image_size( 'gvc-card', 720, 720, true );
		add_image_size( 'gvc-wide', 1280, 720, true );
		add_image_size( 'gvc-portrait', 720, 900, true );
	}
}
add_action( 'after_setup_theme', 'gvc_setup' );

/**
 * Content width.
 */
function gvc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gvc_content_width', 1280 );
}
add_action( 'after_setup_theme', 'gvc_content_width', 0 );

/**
 * Register widget areas.
 */
function gvc_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'gv-craft' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Widgets shown beside blog posts and archives.', 'gv-craft' ),
			'before_widget' => '<section id="%1$s" class="gvc-widget-box %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Shop Sidebar', 'gv-craft' ),
			'id'            => 'gvc-shop-sidebar',
			'description'   => __( 'Widgets shown on shop and product category archives.', 'gv-craft' ),
			'before_widget' => '<section id="%1$s" class="gvc-widget-box %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column', 'gv-craft' ),
			'id'            => 'gvc-footer',
			'description'   => __( 'Optional widget area rendered above the footer menu.', 'gv-craft' ),
			'before_widget' => '<section id="%1$s" class="gvc-footer__widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="gvc-footer__title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'gvc_widgets_init' );

/* -------------------------------------------------------------------------
 * 2. Assets
 * ---------------------------------------------------------------------- */
if ( ! function_exists( 'gvc_scripts' ) ) {
	/**
	 * Enqueue front-end styles and scripts.
	 */
	function gvc_scripts() {
		$fonts = 'https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap';
		$icons = 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap';

		wp_enqueue_style( 'gv-craft-fonts', $fonts, array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_style( 'gv-craft-icons', $icons, array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_style( 'gv-craft-style', get_stylesheet_uri(), array( 'gv-craft-fonts' ), GVC_VERSION );

		if ( gvc_is_woocommerce_page() ) {
			wp_enqueue_style( 'gv-craft-woocommerce', GVC_URI . 'assets/css/woocommerce.css', array( 'gv-craft-style' ), GVC_VERSION );
		}

		wp_enqueue_script( 'gv-craft-main', GVC_URI . 'assets/js/main.js', array(), GVC_VERSION, true );

		$gvc_localize = array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'wcAjax'  => ( gvc_woocommerce_active() && class_exists( 'WC_AJAX' ) ) ? WC_AJAX::get_endpoint( 'add_to_cart' ) : '',
			'cartUrl' => ( gvc_woocommerce_active() && function_exists( 'wc_get_cart_url' ) ) ? wc_get_cart_url() : home_url( '/' ),
			'nonce'   => wp_create_nonce( 'gvc_nonce' ),
			'i18n'    => array(
				'added'    => __( 'Added to your bag', 'gv-craft' ),
				'error'    => __( 'Could not add this item. Please try again.', 'gv-craft' ),
				'required' => __( 'Please choose an option before adding to the bag.', 'gv-craft' ),
				'menu'     => __( 'Menu', 'gv-craft' ),
				'close'    => __( 'Close', 'gv-craft' ),
			),
		);

		// Gallery thumbnails on the single product page.
		if ( is_singular( 'product' ) && function_exists( 'wc_get_product' ) ) {
			$gvc_product = wc_get_product( get_the_ID() );

			if ( $gvc_product ) {
				$gvc_attachments = array();

				foreach ( array_merge( array( $gvc_product->get_image_id() ), $gvc_product->get_gallery_image_ids() ) as $gvc_attachment_id ) {
					$gvc_url = wp_get_attachment_image_url( $gvc_attachment_id, 'gvc-wide' );

					if ( $gvc_url ) {
						$gvc_attachments[ (string) $gvc_attachment_id ] = $gvc_url;
					}
				}

				$gvc_localize['attachments'] = $gvc_attachments;
			}
		}

		wp_localize_script( 'gv-craft-main', 'gvcData', $gvc_localize );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'gvc_scripts' );

/**
 * Load the block editor stylesheet inside the editor too.
 */
function gvc_editor_assets() {
	wp_enqueue_style( 'gv-craft-editor', GVC_URI . 'assets/css/editor.css', array(), GVC_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'gvc_editor_assets' );

/**
 * Customizer preview refresh.
 */
function gvc_customize_preview_js() {
	wp_enqueue_script(
		'gv-craft-customizer',
		GVC_URI . 'assets/js/customizer.js',
		array( 'customize-preview' ),
		GVC_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'gvc_customize_preview_js' );

/* -------------------------------------------------------------------------
 * 3. Includes
 * ---------------------------------------------------------------------- */
require_once GVC_DIR . 'inc/helpers.php';
require_once GVC_DIR . 'inc/template-tags.php';
require_once GVC_DIR . 'inc/class-gv-nav-walker.php';
require_once GVC_DIR . 'inc/customizer.php';
require_once GVC_DIR . 'inc/woocommerce.php';
require_once GVC_DIR . 'inc/meta-boxes.php';
require_once GVC_DIR . 'inc/class-gv-setup.php';
require_once GVC_DIR . 'inc/class-gv-demo.php';

/* -------------------------------------------------------------------------
 * 4. Body classes & misc
 * ---------------------------------------------------------------------- */
if ( ! function_exists( 'gvc_body_classes' ) ) {
	/**
	 * Add helpful classes to <body>.
	 */
	function gvc_body_classes( $classes ) {
		$classes[] = 'gvc-body';

		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'gvc-no-sidebar';
		}

		if ( is_front_page() && gvc_front_page_has_content() ) {
			$classes[] = 'gvc-front-page-content';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'gvc_body_classes' );

/**
 * Excerpt length & ellipsis.
 */
function gvc_excerpt_length( $length = 22 ) {
	return is_admin() ? $length : 22;
}
add_filter( 'excerpt_length', 'gvc_excerpt_length' );

function gvc_excerpt_more() {
	return is_admin() ? '[…]' : '…';
}
add_filter( 'excerpt_more', 'gvc_excerpt_more' );

/**
 * Pingback header.
 */
function gvc_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'gvc_pingback_header' );

/**
 * Theme activation hook: run the one-page setup wizard.
 */
function gvc_after_switch_theme() {
	if ( class_exists( 'GV_Craft_Setup' ) ) {
		GV_Craft_Setup::run();
	}
}
add_action( 'after_switch_theme', 'gvc_after_switch_theme' );
