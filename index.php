<?php
/**
 * The main template file.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="gvc-main" class="gvc-main">
	<div class="gvc-container gvc-section">
		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header class="gvc-page-hero" style="background: transparent; padding: 0 0 2rem; border: 0;">
					<h1 class="gvc-display" style="margin: 0;"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<div class="gvc-grid" style="grid-template-columns: 1fr; gap: 2rem;">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', get_post_type() );
				endwhile;
				?>
			</div>

			<?php gvc_pagination(); ?>

		<?php else : ?>
			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
