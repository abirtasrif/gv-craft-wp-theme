<?php
/**
 * Page content — Contact.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_phone = gvc_option( 'footer_phone' );
$gvc_email = gvc_option( 'footer_email' );
?>

<div class="gvc-split gvc-split--6-6" style="align-items: start;">
	<div>
		<div class="gvc-eyebrow gvc-eyebrow--upper">
			<?php gvc_icon( 'mail', 'gvc-icon--sm' ); ?>
			<?php esc_html_e( 'Contact us', 'gv-craft' ); ?>
		</div>
		<h2 style="margin: 0.75rem 0;"><?php esc_html_e( 'Want to discuss your project?', 'gv-craft' ); ?></h2>
		<p class="gvc-body-lg gvc-muted">
			<?php esc_html_e( 'Whether you are sourcing for a hotel, commissioning a custom batch or simply need care advice, send us a note and the guild will reply within two working days.', 'gv-craft' ); ?>
		</p>

		<div class="gvc-grid" style="gap: 1rem; margin-top: 2rem;">
			<a class="gvc-card gvc-card--hover" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $gvc_phone ) ); ?>" style="display: flex; gap: 1rem; align-items: center; padding: 1.25rem;">
				<div class="gvc-guarantee__icon">
					<?php gvc_icon( 'call', 'gvc-icon--lg' ); ?>
				</div>
				<div>
					<h3 class="gvc-title-md" style="margin: 0; color: var(--gvc-forest);"><?php echo esc_html( $gvc_phone ); ?></h3>
					<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Corporate office line', 'gv-craft' ); ?></p>
				</div>
			</a>

			<a class="gvc-card gvc-card--hover" href="mailto:<?php echo esc_attr( $gvc_email ); ?>" style="display: flex; gap: 1rem; align-items: center; padding: 1.25rem;">
				<div class="gvc-guarantee__icon">
					<?php gvc_icon( 'alternate_email', 'gvc-icon--lg' ); ?>
				</div>
				<div>
					<h3 class="gvc-title-md" style="margin: 0; color: var(--gvc-forest);"><?php echo esc_html( $gvc_email ); ?></h3>
					<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Send us a message', 'gv-craft' ); ?></p>
				</div>
			</a>
		</div>

		<div class="gvc-card" style="padding: 1.5rem; margin-top: 1rem;">
			<h3 class="gvc-title-md" style="margin: 0 0 0.75rem; color: var(--gvc-forest);"><?php esc_html_e( 'Offices', 'gv-craft' ); ?></h3>
			<div class="gvc-grid gvc-grid--2" style="gap: 1.25rem;">
				<div>
					<p class="gvc-label-md" style="color: var(--gvc-secondary); margin: 0 0 0.25rem;"><?php esc_html_e( 'Corporate Office', 'gv-craft' ); ?></p>
					<p class="gvc-body-sm gvc-muted" style="margin: 0;">
						<?php esc_html_e( '41/4, Moneshwar Road, Zigatola, Dhanmondi, Dhaka-1209', 'gv-craft' ); ?>
					</p>
				</div>
				<div>
					<p class="gvc-label-md" style="color: var(--gvc-secondary); margin: 0 0 0.25rem;"><?php esc_html_e( 'Local Office', 'gv-craft' ); ?></p>
					<p class="gvc-body-sm gvc-muted" style="margin: 0;">
						<?php esc_html_e( 'Radwana Tower (3rd Floor), Bhulta, Rupganj, Narayanganj-1462', 'gv-craft' ); ?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="gvc-card" style="padding: 2rem;">
		<h3 class="gvc-title-lg" style="margin: 0 0 1.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Send us a message', 'gv-craft' ); ?></h3>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="gvc_contact" />
			<?php wp_nonce_field( 'gvc_contact', 'gvc_contact_nonce' ); ?>

			<div class="gvc-field">
				<label for="gvc-name"><?php esc_html_e( 'Your name', 'gv-craft' ); ?></label>
				<input type="text" id="gvc-name" name="gvc_name" required />
			</div>

			<div class="gvc-field">
				<label for="gvc-email"><?php esc_html_e( 'Email address', 'gv-craft' ); ?></label>
				<input type="email" id="gvc-email" name="gvc_email" required />
			</div>

			<div class="gvc-field">
				<label for="gvc-subject"><?php esc_html_e( 'Subject', 'gv-craft' ); ?></label>
				<input type="text" id="gvc-subject" name="gvc_subject" />
			</div>

			<div class="gvc-field">
				<label for="gvc-message"><?php esc_html_e( 'Message', 'gv-craft' ); ?></label>
				<textarea id="gvc-message" name="gvc_message" rows="6" required></textarea>
			</div>

			<button class="gvc-btn gvc-btn--primary gvc-btn--block" type="submit">
				<?php esc_html_e( 'Send message', 'gv-craft' ); ?>
			</button>
		</form>
	</div>
</div>
