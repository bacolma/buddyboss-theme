<?php

if ( ! function_exists( 'learndash_focus_mode_comments_list' ) ) {
	function learndash_focus_mode_comments_list( $comment, $args, $depth ) {
		global $wp_roles;
		global $post;

		$GLOBALS['comment'] = $comment;

		$user_data = get_userdata( $comment->user_id );
		$roles = $user_data->roles;
		$role_classes = '';
		if ( ! empty( $roles ) ) {
			foreach ( $roles as $role ):
				$role_classes .= 'role-' . $role;
				if ( $role === 'administrator' || $role === 'group_leader' ) {
					$role_name = translate_user_role( $wp_roles->roles[ $role ]['name'] );
				}

			endforeach;
		}

		$avatarClass = empty( get_avatar( $comment->comment_author_email ) ) ? ' ld-no-avatar-image' : '';

		?>

	<div <?php comment_class( 'ld-focus-comment ptype-' . $post->post_type . ' ' . $role_classes . $avatarClass ); ?> id="comment-<?php comment_ID(); ?>">
		<div class="ld-comment-wrapper">

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<span class="ld-comment-alert"><?php esc_html_e( 'Your response is awaiting for approval.',
						'buddyboss-theme' ); ?></span>
			<?php endif; ?>

			<div class="ld-comment-avatar">
				<?php echo wp_kses_post( get_avatar( $comment->comment_author_email ) ); ?>
				<span class="ld-comment-avatar-author">
					<span class="ld-comment-author-name">
						<?php
						echo esc_html( $comment->comment_author );
						if ( ! empty( $role_name ) ) {
							echo ' (' . $role_name . ')';
						}
						?>
					</span>
					<a class="ld-comment-permalink" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php
					printf( // translators: placeholders: %1$s: Comment Date, %2$s: Comment Time
						esc_html_x( '%1$s at %2$s', 'placeholders: comment date, comment time', 'buddyboss-theme' ),
						'<span> ' . get_comment_date( 'm/d/Y' ) . '</span>',
						'<span> ' . get_comment_time() . '</span>' );
					?>

					</a>
				</span>
			</div>

			<div class="ld-comment-body">
				<?php comment_text(); ?>
				<div class="ld-comment-reply">
					<?php comment_reply_link( array_merge( $args,
						array(
							'reply_text' => 'Reply',
							'after'      => '',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth']
						) ) ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

/**
 * Fix reset password bug coming from LearnDash v3.1.1
 */
if ( function_exists( 'learndash_login_headerurl' ) ) {
	remove_action( 'login_headerurl', 'learndash_login_headerurl' );
}
