<?php
/**
 * Archive template.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="gvc-main" class="gvc-main">
	<div class="gvc-page-hero">
		<div class="gvc-container gvc-container--wide">
			<?php gvc_breadcrumbs(); ?>
			<h1 style="margin: 0;"><?php the_archive_title(); ?></h1>
			<?php
			$gvc_description = get_the_archive_description();

			if ( $gvc_description ) :
				?>
				<div class="gvc-lede" style="max-width: 44rem; margin-top: 0.75rem;"><?php echo wp_kses_post( $gvc_description ); ?></div>
			<?php endif; ?>
		</div>
	</div>

	<div class="gvc-container gvc-container--wide">
		<div class="gvc-section">
			<?php if ( have_posts() ) : ?>
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
