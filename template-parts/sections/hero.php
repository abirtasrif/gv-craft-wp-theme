<?php
/**
 * Front page — editorial hero.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_hero_product = null;

if ( gvc_woocommerce_active() ) {
	$gvc_ids = get_posts(
		array(
			'post_type'      => 'product',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
					'operator' => 'IN',
				),
			),
		)
	);

	if ( empty( $gvc_ids ) ) {
		$gvc_ids = get_posts(
			array(
				'post_type'      => 'product',
				'posts_per_page' => 1,
				'fields'         => 'ids',
			)
		);
	}

	if ( ! empty( $gvc_ids ) ) {
		$gvc_hero_product = wc_get_product( $gvc_ids[0] );
	}
}

$gvc_cta_url  = gvc_option( 'hero_cta_url' );
$gvc_cta2_url = gvc_option( 'hero_cta2_url' );

if ( ! $gvc_cta_url ) {
	$gvc_cta_url = gvc_woocommerce_active() ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
}

if ( ! $gvc_cta2_url ) {
	$gvc_cta2_url = home_url( '/about-us/' );
}
?>
<section class="gvc-hero">
	<div class="gvc-container gvc-container--full">
		<div class="gvc-hero__grid">

			<div class="gvc-hero__copy">
				<?php if ( gvc_option( 'hero_eyebrow' ) ) : ?>
					<span class="gvc-badge">
						<?php gvc_icon( 'compost', 'gvc-icon--sm' ); ?>
						<?php echo esc_html( gvc_option( 'hero_eyebrow' ) ); ?>
					</span>
				<?php endif; ?>

				<h1 class="gvc-hero__title">
					<?php echo esc_html( gvc_option( 'hero_title' ) ); ?><br />
					<span class="gvc-accent-text"><?php echo esc_html( gvc_option( 'hero_title_accent' ) ); ?></span>
				</h1>

				<p class="gvc-body-lg gvc-muted" style="max-width: 36rem;">
					<?php echo esc_html( gvc_option( 'hero_text' ) ); ?>
				</p>

				<div class="gvc-hero__actions">
					<a class="gvc-btn gvc-btn--primary gvc-btn--lg" href="<?php echo esc_url( $gvc_cta_url ); ?>">
						<?php echo esc_html( gvc_option( 'hero_cta_label' ) ); ?>
					</a>
					<a class="gvc-btn gvc-btn--secondary gvc-btn--lg" href="<?php echo esc_url( $gvc_cta2_url ); ?>">
						<?php echo esc_html( gvc_option( 'hero_cta2_label' ) ); ?>
						<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
					</a>
				</div>

				<dl class="gvc-hero__stats">
					<div>
						<dt><?php echo esc_html( gvc_option( 'hero_stat1_value' ) ); ?></dt>
						<dd><?php echo esc_html( gvc_option( 'hero_stat1_label' ) ); ?></dd>
					</div>
					<div>
						<dt><?php echo esc_html( gvc_option( 'hero_stat2_value' ) ); ?></dt>
						<dd><?php echo esc_html( gvc_option( 'hero_stat2_label' ) ); ?></dd>
					</div>
					<div>
						<dt><?php echo esc_html( gvc_option( 'hero_stat3_value' ) ); ?></dt>
						<dd><?php echo esc_html( gvc_option( 'hero_stat3_label' ) ); ?></dd>
					</div>
				</dl>
			</div>

			<div class="gvc-hero__showcase">
				<div class="gvc-showcase">
					<div class="gvc-showcase__image">
						<?php
						if ( $gvc_hero_product && $gvc_hero_product->get_image_id() ) {
							echo wp_get_attachment_image( $gvc_hero_product->get_image_id(), 'gvc-wide', false, array( 'alt' => $gvc_hero_product->get_name() ) );
						} else {
							printf( '<img src="%s" alt="%s" />', esc_url( gvc_placeholder_url() ), esc_attr__( 'Handcrafted artisan goods', 'gv-craft' ) );
						}
						?>

						<?php if ( gvc_option( 'hero_badge' ) ) : ?>
							<div class="gvc-badge gvc-badge--floating" style="position: absolute; top: 1rem; left: 1rem;">
								<span class="gvc-pill-dot gvc-pulse" aria-hidden="true"></span>
								<?php echo esc_html( gvc_option( 'hero_badge' ) ); ?>
							</div>
						<?php endif; ?>

						<div class="gvc-hotspot">
							<button class="gvc-hotspot__btn" type="button" aria-label="<?php esc_attr_e( 'View craft detail', 'gv-craft' ); ?>">
								<?php gvc_icon( 'nature', 'gvc-icon--sm' ); ?>
							</button>
							<div class="gvc-hotspot__tip">
								<p class="gvc-label-sm" style="color: var(--gvc-forest);"><?php echo esc_html( gvc_option( 'hero_hotspot_title' ) ); ?></p>
								<p style="font-size: 11px; color: var(--gvc-text-muted); margin: 0;"><?php echo esc_html( gvc_option( 'hero_hotspot_text' ) ); ?></p>
							</div>
						</div>
					</div>

					<?php if ( $gvc_hero_product ) : ?>
						<div class="gvc-showcase__meta">
							<div>
								<div style="display: flex; align-items: center; gap: 0.5rem;">
									<span class="gvc-label-sm" style="color: var(--gvc-secondary); text-transform: uppercase; letter-spacing: 0.08em;"><?php esc_html_e( "Editor's Pick", 'gv-craft' ); ?></span>
									<span class="gvc-body-sm gvc-muted">· <?php echo esc_html( gvc_product_meta( $gvc_hero_product, 'batch' ) ); ?></span>
								</div>
								<h3 class="gvc-title-lg" style="margin: 0.25rem 0 0; color: var(--gvc-primary);">
									<a href="<?php echo esc_url( get_permalink( $gvc_hero_product->get_id() ) ); ?>"><?php echo esc_html( $gvc_hero_product->get_name() ); ?></a>
								</h3>
								<div class="gvc-price" style="margin-top: 0.25rem;">
									<span class="gvc-price__now"><?php echo wp_kses_post( $gvc_hero_product->get_price_html() ); ?></span>
								</div>
							</div>

							<?php if ( $gvc_hero_product->is_type( 'simple' ) ) : ?>
								<button class="gvc-btn gvc-btn--primary" type="button" data-gvc-add="<?php echo esc_attr( $gvc_hero_product->get_id() ); ?>">
									<?php gvc_icon( 'add_shopping_cart', 'gvc-icon--sm' ); ?>
									<?php esc_html_e( 'Quick Add', 'gv-craft' ); ?>
								</button>
							<?php else : ?>
								<a class="gvc-btn gvc-btn--primary" href="<?php echo esc_url( get_permalink( $gvc_hero_product->get_id() ) ); ?>">
									<?php gvc_icon( 'visibility', 'gvc-icon--sm' ); ?>
									<?php esc_html_e( 'View Details', 'gv-craft' ); ?>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</section>
