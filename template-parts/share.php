<div class="bb-share-container">
	<?php
	if ( function_exists( 'bb_bookmarks' ) && is_user_logged_in() ) {
		echo
			bb_bookmarks()->action_button(
				array(
					'object_id'     => get_the_ID(),
					'object_type'   => 'post_' . get_post_type( get_the_ID() ),
					'action_type'   => 'like',

					'wrapper_class' => 'bb-like-wrap',
					'icon_class'    => 'bb-icon-like',
					'text_template' => '{{bookmarks_count}}',

					'title_add'     => __( 'Like this entry', 'buddyboss-theme' ),
					'title_remove'  => __( 'Remove like', 'buddyboss-theme' ),
					'tooltip_pos'   => 'right',
				)

		);
	}
	?>

	<div class="bb-shareIcons"></div>

	<?php
	if ( function_exists( 'bb_bookmarks' ) && is_user_logged_in() ) {
		echo
			bb_bookmarks()->action_button(
				array(
					'object_id'     => get_the_ID(),
					'object_type'   => 'post_' . get_post_type( get_the_ID() ),
					'action_type'   => 'bookmark',

					'wrapper_class' => 'bookmark-link-container',
					'icon_class'    => 'bb-bookmark bb-icon-bookmark-small',
					'text_template' => '',

					'title_add'     => __( 'Bookmark this story to read later', 'buddyboss-theme' ),
					'title_remove'  => __( 'Remove bookmark', 'buddyboss-theme' ),
					'tooltip_pos'   => 'right',
				)
		);
	}
	?>

</div>
