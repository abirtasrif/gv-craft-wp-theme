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
		<div class="gvc-container">

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

				<div>
					<h3 class="gvc-footer__title"><?php esc_html_e( 'Ecosystem', 'gv-craft' ); ?></h3>
					<ul class="gvc-footer__list">
						<li><a href="<?php echo esc_url( home_url( '/impact-ledger/' ) ); ?>"><?php esc_html_e( 'Sustainability Pledges', 'gv-craft' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/artisan-guilds/' ) ); ?>"><?php esc_html_e( 'Artisan Guilds Network', 'gv-craft' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/regenerative-living-journal/' ) ); ?>"><?php esc_html_e( 'Material Stories', 'gv-craft' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/impact-ledger/' ) ); ?>"><?php esc_html_e( 'Impact Ledger', 'gv-craft' ); ?></a></li>
					</ul>
				</div>

				<div>
					<h3 class="gvc-footer__title"><?php esc_html_e( 'Care & Trade', 'gv-craft' ); ?></h3>
					<ul class="gvc-footer__list">
						<li><a href="<?php echo esc_url( home_url( '/care-repair/' ) ); ?>"><?php esc_html_e( 'Care & Repair', 'gv-craft' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/shipping-returns/' ) ); ?>"><?php esc_html_e( 'Shipping & Returns', 'gv-craft' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/wholesale-inquiries/' ) ); ?>"><?php esc_html_e( 'Wholesale Inquiries', 'gv-craft' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'FAQs', 'gv-craft' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'gv-craft' ); ?></a></li>
					</ul>
				</div>

				<div>
					<h3 class="gvc-footer__title"><?php esc_html_e( 'Engineering', 'gv-craft' ); ?></h3>
					<p class="gvc-body-sm" style="color: var(--gvc-surface-variant);">
						<?php echo esc_html( gvc_option( 'footer_engineering' ) ); ?>
					</p>
					<ul class="gvc-footer__list" style="font-size: 12px;">
						<li><?php gvc_icon( 'check', 'gvc-icon--sm' ); ?> <?php esc_html_e( 'WTP & ETP Systems', 'gv-craft' ); ?></li>
						<li><?php gvc_icon( 'check', 'gvc-icon--sm' ); ?> <?php esc_html_e( 'Industrial STP Setups', 'gv-craft' ); ?></li>
						<li><?php gvc_icon( 'check', 'gvc-icon--sm' ); ?> <?php esc_html_e( 'Air Treatment Plants (ATP)', 'gv-craft' ); ?></li>
					</ul>
					<?php if ( gvc_option( 'footer_phone' ) ) : ?>
						<p style="margin-top: 0.75rem; font-size: 12px;">
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', gvc_option( 'footer_phone' ) ) ); ?>">
								<?php gvc_icon( 'call', 'gvc-icon--sm' ); ?> <?php echo esc_html( gvc_option( 'footer_phone' ) ); ?>
							</a>
						</p>
					<?php endif; ?>
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

				<div class="gvc-footer__badges">
					<?php if ( has_nav_menu( 'legal' ) ) : ?>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'legal',
								'container'      => false,
								'depth'          => 1,
								'items_wrap'     => '<ul style="display:flex;gap:1.5rem;list-style:none;margin:0;padding:0;">%3$s</ul>',
							)
						);
						?>
					<?php else : ?>
						<span><?php esc_html_e( 'ECC Certified', 'gv-craft' ); ?></span>
						<span><?php esc_html_e( 'Zero-Waste Verified', 'gv-craft' ); ?></span>
						<span><?php esc_html_e( 'Fair Wage Audited', 'gv-craft' ); ?></span>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</footer>

</div><!-- #page -->

<div class="gvc-toast" id="gvc-toast" role="status" aria-live="polite"></div>

<?php wp_footer(); ?>
</body>
</html>
