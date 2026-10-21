<?php
/**
 * Search results template.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="gvc-main" class="gvc-main">
	<div class="gvc-container">

		<div class="gvc-page-hero">
			<?php gvc_breadcrumbs(); ?>
			<h1 style="margin: 0;">
				<?php
				printf(
					/* translators: %s: search query. */
					esc_html__( 'Results for “%s”', 'gv-craft' ),
					esc_html( get_search_query() )
				);
				?>
			</h1>
			<p class="gvc-lede" style="margin-top: 0.5rem;">
				<?php
				printf(
					/* translators: %d: number of results. */
					esc_html__( '%d matching pieces found.', 'gv-craft' ),
					(int) $GLOBALS['wp_query']->found_posts
				);
				?>
			</p>
		</div>

		<div class="gvc-section">
			<?php if ( have_posts() ) : ?>

				<div style="max-width: 34rem; margin-bottom: 2rem;">
					<?php get_search_form(); ?>
				</div>

				<div class="gvc-grid gvc-grid--3">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', 'card' );
					endwhile;
					?>
				</div>

				<?php gvc_pagination(); ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
			<?php endif; ?>
		</div>

	</div>
</main>

<?php
get_footer();
