<?php
/**
 * Page content — Care & Repair.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_care = array(
	array(
		'texture',
		__( 'Wool & linen mats', 'gv-craft' ),
		array(
			__( 'Vacuum regularly on low suction without a rotary beater bar.', 'gv-craft' ),
			__( 'Blot spills immediately with unbleached damp cotton cloth and cold water — never scrub.', 'gv-craft' ),
			__( 'Use a pH-neutral, plant-based biodegradable wool wash for deeper cleaning.', 'gv-craft' ),
			__( 'Rotate twice annually for an even natural patina over generations.', 'gv-craft' ),
		),
	),
	array(
		'water_drop',
		__( 'Clay & glazed ceramics', 'gv-craft' ),
		array(
			__( 'Wash with warm water and a soft cloth; avoid abrasive sponges.', 'gv-craft' ),
			__( 'Do not put kiln-fired stoneware in the dishwasher.', 'gv-craft' ),
			__( 'Keep unglazed bases off wet surfaces to protect the natural seal.', 'gv-craft' ),
			__( 'Store stacked pieces with a felt layer to avoid rim marks.', 'gv-craft' ),
		),
	),
	array(
		'park',
		__( 'Wood & bamboo', 'gv-craft' ),
		array(
			__( 'Hand wash and dry upright immediately.', 'gv-craft' ),
			__( 'Re-oil with food-grade tung or beeswax twice a year.', 'gv-craft' ),
			__( 'Never soak — swelling and splitting are irreversible.', 'gv-craft' ),
			__( 'Keep away from direct radiator heat.', 'gv-craft' ),
		),
	),
	array(
		'texture',
		__( 'Jute & natural fibres', 'gv-craft' ),
		array(
			__( 'Spot clean with cold water and a mild plant soap.', 'gv-craft' ),
			__( 'Air dry in shade to keep the natural fibre supple.', 'gv-craft' ),
			__( 'Store folded, never hung, to prevent stretch marks.', 'gv-craft' ),
			__( 'A light mist of water relaxes a tired weave.', 'gv-craft' ),
		),
	),
);
?>
<div class="gvc-split gvc-split--6-6" style="align-items: center;">
	<div>
		<div class="gvc-eyebrow gvc-eyebrow--upper">
			<?php gvc_icon( 'build', 'gvc-icon--sm' ); ?>
			<?php esc_html_e( '10-year craft pledge', 'gv-craft' ); ?>
		</div>
		<h2 style="margin: 0.75rem 0;"><?php esc_html_e( 'Care that keeps the craft alive', 'gv-craft' ); ?></h2>
		<p class="gvc-body-lg gvc-muted">
			<?php esc_html_e( 'Every piece is made to be kept. For ten years from the day it leaves the guild we will restore stitching, replace natural latex backing, re-glaze ceramics and re-oil timber — free of charge.', 'gv-craft' ); ?>
		</p>
		<a class="gvc-btn gvc-btn--primary gvc-mt-2" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">
			<?php esc_html_e( 'Request a repair', 'gv-craft' ); ?>
			<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
		</a>
	</div>
	<div>
		<img src="<?php echo esc_url( GVC_URI . 'assets/img/demo/rug-texture-macro.jpg' ); ?>" alt="<?php esc_attr_e( 'Close-up of hand tufted wool', 'gv-craft' ); ?>" style="border-radius: var(--gvc-radius-md); width: 100%;" loading="lazy" />
	</div>
</div>

<div class="gvc-grid gvc-grid--2" style="margin-top: 3rem; gap: 1.5rem;">
	<?php foreach ( $gvc_care as $gvc_item ) : ?>
		<div class="gvc-card" style="padding: 1.5rem;">
			<div class="gvc-guarantee__icon" style="margin-bottom: 1rem;">
				<?php gvc_icon( $gvc_item[0], 'gvc-icon--lg' ); ?>
			</div>
			<h3 class="gvc-title-lg" style="margin: 0 0 0.75rem; color: var(--gvc-forest);"><?php echo esc_html( $gvc_item[1] ); ?></h3>
			<ul class="gvc-checklist">
				<?php foreach ( $gvc_item[2] as $gvc_tip ) : ?>
					<li>
						<?php gvc_icon( 'check_circle', 'gvc-icon--sm' ); ?>
						<div class="gvc-body-sm gvc-muted"><?php echo esc_html( $gvc_tip ); ?></div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endforeach; ?>
</div>

<div class="gvc-card" style="padding: 2rem; margin-top: 2.5rem; background: var(--gvc-cream-dark);">
	<h3 class="gvc-title-lg" style="margin: 0 0 0.75rem; color: var(--gvc-forest);"><?php esc_html_e( 'Circular trade-in', 'gv-craft' ); ?></h3>
	<p class="gvc-body-md gvc-muted" style="max-width: 46rem;">
		<?php esc_html_e( 'When a piece has finished its life in your home, send it back. We will repair it for another household, or compost it and credit you 20% of the original value towards a replacement — a closed loop that keeps fibres out of landfill.', 'gv-craft' ); ?>
	</p>
</div>
