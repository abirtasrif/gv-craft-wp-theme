<?php
/**
 * GV Craft by JarvanIT — WooCommerce integration.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme supports for WooCommerce.
 */
function gvc_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 720,
			'single_image_width'    => 1024,
			'product_grid'          => array(
				'default_rows'    => 4,
				'min_rows'        => 1,
				'max_rows'        => 10,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 4,
			),
		)
	);

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'gvc_woocommerce_setup' );

/**
 * Product loop columns.
 */
function gvc_loop_columns() {
	return 4;
}
add_filter( 'loop_shop_columns', 'gvc_loop_columns', 20 );

/**
 * Replace the default content wrappers with the theme shell.
 */
function gvc_woocommerce_wrappers() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	add_action( 'woocommerce_before_main_content', 'gvc_woocommerce_wrapper_start', 10 );
	add_action( 'woocommerce_after_main_content', 'gvc_woocommerce_wrapper_end', 10 );
}
add_action( 'init', 'gvc_woocommerce_wrappers' );

/**
 * Opening wrapper.
 */
function gvc_woocommerce_wrapper_start() {
	echo '<main id="gvc-main" class="gvc-main"><div class="gvc-container">';
}

/**
 * Closing wrapper.
 */
function gvc_woocommerce_wrapper_end() {
	echo '</div></main>';
}

/**
 * Remove the default loop wrappers — the theme renders its own grid.
 */
function gvc_woocommerce_loop_hooks() {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
}
add_action( 'init', 'gvc_woocommerce_loop_hooks' );

/**
 * Button labels.
 *
 * @param string $text Default text.
 * @return string
 */
function gvc_add_to_cart_text( $text ) {
	return __( 'Add to Bag', 'gv-craft' );
}
add_filter( 'woocommerce_product_add_to_cart_text', 'gvc_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'gvc_add_to_cart_text' );

/**
 * "Proceed to checkout" text.
 *
 * @param string $text Default text.
 * @return string
 */
function gvc_proceed_to_checkout_text( $text ) {
	return __( 'Secure Checkout', 'gv-craft' );
}
add_filter( 'woocommerce_proceed_to_checkout_text', 'gvc_proceed_to_checkout_text' );

/**
 * Replace the add-to-cart button label on the single product page.
 *
 * @param string $text Default text.
 * @return string
 */
function gvc_single_add_to_cart_text( $text ) {
	return __( 'Add to Bag', 'gv-craft' );
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'gvc_single_add_to_cart_text' );

/**
 * Breadcrumb separator.
 *
 * @param string $separator Separator.
 * @return string
 */
function gvc_breadcrumb_separator( $separator ) {
	return '<span class="gvc-breadcrumbs__sep">/</span>';
}
add_filter( 'woocommerce_breadcrumb_separator', 'gvc_breadcrumb_separator' );

/**
 * Cart fragments so the header counter stays in sync.
 *
 * @param array $fragments Fragments.
 * @return array
 */
function gvc_cart_fragments( $fragments ) {
	ob_start();
	?>
	<span class="gvc-cart-btn__count" data-gvc-cart-count><?php echo esc_html( gvc_cart_count() ); ?></span>
	<?php
	$fragments['span[data-gvc-cart-count]'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'gvc_cart_fragments' );

/**
 * Number of products per shop page.
 *
 * @return int
 */
function gvc_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'gvc_products_per_page', 20 );

/**
 * Grid columns.
 *
 * @return int
 */
function gvc_loop_columns_4() {
	return 4;
}
add_filter( 'loop_shop_columns', 'gvc_loop_columns_4', 20 );

/**
 * Related products count.
 *
 * @param array $args Related product args.
 * @return array
 */
function gvc_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns']        = 3;

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'gvc_related_products_args', 20 );

/**
 * Cross-sells count.
 *
 * @param int $count Number of cross sells.
 * @return int
 */
function gvc_cross_sells_count( $count ) {
	return 4;
}
add_filter( 'woocommerce_cross_sells_total', 'gvc_cross_sells_count' );

/**
 * Cart item name markup.
 *
 * @param array $item_data Item data.
 * @param array $cart_item Cart item.
 * @return array
 */
function gvc_cart_item_data( $item_data, $cart_item ) {
	$guild = '';

	if ( isset( $cart_item['data'] ) && is_a( $cart_item['data'], 'WC_Product' ) ) {
		$guild = gvc_product_meta( $cart_item['data'], 'guild' );
	}

	if ( $guild ) {
		$item_data[] = array(
			'key'   => __( 'Artisan', 'gv-craft' ),
			'value' => $guild,
		);
	}

	return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'gvc_cart_item_data', 10, 2 );

/**
 * Order button text on the checkout.
 *
 * @param string $text Default text.
 * @return string
 */
function gvc_place_order_text( $text ) {
	return __( 'Place Order — Carbon-Neutral Delivery', 'gv-craft' );
}
add_filter( 'woocommerce_order_button_text', 'gvc_place_order_text' );

/**
 * Empty cart message.
 *
 * @return string
 */
function gvc_empty_cart_message() {
	return __( 'Your bag is empty — the forests can wait a little longer.', 'gv-craft' );
}
add_filter( 'wc_empty_cart_message', 'gvc_empty_cart_message' );

/**
 * Ensure the theme styles load on WooCommerce blocks / shortcode pages.
 */
function gvc_wc_body_class( $classes ) {
	if ( gvc_woocommerce_active() && ( is_cart() || is_checkout() || is_account_page() ) ) {
		$classes[] = 'gvc-checkout-page';
	}

	return $classes;
}
add_filter( 'body_class', 'gvc_wc_body_class' );

/**
 * Register the custom "shop" page template so the shop can use the archive design.
 *
 * @param array $templates Templates.
 * @return array
 */
function gvc_page_templates( $templates ) {
	$templates['page-templates/template-shop.php'] = __( 'GV Craft — Shop Grid', 'gv-craft' );

	return $templates;
}
add_filter( 'theme_page_templates', 'gvc_page_templates' );
