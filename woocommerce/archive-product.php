<?php
/**
 * Shop / product category archive.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

get_header();

$gvc_is_category = is_product_category();
$gvc_term        = $gvc_is_category ? get_queried_object() : null;
$gvc_shop_url    = wc_get_page_permalink( 'shop' );
$gvc_cats        = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'parent'     => 0,
	)
);
$gvc_tags        = get_terms(
	array(
		'taxonomy'   => 'product_tag',
		'hide_empty' => true,
	)
);
?>

<main id="gvc-main" class="gvc-main">
	<div class="gvc-page-hero">
		<div class="gvc-container gvc-container--commerce">
			<?php gvc_breadcrumbs(); ?>

			<div style="display: flex; flex-wrap: wrap; align-items: flex-start; justify-content: space-between; gap: 1rem;">
				<div>
					<div class="gvc-eyebrow" style="margin-bottom: 0.35rem;">
						<span><?php esc_html_e( 'Artisan Catalog', 'gv-craft' ); ?></span>
						<span>·</span>
						<span style="color: var(--gvc-leaf);"><?php esc_html_e( '100% Sustainable', 'gv-craft' ); ?></span>
					</div>
					<h1 style="margin: 0;">
						<?php
						if ( $gvc_term ) {
							echo esc_html( $gvc_term->name );
						} elseif ( is_shop() ) {
							echo esc_html( get_the_title( wc_get_page_id( 'shop' ) ) );
						} else {
							esc_html_e( 'Browse the catalogue', 'gv-craft' );
						}
						?>
					</h1>
				</div>

				<span class="gvc-badge">
					<?php gvc_icon( 'nest_eco_leaf', 'gvc-icon--sm' ); ?>
					<?php esc_html_e( 'Ethical Origin', 'gv-craft' ); ?>
				</span>
			</div>

			<?php if ( $gvc_term && $gvc_term->description ) : ?>
				<p class="gvc-lede" style="max-width: 42rem; margin-top: 0.75rem;"><?php echo esc_html( $gvc_term->description ); ?></p>
			<?php else : ?>
				<p class="gvc-lede" style="max-width: 42rem; margin-top: 0.75rem;">
					<?php esc_html_e( 'Explore mindful craft traditions, earth-first raw materials and circular living designs created by native artisan guilds.', 'gv-craft' ); ?>
				</p>
			<?php endif; ?>
		</div>
	</div>

	<div class="gvc-container gvc-container--commerce">
		<div class="gvc-section" style="padding-top: 2rem;">
			<div class="gvc-shop-layout">

				<aside class="gvc-shop-sidebar" id="gvc-shop-sidebar">

					<div class="gvc-widget-box">
						<h3><?php esc_html_e( 'Search the catalogue', 'gv-craft' ); ?></h3>
						<form role="search" method="get" action="<?php echo esc_url( $gvc_shop_url ); ?>">
							<div class="gvc-input-group">
								<?php gvc_icon( 'search', 'gvc-icon--sm' ); ?>
								<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search materials or crafts…', 'gv-craft' ); ?>" />
							</div>
							<?php
							if ( $gvc_term ) {
								printf( '<input type="hidden" name="product_cat" value="%s" />', esc_attr( $gvc_term->slug ) );
							}
							?>
						</form>
					</div>

					<?php if ( ! is_wp_error( $gvc_cats ) && ! empty( $gvc_cats ) ) : ?>
						<div class="gvc-widget-box">
							<h3><?php esc_html_e( 'Craft disciplines', 'gv-craft' ); ?></h3>
							<ul>
								<li>
									<a href="<?php echo esc_url( $gvc_shop_url ); ?>" style="<?php echo ! $gvc_term ? 'color: var(--gvc-primary); font-weight: 600;' : ''; ?>">
										<?php esc_html_e( 'All pieces', 'gv-craft' ); ?>
									</a>
								</li>
								<?php foreach ( $gvc_cats as $gvc_cat ) : ?>
									<li>
										<a href="<?php echo esc_url( get_term_link( $gvc_cat ) ); ?>" style="<?php echo ( $gvc_term && $gvc_term->term_id === $gvc_cat->term_id ) ? 'color: var(--gvc-primary); font-weight: 600;' : ''; ?>">
											<?php echo esc_html( $gvc_cat->name ); ?>
											<span class="gvc-muted">(<?php echo esc_html( number_format_i18n( $gvc_cat->count ) ); ?>)</span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<div class="gvc-widget-box">
						<h3><?php esc_html_e( 'Price range', 'gv-craft' ); ?></h3>
						<form method="get" action="<?php echo esc_url( $gvc_shop_url ); ?>">
							<div style="display: flex; gap: 0.5rem; align-items: center;">
								<input type="number" name="min_price" min="0" step="1" placeholder="<?php esc_attr_e( 'Min', 'gv-craft' ); ?>" value="<?php echo esc_attr( isset( $_GET['min_price'] ) ? sanitize_text_field( wp_unslash( $_GET['min_price'] ) ) : '' ); ?>" style="height: 42px; font-size: 13px;" />
								<span class="gvc-muted">—</span>
								<input type="number" name="max_price" min="0" step="1" placeholder="<?php esc_attr_e( 'Max', 'gv-craft' ); ?>" value="<?php echo esc_attr( isset( $_GET['max_price'] ) ? sanitize_text_field( wp_unslash( $_GET['max_price'] ) ) : '' ); ?>" style="height: 42px; font-size: 13px;" />
							</div>
							<button class="gvc-btn gvc-btn--soft gvc-btn--sm gvc-btn--block" type="submit" style="margin-top: 0.75rem;">
								<?php esc_html_e( 'Apply price', 'gv-craft' ); ?>
							</button>
						</form>
					</div>

					<?php if ( ! is_wp_error( $gvc_tags ) && ! empty( $gvc_tags ) ) : ?>
						<div class="gvc-widget-box">
							<h3><?php esc_html_e( 'Eco certifications', 'gv-craft' ); ?></h3>
							<ul>
								<?php foreach ( $gvc_tags as $gvc_tag ) : ?>
									<li>
										<a href="<?php echo esc_url( add_query_arg( 'product_tag', $gvc_tag->slug, $gvc_shop_url ) ); ?>">
											<span class="gvc-pill-dot" style="display: inline-block; margin-right: 0.375rem;"></span>
											<?php echo esc_html( $gvc_tag->name ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'gvc-shop-sidebar' ) ) : ?>
						<?php dynamic_sidebar( 'gvc-shop-sidebar' ); ?>
					<?php endif; ?>

					<div class="gvc-widget-box" style="background: var(--gvc-forest); border-color: var(--gvc-forest); color: #fff;">
						<h3 style="color: var(--gvc-mint);"><?php esc_html_e( 'Craft that restores landscapes', 'gv-craft' ); ?></h3>
						<p class="gvc-body-sm" style="color: var(--gvc-surface-variant);">
							<?php esc_html_e( 'Every purchase funds a mangrove sapling in the coastal saltflats.', 'gv-craft' ); ?>
						</p>
						<a class="gvc-btn gvc-btn--mint gvc-btn--sm gvc-btn--block" href="<?php echo esc_url( home_url( '/impact-ledger/' ) ); ?>">
							<?php esc_html_e( 'Read impact report', 'gv-craft' ); ?>
						</a>
					</div>

				</aside>

				<div class="gvc-shop-main">

					<div class="gvc-shop-toolbar">
						<div class="gvc-shop-toolbar__left">
							<button class="gvc-btn gvc-btn--soft gvc-btn--sm gvc-text-center-mobile" type="button" data-gvc-toggle-sidebar style="display: none;">
								<?php gvc_icon( 'tune', 'gvc-icon--sm' ); ?>
								<?php esc_html_e( 'Filter & Sort', 'gv-craft' ); ?>
							</button>
							<span class="gvc-result-count">
								<?php
								printf(
									/* translators: %d: product count. */
									esc_html( _n( '%d piece', '%d pieces', (int) wc_get_loop_prop( 'total' ), 'gv-craft' ) ),
									(int) wc_get_loop_prop( 'total' )
								);
								?>
							</span>
						</div>

						<?php if ( get_option( 'woocommerce_enable_catalog_ordering', 'yes' ) === 'yes' ) : ?>
							<div class="gvc-sort-select">
								<?php woocommerce_catalog_ordering(); ?>
							</div>
						<?php endif; ?>
					</div>

					<?php if ( have_posts() ) : ?>

						<div class="gvc-products gvc-products--4">
							<?php
							while ( have_posts() ) :
								the_post();
								wc_get_template_part( 'content', 'product' );
							endwhile;
							?>
						</div>

						<?php gvc_pagination(); ?>

					<?php else : ?>
						<div class="gvc-card" style="padding: 2.5rem; text-align: center;">
							<h2 style="margin-bottom: 0.5rem;"><?php esc_html_e( 'No pieces matched that filter', 'gv-craft' ); ?></h2>
							<p class="gvc-lede"><?php esc_html_e( 'Loosen a filter or two and the catalogue will open up again.', 'gv-craft' ); ?></p>
							<p style="margin-top: 1.5rem;">
								<a class="gvc-btn gvc-btn--primary" href="<?php echo esc_url( $gvc_shop_url ); ?>"><?php esc_html_e( 'Clear filters', 'gv-craft' ); ?></a>
							</p>
						</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
