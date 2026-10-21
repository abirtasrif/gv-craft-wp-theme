<?php
/**
 * Front page — brand guarantees.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_guarantees = array(
	array( 'local_shipping', gvc_option( 'guarantee_1_title' ), gvc_option( 'guarantee_1_text' ) ),
	array( 'cached', gvc_option( 'guarantee_2_title' ), gvc_option( 'guarantee_2_text' ) ),
	array( 'verified_user', gvc_option( 'guarantee_3_title' ), gvc_option( 'guarantee_3_text' ) ),
	array( 'recycling', gvc_option( 'guarantee_4_title' ), gvc_option( 'guarantee_4_text' ) ),
);
?>
<section class="gvc-section gvc-section--tight gvc-section--tint" style="border-block: 1px solid var(--gvc-border);">
	<div class="gvc-container">
		<div class="gvc-grid gvc-grid--4" style="gap: 2rem;">
			<?php foreach ( $gvc_guarantees as $gvc_guarantee ) : ?>
				<div class="gvc-guarantee">
					<div class="gvc-guarantee__icon">
						<?php gvc_icon( $gvc_guarantee[0], 'gvc-icon--lg' ); ?>
					</div>
					<div>
						<h3 class="gvc-title-md" style="margin: 0 0 0.25rem; color: var(--gvc-forest);"><?php echo esc_html( $gvc_guarantee[1] ); ?></h3>
						<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php echo esc_html( $gvc_guarantee[2] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
