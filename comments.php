<?php
/**
 * The comments template.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="gvc-comments">

	<?php if ( have_comments() ) : ?>
		<h2 class="gvc-title-lg" style="margin-bottom: 1rem;">
			<?php
			$gvc_comment_count = get_comments_number();

			printf(
				/* translators: %s: comment count. */
				esc_html( _n( '%s review', '%s reviews', $gvc_comment_count, 'gv-craft' ) ),
				esc_html( number_format_i18n( $gvc_comment_count ) )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 40,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation(
			array(
				'prev_text' => esc_html__( 'Previous', 'gv-craft' ),
				'next_text' => esc_html__( 'Next', 'gv-craft' ),
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="gvc-body-sm gvc-muted"><?php esc_html_e( 'Comments are closed for this piece.', 'gv-craft' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'         => esc_html__( 'Write an artisan review', 'gv-craft' ),
			'title_reply_to'      => esc_html__( 'Reply to %s', 'gv-craft' ),
			'cancel_reply_link'   => esc_html__( 'Cancel reply', 'gv-craft' ),
			'label_submit'        => esc_html__( 'Post review', 'gv-craft' ),
			'class_submit'        => 'gvc-btn gvc-btn--primary',
			'comment_notes_before' => '',
		)
	);
	?>

</section>
