<?php
/**
 * Page content — Wholesale inquiries.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="gvc-split gvc-split--6-6" style="align-items: start;">
	<div>
		<div class="gvc-eyebrow gvc-eyebrow--upper">
			<?php gvc_icon( 'handshake', 'gvc-icon--sm' ); ?>
			<?php esc_html_e( 'Trade & hospitality', 'gv-craft' ); ?>
		</div>
		<h2 style="margin: 0.75rem 0;"><?php esc_html_e( 'Bring the guilds into your space', 'gv-craft' ); ?></h2>
		<p class="gvc-body-lg gvc-muted">
			<?php esc_html_e( 'We work with interior designers, boutique hotels, restaurants and retailers who want traceable, handmade goods at a fair trade price. Wholesale orders are placed directly with the cooperative that makes the piece.', 'gv-craft' ); ?>
		</p>

		<div class="gvc-grid gvc-grid--2" style="gap: 1rem; margin-top: 2rem;">
			<div class="gvc-card" style="padding: 1.25rem;">
				<?php gvc_icon( 'groups', 'gvc-icon--lg' ); ?>
				<h3 class="gvc-title-md" style="margin: 0.75rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Hospitality', 'gv-craft' ); ?></h3>
				<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Lobby, room and table-top programmes with custom dimensions and colourways.', 'gv-craft' ); ?></p>
			</div>
			<div class="gvc-card" style="padding: 1.25rem;">
				<?php gvc_icon( 'architecture', 'gvc-icon--lg' ); ?>
				<h3 class="gvc-title-md" style="margin: 0.75rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Interior design', 'gv-craft' ); ?></h3>
				<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Sample sets, material boards and bespoke colour matching for projects.', 'gv-craft' ); ?></p>
			</div>
			<div class="gvc-card" style="padding: 1.25rem;">
				<?php gvc_icon( 'storefront', 'gvc-icon--lg' ); ?>
				<h3 class="gvc-title-md" style="margin: 0.75rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Retail', 'gv-craft' ); ?></h3>
				<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Consignment terms, story cards and batch traceability for your shelves.', 'gv-craft' ); ?></p>
			</div>
			<div class="gvc-card" style="padding: 1.25rem;">
				<?php gvc_icon( 'workspace_premium', 'gvc-icon--lg' ); ?>
				<h3 class="gvc-title-md" style="margin: 0.75rem 0 0.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Corporate gifting', 'gv-craft' ); ?></h3>
				<p class="gvc-body-sm gvc-muted" style="margin: 0;"><?php esc_html_e( 'Thoughtful, plastic-free welcome gifts with impact reporting per order.', 'gv-craft' ); ?></p>
			</div>
		</div>
	</div>

	<div class="gvc-card" style="padding: 2rem;">
		<h3 class="gvc-title-lg" style="margin: 0 0 1.25rem; color: var(--gvc-forest);"><?php esc_html_e( 'Request trade pricing', 'gv-craft' ); ?></h3>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="gvc_contact" />
			<input type="hidden" name="gvc_subject" value="Wholesale inquiry" />
			<?php wp_nonce_field( 'gvc_contact', 'gvc_contact_nonce' ); ?>

			<div class="gvc-field">
				<label for="gvc-w-name"><?php esc_html_e( 'Business name', 'gv-craft' ); ?></label>
				<input type="text" id="gvc-w-name" name="gvc_name" required />
			</div>

			<div class="gvc-field">
				<label for="gvc-w-email"><?php esc_html_e( 'Work email', 'gv-craft' ); ?></label>
				<input type="email" id="gvc-w-email" name="gvc_email" required />
			</div>

			<div class="gvc-field">
				<label for="gvc-w-message"><?php esc_html_e( 'What are you looking to source?', 'gv-craft' ); ?></label>
				<textarea id="gvc-w-message" name="gvc_message" rows="6" required></textarea>
			</div>

			<button class="gvc-btn gvc-btn--primary gvc-btn--block" type="submit">
				<?php esc_html_e( 'Send inquiry', 'gv-craft' ); ?>
			</button>
		</form>
	</div>
</div>
