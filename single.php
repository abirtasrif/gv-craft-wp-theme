<?php
/**
 * Single post template.
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
			?>
			<article <?php post_class( 'gvc-section' ); ?>>
				<?php gvc_breadcrumbs(); ?>

				<header style="max-width: 52rem; margin-bottom: 2rem;">
					<h1 style="margin-bottom: 0.75rem;"><?php the_title(); ?></h1>

					<div class="gvc-post-meta">
						<span>
							<?php gvc_icon( 'calendar_today', 'gvc-icon--sm' ); ?>
							<?php echo esc_html( get_the_date() ); ?>
						</span>
						<span>
							<?php gvc_icon( 'person', 'gvc-icon--sm' ); ?>
							<?php echo esc_html( get_the_author() ); ?>
						</span>
						<?php if ( has_category() ) : ?>
							<span>
								<?php gvc_icon( 'eco', 'gvc-icon--sm' ); ?>
								<?php echo esc_html( get_the_category_list( ', ' ) ); ?>
							</span>
						<?php endif; ?>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="gvc-single__hero">
						<?php the_post_thumbnail( 'gvc-wide', array( 'loading' => 'eager' ) ); ?>
					</figure>
				<?php endif; ?>

				<div class="gvc-entry" style="max-width: 46rem;">
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

				<footer class="gvc-post-nav">
					<?php
					previous_post_link( '<div class="gvc-link-arrow">%link</div>' );
					next_post_link( '<div class="gvc-link-arrow">%link</div>' );
					?>
				</footer>
			</article>

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
