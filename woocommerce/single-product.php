<?php
/**
 * Single product page.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

get_header();

global $product;

while ( have_posts() ) :
	the_post();

	if ( ! $product ) {
		$product = wc_get_product( get_the_ID() );
	}

	if ( ! $product ) {
		continue;
	}

	$gvc_gallery_ids = array_filter( array_merge( array( $product->get_image_id() ), $product->get_gallery_image_ids() ) );
	$gvc_badges      = gvc_product_badges( $product );
	$gvc_guild       = gvc_product_meta( $product, 'guild' );
	$gvc_batch       = gvc_product_meta( $product, 'batch' );
	$gvc_material    = gvc_product_meta( $product, 'material' );
	$gvc_hours       = gvc_product_meta( $product, 'craft_hours' );
	$gvc_colorways   = gvc_product_meta( $product, 'colorways' );
	$gvc_impact      = array(
		array( 'recycling', gvc_product_meta( $product, 'impact_1' ) ),
		array( 'colors', gvc_product_meta( $product, 'impact_2' ) ),
		array( 'forest', gvc_product_meta( $product, 'impact_3' ) ),
	);
	?>

	<main id="gvc-main" class="gvc-main">
		<div class="gvc-container gvc-container--commerce">

			<div style="padding-top: 0.5rem;">
				<?php gvc_breadcrumbs(); ?>
			</div>

			<div class="gvc-product" style="padding-block: 1rem 3rem;">

				<!-- Gallery -->
				<div class="gvc-product__gallery">
					<div class="gvc-product__gallery-main">
						<div class="gvc-product__badges">
							<?php foreach ( $gvc_badges as $gvc_badge ) : ?>
								<span class="gvc-badge">
									<?php gvc_icon( 'eco', 'gvc-icon--sm' ); ?>
									<?php echo esc_html( $gvc_badge ); ?>
								</span>
							<?php endforeach; ?>
							<?php if ( $gvc_batch ) : ?>
								<span class="gvc-badge gvc-badge--outline"><?php echo esc_html( $gvc_batch ); ?></span>
							<?php endif; ?>
						</div>

						<?php
						if ( $gvc_gallery_ids ) {
							$gvc_main_id = array_shift( $gvc_gallery_ids );

							echo wp_get_attachment_image( $gvc_main_id, 'gvc-wide', false, array( 'id' => 'gvc-main-image', 'alt' => $product->get_name() ) );
						} else {
							printf( '<img src="%s" alt="%s" />', esc_url( gvc_placeholder_url() ), esc_attr( $product->get_name() ) );
						}
						?>

						<button class="gvc-btn gvc-btn--soft gvc-btn--sm" type="button" style="position: absolute; right: 1rem; bottom: 1rem;" data-gvc-lightbox>
							<?php gvc_icon( 'zoom_in', 'gvc-icon--sm' ); ?>
							<?php esc_html_e( 'AR Room Visualizer', 'gv-craft' ); ?>
						</button>
					</div>

					<?php if ( ! empty( $gvc_gallery_ids ) ) : ?>
						<div class="gvc-product__thumbs">
							<?php
							$gvc_thumb_ids = array_merge( array( (int) get_post_thumbnail_id() ), $gvc_gallery_ids );
							$gvc_thumb_ids = array_slice( array_unique( array_filter( $gvc_thumb_ids ) ), 0, 4 );

							foreach ( $gvc_thumb_ids as $gvc_index => $gvc_thumb_id ) :
								?>
								<button class="gvc-product__thumb <?php echo 0 === $gvc_index ? 'is-active' : ''; ?>" type="button" data-gvc-thumb="<?php echo esc_attr( $gvc_thumb_id ); ?>">
									<?php echo wp_get_attachment_image( $gvc_thumb_id, 'gvc-card', false, array( 'alt' => $product->get_name() ) ); ?>
								</button>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if ( $gvc_material ) : ?>
						<div class="gvc-surface" style="display: flex; align-items: flex-start; gap: 1rem; padding: 1.5rem;">
							<div class="gvc-guarantee__icon" style="background: var(--gvc-mint);">
								<?php gvc_icon( 'verified', 'gvc-icon--lg' ); ?>
							</div>
							<div>
								<h2 class="gvc-title-md" style="margin: 0 0 0.25rem; color: var(--gvc-forest);">
									<?php esc_html_e( 'Authentic Guild Provenance Guarantee', 'gv-craft' ); ?>
								</h2>
								<p class="gvc-body-sm gvc-muted" style="margin: 0;">
									<?php echo esc_html( $gvc_material ); ?>
								</p>
								<?php if ( $gvc_hours ) : ?>
									<div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 0.75rem; font-size: 12px; font-weight: 600; color: var(--gvc-secondary);">
										<span style="display: inline-flex; align-items: center; gap: 0.375rem;">
											<?php gvc_icon( 'schedule', 'gvc-icon--sm' ); ?>
											<?php
											printf(
												/* translators: %s: hours. */
												esc_html__( '%s hours of hand craft', 'gv-craft' ),
												esc_html( $gvc_hours )
											);
											?>
										</span>
										<span style="display: inline-flex; align-items: center; gap: 0.375rem;">
											<?php gvc_icon( 'water_drop', 'gvc-icon--sm' ); ?>
											<?php esc_html_e( 'Zero toxic effluent', 'gv-craft' ); ?>
										</span>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<!-- Summary -->
				<div class="gvc-product__summary">
					<div class="gvc-card" style="padding: 1.5rem;">

						<?php if ( $gvc_guild ) : ?>
							<span class="gvc-product__guild">
								<?php gvc_icon( 'workspace_premium', 'gvc-icon--sm' ); ?>
								<?php echo esc_html( $gvc_guild ); ?>
								<?php if ( $gvc_batch ) : ?>
									· <?php echo esc_html( $gvc_batch ); ?>
								<?php endif; ?>
							</span>
						<?php endif; ?>

						<h1 class="gvc-product__title"><?php the_title(); ?></h1>

						<?php if ( $product->get_review_count() > 0 ) : ?>
							<div class="gvc-product__rating">
								<?php gvc_stars( $product->get_average_rating() ); ?>
								<strong style="color: var(--gvc-forest);"><?php echo esc_html( number_format_i18n( (float) $product->get_average_rating(), 1 ) ); ?></strong>
								<span>
									<?php
									printf(
										/* translators: %s: review count. */
										esc_html__( '(%s verified artisan reviews)', 'gv-craft' ),
										esc_html( number_format_i18n( $product->get_review_count() ) )
									);
									?>
								</span>
							</div>
						<?php endif; ?>

						<div class="gvc-product__price">
							<span class="gvc-price__now"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
						</div>

						<?php if ( $product->get_price() > 0 ) : ?>
							<div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 0.875rem 0; border-bottom: 1px solid var(--gvc-border); font-size: 12px; color: var(--gvc-text-muted);">
								<span style="display: inline-flex; align-items: center; gap: 0.375rem;">
									<?php gvc_icon( 'payments', 'gvc-icon--sm' ); ?>
									<?php
									printf(
										/* translators: %s: installment price. */
										esc_html__( 'or 4 interest-free payments of %s with', 'gv-craft' ),
										'<strong style="color: var(--gvc-forest);">' . wp_kses_post( wc_price( $product->get_price() / 4 ) ) . '</strong>'
									);
									?>
								</span>
								<span class="gvc-label-md" style="background: var(--gvc-cream-dark); color: var(--gvc-forest); padding: 0.125rem 0.5rem; border-radius: 4px; letter-spacing: 0.08em;">ECOPAY</span>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( array_filter( $gvc_impact ) ) ) : ?>
							<div class="gvc-product__eco">
								<div class="gvc-product__eco-head">
									<span style="display: inline-flex; align-items: center; gap: 0.375rem;">
										<?php gvc_icon( 'energy_savings_leaf', 'gvc-icon--sm' ); ?>
										<?php esc_html_e( 'Verified Ecological Ledger', 'gv-craft' ); ?>
									</span>
									<span style="font-size: 10px; color: var(--gvc-text-muted); text-transform: none; letter-spacing: 0;">
										<?php esc_html_e( 'Resilient GreenVision Audited', 'gv-craft' ); ?>
									</span>
								</div>

								<div class="gvc-product__eco-grid">
									<?php foreach ( $gvc_impact as $gvc_metric ) : ?>
										<?php
										$gvc_parts = array_map( 'trim', explode( '|', (string) $gvc_metric[1] ) );
										?>
										<div>
											<?php gvc_icon( $gvc_metric[0], 'gvc-icon--sm' ); ?>
											<strong><?php echo esc_html( isset( $gvc_parts[0] ) ? $gvc_parts[0] : '' ); ?></strong>
											<span><?php echo esc_html( isset( $gvc_parts[1] ) ? $gvc_parts[1] : '' ); ?></span>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>

						<?php
						/**
						 * Add to cart + variations.
						 */
						woocommerce_template_single_add_to_cart();
						?>

						<?php if ( $gvc_colorways ) : ?>
							<div class="gvc-product__options">
								<span class="gvc-option-label">
									<?php esc_html_e( 'Artisan Colorway:', 'gv-craft' ); ?>
									<span class="gvc-option-value" data-gvc-colorway-name></span>
								</span>
								<div class="gvc-swatch-row">
									<?php
									$gvc_color_list = array_filter( array_map( 'trim', explode( ',', $gvc_colorways ) ) );

									foreach ( $gvc_color_list as $gvc_color ) :
										$gvc_color_parts = array_map( 'trim', explode( '|', $gvc_color ) );
										$gvc_color_name  = isset( $gvc_color_parts[0] ) ? $gvc_color_parts[0] : '';
										$gvc_color_1    = isset( $gvc_color_parts[1] ) ? $gvc_color_parts[1] : '#2c694e';
										$gvc_color_2    = isset( $gvc_color_parts[2] ) ? $gvc_color_parts[2] : '#f7f9f6';
										?>
										<button class="gvc-swatch" type="button" data-gvc-colorway="<?php echo esc_attr( $gvc_color_name ); ?>" title="<?php echo esc_attr( $gvc_color_name ); ?>" aria-label="<?php echo esc_attr( $gvc_color_name ); ?>">
											<span style="background: linear-gradient(135deg, <?php echo esc_attr( $gvc_color_1 ); ?> 50%, <?php echo esc_attr( $gvc_color_2 ); ?> 50%);"></span>
										</button>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>

						<div class="gvc-product__assurance">
							<span>
								<?php gvc_icon( 'local_shipping', 'gvc-icon--sm' ); ?>
								<strong><?php esc_html_e( 'Free carbon-neutral dispatch', 'gv-craft' ); ?></strong> — <?php esc_html_e( 'every parcel offset through mangrove conservation.', 'gv-craft' ); ?>
							</span>
							<span>
								<?php gvc_icon( 'restore', 'gvc-icon--sm' ); ?>
								<strong><?php esc_html_e( '30-day circular return', 'gv-craft' ); ?></strong> — <?php esc_html_e( 'free returns and repurposing credit.', 'gv-craft' ); ?>
							</span>
							<span>
								<?php gvc_icon( 'verified_user', 'gvc-icon--sm' ); ?>
								<strong><?php esc_html_e( '10-year craft pledge', 'gv-craft' ); ?></strong> — <?php esc_html_e( 'free repair kits and stitch restoration.', 'gv-craft' ); ?>
							</span>
						</div>
					</div>
				</div>

			</div>

			<!-- Tabs -->
			<div class="gvc-tabs" data-gvc-tabs>
				<div class="gvc-tabs__list" role="tablist">
					<button type="button" class="is-active" data-gvc-tab="description" role="tab"><?php esc_html_e( 'The Craft', 'gv-craft' ); ?></button>
					<button type="button" data-gvc-tab="materials" role="tab"><?php esc_html_e( 'Materials & Specs', 'gv-craft' ); ?></button>
					<button type="button" data-gvc-tab="provenance" role="tab"><?php esc_html_e( 'Provenance', 'gv-craft' ); ?></button>
					<button type="button" data-gvc-tab="care" role="tab"><?php esc_html_e( 'Care & Repair', 'gv-craft' ); ?></button>
				</div>

				<div class="gvc-tabs__panel is-active" data-gvc-panel="description">
					<div class="gvc-entry" style="max-width: 52rem;">
						<?php the_content(); ?>
					</div>
				</div>

				<div class="gvc-tabs__panel" data-gvc-panel="materials">
					<div class="gvc-grid gvc-grid--3">
						<div class="gvc-card" style="padding: 1.5rem;">
							<div class="gvc-guarantee__icon" style="margin-bottom: 1rem;">
								<?php gvc_icon( 'texture', 'gvc-icon--lg' ); ?>
							</div>
							<h3 class="gvc-title-lg" style="margin: 0 0 0.5rem; color: var(--gvc-forest);"><?php esc_html_e( 'Handspun Fibre', 'gv-craft' ); ?></h3>
							<p class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Organic wool and linen provide natural soil resistance and springy cushion underfoot, blended with textured linen loops.', 'gv-craft' ); ?></p>
							<div class="gvc-spec"><span><?php esc_html_e( 'Pile weight', 'gv-craft' ); ?></span><strong><?php esc_html_e( '2,800 g/m²', 'gv-craft' ); ?></strong></div>
							<div class="gvc-spec"><span><?php esc_html_e( 'Fibre origin', 'gv-craft' ); ?></span><strong><?php esc_html_e( 'Ethically sourced', 'gv-craft' ); ?></strong></div>
							<div class="gvc-spec"><span><?php esc_html_e( 'Pile height', 'gv-craft' ); ?></span><strong><?php esc_html_e( '14 mm high-low tuft', 'gv-craft' ); ?></strong></div>
						</div>

						<div class="gvc-card" style="padding: 1.5rem;">
							<div class="gvc-guarantee__icon" style="margin-bottom: 1rem; background: var(--gvc-mint);">
								<?php gvc_icon( 'forest', 'gvc-icon--lg' ); ?>
							</div>
							<h3 class="gvc-title-lg" style="margin: 0 0 0.5rem; color: var(--gvc-forest);"><?php esc_html_e( 'Natural Binder', 'gv-craft' ); ?></h3>
							<p class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Conventional carpets use synthetic latex. We bind our pile with sap sustainably tapped from living rubber trees.', 'gv-craft' ); ?></p>
							<div class="gvc-spec"><span><?php esc_html_e( 'VOC emissions', 'gv-craft' ); ?></span><strong><?php esc_html_e( '0.00% clean air', 'gv-craft' ); ?></strong></div>
							<div class="gvc-spec"><span><?php esc_html_e( 'Biodegradability', 'gv-craft' ); ?></span><strong><?php esc_html_e( '100% compostable', 'gv-craft' ); ?></strong></div>
							<div class="gvc-spec"><span><?php esc_html_e( 'Floor safety', 'gv-craft' ); ?></span><strong><?php esc_html_e( 'Naturally anti-slip', 'gv-craft' ); ?></strong></div>
						</div>

						<div class="gvc-card" style="padding: 1.5rem;">
							<div class="gvc-guarantee__icon" style="margin-bottom: 1rem;">
								<?php gvc_icon( 'palette', 'gvc-icon--lg' ); ?>
							</div>
							<h3 class="gvc-title-lg" style="margin: 0 0 0.5rem; color: var(--gvc-forest);"><?php esc_html_e( 'Plant Dye Extraction', 'gv-craft' ); ?></h3>
							<p class="gvc-body-sm gvc-muted"><?php esc_html_e( 'The soothing sage and moss tones are extracted from foraged pomegranate rinds, wild indigo leaves and dried marigold flowers.', 'gv-craft' ); ?></p>
							<div class="gvc-spec"><span><?php esc_html_e( 'Mordant type', 'gv-craft' ); ?></span><strong><?php esc_html_e( 'Mineral alum', 'gv-craft' ); ?></strong></div>
							<div class="gvc-spec"><span><?php esc_html_e( 'Colourfastness', 'gv-craft' ); ?></span><strong><?php esc_html_e( 'Grade 4.5+ UV stable', 'gv-craft' ); ?></strong></div>
							<div class="gvc-spec"><span><?php esc_html_e( 'Water stewardship', 'gv-craft' ); ?></span><strong><?php esc_html_e( 'Closed-loop filtered', 'gv-craft' ); ?></strong></div>
						</div>
					</div>
				</div>

				<div class="gvc-tabs__panel" data-gvc-panel="provenance">
					<div class="gvc-split gvc-split--5-7" style="align-items: center;">
						<div class="gvc-media gvc-media--portrait gvc-card" style="border-radius: var(--gvc-radius-md); overflow: hidden;">
							<?php
							$gvc_prov = gvc_product_meta( $product, 'provenance' );

							if ( $gvc_prov ) {
								printf( '<img src="%s" alt="%s" />', esc_url( $gvc_prov ), esc_attr( $product->get_name() ) );
							} elseif ( ! empty( $gvc_gallery_ids ) ) {
								echo wp_get_attachment_image( array_shift( $gvc_gallery_ids ), 'gvc-portrait', false, array( 'alt' => $product->get_name() ) );
							} else {
								printf( '<img src="%s" alt="%s" />', esc_url( gvc_placeholder_url() ), esc_attr( $product->get_name() ) );
							}
							?>
						</div>

						<div>
							<div class="gvc-eyebrow gvc-eyebrow--upper">
								<?php gvc_icon( 'handshake', 'gvc-icon--sm' ); ?>
								<?php esc_html_e( 'Artisan Guild Collective Story', 'gv-craft' ); ?>
							</div>
							<h2 style="margin: 0.5rem 0 0.75rem;"><?php esc_html_e( 'Honoring Hands, Regenerating Ecosystems', 'gv-craft' ); ?></h2>
							<p class="gvc-body-lg gvc-muted">
								<?php
								printf(
									/* translators: %s: guild name. */
									esc_html__( 'Every piece is created inside the %s network, directly supported by the environmental engineers at Resilient GreenVision. Our decentralised cooperative equips rural craftswomen with fair living wages, solar-powered workshops and closed-loop botanical dye vats.', 'gv-craft' ),
									esc_html( $gvc_guild ? $gvc_guild : __( 'guild', 'gv-craft' ) )
								);
								?>
							</p>

							<div class="gvc-grid gvc-grid--3" style="gap: 1rem; margin-top: 1.5rem;">
								<div class="gvc-surface" style="padding: 1rem;">
									<?php gvc_icon( 'volunteer_activism', 'gvc-icon--lg' ); ?>
									<h3 class="gvc-title-md" style="margin: 0.5rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Living Wage Plus', 'gv-craft' ); ?></h3>
									<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Earners receive 185% above the local industrial benchmark.', 'gv-craft' ); ?></p>
								</div>
								<div class="gvc-surface" style="padding: 1rem;">
									<?php gvc_icon( 'solar_power', 'gvc-icon--lg' ); ?>
									<h3 class="gvc-title-md" style="margin: 0.5rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Clean Solar Looms', 'gv-craft' ); ?></h3>
									<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Off-grid clean energy runs the spinning and finishing studios.', 'gv-craft' ); ?></p>
								</div>
								<div class="gvc-surface" style="padding: 1rem;">
									<?php gvc_icon( 'water_drop', 'gvc-icon--lg' ); ?>
									<h3 class="gvc-title-md" style="margin: 0.5rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Zero Effluent Runoff', 'gv-craft' ); ?></h3>
									<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Equipped with biological ETP water purification.', 'gv-craft' ); ?></p>
								</div>
							</div>

							<blockquote style="margin: 1.5rem 0 0; padding: 1rem 1.25rem; border-left: 4px solid var(--gvc-secondary); font-style: italic; color: var(--gvc-primary); background: var(--gvc-cream-dark); border-radius: 0 var(--gvc-radius) var(--gvc-radius) 0;">
								<?php esc_html_e( '“When you place this piece in your home, you anchor our daughters in school and preserve our ancestral hand-craft wisdom for another generation.”', 'gv-craft' ); ?>
							</blockquote>
						</div>
					</div>
				</div>

				<div class="gvc-tabs__panel" data-gvc-panel="care">
					<div class="gvc-card" style="padding: 1.75rem; max-width: 52rem;">
						<h3 class="gvc-title-lg" style="margin: 0 0 0.75rem; color: var(--gvc-forest);"><?php esc_html_e( 'Regenerative care guide', 'gv-craft' ); ?></h3>
						<ul class="gvc-checklist">
							<li>
								<?php gvc_icon( 'check_circle', 'gvc-icon--sm' ); ?>
								<div class="gvc-body-md gvc-muted"><?php esc_html_e( 'Vacuum regularly on low suction without a rotary beater bar.', 'gv-craft' ); ?></div>
							</li>
							<li>
								<?php gvc_icon( 'check_circle', 'gvc-icon--sm' ); ?>
								<div class="gvc-body-md gvc-muted"><?php esc_html_e( 'Blot spills immediately with unbleached damp cotton cloth and cold water. Never scrub.', 'gv-craft' ); ?></div>
							</li>
							<li>
								<?php gvc_icon( 'check_circle', 'gvc-icon--sm' ); ?>
								<div class="gvc-body-md gvc-muted"><?php esc_html_e( 'Use pH-neutral, plant-based biodegradable wool wash.', 'gv-craft' ); ?></div>
							</li>
							<li>
								<?php gvc_icon( 'check_circle', 'gvc-icon--sm' ); ?>
								<div class="gvc-body-md gvc-muted"><?php esc_html_e( 'Rotate twice annually for an even natural patina over generations.', 'gv-craft' ); ?></div>
							</li>
							<li>
								<?php gvc_icon( 'check_circle', 'gvc-icon--sm' ); ?>
								<div class="gvc-body-md gvc-muted"><?php esc_html_e( 'Send any piece back to us for free stitch restoration within ten years.', 'gv-craft' ); ?></div>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<!-- Reviews -->
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<section class="gvc-section gvc-section--white" style="border-block: 1px solid var(--gvc-border); margin-inline: calc(var(--gvc-gutter) * -1); padding-inline: var(--gvc-gutter);">
					<?php comments_template(); ?>
				</section>
			<?php endif; ?>

			<!-- Related -->
			<section class="gvc-section">
				<?php
				$gvc_related = wc_get_related_products( $product->get_id(), 3 );

				if ( ! empty( $gvc_related ) ) :
					?>
					<div class="gvc-section-head gvc-section-head--split" style="margin-bottom: 1.5rem;">
						<div>
							<div class="gvc-eyebrow gvc-eyebrow--upper"><?php esc_html_e( 'Curated complementary pieces', 'gv-craft' ); ?></div>
							<h2 style="margin: 0;"><?php esc_html_e( 'Complete your organic space', 'gv-craft' ); ?></h2>
						</div>
						<a class="gvc-link-arrow" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
							<?php esc_html_e( 'View all', 'gv-craft' ); ?>
							<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
						</a>
					</div>

					<div class="gvc-grid gvc-grid--3">
						<?php
						foreach ( $gvc_related as $gvc_related_id ) {
							$gvc_related_product = wc_get_product( $gvc_related_id );

							if ( $gvc_related_product ) {
								gvc_product_card( $gvc_related_product );
							}
						}
						?>
					</div>
				<?php endif; ?>
			</section>

		</div>
	</main>

	<?php
endwhile;

get_footer();
