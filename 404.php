<?php
/**
 * 404 template.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="gvc-main" class="gvc-main">
	<div class="gvc-container gvc-section">
		<div style="max-width: 42rem; margin-inline: auto; text-align: center;">

			<span class="gvc-badge">
				<?php gvc_icon( 'eco', 'gvc-icon--sm' ); ?>
				<?php esc_html_e( 'Lost in the delta', 'gv-craft' ); ?>
			</span>

			<h1 style="margin: 1rem 0 0.75rem;"><?php esc_html_e( 'This trail ends here', 'gv-craft' ); ?></h1>

			<p class="gvc-lede">
				<?php esc_html_e( 'The page you were looking for has been composted. Let us guide you back to something handmade.', 'gv-craft' ); ?>
			</p>

			<div style="display: flex; flex-wrap: wrap; gap: 0.75rem; justify-content: center; margin-top: 2rem;">
				<a class="gvc-btn gvc-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php esc_html_e( 'Back to the homepage', 'gv-craft' ); ?>
				</a>
				<?php if ( gvc_woocommerce_active() ) : ?>
					<a class="gvc-btn gvc-btn--secondary" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
						<?php esc_html_e( 'Browse the catalogue', 'gv-craft' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<div style="max-width: 26rem; margin: 2.5rem auto 0; text-align: left;">
				<?php get_search_form(); ?>
			</div>

		</div>
	</div>
</main>

<?php
get_footer();
