<?php
/**
 * Template Name: GV Craft — Shop Grid
 * Template Post Type: page
 *
 * A full width catalogue page built from the same design system as the
 * category archives. Add the WooCommerce shortcode to fill it with products.
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
			<h1 style="margin: 0;"><?php the_title(); ?></h1>
			<?php
			while ( have_posts() ) :
				the_post();

				if ( has_excerpt() ) {
					echo '<p class="gvc-lede" style="max-width: 44rem; margin-top: 0.75rem;">' . esc_html( get_the_excerpt() ) . '</p>';
				}
				break;
			endwhile;
			?>
		</div>

		<div class="gvc-section">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>

	</div>
</main>

<?php
get_footer();
