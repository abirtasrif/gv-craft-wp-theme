<?php
/**
 * The front page.
 *
 * Renders the designed GV Craft home layout. If the front page has been given
 * real block-editor content, that content is used instead.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( gvc_front_page_has_content() ) :
	?>
	<main id="gvc-main" class="gvc-main">
		<div class="gvc-container gvc-section">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
	</main>
	<?php
else :
	?>
	<main id="gvc-main" class="gvc-main">
		<?php
		get_template_part( 'template-parts/sections/hero' );

		if ( gvc_option( 'section_categories' ) ) {
			get_template_part( 'template-parts/sections/disciplines' );
		}

		if ( gvc_option( 'section_featured' ) ) {
			get_template_part( 'template-parts/sections/featured' );
		}

		if ( gvc_option( 'section_impact' ) ) {
			get_template_part( 'template-parts/sections/impact' );
		}

		if ( gvc_option( 'section_guild' ) ) {
			get_template_part( 'template-parts/sections/guild' );
		}

		if ( gvc_option( 'section_guarantees' ) ) {
			get_template_part( 'template-parts/sections/guarantees' );
		}

		if ( gvc_option( 'section_journal' ) ) {
			get_template_part( 'template-parts/sections/journal' );
		}

		if ( gvc_option( 'section_newsletter' ) ) {
			get_template_part( 'template-parts/sections/newsletter' );
		}
		?>
	</main>
	<?php
endif;

get_footer();
