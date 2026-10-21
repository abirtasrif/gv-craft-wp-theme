<?php
/**
 * Cart page.
 *
 * Built on the WooCommerce 11 template API and styled with the GV Craft design
 * system.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
?>

<div class="gvc-section" style="padding-top: 0;">
	<h1 style="margin-bottom: 0.5rem;"><?php esc_html_e( 'Your bag', 'gv-craft' ); ?></h1>
	<p class="gvc-lede" style="margin-bottom: 2rem;"><?php esc_html_e( 'Everything you select funds living wages and habitat restoration.', 'gv-craft' ); ?></p>

	<?php if ( wc_notice_count() > 0 ) : ?>
		<?php woocommerce_output_all_notices(); ?>
	<?php endif; ?>

	<form class="woocommerce-cart-form gvc-cart-layout" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<div>
			<table class="gvc-cart-table">
				<thead>
					<tr>
						<th scope="col" class="product-remove"><span class="screen-reader-text"><?php esc_html_e( 'Remove item', 'gv-craft' ); ?></span></th>
						<th scope="col" class="product-thumbnail"><span class="screen-reader-text"><?php esc_html_e( 'Thumbnail image', 'gv-craft' ); ?></span></th>
						<th scope="col" class="product-name"><?php esc_html_e( 'Piece', 'gv-craft' ); ?></th>
						<th scope="col" class="product-price"><?php esc_html_e( 'Price', 'gv-craft' ); ?></th>
						<th scope="col" class="product-quantity"><?php esc_html_e( 'Quantity', 'gv-craft' ); ?></th>
						<th scope="col" class="product-subtotal"><?php esc_html_e( 'Subtotal', 'gv-craft' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						$visible = apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key );

						if ( ! ( $_product instanceof WC_Product ) || ! $_product->exists() || 0 === $cart_item['quantity'] || ! $visible ) {
							continue;
						}

						$cart_item_name    = WC()->cart->get_item_product_name( $cart_item, $_product );
						$product_name      = apply_filters( 'woocommerce_cart_item_name', $cart_item_name, $cart_item, $cart_item_key );
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<td class="product-remove">
								<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a role="button" href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_attr( sprintf( /* translators: %s is the product name */ __( 'Remove %s from your bag', 'gv-craft' ), wp_strip_all_tags( $product_name ) ) ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
								?>
							</td>

							<td class="product-thumbnail">
								<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo wp_kses_post( $thumbnail );
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
								}
								?>
							</td>

							<td role="rowheader" class="product-name" data-title="<?php esc_attr_e( 'Piece', 'gv-craft' ); ?>">
								<div class="gvc-cart-product">
									<div>
										<?php if ( ! $product_permalink ) : ?>
											<span class="gvc-cart-product__name"><?php echo wp_kses_post( $product_name ); ?></span>
										<?php else : ?>
											<a class="gvc-cart-product__name" href="<?php echo esc_url( $product_permalink ); ?>">
												<?php echo wp_kses_post( $cart_item_name ); ?>
											</a>
										<?php endif; ?>

										<?php do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key ); ?>

										<div class="gvc-cart-product__meta">
											<?php echo wc_get_formatted_cart_item_data( $cart_item, false, $cart_item_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>

										<?php if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) : ?>
											<p class="backorder_notification" style="font-size: 11px; color: var(--gvc-secondary);">
												<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) ); ?>
											</p>
										<?php endif; ?>
									</div>
								</div>
							</td>

							<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'gv-craft' ); ?>">
								<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</td>

							<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'gv-craft' ); ?>">
								<?php
								if ( $_product->is_sold_individually() ) {
									$min_quantity = 1;
									$max_quantity = 1;
								} else {
									$min_quantity = 0;
									$max_quantity = $_product->get_max_purchase_quantity();
								}

								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $max_quantity,
										'min_value'    => $min_quantity,
										'product_name' => $product_name,
									),
									$_product,
									false
								);

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								?>
							</td>

							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'gv-craft' ); ?>">
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</td>
						</tr>
					<?php } ?>

					<?php do_action( 'woocommerce_cart_contents' ); ?>
					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>

			<div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between; align-items: center; margin-top: 1.5rem;">
				<a class="gvc-link-arrow" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
					<?php gvc_icon( 'arrow_back', 'gvc-icon--sm' ); ?>
					<?php esc_html_e( 'Continue shopping', 'gv-craft' ); ?>
				</a>

				<div style="display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center;">
					<?php if ( wc_coupons_enabled() ) : ?>
						<div class="gvc-coupon">
							<label class="screen-reader-text" for="coupon_code"><?php esc_html_e( 'Coupon code', 'gv-craft' ); ?></label>
							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Guild code', 'gv-craft' ); ?>" />
							<button type="submit" class="gvc-btn gvc-btn--soft gvc-btn--sm" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'gv-craft' ); ?>">
								<?php esc_html_e( 'Apply', 'gv-craft' ); ?>
							</button>
						</div>
						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					<?php endif; ?>

					<button type="submit" class="gvc-btn gvc-btn--secondary gvc-btn--sm" name="update_cart" value="<?php esc_attr_e( 'Update bag', 'gv-craft' ); ?>">
						<?php esc_html_e( 'Update bag', 'gv-craft' ); ?>
					</button>
				</div>
			</div>

			<?php do_action( 'woocommerce_cart_actions' ); ?>

			<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
		</div>

		<div class="gvc-cart-summary">
			<h3><?php esc_html_e( 'Order summary', 'gv-craft' ); ?></h3>

			<?php
			if ( function_exists( 'woocommerce_cart_totals' ) ) {
				woocommerce_cart_totals();
			} else {
				do_action( 'woocommerce_cart_totals' );
			}
			?>

			<p class="gvc-body-sm gvc-muted" style="margin-top: 1rem; display: flex; align-items: center; gap: 0.375rem;">
				<?php gvc_icon( 'verified_user', 'gvc-icon--sm' ); ?>
				<?php esc_html_e( '256-bit encrypted, carbon-neutral delivery.', 'gv-craft' ); ?>
			</p>
		</div>

	</form>

	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
