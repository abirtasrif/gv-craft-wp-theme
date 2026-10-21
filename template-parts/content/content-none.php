<?php
/**
 * Shown when no posts are found.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="gvc-card" style="padding: 2.5rem; text-align: center; max-width: 40rem; margin-inline: auto;">
	<span class="gvc-badge">
		<?php gvc_icon( 'search_off', 'gvc-icon--sm' ); ?>
		<?php esc_html_e( 'Nothing found', 'gv-craft' ); ?>
	</span>

	<h2 style="margin: 1rem 0 0.5rem;"><?php esc_html_e( 'No pieces matched that search', 'gv-craft' ); ?></h2>

	<p class="gvc-lede">
		<?php esc_html_e( 'Try another material, craft or artisan region — or explore the full catalogue.', 'gv-craft' ); ?>
	</p>

	<div style="display: flex; flex-wrap: wrap; gap: 0.75rem; justify-content: center; margin-top: 1.5rem;">
		<?php get_search_form(); ?>
	</div>

	<?php if ( gvc_woocommerce_active() ) : ?>
		<p style="margin-top: 1.5rem;">
			<a class="gvc-btn gvc-btn--primary" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
				<?php esc_html_e( 'Browse the catalogue', 'gv-craft' ); ?>
			</a>
		</p>
	<?php endif; ?>
</section>
