<?php
/**
 * Front page — artisan guild spotlight.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_cta_url = gvc_option( 'guild_cta_url' );

if ( ! $gvc_cta_url ) {
	$gvc_cta_url = home_url( '/artisan-guilds/' );
}

$gvc_images = array();

if ( gvc_woocommerce_active() ) {
	$gvc_product_ids = get_posts(
		array(
			'post_type'      => 'product',
			'posts_per_page' => 2,
			'fields'         => 'ids',
			'orderby'        => 'rand',
		)
	);

	foreach ( $gvc_product_ids as $gvc_product_id ) {
		$gvc_thumb = get_post_thumbnail_id( $gvc_product_id );

		if ( $gvc_thumb ) {
			$gvc_images[] = $gvc_thumb;
		}
	}
}
?>
<section class="gvc-section" id="guilds">
	<div class="gvc-container">
		<div class="gvc-split gvc-split--5-7">

			<div>
				<div class="gvc-eyebrow">
					<?php gvc_icon( 'groups', 'gvc-icon--sm' ); ?>
					<?php echo esc_html( gvc_option( 'guild_eyebrow' ) ); ?>
				</div>

				<h2 style="margin: 0.75rem 0;"><?php echo esc_html( gvc_option( 'guild_title' ) ); ?></h2>

				<p class="gvc-body-lg gvc-muted">
					<?php echo esc_html( gvc_option( 'guild_text' ) ); ?>
				</p>

				<ul class="gvc-checklist" style="margin-top: 1.5rem;">
					<li>
						<?php gvc_icon( 'check_circle' ); ?>
						<div>
							<h4 class="gvc-title-md" style="margin: 0 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Guaranteed Forward Purchase Agreements', 'gv-craft' ); ?></h4>
							<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'We eliminate middlemen, paying 50% upfront before tufting commences.', 'gv-craft' ); ?></p>
						</div>
					</li>
					<li>
						<?php gvc_icon( 'check_circle' ); ?>
						<div>
							<h4 class="gvc-title-md" style="margin: 0 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Water Treatment Engineering Support', 'gv-craft' ); ?></h4>
							<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Resilient GreenVision installs small-scale community filtration plants (WTP & ETP) across cluster villages.', 'gv-craft' ); ?></p>
						</div>
					</li>
					<li>
						<?php gvc_icon( 'check_circle' ); ?>
						<div>
							<h4 class="gvc-title-md" style="margin: 0 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Non-Toxic Pigment Revival', 'gv-craft' ); ?></h4>
							<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( '100% natural madder, indigo, turmeric, and walnut bark coloring.', 'gv-craft' ); ?></p>
						</div>
					</li>
				</ul>

				<p style="margin-top: 1.5rem;">
					<a class="gvc-link-arrow" style="font-size: 14px;" href="<?php echo esc_url( $gvc_cta_url ); ?>">
						<?php echo esc_html( gvc_option( 'guild_cta' ) ); ?>
						<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
					</a>
				</p>
			</div>

			<div>
				<div class="gvc-grid gvc-grid--2" style="align-items: start;">
					<?php
					$gvc_first  = isset( $gvc_images[0] ) ? $gvc_images[0] : 0;
					$gvc_second = isset( $gvc_images[1] ) ? $gvc_images[1] : $gvc_first;

					if ( $gvc_first ) :
						?>
						<div class="gvc-media gvc-media--portrait gvc-card" style="border-radius: var(--gvc-radius-md); overflow: hidden;">
							<?php echo wp_get_attachment_image( $gvc_first, 'gvc-portrait', false, array( 'loading' => 'lazy', 'alt' => esc_attr__( 'Botanical rug craftsmanship', 'gv-craft' ) ) ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $gvc_second ) : ?>
						<div class="gvc-media gvc-media--portrait gvc-card" style="border-radius: var(--gvc-radius-md); overflow: hidden; margin-top: 2rem;">
							<?php echo wp_get_attachment_image( $gvc_second, 'gvc-portrait', false, array( 'loading' => 'lazy', 'alt' => esc_attr__( 'Hand tufted mat in a sunlit living room', 'gv-craft' ) ) ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</section>
