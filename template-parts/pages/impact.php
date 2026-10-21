<?php
/**
 * Page content — Impact Ledger.
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

<div class="gvc-card" style="padding: 2rem; background: var(--gvc-cream-dark);">
	<div class="gvc-split gvc-split--6-6">
		<div>
			<div class="gvc-eyebrow gvc-eyebrow--upper">
				<?php gvc_icon( 'monitoring', 'gvc-icon--sm' ); ?>
				<?php esc_html_e( 'Continuous verification', 'gv-craft' ); ?>
			</div>
			<h2 style="margin: 0.75rem 0;"><?php echo esc_html( gvc_option( 'impact_title' ) ); ?></h2>
			<p class="gvc-body-lg gvc-muted" style="margin: 0;"><?php echo esc_html( gvc_option( 'impact_text' ) ); ?></p>
		</div>
		<div>
			<img src="<?php echo esc_url( GVC_URI . 'assets/img/demo/botanical-tufted-rug.jpg' ); ?>" alt="<?php esc_attr_e( 'Botanical tufted rug', 'gv-craft' ); ?>" style="border-radius: var(--gvc-radius-md); width: 100%;" loading="lazy" />
		</div>
	</div>
</div>

<div class="gvc-grid gvc-grid--4" style="margin-top: 2.5rem;">
	<?php foreach ( $gvc_metrics as $gvc_metric ) : ?>
		<div class="gvc-card" style="padding: 1.5rem;">
			<div style="display: flex; align-items: center; justify-content: space-between; color: var(--gvc-leaf);">
				<?php gvc_icon( $gvc_metric[0], 'gvc-icon--lg' ); ?>
				<span class="gvc-label-sm" style="text-transform: uppercase; background: var(--gvc-mint); color: var(--gvc-success); padding: 0.125rem 0.5rem; border-radius: 4px;">
					<?php echo esc_html( $gvc_metric[1] ); ?>
				</span>
			</div>
			<p style="font-family: var(--gvc-font-head); font-size: 36px; font-weight: 700; color: var(--gvc-forest); margin: 1rem 0 0.25rem;">
				<?php echo esc_html( $gvc_metric[2] ); ?>
			</p>
			<p class="gvc-title-md" style="margin: 0; color: var(--gvc-primary);"><?php echo esc_html( $gvc_metric[3] ); ?></p>
			<p class="gvc-body-sm gvc-muted" style="margin: 0.5rem 0 0;"><?php echo esc_html( $gvc_metric[4] ); ?></p>
		</div>
	<?php endforeach; ?>
</div>

<div class="gvc-section-head" style="margin-top: 3.5rem;">
	<div>
		<div class="gvc-eyebrow gvc-eyebrow--upper"><?php esc_html_e( 'Pledges', 'gv-craft' ); ?></div>
		<h2><?php esc_html_e( 'What each order funds', 'gv-craft' ); ?></h2>
	</div>
</div>

<div class="gvc-card" style="padding: 0; overflow: hidden;">
	<table class="gvc-cart-table" style="border: 0; border-radius: 0;">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Commitment', 'gv-craft' ); ?></th>
				<th><?php esc_html_e( 'Per order', 'gv-craft' ); ?></th>
				<th><?php esc_html_e( 'Verification', 'gv-craft' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php esc_html_e( 'Mangrove sapling planted in the coastal saltflats', 'gv-craft' ); ?></td>
				<td>1</td>
				<td><?php esc_html_e( 'Geo-tagged planting record', 'gv-craft' ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Living-wage premium paid directly to the guild', 'gv-craft' ); ?></td>
				<td>185%</td>
				<td><?php esc_html_e( 'Forward purchase agreement', 'gv-craft' ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Community filtration plant maintenance', 'gv-craft' ); ?></td>
				<td>100%</td>
				<td><?php esc_html_e( 'Biological ETP telemetry', 'gv-craft' ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Virgin plastic displaced by natural fibre', 'gv-craft' ); ?></td>
				<td>3.2 kg</td>
				<td><?php esc_html_e( 'Batch tag on the product', 'gv-craft' ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Carbon-neutral delivery offset', 'gv-craft' ); ?></td>
				<td>100%</td>
				<td><?php esc_html_e( 'Mangrove conservation project', 'gv-craft' ); ?></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="gvc-surface" style="padding: 2rem; margin-top: 2.5rem; display: flex; flex-wrap: wrap; gap: 1.5rem; align-items: center; justify-content: space-between;">
	<div style="max-width: 40rem;">
		<h3 class="gvc-title-lg" style="margin: 0 0 0.5rem; color: var(--gvc-forest);"><?php esc_html_e( 'Want the full quarterly disclosure?', 'gv-craft' ); ?></h3>
		<p class="gvc-body-md gvc-muted" style="margin: 0;"><?php esc_html_e( 'Join the Regenerative Living Journal for seasonal guild releases, botanical care guides and audited impact reports.', 'gv-craft' ); ?></p>
	</div>
	<a class="gvc-btn gvc-btn--primary" href="<?php echo esc_url( home_url( '/#newsletter' ) ); ?>"><?php esc_html_e( 'Subscribe', 'gv-craft' ); ?></a>
</div>
