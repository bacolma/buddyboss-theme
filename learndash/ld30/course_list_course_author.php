<div class="bb-course-meta">
	<?php if ( class_exists( 'BuddyPress' ) ) {
		$user_link = bp_core_get_user_domain( get_the_author_meta( 'ID', $post->post_author ) );
	} else {
		$user_link = get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ), get_the_author_meta( 'user_nicename', $post->post_author ) );
	} ?>
	<a class="item-avatar" href="<?php echo $user_link; ?>" class="item-avatar">
		<?php echo get_avatar( get_the_author_meta( 'email', $post->post_author ), 80, '', '', array() ); ?>
	</a>
	<strong>
		<a href="<?php echo $user_link; ?>"><?php echo get_the_author_meta( 'display_name', $post->post_author ); ?></a>
	</strong>
</div>
