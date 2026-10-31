<?php
/**
 * Front page — sustainable craft disciplines.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_count = max( 2, (int) gvc_option( 'cats_count', 4 ) );
$gvc_terms = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'number'     => $gvc_count,
		'parent'     => 0,
		'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
	)
);

if ( is_wp_error( $gvc_terms ) ) {
	return;
}

$gvc_icons = array(
	'mats-rugs'            => array( 'spa', 'Organic Wool & Cotton' ),
	'ceramics'             => array( 'water_drop', 'Non-toxic River Clay' ),
	'jute-fibers'          => array( 'yard', '100% Golden Jute' ),
	'woodcraft'            => array( 'park', 'FSC Salvaged Timber' ),
	'sustainable-tableware' => array( 'restaurant', 'Compostable by Design' ),
	'botanical-decor'      => array( 'potted_plant', 'Plant-Dyed Pigments' ),
	'zero-waste-kitchen'   => array( 'recycling', '100% Biodegradable' ),
);
?>
<section class="gvc-section gvc-section--cream" id="catalog">
	<div class="gvc-container gvc-container--full">

		<?php
		gvc_section_head(
			array(
				'eyebrow'      => gvc_option( 'cats_eyebrow' ),
				'eyebrow_icon' => 'potted_plant',
				'title'        => gvc_option( 'cats_title' ),
				'text'         => gvc_option( 'cats_text' ),
			)
		);
		?>

		<div class="gvc-grid gvc-grid--4">

			<?php
			if ( empty( $gvc_terms ) ) :
				?>
				<p class="gvc-empty-state"><?php esc_html_e( 'Craft disciplines will appear here soon.', 'gv-craft' ); ?></p>
			<?php endif; ?>

			<?php foreach ( $gvc_terms as $gvc_term ) :
				$gvc_image_id = (int) get_term_meta( $gvc_term->term_id, 'thumbnail_id', true );

				if ( ! $gvc_image_id ) {
					$gvc_first = get_posts(
						array(
							'post_type'      => 'product',
							'posts_per_page' => 1,
							'fields'         => 'ids',
							'tax_query'      => array(
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'term_id',
									'terms'    => $gvc_term->term_id,
								),
							),
						)
					);

					if ( ! empty( $gvc_first ) ) {
						$gvc_image_id = get_post_thumbnail_id( $gvc_first[0] );
					}
				}

				$gvc_meta   = isset( $gvc_icons[ $gvc_term->slug ] ) ? $gvc_icons[ $gvc_term->slug ] : array( 'eco', 'Ethical Origin' );
				$gvc_link   = gvc_woocommerce_active() ? get_term_link( $gvc_term ) : '';
				$gvc_count_products = (int) $gvc_term->count;
				?>
				<article class="gvc-cat-card">
					<div class="gvc-media gvc-media--square gvc-media--zoom">
						<?php if ( $gvc_image_id ) : ?>
							<?php echo wp_get_attachment_image( $gvc_image_id, 'gvc-card', false, array( 'loading' => 'lazy', 'alt' => $gvc_term->name ) ); ?>
						<?php else : ?>
							<img src="<?php echo esc_url( gvc_placeholder_url() ); ?>" alt="<?php echo esc_attr( $gvc_term->name ); ?>" loading="lazy" />
						<?php endif; ?>

						<span class="gvc-badge gvc-badge--floating" style="position: absolute; top: 0.75rem; left: 0.75rem;">
							<?php gvc_icon( $gvc_meta[0], 'gvc-icon--sm' ); ?>
							<?php echo esc_html( $gvc_meta[1] ); ?>
						</span>
					</div>

					<div class="gvc-cat-card__body">
						<div>
							<h3 class="gvc-title-lg" style="margin: 0;"><?php echo esc_html( $gvc_term->name ); ?></h3>
							<?php if ( $gvc_term->description ) : ?>
								<p class="gvc-body-sm gvc-muted" style="margin: 0.375rem 0 0;">
									<?php echo esc_html( wp_trim_words( $gvc_term->description, 18 ) ); ?>
								</p>
							<?php endif; ?>
						</div>

						<div class="gvc-cat-card__foot">
							<span class="gvc-label-md gvc-muted">
								<?php
								printf(
									/* translators: %s: number of artifacts. */
									esc_html__( 'View %s Artifacts', 'gv-craft' ),
									esc_html( number_format_i18n( $gvc_count_products ) )
								);
								?>
							</span>
							<a class="gvc-link-arrow" href="<?php echo esc_url( $gvc_link ); ?>">
								<span class="screen-reader-text"><?php echo esc_html( $gvc_term->name ); ?></span>
								<?php gvc_icon( 'chevron_right', 'gvc-icon--sm' ); ?>
							</a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>

		</div>
	</div>
</section>
