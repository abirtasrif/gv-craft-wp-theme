<?php
/**
 * The theme footer.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_shop_url = gvc_woocommerce_active() ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
?>
	<footer class="gvc-site-footer">
		<div class="gvc-container gvc-container--full">

			<div class="gvc-footer__grid">

				<div>
					<a class="gvc-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<?php gvc_logo( true ); ?>
					</a>

					<p class="gvc-body-md" style="color: var(--gvc-surface-variant); max-width: 32rem; margin-top: 1rem;">
						<?php echo esc_html( gvc_option( 'footer_about' ) ); ?>
					</p>

					<div class="gvc-label-sm" style="color: var(--gvc-mint); display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">
						<span class="gvc-pill-dot" aria-hidden="true"></span>
						<?php echo esc_html( gvc_option( 'footer_address' ) ); ?>
					</div>

					<?php gvc_social_links(); ?>
				</div>

			</div>

			<?php if ( is_active_sidebar( 'gvc-footer' ) ) : ?>
				<div class="gvc-footer__grid" style="border-bottom: 0; padding-bottom: 1rem;">
					<?php dynamic_sidebar( 'gvc-footer' ); ?>
				</div>
			<?php endif; ?>

			<div class="gvc-footer__bottom">
				<p>
					<?php
					printf(
						/* translators: 1: year, 2: site name. */
						esc_html__( '© %1$s %2$s. %3$s', 'gv-craft' ),
						esc_html( gmdate( 'Y' ) ),
						esc_html( get_bloginfo( 'name' ) ),
						esc_html( gvc_option( 'footer_copyright' ) )
					);
					?>

				</p>

				<p class="gvc-footer__credit">
					<a href="https://jarvan-it.top/" target="_blank" rel="noopener noreferrer">Designed & Developed by Jarvan IT</a>
				</p>
			</div>

		</div>
	</footer>

</div><!-- #page -->

<div class="gvc-toast" id="gvc-toast" role="status" aria-live="polite"></div>

<?php wp_footer(); ?>
</body>
</html>
