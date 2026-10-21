<?php
/**
 * Post card used in archives.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'gvc-post-card' ); ?>>
	<a class="gvc-media gvc-media--wide" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'gvc-card' ); ?>
		<?php else : ?>
			<img src="<?php echo esc_url( gvc_placeholder_url() ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
		<?php endif; ?>
	</a>

	<div class="gvc-post-card__body">
		<div class="gvc-post-card__meta">
			<?php gvc_icon( 'eco', 'gvc-icon--sm' ); ?>
			<?php echo esc_html( get_the_date() ); ?>
		</div>

		<h2 class="gvc-title-lg" style="margin: 0;">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<p class="gvc-body-sm gvc-muted" style="margin: 0;">
			<?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?>
		</p>

		<a class="gvc-link-arrow" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Read the story', 'gv-craft' ); ?>
			<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
		</a>
	</div>
</article>
