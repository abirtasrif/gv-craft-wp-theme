<?php
/**
 * Page content — Wishlist.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_wishlist_ids = array();

if ( gvc_woocommerce_active() ) {
	$gvc_wishlist_ids = get_posts(
		array(
			'post_type'      => 'product',
			'posts_per_page' => 60,
			'fields'         => 'ids',
		)
	);
}
?>
<div class="gvc-split gvc-split--6-6" style="align-items: center; margin-bottom: 2.5rem;">
	<div>
		<div class="gvc-eyebrow gvc-eyebrow--upper">
			<?php gvc_icon( 'favorite', 'gvc-icon--sm' ); ?>
			<?php esc_html_e( 'Saved for later', 'gv-craft' ); ?>
		</div>
		<h2 style="margin: 0.75rem 0;"><?php esc_html_e( 'Your wishlist', 'gv-craft' ); ?></h2>
		<p class="gvc-body-lg gvc-muted" style="margin: 0;">
			<?php esc_html_e( 'Pieces you save are kept on this device so you can decide later — no account, no newsletter, no noise.', 'gv-craft' ); ?>
		</p>
	</div>
	<div>
		<img src="<?php echo esc_url( GVC_URI . 'assets/img/demo/delta-jute-tote.jpg' ); ?>" alt="<?php esc_attr_e( 'Handwoven jute tote', 'gv-craft' ); ?>" style="border-radius: var(--gvc-radius-md); width: 100%;" loading="lazy" />
	</div>
</div>

<?php if ( empty( $gvc_wishlist_ids ) ) : ?>

	<div class="gvc-card" style="padding: 2.5rem; text-align: center;">
		<p class="gvc-lede"><?php esc_html_e( 'No saved pieces yet — browse the catalogue and tap the heart on anything you love.', 'gv-craft' ); ?></p>
		<?php if ( gvc_woocommerce_active() ) : ?>
			<a class="gvc-btn gvc-btn--primary" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Browse the catalogue', 'gv-craft' ); ?></a>
		<?php endif; ?>
	</div>

<?php else : ?>

	<div class="gvc-products gvc-products--4" id="gvc-wishlist-grid">
		<?php
		foreach ( $gvc_wishlist_ids as $gvc_product_id ) {
			$gvc_product = wc_get_product( $gvc_product_id );

			if ( ! $gvc_product ) {
				continue;
			}
			?>
			<div class="gvc-wishlist-item" data-gvc-wishlist-item="<?php echo esc_attr( $gvc_product_id ); ?>" style="display: none;">
				<?php gvc_product_card( $gvc_product ); ?>
			</div>
		<?php } ?>
	</div>

	<div class="gvc-card" id="gvc-wishlist-empty" style="padding: 2.5rem; text-align: center; margin-top: 1.5rem;">
		<p class="gvc-lede"><?php esc_html_e( 'Nothing saved on this device yet. Tap the heart on any piece to keep it here.', 'gv-craft' ); ?></p>
		<a class="gvc-btn gvc-btn--primary" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Browse the catalogue', 'gv-craft' ); ?></a>
	</div>

<?php endif; ?>
