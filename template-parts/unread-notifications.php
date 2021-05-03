<?php if ( bp_has_notifications( bp_ajax_querystring( 'notifications' ) . '&user_id=' . get_current_user_id() ) ) : ?>
	<?php while ( bp_the_notifications() ) : bp_the_notification(); ?>
        <li class="read-item <?php echo isset( buddypress()->notifications->query_loop->notification->is_new ) && buddypress()->notifications->query_loop->notification->is_new ? 'unread' : ''; ?>">
			<span class="bb-full-link">
				<?php bp_the_notification_description(); ?>
			</span>
            <div class="notification-avatar">
				<?php buddyboss_notification_avatar(); ?>
            </div>
            <div class="notification-content">
				<span class="bb-full-link">
					<?php bp_the_notification_description(); ?>
				</span>
                <span><?php bp_the_notification_description(); ?></span>
                <span class="posted"><?php bp_the_notification_time_since(); ?></span>
            </div>
        </li>
	<?php endwhile; ?>
<?php else : ?>
    <li class="bs-item-wrap">
        <div class="notification-content"><?php _e( 'No new notifications', 'buddyboss-theme' ); ?>!</div>
    </li>
<?php endif; ?>