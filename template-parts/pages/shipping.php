<?php
/**
 * Page content — Shipping & Returns.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_shipping = array(
	array(
		'local_shipping',
		__( 'Dispatch', 'gv-craft' ),
		__( 'In-stock pieces leave the workshop within 2 working days. Bespoke dimensions and made-to-order batches take 2–3 weeks, and you will receive the batch number before dispatch.', 'gv-craft' ),
	),
	array(
		'public',
		__( 'Delivery', 'gv-craft' ),
		__( 'Domestic orders arrive in 2–4 working days. International orders travel in weekly consolidated freight to keep emissions low, typically 7–14 days after dispatch.', 'gv-craft' ),
	),
	array(
		'energy_savings_leaf',
		__( 'Carbon-neutral transit', 'gv-craft' ),
		__( 'Every mile is measured and offset through verified mangrove conservation in the Sundarbans. Offsets are published with the quarterly impact disclosure.', 'gv-craft' ),
	),
	array(
		'restore',
		__( 'Returns', 'gv-craft' ),
		__( 'You have 30 days to live with a piece. Returns are free and carbon-neutral; we collect from your door and credit 10% of the piece value towards a future order.', 'gv-craft' ),
	),
	array(
		'recycling',
		__( 'Packaging', 'gv-craft' ),
		__( 'Unbleached recycled board, soy inks and water-activated paper tape. No plastic film, no void fill, no plastic tape — ever.', 'gv-craft' ),
	),
	array(
		'verified_user',
		__( 'Damage & loss', 'gv-craft' ),
		__( 'Every parcel is insured and tracked. If something arrives damaged we replace it immediately, no photographs and no return required.', 'gv-craft' ),
	),
);
?>
<div class="gvc-grid gvc-grid--2" style="gap: 1.5rem;">
	<?php foreach ( $gvc_shipping as $gvc_item ) : ?>
		<div class="gvc-card" style="padding: 1.5rem;">
			<div class="gvc-guarantee__icon" style="margin-bottom: 1rem;">
				<?php gvc_icon( $gvc_item[0], 'gvc-icon--lg' ); ?>
			</div>
			<h3 class="gvc-title-lg" style="margin: 0 0 0.5rem; color: var(--gvc-forest);"><?php echo esc_html( $gvc_item[1] ); ?></h3>
			<p class="gvc-body-md gvc-muted" style="margin: 0;"><?php echo esc_html( $gvc_item[2] ); ?></p>
		</div>
	<?php endforeach; ?>
</div>

<div class="gvc-card" style="padding: 2rem; margin-top: 2.5rem;">
	<h3 class="gvc-title-lg" style="margin: 0 0 1rem; color: var(--gvc-forest);"><?php esc_html_e( 'Rate card', 'gv-craft' ); ?></h3>
	<table class="gvc-cart-table" style="border: 0;">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Destination', 'gv-craft' ); ?></th>
				<th><?php esc_html_e( 'Standard', 'gv-craft' ); ?></th>
				<th><?php esc_html_e( 'Transit time', 'gv-craft' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php esc_html_e( 'Bangladesh', 'gv-craft' ); ?></td>
				<td><?php esc_html_e( 'Free over $75, otherwise $8', 'gv-craft' ); ?></td>
				<td><?php esc_html_e( '2–4 working days', 'gv-craft' ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'South Asia', 'gv-craft' ); ?></td>
				<td><?php esc_html_e( '$16', 'gv-craft' ); ?></td>
				<td><?php esc_html_e( '5–8 working days', 'gv-craft' ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Europe & Middle East', 'gv-craft' ); ?></td>
				<td><?php esc_html_e( '$24', 'gv-craft' ); ?></td>
				<td><?php esc_html_e( '7–12 working days', 'gv-craft' ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Rest of world', 'gv-craft' ); ?></td>
				<td><?php esc_html_e( '$32', 'gv-craft' ); ?></td>
				<td><?php esc_html_e( '10–16 working days', 'gv-craft' ); ?></td>
			</tr>
		</tbody>
	</table>
</div>
