<?php
/**
 * Front page — curated artisan goods.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

if ( ! gvc_woocommerce_active() ) {
	return;
}

$gvc_count = max( 2, (int) gvc_option( 'featured_count', 8 ) );
$gvc_ids   = get_posts(
	array(
		'post_type'      => 'product',
		'posts_per_page' => $gvc_count,
		'fields'         => 'ids',
		'meta_query'     => array(
			'relation' => 'OR',
			array(
				'key'   => '_featured',
				'value' => 'yes',
			),
			array(
				'key'     => 'total_sales',
				'compare' => 'EXISTS',
			),
		),
	)
);

if ( empty( $gvc_ids ) ) {
	$gvc_ids = get_posts(
		array(
			'post_type'      => 'product',
			'posts_per_page' => $gvc_count,
			'fields'         => 'ids',
		)
	);
}

if ( empty( $gvc_ids ) ) {
	return;
}

$gvc_shop_url = wc_get_page_permalink( 'shop' );
$gvc_chips    = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'parent'     => 0,
		'number'     => 4,
		'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
	)
);
?>
<section class="gvc-section gvc-section--white" id="featured">
	<div class="gvc-container">

		<div class="gvc-section-head gvc-section-head--split" style="border-bottom: 1px solid var(--gvc-border); padding-bottom: 1.5rem;">
			<div>
				<h2><?php echo esc_html( gvc_option( 'featured_title' ) ); ?></h2>
				<p class="gvc-body-md gvc-muted"><?php echo esc_html( gvc_option( 'featured_text' ) ); ?></p>
			</div>

			<div class="gvc-chip-row">
				<a class="gvc-chip is-active" href="<?php echo esc_url( $gvc_shop_url ); ?>"><?php esc_html_e( 'All Pieces', 'gv-craft' ); ?></a>
				<?php foreach ( $gvc_chips as $gvc_chip ) : ?>
					<a class="gvc-chip" href="<?php echo esc_url( add_query_arg( 'product_cat', $gvc_chip->slug, $gvc_shop_url ) ); ?>">
						<?php echo esc_html( $gvc_chip->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="gvc-products gvc-products--4" style="padding-top: 2.5rem;">
			<?php
			foreach ( $gvc_ids as $gvc_id ) :
				$gvc_product = wc_get_product( $gvc_id );

				if ( ! $gvc_product ) {
					continue;
				}

				gvc_product_card( $gvc_product );
			endforeach;
			?>
		</div>

		<div class="gvc-text-center gvc-mt-4">
			<a class="gvc-btn gvc-btn--secondary" href="<?php echo esc_url( $gvc_shop_url ); ?>">
				<?php esc_html_e( 'Browse the full catalogue', 'gv-craft' ); ?>
				<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
			</a>
		</div>

	</div>
</section>
