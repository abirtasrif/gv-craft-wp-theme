<?php
/**
 * Front page — newsletter sign-up.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="gvc-section gvc-section--mint" id="newsletter">
	<div class="gvc-container gvc-container--full">
		<div class="gvc-newsletter">
			<?php gvc_icon( 'mail', 'gvc-icon--xl' ); ?>

			<h2 style="margin: 0.75rem 0 0.5rem;"><?php echo esc_html( gvc_option( 'newsletter_title' ) ); ?></h2>

			<p class="gvc-body-md gvc-muted" style="max-width: 32rem; margin-inline: auto;">
				<?php echo esc_html( gvc_option( 'newsletter_text' ) ); ?>
			</p>

			<form class="gvc-newsletter__form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="gvc_subscribe" />
				<?php wp_nonce_field( 'gvc_subscribe', 'gvc_subscribe_nonce' ); ?>
				<input type="email" name="gvc_email" required placeholder="<?php esc_attr_e( 'Enter your email address', 'gv-craft' ); ?>" aria-label="<?php esc_attr_e( 'Email address', 'gv-craft' ); ?>" />
				<button class="gvc-btn gvc-btn--primary" type="submit"><?php esc_html_e( 'Subscribe', 'gv-craft' ); ?></button>
			</form>

			<p class="gvc-label-sm gvc-muted" style="margin-top: 0.75rem; opacity: 0.8;">
				<?php esc_html_e( 'We respect your peace. Unsubscribe anytime. Zero spam.', 'gv-craft' ); ?>
			</p>
		</div>
	</div>
</section>
