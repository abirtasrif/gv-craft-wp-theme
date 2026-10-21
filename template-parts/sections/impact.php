<?php
/**
 * Front page — craft impact ledger.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_metrics = array(
	array( 'delete_sweep', 'Active', gvc_option( 'impact_1_value' ), gvc_option( 'impact_1_label' ), gvc_option( 'impact_1_note' ) ),
	array( 'handshake', '100% Pledged', gvc_option( 'impact_2_value' ), gvc_option( 'impact_2_label' ), gvc_option( 'impact_2_note' ) ),
	array( 'forest', 'Verified', gvc_option( 'impact_3_value' ), gvc_option( 'impact_3_label' ), gvc_option( 'impact_3_note' ) ),
	array( 'qr_code_2', 'Blockchain', gvc_option( 'impact_4_value' ), gvc_option( 'impact_4_label' ), gvc_option( 'impact_4_note' ) ),
);
?>
<section class="gvc-section gvc-section--forest gvc-impact" id="impact">
	<div class="gvc-container gvc-impact__grid">

		<div style="max-width: 46rem;">
			<span class="gvc-badge" style="background: rgba(64, 145, 108, 0.3); color: var(--gvc-mint);">
				<?php gvc_icon( 'monitoring', 'gvc-icon--sm' ); ?>
				<?php echo esc_html( gvc_option( 'impact_eyebrow' ) ); ?>
			</span>

			<h2 style="margin: 1rem 0 0.75rem;"><?php echo esc_html( gvc_option( 'impact_title' ) ); ?></h2>

			<p class="gvc-body-lg" style="color: var(--gvc-surface-variant);">
				<?php echo esc_html( gvc_option( 'impact_text' ) ); ?>
			</p>
		</div>

		<div class="gvc-grid gvc-grid--4" style="margin-top: 3rem;">
			<?php foreach ( $gvc_metrics as $gvc_metric ) : ?>
				<div class="gvc-metric">
					<div class="gvc-metric__head">
						<?php gvc_icon( $gvc_metric[0], 'gvc-icon--lg' ); ?>
						<span class="gvc-label-sm" style="text-transform: uppercase; background: rgba(64, 145, 108, 0.3); color: var(--gvc-mint); padding: 0.125rem 0.5rem; border-radius: 4px;">
							<?php echo esc_html( $gvc_metric[1] ); ?>
						</span>
					</div>
					<p class="gvc-metric__value"><?php echo esc_html( $gvc_metric[2] ); ?></p>
					<p class="gvc-metric__label"><?php echo esc_html( $gvc_metric[3] ); ?></p>
					<p class="gvc-metric__note"><?php echo esc_html( $gvc_metric[4] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
