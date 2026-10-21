<?php
/**
 * Page content — FAQs.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_faqs = array(
	array(
		__( 'Are the materials really plastic-free?', 'gv-craft' ),
		__( 'Yes. Every fibre, binder, glaze and finish in the catalogue is plant, mineral or natural rubber based. We publish the full material story on each product page so you can verify it yourself.', 'gv-craft' ),
	),
	array(
		__( 'How do you guarantee artisan wages?', 'gv-craft' ),
		__( 'We pay a forward purchase price of at least 50% before production begins and the remainder on delivery. Every guild is audited annually against the regional living-wage benchmark.', 'gv-craft' ),
	),
	array(
		__( 'What does “carbon-neutral shipping” mean?', 'gv-craft' ),
		__( 'Every parcel distance is measured and offset through verified mangrove conservation projects in the Sundarbans. We publish the offsets alongside the quarterly impact disclosure.', 'gv-craft' ),
	),
	array(
		__( 'Can I return a piece that has been used?', 'gv-craft' ),
		__( 'You have 30 days to live with a piece. If it does not suit your space, we arrange a free carbon-neutral collection and credit you 10% of the piece value towards a future order or a repair.', 'gv-craft' ),
	),
	array(
		__( 'Do you repair what you sell?', 'gv-craft' ),
		__( 'For ten years. Send any piece back and we will restore stitching, replace natural latex backing or re-glaze ceramics at no charge. See the Care & Repair page for the full pledge.', 'gv-craft' ),
	),
	array(
		__( 'Is the packaging compostable?', 'gv-craft' ),
		__( 'Boxes are unbleached recycled board printed with soy ink and sealed with water-activated paper tape. The mailer bag is home-compostable within 180 days.', 'gv-craft' ),
	),
	array(
		__( 'Do you ship internationally?', 'gv-craft' ),
		__( 'We currently ship within Bangladesh and to a growing list of countries. International orders are grouped into weekly consolidated shipments to keep freight emissions low.', 'gv-craft' ),
	),
	array(
		__( 'How can I join the guild network?', 'gv-craft' ),
		__( 'We accept new cooperatives through the Artisan Guilds page — send us a field report describing your craft, materials and current capacity, and our team will respond within a week.', 'gv-craft' ),
	),
);
?>
<div class="gvc-faq" style="max-width: 52rem;">
	<?php foreach ( $gvc_faqs as $gvc_index => $gvc_faq ) : ?>
		<details <?php echo 0 === $gvc_index ? 'open' : ''; ?>>
			<summary>
				<?php echo esc_html( $gvc_faq[0] ); ?>
				<?php gvc_icon( 'expand_more', 'gvc-icon--sm' ); ?>
			</summary>
			<p><?php echo esc_html( $gvc_faq[1] ); ?></p>
		</details>
	<?php endforeach; ?>
</div>

<div class="gvc-card" style="padding: 2rem; margin-top: 2.5rem; display: flex; flex-wrap: wrap; gap: 1.5rem; align-items: center; justify-content: space-between;">
	<div style="max-width: 38rem;">
		<h3 class="gvc-title-lg" style="margin: 0 0 0.5rem; color: var(--gvc-forest);"><?php esc_html_e( 'Still curious?', 'gv-craft' ); ?></h3>
		<p class="gvc-body-md gvc-muted" style="margin: 0;"><?php esc_html_e( 'Send the guild a message and we will answer anything about materials, lead times or repair.', 'gv-craft' ); ?></p>
	</div>
	<a class="gvc-btn gvc-btn--primary" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">
		<?php esc_html_e( 'Contact us', 'gv-craft' ); ?>
		<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
	</a>
</div>
