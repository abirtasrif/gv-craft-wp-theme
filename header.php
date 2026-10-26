<?php
/**
 * The theme header.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="gvc-skip-link" href="#gvc-main"><?php esc_html_e( 'Skip to content', 'gv-craft' ); ?></a>

<div id="page" class="gvc-page">

	<?php gvc_announcement_bar(); ?>

	<header class="gvc-site-header" id="gvc-header">
		<div class="gvc-container gvc-container--full gvc-header__inner">

			<div class="gvc-header__brand">
				<a class="gvc-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<?php gvc_logo(); ?>
				</a>

				<div class="gvc-header__search">
					<div class="gvc-input-group">
						<?php gvc_icon( 'search', 'gvc-icon--sm' ); ?>
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>

			<?php gvc_primary_navigation(); ?>

			<div class="gvc-header__actions">
				<?php if ( gvc_woocommerce_active() ) : ?>
					<a class="gvc-icon-btn" href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" aria-label="<?php esc_attr_e( 'My account', 'gv-craft' ); ?>">
						<?php gvc_icon( 'person' ); ?>
					</a>
				<?php endif; ?>

				<a class="gvc-icon-btn" href="<?php echo esc_url( home_url( '/wishlist/' ) ); ?>" aria-label="<?php esc_attr_e( 'Wishlist', 'gv-craft' ); ?>">
					<?php gvc_icon( 'favorite' ); ?>
				</a>

				<?php if ( gvc_woocommerce_active() ) : ?>
					<a class="gvc-cart-btn" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
						<?php gvc_icon( 'shopping_bag' ); ?>
						<span class="gvc-cart-btn__label"><?php esc_html_e( 'Cart', 'gv-craft' ); ?></span>
						<span class="gvc-cart-btn__count" data-gvc-cart-count><?php echo esc_html( gvc_cart_count() ); ?></span>
					</a>
				<?php endif; ?>

				<button class="gvc-icon-btn gvc-header__mobile-toggle" type="button" data-gvc-drawer-open aria-label="<?php esc_attr_e( 'Open menu', 'gv-craft' ); ?>" aria-controls="gvc-drawer" aria-expanded="false">
					<?php gvc_icon( 'menu' ); ?>
				</button>
			</div>

		</div>
	</header>

	<?php gvc_drawer_navigation(); ?>

	<?php gvc_mobile_nav(); ?>

<?php do_action( 'gvc_after_header' ); ?>
