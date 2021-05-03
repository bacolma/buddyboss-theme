<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<!-- .comments-title -->
	<h4 class="comments-title"><?php esc_html_e( 'Responses', 'buddyboss-theme' ); ?></h4>

	<?php
	$user_link = function_exists( 'bp_core_get_user_domain' ) ? bp_core_get_user_domain( get_current_user_id() ) : get_author_posts_url( get_current_user_id() );

	// You can start editing here -- including this comment!
	$args = array(
		'comment_field'      => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __( 'Write a response...', 'buddyboss-theme' ) . '"></textarea></p>',
		'title_reply'        => '',

		/*
         * translators:
		 * %1$s - user avatar html
		 * %3$s - User Name
         */
		'logged_in_as'       => '<p class="logged-in-as">' . sprintf( __( '<a class="comment-author" href="%1$s"><span class="vcard">%2$s</span><span class="name">%3$s</span></a>', 'buddyboss-theme' ), $user_link, get_avatar( get_current_user_id(), 80 ), $user_identity ) . '</p>',
		'class_submit'       => 'submit button outline small',
		'title_reply_before' => '',
		'title_reply_after'  => '',
		'label_submit'       => __( 'Publish', 'buddyboss-theme' ),
	);

	comment_form( $args );

	if ( have_comments() ) : ?>
		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'callback'    => 'buddyboss_comment',
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 80,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'buddyboss-theme' ); ?></p><?php
		endif;

	endif; // Check for have_comments().
	?>

	<script>
		// Disable 'submit comment' until we have something in the field
		if ( jQuery( '#submit' ).length ){
			jQuery( '#submit' ).prop( 'disabled', true );

			jQuery( '#comment' ).keyup( function() {
				if ( jQuery.trim( jQuery( '#comment' ).val().length ) > 0 ) {
					jQuery( '#submit' ).prop( 'disabled', false );
				} else {
					jQuery( '#submit' ).prop( 'disabled', true );
				}
			});
		}
	</script>

</div><!-- #comments -->