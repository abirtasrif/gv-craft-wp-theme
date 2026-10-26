<?php
/**
 * GV Craft by JarvanIT — one click site setup.
 *
 * Creates the pages, menus and WooCommerce assignments the theme expects so a
 * fresh install is usable straight away.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setup wizard.
 */
class GV_Craft_Setup {

	/**
	 * Run the whole setup (idempotent).
	 */
	public static function run() {
		$pages = self::create_pages();
		$menus = self::create_menus();

		self::assign_woocommerce_pages( $pages );
		self::configure_permalinks();
		self::set_front_page( $pages );

		update_option( 'gvc_setup_complete', 1 );

		if ( $menus['primary'] ) {
			set_theme_mod( 'nav_menu_locations', array( 'primary' => $menus['primary'], 'footer' => $menus['footer'], 'legal' => $menus['legal'] ) );
		}

		flush_rewrite_rules();
	}

	/**
	 * Page definitions.
	 *
	 * @return array
	 */
	public static function page_definitions() {
		return array(
			'home'         => array(
				'title'   => __( 'Home', 'gv-craft' ),
				'slug'    => 'home',
				'content' => '',
			),
			'about'        => array(
				'title'   => __( 'About Us', 'gv-craft' ),
				'slug'    => 'about-us',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"about\"]\n<!-- /wp:shortcode -->",
			),
			'impact'       => array(
				'title'   => __( 'Impact Ledger', 'gv-craft' ),
				'slug'    => 'impact-ledger',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"impact\"]\n<!-- /wp:shortcode -->",
			),
			'artisans'     => array(
				'title'   => __( 'Artisan Guilds', 'gv-craft' ),
				'slug'    => 'artisan-guilds',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"artisans\"]\n<!-- /wp:shortcode -->",
			),
			'journal'      => array(
				'title'   => __( 'Regenerative Living Journal', 'gv-craft' ),
				'slug'    => 'regenerative-living-journal',
				'content' => '',
			),
			'contact'      => array(
				'title'   => __( 'Contact Us', 'gv-craft' ),
				'slug'    => 'contact-us',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"contact\"]\n<!-- /wp:shortcode -->",
			),
			'faq'          => array(
				'title'   => __( 'FAQs', 'gv-craft' ),
				'slug'    => 'faq',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"faq\"]\n<!-- /wp:shortcode -->",
			),
			'wholesale'    => array(
				'title'   => __( 'Wholesale Inquiries', 'gv-craft' ),
				'slug'    => 'wholesale-inquiries',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"wholesale\"]\n<!-- /wp:shortcode -->",
			),
			'care'         => array(
				'title'   => __( 'Care & Repair', 'gv-craft' ),
				'slug'    => 'care-repair',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"care\"]\n<!-- /wp:shortcode -->",
			),
			'shipping'     => array(
				'title'   => __( 'Shipping & Returns', 'gv-craft' ),
				'slug'    => 'shipping-returns',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"shipping\"]\n<!-- /wp:shortcode -->",
			),
			'privacy'      => array(
				'title'   => __( 'Privacy Policy', 'gv-craft' ),
				'slug'    => 'privacy-policy',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"privacy\"]\n<!-- /wp:shortcode -->",
			),
			'terms'        => array(
				'title'   => __( 'Terms & Conditions', 'gv-craft' ),
				'slug'    => 'terms-conditions',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"terms\"]\n<!-- /wp:shortcode -->",
			),
			'wishlist'     => array(
				'title'   => __( 'Wishlist', 'gv-craft' ),
				'slug'    => 'wishlist',
				'content' => "<!-- wp:shortcode -->\n[gv_page slug=\"wishlist\"]\n<!-- /wp:shortcode -->",
			),
		);
	}

	/**
	 * Create the theme pages.
	 *
	 * @return array Map of slug => page ID.
	 */
	public static function create_pages() {
		$created = array();

		foreach ( self::page_definitions() as $key => $data ) {
			$slug     = isset( $data['slug'] ) ? $data['slug'] : $key;
			$existing = get_page_by_path( $slug );

			if ( ! $existing ) {
				// A page with the same title but an older slug — rename it instead of duplicating.
				$by_title = get_posts(
					array(
						'post_type'              => 'page',
						'title'                  => $data['title'],
						'posts_per_page'         => 1,
						'post_status'            => array( 'publish', 'draft', 'pending', 'private' ),
						'update_post_meta_cache' => false,
						'update_post_term_cache' => false,
						'no_found_rows'          => true,
					)
				);

				if ( ! empty( $by_title ) && $by_title[0]->post_title === $data['title'] ) {
					$existing = $by_title[0];
					wp_update_post(
						array(
							'ID'        => $existing->ID,
							'post_name' => $slug,
						)
					);
				}
			}

			if ( $existing ) {
				$created[ $key ] = $existing->ID;

				// Swap the auto-generated WordPress privacy page for the designed one.
				if ( 'privacy' === $key && (int) get_option( 'wp_page_for_privacy_policy' ) === (int) $existing->ID ) {
					wp_update_post(
						array(
							'ID'           => $existing->ID,
							'post_content' => $data['content'],
							'post_status'  => 'publish',
						)
					);
				}

				continue;
			}

			$page_id = wp_insert_post(
				array(
					'post_title'     => $data['title'],
					'post_name'      => $slug,
					'post_content'   => $data['content'],
					'post_status'    => 'publish',
					'post_type'      => 'page',
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
				)
			);

			if ( $page_id && ! is_wp_error( $page_id ) ) {
				$created[ $key ] = $page_id;
			}
		}

		return $created;
	}

	/**
	 * Create the primary / footer / legal menus.
	 *
	 * @return array
	 */
	public static function create_menus() {
		$locations = get_theme_mod( 'nav_menu_locations', array() );

		$menus = array(
			'primary' => isset( $locations['primary'] ) ? (int) $locations['primary'] : 0,
			'footer'  => isset( $locations['footer'] ) ? (int) $locations['footer'] : 0,
			'legal'   => isset( $locations['legal'] ) ? (int) $locations['legal'] : 0,
		);

		$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );

		$definitions = array(
			'primary' => array(
				'name'  => __( 'GV Craft Primary', 'gv-craft' ),
				'items' => array(
					array( 'title' => __( 'Mats & Rugs', 'gv-craft' ), 'url' => $shop_url . '?product_cat=mats-rugs' ),
					array( 'title' => __( 'Jute & Fibers', 'gv-craft' ), 'url' => $shop_url . '?product_cat=jute-fibers' ),
					array( 'title' => __( 'Woodcraft', 'gv-craft' ), 'url' => $shop_url . '?product_cat=woodcraft' ),
					array( 'title' => __( 'Sustainable Tableware', 'gv-craft' ), 'url' => $shop_url . '?product_cat=sustainable-tableware' ),
					array( 'title' => __( 'Impact Ledger', 'gv-craft' ), 'url' => home_url( '/impact-ledger/' ) ),
					array( 'title' => __( 'About Us', 'gv-craft' ), 'url' => home_url( '/about-us/' ) ),
					array( 'title' => __( 'Terms & Conditions', 'gv-craft' ), 'url' => home_url( '/terms-conditions/' ) ),
				),
			),
			'footer'  => array(
				'name'  => __( 'GV Craft Footer', 'gv-craft' ),
				'items' => array(
					array( 'title' => __( 'About Us', 'gv-craft' ), 'url' => home_url( '/about-us/' ) ),
					array( 'title' => __( 'Sustainability Pledges', 'gv-craft' ), 'url' => home_url( '/impact-ledger/' ) ),
					array( 'title' => __( 'Artisan Guilds Network', 'gv-craft' ), 'url' => home_url( '/artisan-guilds/' ) ),
					array( 'title' => __( 'Material Stories', 'gv-craft' ), 'url' => home_url( '/regenerative-living-journal/' ) ),
					array( 'title' => __( 'Impact Ledger', 'gv-craft' ), 'url' => home_url( '/impact-ledger/' ) ),
					array( 'title' => __( 'Care & Repair', 'gv-craft' ), 'url' => home_url( '/care-repair/' ) ),
					array( 'title' => __( 'Shipping & Returns', 'gv-craft' ), 'url' => home_url( '/shipping-returns/' ) ),
					array( 'title' => __( 'Wholesale Inquiries', 'gv-craft' ), 'url' => home_url( '/wholesale-inquiries/' ) ),
					array( 'title' => __( 'Privacy Policy', 'gv-craft' ), 'url' => home_url( '/privacy-policy/' ) ),
					array( 'title' => __( 'Contact Us', 'gv-craft' ), 'url' => home_url( '/contact-us/' ) ),
				),
			),
			'legal'   => array(
				'name'  => __( 'GV Craft Legal', 'gv-craft' ),
				'items' => array(
					array( 'title' => __( 'Privacy Policy', 'gv-craft' ), 'url' => home_url( '/privacy-policy/' ) ),
					array( 'title' => __( 'Terms & Conditions', 'gv-craft' ), 'url' => home_url( '/terms-conditions/' ) ),
					array( 'title' => __( 'Shipping & Returns', 'gv-craft' ), 'url' => home_url( '/shipping-returns/' ) ),
				),
			),
		);

		foreach ( $definitions as $key => $definition ) {
			$menu_id = $menus[ $key ];

			if ( ! $menu_id || ! wp_get_nav_menu_object( $menu_id ) ) {
				$menu_id = wp_create_nav_menu( $definition['name'] );

				if ( is_wp_error( $menu_id ) ) {
					continue;
				}

				foreach ( $definition['items'] as $item ) {
					wp_update_nav_menu_item(
						$menu_id,
						0,
						array(
							'menu-item-title'  => $item['title'],
							'menu-item-url'    => $item['url'],
							'menu-item-status' => 'publish',
						)
					);
				}
			}

			$menus[ $key ] = $menu_id;
		}

		return $menus;
	}

	/**
	 * Point WooCommerce at the right pages.
	 *
	 * @param array $pages Page map.
	 */
	public static function assign_woocommerce_pages( $pages ) {
		$map = array(
			'shop'      => array( 'Shop', 'woocommerce', 'woocommerce_shop_page_id' ),
			'cart'      => array( 'Cart', 'woocommerce_cart', 'woocommerce_cart_page_id' ),
			'checkout'  => array( 'Checkout', 'woocommerce_checkout', 'woocommerce_checkout_page_id' ),
			'myaccount' => array( 'My Account', 'woocommerce_my_account', 'woocommerce_myaccount_page_id' ),
		);

		foreach ( $map as $option => $data ) {
			list( $title, $shortcode, $option_name ) = $data;

			$content = '<!-- wp:shortcode -->[' . $shortcode . ']<!-- /wp:shortcode -->';
			$existing = (int) get_option( $option_name );

			if ( $existing && 'publish' === get_post_status( $existing ) ) {
				// Force the classic shortcode so the theme templates are used.
				$current = get_post_field( 'post_content', $existing );

				if ( false === strpos( (string) $current, '[' . $shortcode . ']' ) ) {
					wp_update_post(
						array(
							'ID'           => $existing,
							'post_content' => $content,
						)
					);
				}

				continue;
			}

			// Create the page (WooCommerce 11 removed wc_create_page()).
			$slug   = sanitize_title( $title );
			$page   = get_page_by_path( $slug );
			$page_id = 0;

			if ( $page ) {
				$page_id = $page->ID;
				wp_update_post(
					array(
						'ID'           => $page_id,
						'post_title'   => $title,
						'post_status'  => 'publish',
						'post_content' => $content,
					)
				);
			} else {
				$page_id = wp_insert_post(
					array(
						'post_title'   => $title,
						'post_name'    => $slug,
						'post_status'  => 'publish',
						'post_type'    => 'page',
						'post_content' => $content,
					)
				);
			}

			if ( $page_id && ! is_wp_error( $page_id ) ) {
				update_option( $option_name, (int) $page_id );
			}
		}
	}

	/**
	 * Use pretty permalinks.
	 */
	public static function configure_permalinks() {
		if ( ! get_option( 'permalink_structure' ) ) {
			update_option( 'permalink_structure', '/%postname%/' );
		}
	}

	/**
	 * Use the Home page as the front page and the Journal as the posts page.
	 *
	 * @param array $pages Page map.
	 */
	public static function set_front_page( $pages ) {
		if ( ! empty( $pages['home'] ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $pages['home'] );
		}

		if ( ! empty( $pages['journal'] ) ) {
			update_option( 'page_for_posts', $pages['journal'] );
		}
	}
}

/* -------------------------------------------------------------------------
 * Admin: GV Craft setup screen
 * ---------------------------------------------------------------------- */

/**
 * Register the setup admin page.
 */
function gvc_setup_admin_menu() {
	add_theme_page(
		__( 'GV Craft Setup', 'gv-craft' ),
		__( 'GV Craft Setup', 'gv-craft' ),
		'manage_options',
		'gvc-setup',
		'gvc_setup_admin_page'
	);
}
add_action( 'admin_menu', 'gvc_setup_admin_menu' );

/**
 * Render the setup screen.
 */
function gvc_setup_admin_page() {
	$done  = wp_create_nonce( 'gvc_setup_action' );
	$state = get_option( 'gvc_setup_complete' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'GV Craft by JarvanIT — Setup', 'gv-craft' ); ?></h1>

		<?php if ( isset( $_GET['gvc_done'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
			<div class="notice notice-success is-dismissible">
				<p><?php esc_html_e( 'Done. The GV Craft structure is ready.', 'gv-craft' ); ?></p>
			</div>
		<?php endif; ?>

		<div class="card" style="max-width:720px;padding:20px;margin-top:16px;">
			<h2><?php esc_html_e( '1 · One-click setup', 'gv-craft' ); ?></h2>
			<p><?php esc_html_e( 'Creates the Home, About, Impact Ledger, Artisan Guilds, Journal, Contact, FAQ, Wholesale, Care & Repair, Shipping & Returns, Privacy Policy and Terms pages, wires the WooCommerce Shop / Cart / Checkout / My Account pages and builds the primary, footer and legal menus.', 'gv-craft' ); ?></p>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="gvc_run_setup" />
				<?php wp_nonce_field( $done ); ?>
				<?php submit_button( __( 'Run the setup', 'gv-craft' ), 'primary', 'submit', false ); ?>
			</form>
			<?php if ( $state ) : ?>
				<p style="color:#2271b1;"><?php esc_html_e( 'Setup has already been completed — running it again is safe and only fills in what is missing.', 'gv-craft' ); ?></p>
			<?php endif; ?>
		</div>

		<div class="card" style="max-width:720px;padding:20px;margin-top:16px;">
			<h2><?php esc_html_e( '2 · Demo content', 'gv-craft' ); ?></h2>
			<p><?php esc_html_e( 'Imports the artisan product catalogue (8 products with eco stories, badges, guilds and impact metrics), the craft categories, and the journal posts so the homepage is immediately full of life.', 'gv-craft' ); ?></p>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="gvc_run_demo" />
				<?php wp_nonce_field( $done ); ?>
				<?php submit_button( __( 'Import demo content', 'gv-craft' ), 'secondary', 'submit', false ); ?>
			</form>
		</div>

		<div class="card" style="max-width:720px;padding:20px;margin-top:16px;">
			<h2><?php esc_html_e( '3 · Quick checklist', 'gv-craft' ); ?></h2>
			<ol>
				<li><?php esc_html_e( 'Install and activate WooCommerce (Apperance → Themes → Add New → WooCommerce).', 'gv-craft' ); ?></li>
				<li><?php esc_html_e( 'Run the setup above, then import the demo content.', 'gv-craft' ); ?></li>
				<li><?php esc_html_e( 'Add your own logo at Appearance → Customize → Site Identity.', 'gv-craft' ); ?></li>
				<li><?php esc_html_e( 'Set the WooCommerce currency, payment gateway and shipping zones.', 'gv-craft' ); ?></li>
				<li><?php esc_html_e( 'Edit every homepage string in Appearance → Customize → GV Craft Options.', 'gv-craft' ); ?></li>
			</ol>
		</div>
	</div>
	<?php
}

/**
 * Handle the setup action.
 */
function gvc_handle_setup_action() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to do that.', 'gv-craft' ) );
	}

	check_admin_referer( 'gvc_setup_action' );

	GV_Craft_Setup::run();

	wp_safe_redirect( admin_url( 'themes.php?page=gvc-setup&gvc_done=1' ) );
	exit;
}
add_action( 'admin_post_gvc_run_setup', 'gvc_handle_setup_action' );

/**
 * Handle the demo import action.
 */
function gvc_handle_demo_action() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to do that.', 'gv-craft' ) );
	}

	check_admin_referer( 'gvc_setup_action' );

	if ( class_exists( 'GV_Craft_Demo' ) ) {
		GV_Craft_Demo::import();
	}

	wp_safe_redirect( admin_url( 'themes.php?page=gvc-setup&gvc_done=1' ) );
	exit;
}
add_action( 'admin_post_gvc_run_demo', 'gvc_handle_demo_action' );

/**
 * Prompt the admin to finish the setup after activation.
 */
function gvc_setup_notice() {
	if ( ! current_user_can( 'manage_options' ) || get_option( 'gvc_setup_complete' ) ) {
		return;
	}

	$screen = get_current_screen();

	if ( $screen && 'appearance_page_gvc-setup' === $screen->id ) {
		return;
	}

	?>
	<div class="notice notice-info is-dismissible">
		<p>
			<strong><?php esc_html_e( 'GV Craft by JarvanIT is active.', 'gv-craft' ); ?></strong>
			<?php esc_html_e( 'Run the one-click setup to create the pages, menus and shop structure.', 'gv-craft' ); ?>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=gvc-setup' ) ); ?>"><?php esc_html_e( 'Open GV Craft Setup', 'gv-craft' ); ?></a>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'gvc_setup_notice' );
