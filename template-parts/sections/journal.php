<?php
/**
 * Front page — regenerative living journal.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_posts = get_posts(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
	)
);

if ( empty( $gvc_posts ) ) {
	return;
}

$gvc_blog_id = (int) get_option( 'page_for_posts' );
$gvc_blog_url = $gvc_blog_id ? get_permalink( $gvc_blog_id ) : home_url( '/' );
?>
<section class="gvc-section gvc-section--white" style="border-top: 1px solid var(--gvc-border);">
	<div class="gvc-container gvc-container--full">

		<?php
		gvc_section_head(
			array(
				'eyebrow'      => __( 'Regenerative Living Journal', 'gv-craft' ),
				'eyebrow_icon' => 'auto_stories',
				'title'        => __( 'Field notes from the craft floor', 'gv-craft' ),
				'text'         => __( 'Seasonal guild releases, botanical care guides and quarterly environmental impact disclosures.', 'gv-craft' ),
			)
		);
		?>

		<div class="gvc-grid gvc-grid--3">
			<?php
			foreach ( $gvc_posts as $gvc_post ) :
				$gvc_thumb = get_post_thumbnail_id( $gvc_post->ID );
				?>
				<article class="gvc-post-card">
					<a class="gvc-media gvc-media--wide" href="<?php echo esc_url( get_permalink( $gvc_post ) ); ?>">
						<?php if ( $gvc_thumb ) : ?>
							<?php echo wp_get_attachment_image( $gvc_thumb, 'gvc-card', false, array( 'loading' => 'lazy', 'alt' => get_the_title( $gvc_post ) ) ); ?>
						<?php else : ?>
							<img src="<?php echo esc_url( gvc_placeholder_url() ); ?>" alt="<?php echo esc_attr( get_the_title( $gvc_post ) ); ?>" loading="lazy" />
						<?php endif; ?>
					</a>
					<div class="gvc-post-card__body">
						<div class="gvc-post-card__meta">
							<?php gvc_icon( 'eco', 'gvc-icon--sm' ); ?>
							<?php echo esc_html( get_the_date( '', $gvc_post ) ); ?>
						</div>
						<h3 class="gvc-title-lg" style="margin: 0;">
							<a href="<?php echo esc_url( get_permalink( $gvc_post ) ); ?>"><?php echo esc_html( get_the_title( $gvc_post ) ); ?></a>
						</h3>
						<p class="gvc-body-sm gvc-muted" style="margin: 0;">
							<?php echo esc_html( wp_trim_words( get_the_excerpt( $gvc_post ), 22 ) ); ?>
						</p>
						<a class="gvc-link-arrow" href="<?php echo esc_url( get_permalink( $gvc_post ) ); ?>">
							<?php esc_html_e( 'Read the story', 'gv-craft' ); ?>
							<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="gvc-text-center gvc-mt-4">
			<a class="gvc-btn gvc-btn--secondary" href="<?php echo esc_url( $gvc_blog_url ); ?>">
				<?php esc_html_e( 'Open the journal', 'gv-craft' ); ?>
				<?php gvc_icon( 'arrow_forward', 'gvc-icon--sm' ); ?>
			</a>
		</div>

	</div>
</section>
