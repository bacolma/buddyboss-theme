<?php

if( is_user_logged_in() ) {


	// Action - Before buddypress profile menu
	do_action( THEME_HOOK_PREFIX . 'before_bb_profile_menu' );

	if ( bp_is_active( 'xprofile' ) ) {
		// Profile link.
		$profile_link = trailingslashit( bp_loggedin_user_domain() . bp_get_profile_slug() );
		?>
		<li id="wp-admin-bar-my-account-xprofile" class="menupop parent">
			<a class="ab-item" aria-haspopup="true" href="<?php echo $profile_link; ?>">
				<span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php _e( 'Profile', 'buddyboss-theme' ); ?>
			</a>
			<div class="ab-sub-wrapper wrapper">
				<ul id="wp-admin-bar-my-account-xprofile-default" class="ab-submenu">
					<li id="wp-admin-bar-my-account-xprofile-public">
						<a class="ab-item" href="<?php echo $profile_link; ?>"><?php _e( 'View', 'buddyboss-theme' ); ?></a>
					</li>
					<li id="wp-admin-bar-my-account-xprofile-edit">
						<a class="ab-item" href="<?php echo trailingslashit( $profile_link . 'edit' ); ?>"><?php _e( 'Edit', 'buddyboss-theme' ); ?></a>
					</li>
					<?php if ( buddypress()->avatar->show_avatars ) { ?>
					<li id="wp-admin-bar-my-account-xprofile-change-avatar">
						<a class="ab-item" href="<?php echo trailingslashit( $profile_link . 'change-avatar' ); ?>"><?php _e( 'Profile Photo', 'buddyboss-theme' ); ?></a>
					</li>
					<?php } ?>
					<?php if ( bp_displayed_user_use_cover_image_header() ) { ?>
					<li id="wp-admin-bar-my-account-xprofile-change-cover-image">
						<a class="ab-item" href="<?php echo trailingslashit( $profile_link . 'change-cover-image' ); ?>"><?php _e( 'Cover Photo', 'buddyboss-theme' ); ?></a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</li>
		<?php
	}

	// Action - After buddypress xprofile menu
	do_action( THEME_HOOK_PREFIX . 'after_bb_xprofile_menu' );

	if ( bp_is_active( 'settings' ) ) {
		// Setup the logged in user variables.
		$settings_link = trailingslashit( bp_loggedin_user_domain() . bp_get_settings_slug() );

		?>
		<li id="wp-admin-bar-my-account-settings" class="menupop parent">
			<a class="ab-item" aria-haspopup="true" href="<?php echo $settings_link; ?>">
				<span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php _e( 'Account', 'buddyboss-theme' ); ?></a>
			<div class="ab-sub-wrapper wrapper">
				<ul id="wp-admin-bar-my-account-settings-default" class="ab-submenu">
					<li id="wp-admin-bar-my-account-settings-general">
						<a class="ab-item" href="<?php echo $settings_link; ?>">
							<?php _e( 'Login Information', 'buddyboss-theme' ); ?>
						</a>
					</li>
					<?php if ( has_action( 'bp_notification_settings' ) ) { ?>
					<li id="wp-admin-bar-my-account-settings-notifications">
						<a class="ab-item" href="<?php echo trailingslashit( $settings_link . 'notifications' ); ?>">
							<?php _e( 'Email Preferences', 'buddyboss-theme' ); ?>
						</a>
					</li>
					<?php } ?>
					<li id="wp-admin-bar-my-account-settings-profile">
						<a class="ab-item" href="<?php echo trailingslashit( $settings_link . 'profile' ); ?>">
							<?php _e( 'Privacy', 'buddyboss-theme' ); ?>
						</a>
					</li>
					<li id="wp-admin-bar-my-account-settings-export">
						<a class="ab-item" href="<?php echo trailingslashit( $settings_link . 'export/' ); ?>">
							<?php _e( 'Export Data', 'buddyboss-theme' ); ?>
						</a>
					</li>
					<?php if ( !bp_current_user_can( 'bp_moderate' ) && ! bp_core_get_root_option( 'bp-disable-account-deletion' ) ) { ?>
					<li id="wp-admin-bar-my-account-settings-delete-account">
						<a class="ab-item" href="<?php echo trailingslashit( $settings_link . 'delete-account' ); ?>">
							<?php _e( 'Delete Account', 'buddyboss-theme' ); ?>
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</li>
		<?php
	}

	// Action - After buddypress setting menu
	do_action( THEME_HOOK_PREFIX . 'after_bb_setting_menu' );

	if ( bp_is_active( 'activity' ) ) {
		// Setup the logged in user variables.
		$activity_link = trailingslashit( bp_loggedin_user_domain() . bp_get_activity_slug() );

		?>
		<li id="wp-admin-bar-my-account-activity" class="menupop parent">
			<a class="ab-item" aria-haspopup="true" href="<?php echo esc_url( $activity_link ); ?>">
				<span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php _e( 'Timeline', 'buddyboss-theme' ); ?>
			</a>
			<div class="ab-sub-wrapper wrapper">
				<ul id="wp-admin-bar-my-account-activity-default" class="ab-submenu">
					<li id="wp-admin-bar-my-account-activity-personal">
						<a class="ab-item" href="<?php echo esc_url( $activity_link ); ?>"><?php echo function_exists( 'bp_is_activity_tabs_active' ) && bp_is_activity_tabs_active() ? __( 'Personal', 'buddyboss-theme' ) : __( 'Posts', 'buddyboss-theme' ); ?></a>
					</li>
                    <?php if ( function_exists( 'bp_is_activity_tabs_active' ) && bp_is_activity_tabs_active() ) : ?>
                        <?php if ( bp_is_activity_like_active() ) : ?>
                            <li id="wp-admin-bar-my-account-activity-favorites">
                                <a class="ab-item" href="<?php echo esc_url( trailingslashit( $activity_link . 'favorites' ) ); ?>"><?php _e( 'Likes', 'buddyboss-theme' ); ?></a>
                            </li>
	                    <?php endif; ?>
                        <?php if ( bp_is_active( 'friends' ) ) : ?>
                            <li id="wp-admin-bar-my-account-activity-friends">
                                <a class="ab-item" href="<?php echo esc_url( trailingslashit( $activity_link . 'friends' ) ); ?>"><?php _e( 'Connections', 'buddyboss-theme' ); ?></a>
                            </li>
	                    <?php endif; ?>
                        <?php if ( bp_is_active( 'groups' ) ) : ?>
                            <li id="wp-admin-bar-my-account-activity-groups">
                                <a class="ab-item" href="<?php echo esc_url( trailingslashit( $activity_link . 'groups' ) ); ?>"><?php _e( 'Groups', 'buddyboss-theme' ); ?></a>
                            </li>
	                    <?php endif; ?>
                        <?php if ( bp_activity_do_mentions() ) : ?>
                            <li id="wp-admin-bar-my-account-activity-mentions">
                                <a class="ab-item" href="<?php echo esc_url( trailingslashit( $activity_link . 'mentions' ) ); ?>"><?php _e( 'Mentions', 'buddyboss-theme' ); ?></a>
                            </li>
	                    <?php endif; ?>
                        <?php if ( bp_is_activity_follow_active() ) : ?>
                            <li id="wp-admin-bar-my-account-activity-following">
                                <a class="ab-item" href="<?php echo esc_url( trailingslashit( $activity_link . 'following' ) ); ?>"><?php _e( 'Following', 'buddyboss-theme' ); ?></a>
                            </li>
	                    <?php endif; ?>
                    <?php endif; ?>
				</ul>
			</div>
		</li>
		<?php
	}

	// Action - After buddypress activity menu
	do_action( THEME_HOOK_PREFIX . 'after_bb_activity_menu' );

	if ( bp_is_active( 'notifications' ) ) {
		// Setup the logged in user variables.
		$notifications_link = trailingslashit( bp_loggedin_user_domain() . bp_get_notifications_slug() );

		// Pending notification requests.
		$count = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );
		if ( ! empty( $count ) ) {
			$title = sprintf(
			/* translators: %s: Unread notification count for the current user */
				__( 'Notifications %s', 'buddyboss-theme' ),
				'<span class="count">' . bp_core_number_format( $count ) . '</span>'
			);
			$unread = sprintf(
			/* translators: %s: Unread notification count for the current user */
				__( 'Unread %s', 'buddyboss-theme' ),
				'<span class="count">' . bp_core_number_format( $count ) . '</span>'
			);
		} else {
			$title  = __( 'Notifications', 'buddyboss-theme' );
			$unread = __( 'Unread', 'buddyboss-theme' );
		}

		?>
		<li id="wp-admin-bar-my-account-notifications" class="menupop parent">
			<a class="ab-item" aria-haspopup="true" href="<?php echo esc_url( $notifications_link ); ?>">
				<span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php echo $title; ?>
			</a>
			<div class="ab-sub-wrapper wrapper">
				<ul id="wp-admin-bar-my-account-notifications-default" class="ab-submenu">
					<li id="wp-admin-bar-my-account-notifications-unread">
						<a class="ab-item" href="<?php echo esc_url( $notifications_link ); ?>"><?php echo $unread; ?></a>
					</li>
					<li id="wp-admin-bar-my-account-notifications-read">
						<a class="ab-item" href="<?php echo esc_url( trailingslashit( $notifications_link . 'read' ) ); ?>"><?php _e( 'Read', 'buddyboss-theme' ); ?></a>
					</li>
				</ul>
			</div>
		</li>
		<?php
	}

	// Action - After buddypress notifications menu
	do_action( THEME_HOOK_PREFIX . 'after_bb_notifications_menu' );

	if ( bp_is_active( 'messages' ) ) {
		// Setup the logged in user variables.
		$messages_link = trailingslashit( bp_loggedin_user_domain() . bp_get_messages_slug() );

		// Unread message count.
		$count = messages_get_unread_count( bp_loggedin_user_id() );
		if ( !empty( $count ) ) {
			$title = sprintf(
			/* translators: %s: Unread message count for the current user */
				__( 'Messages %s', 'buddyboss-theme' ),
				'<span class="count">' . bp_core_number_format( $count ) . '</span>'
			);
			$inbox = sprintf(
			/* translators: %s: Unread message count for the current user */
				__( 'Messages %s', 'buddyboss-theme' ),
				'<span class="count">' . bp_core_number_format( $count ) . '</span>'
			);
		} else {
			$title = __( 'Messages', 'buddyboss-theme' );
			$inbox = __( 'Messages',    'buddyboss-theme' );
		}

		?>
		<li id="wp-admin-bar-my-account-messages" class="menupop parent">
			<a class="ab-item" aria-haspopup="true" href="<?php echo esc_url( $messages_link ); ?>">
				<span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php echo $title; ?>
			</a>
			<div class="ab-sub-wrapper wrapper">
				<ul id="wp-admin-bar-my-account-messages-default" class="ab-submenu">
					<li id="wp-admin-bar-my-account-messages-inbox">
						<a class="ab-item" href="<?php echo esc_url( $messages_link ); ?>"><?php echo $inbox; ?></a>
					</li>
					<li id="wp-admin-bar-my-account-messages-compose">
						<a class="ab-item" href="<?php echo esc_url( trailingslashit( $messages_link . 'compose' ) ); ?>"><?php _e( 'New Message', 'buddyboss-theme' ); ?></a>
					</li>
					<?php if ( bp_current_user_can( 'bp_moderate' ) ) { ?>
						<li id="wp-admin-bar-my-account-messages-notices">
							<a class="ab-item" href="<?php echo esc_url( admin_url( '/admin.php?page=bp-notices' ) ); ?>"><?php _e( 'Site Notices', 'buddyboss-theme' ); ?></a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</li>
		<?php
	}

	// Action - After buddypress messages menu
	do_action( THEME_HOOK_PREFIX . 'after_bb_messages_menu' );

	if ( bp_is_active( 'friends' ) ) {
		// Setup the logged in user variables.
		$friends_link = trailingslashit( bp_loggedin_user_domain() . bp_get_friends_slug() );

		// Pending friend requests.
		$count = count( friends_get_friendship_request_user_ids( bp_loggedin_user_id() ) );
		if ( !empty( $count ) ) {
			$title = sprintf(
			/* translators: %s: Pending friend request count for the current user */
				__( 'Connections %s', 'buddyboss-theme' ),
				'<span class="count">' . bp_core_number_format( $count ) . '</span>'
			);
			$pending = sprintf(
			/* translators: %s: Pending friend request count for the current user */
				__( 'Pending Requests %s', 'buddyboss-theme' ),
				'<span class="count">' . bp_core_number_format( $count ) . '</span>'
			);
		} else {
			$title   = __( 'Connections', 'buddyboss-theme' );
			$pending = __( 'No Pending Requests', 'buddyboss-theme' );
		}

		?>
		<li id="wp-admin-bar-my-account-friends" class="menupop parent">
			<a class="ab-item" aria-haspopup="true" href="<?php echo esc_url( $friends_link ); ?>">
				<span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php echo $title; ?>
			</a>
			<div class="ab-sub-wrapper wrapper">
				<ul id="wp-admin-bar-my-account-friends-default" class="ab-submenu">
					<li id="wp-admin-bar-my-account-friends-friendships">
						<a class="ab-item" href="<?php echo esc_url( $friends_link ); ?>"><?php _e( 'My Connections', 'buddyboss-theme' ); ?></a>
					</li>
					<li id="wp-admin-bar-my-account-friends-requests">
						<a class="ab-item" href="<?php echo esc_url( trailingslashit( $friends_link . 'requests' ) ); ?>"><?php echo $pending; ?></a>
					</li>
				</ul>
			</div>
		</li>
		<?php
	}

	// Action - After buddypress friends menu
	do_action( THEME_HOOK_PREFIX . 'after_bb_friends_menu' );

	if ( bp_is_active( 'groups' ) ) {
		// Setup the logged in user variables.
		$groups_link = trailingslashit( bp_loggedin_user_domain() . bp_get_groups_slug() );

		// Pending group invites.
		$count   = groups_get_invite_count_for_user();
		$title   = __( 'Groups', 'buddyboss-theme' );
		$pending = __( 'No Pending Invites', 'buddyboss-theme' );

		if ( ! empty( $count ) ) {
			$title = sprintf(
			/* translators: %s: Group invitation count for the current user */
				__( 'Groups %s', 'buddyboss-theme' ),
				'<span class="count">' . bp_core_number_format( $count ) . '</span>'
			);

			$pending = sprintf(
			/* translators: %s: Group invitation count for the current user */
				__( 'Pending Invites %s', 'buddyboss-theme' ),
				'<span class="count">' . bp_core_number_format( $count ) . '</span>'
			);
		}

		?>
		<li id="wp-admin-bar-my-account-groups" class="menupop parent">
			<a class="ab-item" aria-haspopup="true" href="<?php echo esc_url( $groups_link ); ?>">
				<span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php echo $title; ?>
			</a>
			<div class="ab-sub-wrapper wrapper">
				<ul id="wp-admin-bar-my-account-groups-default" class="ab-submenu">
					<li id="wp-admin-bar-my-account-groups-memberships">
						<a class="ab-item" href="<?php echo esc_url( $groups_link ); ?>"><?php _e( 'My Groups', 'buddyboss-theme' ); ?></a>
					</li>
					<li id="wp-admin-bar-my-account-groups-invites">
						<a class="ab-item" href="<?php echo esc_url( trailingslashit( $groups_link . 'invites' ) ); ?>"><?php echo $pending; ?></a>
					</li>
					<?php if ( bp_user_can_create_groups() ) { ?>
						<li id="wp-admin-bar-my-account-groups-create">
							<a class="ab-item" href="<?php echo esc_url( trailingslashit( bp_get_groups_directory_permalink() . 'create' ) ); ?>"><?php _e( 'Create Group', 'buddyboss-theme' ); ?></a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</li>
		<?php
	}

	// Action - After buddypress groups menu
	do_action( THEME_HOOK_PREFIX . 'after_bb_groups_menu' );

	if ( bp_is_active( 'forums' ) ) {
		// Setup the logged in user variables
		$user_domain = bp_loggedin_user_domain();
		$forums_link = trailingslashit( $user_domain . bp_get_option( '_bbp_root_slug', BP_FORUMS_SLUG ) );

		?>
		<li id="wp-admin-bar-my-account-forums" class="menupop parent">
			<a class="ab-item" aria-haspopup="true" href="<?php echo esc_url( $forums_link ); ?>">
				<span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php _e( 'Forums', 'buddyboss-theme' ); ?>
			</a>
			<div class="ab-sub-wrapper wrapper">
				<ul id="wp-admin-bar-my-account-forums-default" class="ab-submenu">
					<li id="wp-admin-bar-my-account-forums-topics">
						<a class="ab-item" href="<?php echo esc_url( trailingslashit( $forums_link . bbp_get_topic_archive_slug() ) ); ?>"><?php _e( 'My Discussions', 'buddyboss-theme' ); ?></a>
					</li>
					<li id="wp-admin-bar-my-account-forums-replies">
						<a class="ab-item" href="<?php echo esc_url( trailingslashit( $forums_link . bbp_get_reply_archive_slug() ) ); ?>"><?php _e( 'My Replies', 'buddyboss-theme' ); ?></a>
					</li>
					<li id="wp-admin-bar-my-account-forums-favorites">
						<a class="ab-item" href="<?php echo esc_url( trailingslashit( $forums_link . bbp_get_user_favorites_slug() ) ); ?>"><?php _e( 'My Favorites', 'buddyboss-theme' ); ?></a>
					</li>
					<li id="wp-admin-bar-my-account-forums-subscriptions">
						<a class="ab-item" href="<?php echo esc_url( trailingslashit( $forums_link . bbp_get_user_subscriptions_slug() ) ); ?>"><?php _e( 'Subscriptions', 'buddyboss-theme' ); ?></a>
					</li>
				</ul>
			</div>
		</li>
		<?php
	}

	// Action - After buddypress forums menu
	do_action( THEME_HOOK_PREFIX . 'after_bb_forums_menu' );

	if ( bp_is_active( 'media' ) && bp_is_profile_media_support_enabled() ) {
		// Setup the logged in user variables.
		$media_link = trailingslashit( bp_loggedin_user_domain() . bp_get_media_slug() );

		?>
		<li id="wp-admin-bar-my-account-media" class="menupop parent">
			<a class="ab-item" aria-haspopup="true" href="<?php echo esc_url( $media_link ); ?>">
				<span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php _e( 'Photos', 'buddyboss-theme' ); ?>
			</a>
			<div class="ab-sub-wrapper wrapper">
				<ul id="wp-admin-bar-my-account-media-default" class="ab-submenu">
					<li id="wp-admin-bar-my-account-media-my-media">
						<a class="ab-item" href="<?php echo esc_url( $media_link ); ?>"><?php _e( 'My Photos', 'buddyboss-theme' ); ?></a>
					</li>
					<?php if ( bp_is_profile_albums_support_enabled() ) { ?>
						<li id="wp-admin-bar-my-account-media-albums">
							<a class="ab-item" href="<?php echo esc_url( trailingslashit( $media_link . 'albums' ) ); ?>"><?php _e( 'My Albums', 'buddyboss-theme' ); ?></a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</li>
		<?php
	}

	// Action - After buddypress media menu
	do_action( THEME_HOOK_PREFIX . 'after_bb_media_menu' );

	if ( bp_is_active( 'invites' ) && true === bp_allow_user_to_send_invites() ) {
		// Setup the logged in user variables.
		$invites_link = trailingslashit( bp_loggedin_user_domain() . bp_get_invites_slug() );

		?>
		<li id="wp-admin-bar-my-account-invites" class="menupop parent">
			<a class="ab-item" aria-haspopup="true" href="<?php echo esc_url( $invites_link ); ?>">
				<span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php _e( 'Email Invites', 'buddyboss-theme' ); ?>
			</a>
			<div class="ab-sub-wrapper wrapper">
				<ul id="wp-admin-bar-my-account-invites-default" class="ab-submenu">
					<li id="wp-admin-bar-my-account-invites-invites">
						<a class="ab-item" href="<?php echo esc_url( $invites_link ); ?>"><?php _e( 'Send Invites', 'buddyboss-theme' ); ?></a>
					</li>
					<li id="wp-admin-bar-my-account-invites-sent">
						<a class="ab-item" href="<?php echo esc_url( trailingslashit( $invites_link . 'sent-invites' ) ); ?>"><?php _e( 'Sent Invites', 'buddyboss-theme' ); ?></a>
					</li>
				</ul>
			</div>
		</li>
		<?php
	}

	// Action - After buddypress profile menu
	do_action( THEME_HOOK_PREFIX . 'after_bb_profile_menu' );

	printf( "<li class='logout-link'><a href='%s'>%s</a></li>", wp_logout_url( bp_get_requested_url() ), __( 'Logout', 'buddyboss-theme' ) );
}
