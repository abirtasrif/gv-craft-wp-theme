<?php
/**
 * GV Craft by JarvanIT — navigation walker.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

/**
 * Walker that outputs the theme's eco navigation markup.
 */
class GV_Craft_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Start element.
	 *
	 * @param string   $output Output buffer.
	 * @param WP_Post  $item   Menu item.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 * @param int      $id     Item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$output     .= '<li class="' . esc_attr( $class_names ) . '">';

		$atts = array(
			'title'  => ! empty( $item->attr_title ) ? $item->attr_title : '',
			'target' => ! empty( $item->target ) ? $item->target : '',
			'rel'    => ! empty( $item->xfn ) ? $item->xfn : '',
			'href'   => ! empty( $item->url ) ? $item->url : '',
		);

		$atts       = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		$attributes = '';

		foreach ( $atts as $attr => $value ) {
			if ( '' !== $value && false !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$icon = '';
		if ( ! empty( $item->gvc_icon ) ) {
			$icon = '<span class="gvc-icon gvc-icon--sm" aria-hidden="true">' . esc_html( $item->gvc_icon ) . '</span> ';
		}

		$output .= '<a' . $attributes . '>' . $icon . esc_html( $title ) . '</a>';
	}
}

/**
 * Fallback menu used when no primary menu has been assigned.
 */
function gvc_default_menu( $args = array() ) {
	$shop_url = gvc_woocommerce_active() ? wc_get_page_permalink( 'shop' ) : home_url( '/' );

	$items = array(
		array(
			'title' => __( 'Mats & Rugs', 'gv-craft' ),
			'url'   => add_query_arg( 'product_cat', 'mats-rugs', $shop_url ),
		),
		array(
			'title' => __( 'Jute & Fibers', 'gv-craft' ),
			'url'   => add_query_arg( 'product_cat', 'jute-fibers', $shop_url ),
		),
		array(
			'title' => __( 'Woodcraft', 'gv-craft' ),
			'url'   => add_query_arg( 'product_cat', 'woodcraft', $shop_url ),
		),
		array(
			'title' => __( 'Sustainable Tableware', 'gv-craft' ),
			'url'   => add_query_arg( 'product_cat', 'sustainable-tableware', $shop_url ),
		),
		array(
			'title' => __( 'About Us', 'gv-craft' ),
			'url'   => home_url( '/about-us/' ),
		),
	);

	$output = '<ul id="gvc-primary-menu" class="gvc-nav">';

	foreach ( $items as $item ) {
		$output .= '<li class="menu-item"><a href="' . esc_url( $item['url'] ) . '">';

		if ( ! empty( $item['icon'] ) ) {
			$output .= '<span class="gvc-icon gvc-icon--sm" aria-hidden="true">' . esc_html( $item['icon'] ) . '</span> ';
		}

		$output .= esc_html( $item['title'] ) . '</a></li>';
	}

	$output .= '</ul>';

	echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Render the primary navigation (menu or fallback).
 */
function gvc_primary_navigation() {
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'gvc-nav',
				'depth'          => 3,
				'walker'         => new GV_Craft_Nav_Walker(),
				'fallback_cb'    => false,
			)
		);
	} else {
		gvc_default_menu();
	}
}

/**
 * Render the mobile drawer navigation.
 */
function gvc_drawer_navigation() {
	?>
	<div class="gvc-drawer" id="gvc-drawer" aria-hidden="true">
		<div class="gvc-drawer__overlay" data-gvc-drawer-close></div>
		<div class="gvc-drawer__panel" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Site menu', 'gv-craft' ); ?>">
			<div class="gvc-drawer__head">
				<a class="gvc-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Home', 'gv-craft' ); ?>">
					<?php gvc_logo(); ?>
				</a>
				<button class="gvc-icon-btn" type="button" data-gvc-drawer-close aria-label="<?php esc_attr_e( 'Close menu', 'gv-craft' ); ?>">
					<?php gvc_icon( 'close' ); ?>
				</button>
			</div>
			<div class="gvc-drawer__body">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'depth'          => 3,
							'walker'         => new GV_Craft_Nav_Walker(),
							'fallback_cb'    => 'gvc_default_menu',
						)
					);
				} else {
					gvc_default_menu();
				}
				?>

				<div class="gvc-mt-3 gvc-grid" style="gap: 0.75rem;">
					<?php if ( gvc_woocommerce_active() ) : ?>
						<a class="gvc-btn gvc-btn--primary gvc-btn--block" href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>">
							<?php gvc_icon( 'person', 'gvc-icon--sm' ); ?>
							<?php esc_html_e( 'My Account', 'gv-craft' ); ?>
						</a>
						<a class="gvc-btn gvc-btn--secondary gvc-btn--block" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
							<?php gvc_icon( 'shopping_bag', 'gvc-icon--sm' ); ?>
							<?php esc_html_e( 'View Bag', 'gv-craft' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Remove unwanted entries from the primary navigation menu.
 *
 * @param array        $items Menu items.
 * @param stdClass|array $args Menu query args.
 * @return array
 */
function gvc_filter_primary_menu_items( $items, $args ) {
	$theme_location = '';

	if ( is_object( $args ) && isset( $args->theme_location ) ) {
		$theme_location = $args->theme_location;
	} elseif ( is_array( $args ) && isset( $args['theme_location'] ) ) {
		$theme_location = $args['theme_location'];
	}

	if ( 'primary' === $theme_location ) {
		return array_values(
			array_filter(
				$items,
				function ( $item ) {
					$slug = '';

					if ( is_object( $item ) ) {
						if ( ! empty( $item->object ) && 'page' === $item->object && ! empty( $item->object_id ) ) {
							$page = get_post( (int) $item->object_id );
							$slug = $page ? $page->post_name : '';
						}

						if ( ! $slug && ! empty( $item->url ) ) {
							$path = wp_parse_url( $item->url, PHP_URL_PATH );
							$slug = $path ? basename( untrailingslashit( $path ) ) : '';
						}
					}

					return ! in_array( sanitize_title( $slug ), array( 'impact-ledger', 'terms-conditions', 'privacy-policy' ), true );
				}
			)
		);
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'gvc_filter_primary_menu_items', 10, 2 );
