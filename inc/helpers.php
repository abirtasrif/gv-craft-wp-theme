<?php
/**
 * GV Craft by JarvanIT — helper functions.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default values for every theme option. Keeping them in one place makes the
 * Customizer defaults and the front-end fallbacks identical.
 *
 * @return array
 */
function gvc_defaults() {
	return array(
		// Announcement bar.
		'announce_enable'      => true,
		'announce_pill'       => __( 'Resilient GreenVision Initiative', 'gv-craft' ),
		'announce_text'       => __( 'Zero-Waste Certified & Handcrafted Regenerative Commerce', 'gv-craft' ),
		'announce_shipping'   => __( 'Free carbon-neutral shipping on orders over $75', 'gv-craft' ),
		'announce_link_label' => __( 'Impact Tracker', 'gv-craft' ),
		'announce_link_url'   => '',

		// Hero.
		'hero_eyebrow'        => __( '100% Biodegradable & Upcycled Homeware', 'gv-craft' ),
		'hero_title'          => __( 'Artisan Goods,', 'gv-craft' ),
		'hero_title_accent'   => __( 'Rooted in Nature.', 'gv-craft' ),
		'hero_text'           => __( 'Ethically woven by master coastal artisan collectives in the Sundarbans & Bengal Delta. Every rug, glazed ceramic vessel, and carved timber token brings ancient handcraft into timeless, earth-honoring homes.', 'gv-craft' ),
		'hero_cta_label'      => __( 'Explore Collection', 'gv-craft' ),
		'hero_cta_url'        => '',
		'hero_cta2_label'     => __( 'Our Eco Story', 'gv-craft' ),
		'hero_cta2_url'       => '',
		'hero_stat1_value'    => '4,200+',
		'hero_stat1_label'    => __( 'Mangroves Planted', 'gv-craft' ),
		'hero_stat2_value'    => '100%',
		'hero_stat2_label'    => __( 'Living Wage Pledged', 'gv-craft' ),
		'hero_stat3_value'    => 'Zero',
		'hero_stat3_label'    => __( 'Synthetic Plastics', 'gv-craft' ),
		'hero_badge'          => __( 'Artisan Guild Hand-Tufted', 'gv-craft' ),
		'hero_hotspot_title'  => __( 'Botanical Fern Tuft', 'gv-craft' ),
		'hero_hotspot_text'   => __( 'Hand-dyed with raw olive leaf & walnut extracts.', 'gv-craft' ),

		// Home sections visibility.
		'section_categories'  => true,
		'section_featured'    => true,
		'section_impact'      => true,
		'section_guild'       => true,
		'section_guarantees'  => true,
		'section_newsletter'  => true,
		'section_journal'     => true,

		// Categories section.
		'cats_eyebrow'        => __( 'Honest Raw Elements', 'gv-craft' ),
		'cats_title'          => __( 'Explore Sustainable Craft Disciplines', 'gv-craft' ),
		'cats_text'           => __( 'Engineered through ecological restoration guidelines by Resilient GreenVision. Zero non-biodegradable binders or synthetic fixatives.', 'gv-craft' ),
		'cats_count'          => 4,

		// Featured products.
		'featured_title'      => __( 'Curated Artisan Goods', 'gv-craft' ),
		'featured_text'       => __( 'Directly sourced, fair-trade verified, and climate certified.', 'gv-craft' ),
		'featured_count'      => 8,

		// Impact ledger.
		'impact_eyebrow'      => __( 'Continuous Ledger & Verification by Resilient GreenVision', 'gv-craft' ),
		'impact_title'        => __( 'Real Environmental Accountability', 'gv-craft' ),
		'impact_text'         => __( 'Every transaction directly funds wastewater treatment research, eco-restoration, and eliminates disposable petroleum homeware. Verified on the Resilient GreenVision ecological ledger.', 'gv-craft' ),
		'impact_1_value'      => '12,500 kg',
		'impact_1_label'      => __( 'Virgin Plastic Replaced', 'gv-craft' ),
		'impact_1_note'       => __( 'Displaced through handspun natural jute and biodegradable fibers.', 'gv-craft' ),
		'impact_2_value'      => '184',
		'impact_2_label'      => __( 'Living-Wage Artisans', 'gv-craft' ),
		'impact_2_note'       => __( 'Empowering delta craft cooperatives with 2.8x regional baseline wages.', 'gv-craft' ),
		'impact_3_value'      => '4,280+',
		'impact_3_label'      => __( 'Mangroves Planted', 'gv-craft' ),
		'impact_3_note'       => __( 'Buffer saplings planted along coastal Sundarbans to resist cyclones.', 'gv-craft' ),
		'impact_4_value'      => '100%',
		'impact_4_label'      => __( 'Batch Traceability', 'gv-craft' ),
		'impact_4_note'       => __( 'Scan the craft tag on each piece to view its exact artisan cooperative story.', 'gv-craft' ),

		// Guild spotlight.
		'guild_eyebrow'       => __( 'Artisan Guild Spotlight', 'gv-craft' ),
		'guild_title'         => __( 'The Weavers of the Sundarbans Delta', 'gv-craft' ),
		'guild_text'          => __( 'In communities navigating coastal erosion and climate vulnerability, traditional loop weaving has become an instrument of financial independence and ecological stewardship.', 'gv-craft' ),
		'guild_cta'           => __( 'Read the Sundarbans Guild Field Report', 'gv-craft' ),
		'guild_cta_url'       => '',

		// Guarantee bar.
		'guarantee_1_title'   => __( 'Carbon-Neutral Shipping', 'gv-craft' ),
		'guarantee_1_text'    => __( 'Every mile 100% offset through verified mangrove conservation projects.', 'gv-craft' ),
		'guarantee_2_title'   => __( '30-Day In-Home Trial', 'gv-craft' ),
		'guarantee_2_text'    => __( 'Experience the tactile organic warmth on your floors risk-free.', 'gv-craft' ),
		'guarantee_3_title'   => __( '10-Year Craft Pledge', 'gv-craft' ),
		'guarantee_3_text'    => __( 'Guaranteed longevity with free repair kits and stitch restoration support.', 'gv-craft' ),
		'guarantee_4_title'   => __( '100% Compostable Boxes', 'gv-craft' ),
		'guarantee_4_text'    => __( 'Soy inks, unbleached recycled card, and water-activated paper tape.', 'gv-craft' ),

		// Newsletter.
		'newsletter_title'    => __( 'Join the Regenerative Living Journal', 'gv-craft' ),
		'newsletter_text'     => __( 'Receive seasonal guild releases, botanical care guides, and quarterly environmental impact disclosures from Resilient GreenVision.', 'gv-craft' ),

		// Footer.
		'footer_about'        => __( 'Ethically sourced, earth-honoring artisan goods. In partnership with Resilient GreenVision, engineering ecological longevity through circular craft production and environmental science.', 'gv-craft' ),
		'footer_address'      => __( 'Operational Hub: Zigatola, Dhanmondi, Dhaka & Narayanganj', 'gv-craft' ),
		'footer_copyright'    => __( 'Greenvision Craft by Resilient GreenVision. Ethically sourced, earth-honoring artisan goods.', 'gv-craft' ),
		'footer_engineering'  => __( 'Powered by environmental consulting & water treatment solutions.', 'gv-craft' ),
		'footer_phone'        => '+88 01825-339032',
		'footer_email'        => 'contact@resilientgreenvision.com',

		// Social.
		'social_facebook'     => '',
		'social_instagram'    => '',
		'social_linkedin'     => '',
		'social_twitter'      => '',
		'social_youtube'      => '',
	);
}

/**
 * Read a theme option with a sensible default.
 *
 * @param string $key     Option key (without prefix).
 * @param string $default Optional explicit default.
 * @return mixed
 */
function gvc_option( $key, $default = '' ) {
	$defaults = gvc_defaults();

	if ( '' !== $default ) {
		return get_theme_mod( 'gvc_' . $key, $default );
	}

	return get_theme_mod( 'gvc_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

/**
 * Print a Material Symbols icon.
 *
 * @param string $name    Icon name.
 * @param string $classes Extra CSS classes.
 */
function gvc_icon( $name, $classes = '' ) {
	printf(
		'<span class="gvc-icon %s" aria-hidden="true">%s</span>',
		esc_attr( $classes ),
		esc_html( $name )
	);
}

/**
 * Render a star rating.
 *
 * @param float $rating Rating between 0 and 5.
 * @param int   $count  Optional review count appended.
 */
function gvc_stars( $rating, $count = 0 ) {
	$rating = max( 0, min( 5, (float) $rating ) );
	$html   = '<span class="gvc-stars" role="img" aria-label="' . esc_attr( sprintf( /* translators: %s: rating value. */ __( 'Rated %s out of 5', 'gv-craft' ), $rating ) ) . '">';

	for ( $i = 1; $i <= 5; $i++ ) {
		if ( $rating >= $i ) {
			$html .= '<span class="gvc-stars__star is-on"></span>';
		} elseif ( $rating >= $i - 0.5 ) {
			$html .= '<span class="gvc-stars__star is-half"></span>';
		} else {
			$html .= '<span class="gvc-stars__star"></span>';
		}
	}

	$html .= '</span>';

	if ( $count ) {
		$html .= '<span class="gvc-product-card__rating__count">(' . (int) $count . ')</span>';
	}

	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * URL of the bundled fallback image.
 *
 * @param string $size Image size.
 * @return string
 */
function gvc_placeholder_url( $size = 'full' ) {
	return GVC_URI . 'assets/img/placeholder.svg';
}

/**
 * The site logo markup (custom logo when set, bundled SVG otherwise).
 *
 * @param bool $light Use the light (dark background) variant.
 */
function gvc_logo( $light = false ) {
	if ( has_custom_logo() ) {
		$logo_id = get_theme_mod( 'custom_logo' );
		$logo    = wp_get_attachment_image( $logo_id, 'full', false, array( 'alt' => get_bloginfo( 'name' ) ) );

		if ( $logo ) {
			echo $logo; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			return;
		}
	}

	$src = $light ? GVC_URI . 'assets/img/logo-light.svg' : GVC_URI . 'assets/img/logo.svg';

	printf(
		'<img src="%s" width="240" height="60" alt="%s" />',
		esc_url( $src ),
		esc_attr( get_bloginfo( 'name' ) )
	);
}

/**
 * Does the assigned static front page hold real content?
 *
 * When the front page is empty the theme renders its designed home layout.
 *
 * @return bool
 */
function gvc_front_page_has_content() {
	if ( ! is_front_page() ) {
		return false;
	}

	$front_id = (int) get_option( 'page_on_front' );

	if ( ! $front_id ) {
		return false;
	}

	$post = get_post( $front_id );

	if ( ! $post ) {
		return false;
	}

	$content = trim( (string) $post->post_content );

	if ( '' === $content ) {
		return false;
	}

	// The block editor stores empty pages as a single empty paragraph.
	if ( '<p></p>' === $content || '<p>&nbsp;</p>' === $content ) {
		return false;
	}

	return true;
}

/**
 * WooCommerce is installed and active?
 *
 * @return bool
 */
function gvc_woocommerce_active() {
	return class_exists( 'WooCommerce' );
}

/**
 * Is the current request a WooCommerce page?
 *
 * @return bool
 */
function gvc_is_woocommerce_page() {
	if ( ! gvc_woocommerce_active() ) {
		return false;
	}

	return ( function_exists( 'is_woocommerce' ) && is_woocommerce() )
		|| ( function_exists( 'is_cart' ) && is_cart() )
		|| ( function_exists( 'is_checkout' ) && is_checkout() )
		|| ( function_exists( 'is_account_page' ) && is_account_page() )
		|| is_page_template( 'page-templates/template-shop.php' );
}

/**
 * Get the WooCommerce cart item count.
 *
 * @return int
 */
function gvc_cart_count() {
	if ( ! gvc_woocommerce_active() || ! function_exists( 'WC' ) || ! WC() || ! WC()->cart ) {
		return 0;
	}

	return (int) WC()->cart->get_cart_contents_count();
}

/**
 * Get the WooCommerce cart subtotal as a formatted string.
 *
 * @return string
 */
function gvc_cart_total() {
	if ( ! gvc_woocommerce_active() || ! function_exists( 'WC' ) || ! WC() || ! WC()->cart ) {
		return '';
	}

	return WC()->cart->get_cart_subtotal();
}

/**
 * Escape and print a string of HTML.
 *
 * @param string $html Raw HTML.
 */
function gvc_kses( $html ) {
	echo wp_kses_post( $html );
}

/**
 * Read a GV Craft product meta value.
 *
 * @param WC_Product|int $product Product or ID.
 * @param string         $key     Meta key without prefix.
 * @param string         $default Fallback.
 * @return string
 */
function gvc_product_meta( $product, $key, $default = '' ) {
	if ( is_numeric( $product ) && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $product );
	}

	if ( ! $product || ! is_object( $product ) || ! method_exists( $product, 'get_meta' ) ) {
		return $default;
	}

	$value = $product->get_meta( '_gvc_' . $key );

	return ( '' === $value || null === $value ) ? $default : $value;
}

/**
 * The eco badge list attached to a product.
 *
 * @param WC_Product|int $product Product or ID.
 * @return array
 */
function gvc_product_badges( $product ) {
	$raw = gvc_product_meta( $product, 'badges' );

	if ( ! $raw ) {
		return array();
	}

	$badges = array_filter( array_map( 'trim', explode( '|', $raw ) ) );

	return array_values( $badges );
}

/**
 * A stable, readable placeholder for missing product images.
 *
 * @param int $id Attachment ID.
 * @return string
 */
function gvc_image_fallback( $id = 0 ) {
	return gvc_placeholder_url();
}

/**
 * Format a number for the impact counters.
 *
 * @param string $value Raw value.
 * @return string
 */
function gvc_impact_value( $value ) {
	return $value;
}

/**
 * Convert a YouTube/Vimeo URL to an embed URL (used on the journal + impact pages).
 *
 * @param string $url URL.
 * @return string
 */
function gvc_video_embed_url( $url ) {
	if ( ! $url ) {
		return '';
	}

	if ( preg_match( '/youtube\.com\/watch\?v=([A-Za-z0-9_-]+)/', $url, $m ) ) {
		return 'https://www.youtube.com/embed/' . $m[1];
	}

	if ( preg_match( '/youtu\.be\/([A-Za-z0-9_-]+)/', $url, $m ) ) {
		return 'https://www.youtube.com/embed/' . $m[1];
	}

	if ( preg_match( '/vimeo\.com\/(\d+)/', $url, $m ) ) {
		return 'https://player.vimeo.com/video/' . $m[1];
	}

	return '';
}
