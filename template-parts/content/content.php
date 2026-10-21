<?php
/**
 * Standard post content part.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'gvc-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="gvc-media gvc-media--wide" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'gvc-wide' ); ?>
		</a>
	<?php endif; ?>

	<div class="gvc-post-card__body">
		<div class="gvc-post-card__meta">
			<?php gvc_icon( 'eco', 'gvc-icon--sm' ); ?>
			<?php echo esc_html( get_the_date() ); ?>
		</div>

		<h2 class="gvc-title-lg" style="margin: 0;">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<div class="gvc-entry" style="font-size: 15px;">
			<?php the_excerpt(); ?>
		</div>

		<a class="gvc-link-arrow" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Read the story', 'gv-craft' ); ?>
			<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
		</a>
	</div>
</article>
