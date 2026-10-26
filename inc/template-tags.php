<?php
/**
 * GV Craft by JarvanIT — template tags.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

/**
 * Render the announcement bar.
 */
function gvc_announcement_bar() {
	if ( ! gvc_option( 'announce_enable' ) ) {
		return;
	}

	$link_label = gvc_option( 'announce_link_label' );
	$link_url   = gvc_option( 'announce_link_url' );
	?>
	<div class="gvc-announce">
		<div class="gvc-container gvc-announce__inner">
			<div class="gvc-announce__group">
				<?php if ( gvc_option( 'announce_pill' ) ) : ?>
					<span class="gvc-announce__pill">
						<?php gvc_icon( 'eco', 'gvc-icon--sm' ); ?>
						<?php echo esc_html( gvc_option( 'announce_pill' ) ); ?>
					</span>
				<?php endif; ?>
				<span class="gvc-announce__text"><?php echo esc_html( gvc_option( 'announce_text' ) ); ?></span>
			</div>

			<div class="gvc-announce__links">
				<?php if ( gvc_option( 'announce_shipping' ) ) : ?>
					<span>
						<?php gvc_icon( 'local_shipping', 'gvc-icon--sm' ); ?>
						<?php echo esc_html( gvc_option( 'announce_shipping' ) ); ?>
					</span>
				<?php endif; ?>
				<?php if ( $link_url ) : ?>
					<a href="<?php echo esc_url( $link_url ); ?>">
						<?php gvc_icon( 'energy_savings_leaf', 'gvc-icon--sm' ); ?>
						<?php echo esc_html( $link_label ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Render breadcrumbs.
 */
function gvc_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}

	$sep   = '<span class="gvc-breadcrumbs__sep" aria-hidden="true">/</span>';
	$items = array();

	$items[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'gv-craft' ) . '</a>';

	if ( is_singular( 'product' ) ) {
		$terms = get_the_terms( get_the_ID(), 'product_cat' );

		if ( $terms && ! is_wp_error( $terms ) ) {
			$term   = array_shift( $terms );
			$link   = get_term_link( $term );
			$items[] = '<a href="' . esc_url( is_wp_error( $link ) ? '' : $link ) . '">' . esc_html( $term->name ) . '</a>';
		}

		$items[] = '<span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_category() || is_tax() || is_tag() ) {
		$items[] = '<span>' . esc_html( single_term_title( '', false ) ) . '</span>';
	} elseif ( is_singular() ) {
		$gvc_post = get_queried_object();

		if ( $gvc_post && 'page' === $gvc_post->post_type ) {
			$gvc_parent = (int) wp_get_post_parent_id( $gvc_post );

			if ( $gvc_parent ) {
				$items[] = '<a href="' . esc_url( get_permalink( $gvc_parent ) ) . '">' . esc_html( get_the_title( $gvc_parent ) ) . '</a>';
			}
		} else {
			$blog_id = (int) get_option( 'page_for_posts' );

			if ( $blog_id ) {
				$items[] = '<a href="' . esc_url( get_permalink( $blog_id ) ) . '">' . esc_html( get_the_title( $blog_id ) ) . '</a>';
			}
		}

		$items[] = '<span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_search() ) {
		$items[] = '<span>' . esc_html__( 'Search results', 'gv-craft' ) . '</span>';
	} elseif ( is_404() ) {
		$items[] = '<span>' . esc_html__( 'Page not found', 'gv-craft' ) . '</span>';
	} elseif ( is_home() ) {
		$items[] = '<span>' . esc_html( get_the_title( (int) get_option( 'page_for_posts' ) ) ) . '</span>';
	}

	if ( function_exists( 'is_shop' ) && is_shop() && gvc_woocommerce_active() ) {
		$items = array(
			'<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'gv-craft' ) . '</a>',
			'<a href="' . esc_url( wc_get_page_permalink( 'shop' ) ) . '">' . esc_html__( 'Shop', 'gv-craft' ) . '</a>',
			'<span>' . esc_html( woocommerce_page_title( false ) ) . '</span>',
		);
	}

	echo '<nav class="gvc-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'gv-craft' ) . '">';
	echo wp_kses_post( implode( ' ' . $sep . ' ', $items ) );
	echo '</nav>';
}

/**
 * Numbered pagination using the theme look.
 */
function gvc_pagination() {
	$links = paginate_links(
		array(
			'type'      => 'array',
			'prev_text' => '<span class="gvc-icon gvc-icon--sm" aria-hidden="true">chevron_left</span>',
			'next_text' => '<span class="gvc-icon gvc-icon--sm" aria-hidden="true">chevron_right</span>',
		)
	);

	if ( ! $links ) {
		return;
	}

	echo '<nav class="gvc-pagination" aria-label="' . esc_attr__( 'Pagination', 'gv-craft' ) . '"><ul>';
	foreach ( $links as $link ) {
		echo '<li>' . wp_kses_post( $link ) . '</li>';
	}
	echo '</ul></nav>';
}

/**
 * Section heading block.
 *
 * @param array $args eyebrow, title, text, align, split, id.
 */
function gvc_section_head( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'eyebrow'    => '',
			'eyebrow_icon' => '',
			'title'      => '',
			'text'       => '',
			'align'      => 'left',
			'split'      => true,
			'id'         => '',
		)
	);

	if ( ! $args['eyebrow'] && ! $args['title'] && ! $args['text'] ) {
		return;
	}
	?>
	<div class="gvc-section-head <?php echo $args['split'] ? 'gvc-section-head--split' : ''; ?>" <?php echo $args['id'] ? 'id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
		<div>
			<?php if ( $args['eyebrow'] ) : ?>
				<div class="gvc-eyebrow gvc-eyebrow--upper">
					<?php if ( $args['eyebrow_icon'] ) : ?>
						<?php gvc_icon( $args['eyebrow_icon'], 'gvc-icon--sm' ); ?>
					<?php endif; ?>
					<?php echo esc_html( $args['eyebrow'] ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $args['title'] ) : ?>
				<h2><?php echo esc_html( $args['title'] ); ?></h2>
			<?php endif; ?>
		</div>
		<?php if ( $args['text'] ) : ?>
			<p class="gvc-muted gvc-body-md" style="max-width: 32rem;"><?php echo esc_html( $args['text'] ); ?></p>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Render a product card (used on the home page, archives and related grids).
 *
 * @param WC_Product $product Product object.
 * @param array      $args    Optional arguments.
 */
function gvc_product_card( $product, $args = array() ) {
	if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
		return;
	}

	$args = wp_parse_args(
		$args,
		array(
			'show_add'   => true,
			'show_guild' => true,
			'class'      => '',
		)
	);

	$permalink = get_permalink( $product->get_id() );
	$badges    = gvc_product_badges( $product );
	$guild     = gvc_product_meta( $product, 'guild' );
	$stock     = $product->is_in_stock();

	$image_id = $product->get_image_id();
	$image   = $image_id ? wp_get_attachment_image( $image_id, 'gvc-card', false, array( 'loading' => 'lazy' ) ) : '';
	?>
	<div class="gvc-product-card <?php echo $stock ? '' : 'is-out'; ?> <?php echo esc_attr( $args['class'] ); ?>">
		<div class="gvc-product-card__media">
			<?php if ( $badges ) : ?>
				<div class="gvc-product-card__tags">
					<?php foreach ( array_slice( $badges, 0, 2 ) as $badge ) : ?>
						<span class="gvc-badge"><?php echo esc_html( $badge ); ?></span>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( $args['show_add'] && $stock ) : ?>
				<button class="gvc-product-card__wish" type="button" aria-label="<?php esc_attr_e( 'Save to wishlist', 'gv-craft' ); ?>" data-gvc-wishlist="<?php echo esc_attr( $product->get_id() ); ?>">
					<?php gvc_icon( 'favorite', 'gvc-icon--sm' ); ?>
				</button>
			<?php endif; ?>

			<?php if ( $image ) : ?>
				<a href="<?php echo esc_url( $permalink ); ?>" aria-label="<?php echo esc_attr( $product->get_name() ); ?>">
					<?php echo wp_kses_post( $image ); ?>
				</a>
			<?php else : ?>
				<img src="<?php echo esc_url( gvc_placeholder_url() ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" />
			<?php endif; ?>
		</div>

		<div class="gvc-product-card__body">
			<div>
				<?php if ( $args['show_guild'] && $guild ) : ?>
					<span class="gvc-product-card__guild"><?php echo esc_html( $guild ); ?></span>
				<?php endif; ?>

				<h3 class="gvc-product-card__title">
					<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
				</h3>

				<?php if ( $product->get_review_count() > 0 ) : ?>
					<div class="gvc-product-card__rating">
						<?php gvc_stars( $product->get_average_rating(), $product->get_review_count() ); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="gvc-product-card__foot">
				<div class="gvc-product-card__price">
					<?php echo wp_kses_post( $product->get_price_html() ); ?>
				</div>

				<?php if ( $args['show_add'] ) : ?>
					<?php if ( $product->is_type( 'simple' ) && $stock ) : ?>
						<button class="gvc-add-btn" type="button" data-gvc-add="<?php echo esc_attr( $product->get_id() ); ?>">
							<?php gvc_icon( 'add_shopping_cart', 'gvc-icon--sm' ); ?>
							<span class="screen-reader-text"><?php esc_html_e( 'Add to bag', 'gv-craft' ); ?></span>
						</button>
					<?php else : ?>
						<a class="gvc-add-btn" href="<?php echo esc_url( $permalink ); ?>">
							<?php gvc_icon( 'visibility', 'gvc-icon--sm' ); ?>
							<span class="screen-reader-text"><?php esc_html_e( 'View product', 'gv-craft' ); ?></span>
						</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Render the mobile bottom navigation.
 */
function gvc_mobile_nav() {
	$shop_url = gvc_woocommerce_active() ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
	$count    = gvc_cart_count();
	$is_shop  = function_exists( 'is_shop' ) && ( is_shop() || is_product_category() || is_product_tag() );
	$categories_url = home_url( '/' ) . '#catalog';
	$account_url = gvc_woocommerce_active() ? wc_get_account_endpoint_url( 'dashboard' ) : home_url( '/my-account/' );
	?>
	<nav class="gvc-mobile-nav" aria-label="<?php esc_attr_e( 'Primary mobile navigation', 'gv-craft' ); ?>">
		<a class="gvc-mobile-nav__item <?php echo is_front_page() ? 'is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php gvc_icon( 'cottage' ); ?>
			<span><?php esc_html_e( 'Home', 'gv-craft' ); ?></span>
		</a>
		<a class="gvc-mobile-nav__item <?php echo $is_shop ? 'is-active' : ''; ?>" href="<?php echo esc_url( $shop_url ); ?>">
			<?php gvc_icon( 'grid_view' ); ?>
			<span><?php esc_html_e( 'Shop', 'gv-craft' ); ?></span>
		</a>
		<a class="gvc-mobile-nav__item" href="<?php echo esc_url( $categories_url ); ?>">
			<?php gvc_icon( 'spa' ); ?>
			<span><?php esc_html_e( 'Categories', 'gv-craft' ); ?></span>
		</a>
		<a class="gvc-mobile-nav__item" href="<?php echo esc_url( $account_url ); ?>">
			<?php gvc_icon( 'person' ); ?>
			<span><?php esc_html_e( 'My Account', 'gv-craft' ); ?></span>
		</a>
		<a class="gvc-mobile-nav__item" href="<?php echo esc_url( gvc_woocommerce_active() ? wc_get_cart_url() : home_url( '/' ) ); ?>">
			<span class="gvc-icon" aria-hidden="true">shopping_cart</span>
			<?php if ( $count ) : ?>
				<span class="gvc-mobile-nav__badge"><?php echo esc_html( $count ); ?></span>
			<?php endif; ?>
			<span><?php esc_html_e( 'Cart', 'gv-craft' ); ?></span>
		</a>
	</nav>
	<?php
}

/**
 * Social links list.
 */
function gvc_social_links() {
	$networks = array(
		'facebook'  => 'facebook',
		'instagram' => 'instagram',
		'linkedin'  => 'linkedin',
		'twitter'   => 'x',
		'youtube'   => 'youtube',
	);

	$output = '';

	foreach ( $networks as $key => $icon ) {
		$url = gvc_option( 'social_' . $key );

		if ( ! $url ) {
			continue;
		}

		$output .= sprintf(
			'<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s"><span class="gvc-icon gvc-icon--sm" aria-hidden="true">%s</span></a>',
			esc_url( $url ),
			esc_attr( ucfirst( $key ) ),
			esc_html( $icon )
		);
	}

	if ( $output ) {
		echo '<div class="gvc-socials">' . $output . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * The "Add to bag" AJAX endpoint.
 */
function gvc_ajax_add_to_cart() {
	check_ajax_referer( 'gvc_nonce', 'nonce' );

	$product_id = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
	$quantity   = isset( $_POST['quantity'] ) ? max( 1, absint( $_POST['quantity'] ) ) : 1;
	$variation  = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;

	if ( ! $product_id || ! function_exists( 'WC' ) ) {
		wp_send_json_error( array( 'message' => __( 'Invalid product.', 'gv-craft' ) ) );
	}

	if ( ! gvc_woocommerce_active() ) {
		wp_send_json_error( array( 'message' => __( 'Store is not available.', 'gv-craft' ) ) );
	}

	$product = wc_get_product( $variation ? $variation : $product_id );

	if ( ! $product ) {
		wp_send_json_error( array( 'message' => __( 'Product not found.', 'gv-craft' ) ) );
	}

	$added = WC()->cart->add_to_cart( $product_id, $quantity, $variation );

	if ( ! $added ) {
		$notices = function_exists( 'wc_get_notices' ) ? wc_get_notices( 'error' ) : array();

		if ( ! empty( $notices ) ) {
			$message = wp_strip_all_tags( $notices[0]['notice'] );
			wc_clear_notices();
			wp_send_json_error( array( 'message' => $message ) );
		}

		wp_send_json_error( array( 'message' => __( 'Could not add this item. Please try again.', 'gv-craft' ) ) );
	}

	wp_send_json_success(
		array(
			'message' => sprintf(
				/* translators: %s: product name. */
				__( '%s was added to your bag.', 'gv-craft' ),
				$product->get_name()
			),
			'count'   => WC()->cart->get_cart_contents_count(),
			'total'   => WC()->cart->get_cart_subtotal(),
			'url'     => wc_get_cart_url(),
		)
	);
}
add_action( 'wp_ajax_gvc_add_to_cart', 'gvc_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_gvc_add_to_cart', 'gvc_ajax_add_to_cart' );

/**
 * Return the current cart count (for AJAX refresh).
 */
function gvc_ajax_cart_state() {
	check_ajax_referer( 'gvc_nonce', 'nonce' );

	if ( ! gvc_woocommerce_active() ) {
		wp_send_json_error( array( 'message' => __( 'Store is not available.', 'gv-craft' ) ) );
	}

	wp_send_json_success(
		array(
			'count' => WC()->cart ? WC()->cart->get_cart_contents_count() : 0,
			'total' => WC()->cart ? WC()->cart->get_cart_subtotal() : '',
		)
	);
}
add_action( 'wp_ajax_gvc_cart_state', 'gvc_ajax_cart_state' );
add_action( 'wp_ajax_nopriv_gvc_cart_state', 'gvc_ajax_cart_state' );

/**
 * Handle a newsletter subscription.
 */
function gvc_handle_subscribe() {
	$email = isset( $_POST['gvc_email'] ) ? sanitize_email( wp_unslash( $_POST['gvc_email'] ) ) : '';

	if ( ! isset( $_POST['gvc_subscribe_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['gvc_subscribe_nonce'] ) ), 'gvc_subscribe' ) ) {
		wp_safe_redirect( home_url( '/?gvc_subscribed=0' ) );
		exit;
	}

	if ( ! is_email( $email ) ) {
		wp_safe_redirect( home_url( '/?gvc_subscribed=0' ) );
		exit;
	}

	$subscribers = get_option( 'gvc_subscribers', array() );

	if ( ! is_array( $subscribers ) ) {
		$subscribers = array();
	}

	if ( ! in_array( $email, $subscribers, true ) ) {
		$subscribers[] = $email;
		update_option( 'gvc_subscribers', $subscribers );
	}

	wp_safe_redirect( home_url( '/?gvc_subscribed=1' ) );
	exit;
}
add_action( 'admin_post_gvc_subscribe', 'gvc_handle_subscribe' );
add_action( 'admin_post_nopriv_gvc_subscribe', 'gvc_handle_subscribe' );

/**
 * Shortcode that renders one of the built-in designed pages.
 *
 * Usage: [gv_page slug="about"]
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function gvc_page_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'slug' => 'about',
		),
		$atts,
		'gv_page'
	);

	$slug = sanitize_file_name( $atts['slug'] );
	$file = GVC_DIR . 'template-parts/pages/' . $slug . '.php';

	if ( ! file_exists( $file ) ) {
		return '';
	}

	ob_start();
	include $file;

	return ob_get_clean();
}
add_shortcode( 'gv_page', 'gvc_page_shortcode' );

/**
 * Handle the contact form submission.
 */
function gvc_handle_contact() {
	$name    = isset( $_POST['gvc_name'] ) ? sanitize_text_field( wp_unslash( $_POST['gvc_name'] ) ) : '';
	$email   = isset( $_POST['gvc_email'] ) ? sanitize_email( wp_unslash( $_POST['gvc_email'] ) ) : '';
	$subject = isset( $_POST['gvc_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['gvc_subject'] ) ) : '';
	$message = isset( $_POST['gvc_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['gvc_message'] ) ) : '';

	if ( ! isset( $_POST['gvc_contact_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['gvc_contact_nonce'] ) ), 'gvc_contact' ) ) {
		wp_safe_redirect( home_url( '/?gvc_sent=0#contact' ) );
		exit;
	}

	if ( ! $name || ! is_email( $email ) || ! $message ) {
		wp_safe_redirect( home_url( '/?gvc_sent=0#contact' ) );
		exit;
	}

	$body = sprintf(
		"New message from the Greenvision Craft contact form.\n\nName: %s\nEmail: %s\nSubject: %s\n\n%s\n",
		$name,
		$email,
		$subject,
		$message
	);

	wp_mail(
		get_option( 'admin_email' ),
		sprintf( '[Greenvision Craft] %s', $subject ? $subject : __( 'New enquiry', 'gv-craft' ) ),
		$body,
		array( 'Reply-To: ' . $name . ' <' . $email . '>' )
	);

	wp_safe_redirect( home_url( '/?gvc_sent=1#contact' ) );
	exit;
}
add_action( 'admin_post_gvc_contact', 'gvc_handle_contact' );
add_action( 'admin_post_nopriv_gvc_contact', 'gvc_handle_contact' );

/**
 * Contact form confirmation.
 */
function gvc_contact_notice() {
	if ( ! isset( $_GET['gvc_sent'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}

	$state = sanitize_text_field( wp_unslash( $_GET['gvc_sent'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	echo '<div class="gvc-container" style="padding-top: 1rem;">';

	if ( '1' === $state ) {
		echo '<div class="gvc-badge" style="background: var(--gvc-mint); color: var(--gvc-success);">' . esc_html__( 'Message sent successfully — we will reply within two working days.', 'gv-craft' ) . '</div>';
	} else {
		echo '<div class="gvc-badge" style="background: var(--gvc-error-bg); color: var(--gvc-error);">' . esc_html__( 'Submission failed. Please check the form and try again.', 'gv-craft' ) . '</div>';
	}

	echo '</div>';
}
add_action( 'gvc_after_header', 'gvc_contact_notice' );

/**
 * Show a confirmation for the newsletter form.
 */
function gvc_subscribe_notice() {
	if ( ! isset( $_GET['gvc_subscribed'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}

	$state = sanitize_text_field( wp_unslash( $_GET['gvc_subscribed'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	echo '<div class="gvc-container" style="padding-top: 1rem;">';

	if ( '1' === $state ) {
		echo '<div class="gvc-badge" style="background: var(--gvc-mint); color: var(--gvc-success);">' . esc_html__( 'You are on the list. Welcome to the journal.', 'gv-craft' ) . '</div>';
	} else {
		echo '<div class="gvc-badge" style="background: var(--gvc-error-bg); color: var(--gvc-error);">' . esc_html__( 'That email address did not look right — please try again.', 'gv-craft' ) . '</div>';
	}

	echo '</div>';
}
add_action( 'gvc_after_header', 'gvc_subscribe_notice' );
