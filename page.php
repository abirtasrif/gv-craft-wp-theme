<?php
/**
 * Page template.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="gvc-main" class="gvc-main">
	<div class="gvc-container">

		<?php
		while ( have_posts() ) :
			the_post();

			$gvc_hero = get_post_meta( get_the_ID(), '_gvc_page_hero', true );
			?>

			<?php
			$gvc_hero  = true;
			$gvc_title = '';

			if ( gvc_woocommerce_active() && ( is_cart() || is_checkout() || is_account_page() ) ) {
				$gvc_hero = false;
			}

			if ( ! has_block( 'gvc/full-width' ) && $gvc_hero ) :
				?>
				<div class="gvc-page-hero">
					<?php gvc_breadcrumbs(); ?>
					<h1 style="margin: 0;"><?php the_title(); ?></h1>
					<?php if ( has_excerpt() ) : ?>
						<p class="gvc-lede" style="max-width: 44rem; margin-top: 0.75rem;"><?php echo esc_html( get_the_excerpt() ); ?></p>
					<?php endif; ?>
				</div>
			<?php elseif ( $gvc_hero ) : ?>
				<?php gvc_breadcrumbs(); ?>
			<?php endif; ?>

			<div class="gvc-section">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="gvc-page-links">' . esc_html__( 'Pages:', 'gv-craft' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>

			<?php
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();
