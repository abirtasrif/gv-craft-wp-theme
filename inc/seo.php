<?php
/**
 * Search snippets for themes without a dedicated SEO plugin.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add a concise, page-specific description when an SEO plugin is not active.
 */
function gvc_meta_description() {
	if (
		defined( 'WPSEO_VERSION' )
		|| defined( 'RANK_MATH_VERSION' )
		|| defined( 'AIOSEO_VERSION' )
		|| defined( 'SEOPRESS_VERSION' )
		|| class_exists( '\The_SEO_Framework\Load' )
	) {
		return;
	}

	$description = '';

	if ( is_front_page() ) {
		$description = __( 'Shop handcrafted home decor from Bangladesh at Green Vision Craft: artisan-made jute rugs, woven goods, ceramics and sustainable tableware.', 'gv-craft' );
	} elseif ( function_exists( 'is_product_category' ) && is_product_category() ) {
		$term        = get_queried_object();
		$description = $term && ! empty( $term->description )
			? $term->description
			: sprintf(
				/* translators: %s: product category name. */
				__( 'Explore %s handcrafted by artisan communities in Bangladesh at Green Vision Craft.', 'gv-craft' ),
				single_term_title( '', false )
			);
	} elseif ( is_singular( 'product' ) ) {
		$description = get_the_excerpt();

		if ( ! $description ) {
			$description = get_post_field( 'post_content', get_queried_object_id() );
		}
	} elseif ( is_page() ) {
		$page_slug = get_post_field( 'post_name', get_queried_object_id() );
		$page_descriptions = array(
			'about-us'        => __( 'Discover Green Vision Craft, a Bangladesh artisan marketplace for handcrafted jute rugs, woven goods, ceramics and sustainable homeware.', 'gv-craft' ),
			'impact-ledger'   => __( 'See the environmental and community commitments behind Green Vision Craft orders, including artisan livelihoods and restoration projects in Bangladesh.', 'gv-craft' ),
			'privacy-policy'  => __( 'Read how Green Vision Craft handles personal information for store accounts, orders, customer support and subscriptions.', 'gv-craft' ),
			'terms-conditions' => __( 'Review Green Vision Craft terms for online orders, handmade product details, delivery, returns and website use.', 'gv-craft' ),
		);

		$description = isset( $page_descriptions[ $page_slug ] ) ? $page_descriptions[ $page_slug ] : get_the_excerpt();
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$description = term_description();

		if ( ! $description ) {
			$description = sprintf(
				/* translators: %s: archive title. */
				__( 'Explore %s from Green Vision Craft, featuring artisan stories and handcrafted home goods from Bangladesh.', 'gv-craft' ),
				single_term_title( '', false )
			);
		}
	} elseif ( is_singular() ) {
		$description = get_the_excerpt();
	} elseif ( is_post_type_archive() ) {
		$description = get_the_archive_description();
	}

	if ( ! $description ) {
		$description = get_bloginfo( 'description' );
	}

	$description = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( strip_shortcodes( $description ) ) ) );

	if ( $description ) {
		printf( "<meta name=\"description\" content=\"%s\" />\n", esc_attr( wp_trim_words( $description, 26, '' ) ) );
	}
}
add_action( 'wp_head', 'gvc_meta_description', 2 );
