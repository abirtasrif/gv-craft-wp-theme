<?php
/**
 * Product card used in every product loop.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) ) {
	$product = wc_get_product( get_the_ID() );
}

if ( ! $product || ! $product->is_visible() ) {
	return;
}

$gvc_permalink = $product->get_permalink();
$gvc_badges    = gvc_product_badges( $product );
$gvc_guild     = gvc_product_meta( $product, 'guild' );
$gvc_stock     = $product->is_in_stock();
$gvc_image_id  = $product->get_image_id();
$gvc_image     = $gvc_image_id ? wp_get_attachment_image( $gvc_image_id, 'gvc-card', false, array( 'loading' => 'lazy', 'alt' => $product->get_name() ) ) : '';
$gvc_label     = $product->add_to_cart_description();
?>

<div class="gvc-product-card <?php echo $gvc_stock ? '' : 'is-out'; ?>">

	<div class="gvc-product-card__media">
		<?php if ( $gvc_badges ) : ?>
			<div class="gvc-product-card__tags">
				<?php foreach ( array_slice( $gvc_badges, 0, 2 ) as $gvc_badge ) : ?>
					<span class="gvc-badge"><?php echo esc_html( $gvc_badge ); ?></span>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<button class="gvc-product-card__wish" type="button" aria-label="<?php esc_attr_e( 'Save to wishlist', 'gv-craft' ); ?>" data-gvc-wishlist="<?php echo esc_attr( $product->get_id() ); ?>">
			<?php gvc_icon( 'favorite', 'gvc-icon--sm' ); ?>
		</button>

		<a href="<?php echo esc_url( $gvc_permalink ); ?>" aria-label="<?php echo esc_attr( $product->get_name() ); ?>">
			<?php if ( $gvc_image ) : ?>
				<?php echo wp_kses_post( $gvc_image ); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( gvc_placeholder_url() ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" loading="lazy" />
			<?php endif; ?>
		</a>

		<?php if ( ! $gvc_stock ) : ?>
			<span class="gvc-badge gvc-badge--dark" style="position: absolute; bottom: 0.75rem; left: 0.75rem;">
				<?php esc_html_e( 'Sold out', 'gv-craft' ); ?>
			</span>
		<?php endif; ?>
	</div>

	<div class="gvc-product-card__body">
		<div>
			<?php if ( $gvc_guild ) : ?>
				<span class="gvc-product-card__guild"><?php echo esc_html( $gvc_guild ); ?></span>
			<?php endif; ?>

			<h3 class="gvc-product-card__title">
				<a href="<?php echo esc_url( $gvc_permalink ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
			</h3>

			<?php if ( $product->get_review_count() > 0 ) : ?>
				<div class="gvc-product-card__rating">
					<?php gvc_stars( $product->get_average_rating(), $product->get_review_count() ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="gvc-product-card__foot">
			<div class="gvc-product-card__price">
				<?php echo wp_kses_post( $product->get_price_html() ); ?>
			</div>

			<?php if ( $product->is_type( 'simple' ) && $gvc_stock ) : ?>
				<button class="gvc-add-btn" type="button" data-gvc-add="<?php echo esc_attr( $product->get_id() ); ?>" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: product name. */ __( 'Add %s to bag', 'gv-craft' ), $product->get_name() ) ); ?>">
					<?php gvc_icon( 'add_shopping_cart', 'gvc-icon--sm' ); ?>
				</button>
			<?php elseif ( $gvc_stock ) : ?>
				<a class="gvc-add-btn" href="<?php echo esc_url( $gvc_permalink ); ?>" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: product name. */ __( 'View %s', 'gv-craft' ), $product->get_name() ) ); ?>">
					<?php gvc_icon( 'visibility', 'gvc-icon--sm' ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>
