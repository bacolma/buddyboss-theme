<?php
$menu_link                 = trailingslashit( bp_loggedin_user_domain() . bp_get_notifications_slug() );
$notifications             = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );
$unread_notification_count = ! empty( $notifications ) ? $notifications : 0;
?>
<div id="header-notifications-dropdown-elem" class="notification-wrap menu-item-has-children">
    <a href="<?php echo $menu_link ?>"
       ref="notification_bell"
       class="notification-link">
       <span data-balloon-pos="down" data-balloon="<?php _e( 'Notifications', 'buddyboss-theme' ); ?>">
            <i class="bb-icon-bell-small"></i>
    		<?php if ( $unread_notification_count > 0 ): ?>
                <span class="count"><?php echo $unread_notification_count; ?></span>
    		<?php endif; ?>
        </span>
    </a>
    <section class="notification-dropdown">
        <header class="notification-header">
            <h2 class="title"><?php _e( 'Notifications', 'buddyboss-theme' ); ?></h2>
        </header>

        <ul class="notification-list">
            <i class="bb-notification-loader"><i></i><i></i><i></i></i>
        </ul>

		<footer class="notification-footer">
			<a href="<?php echo $menu_link ?>" class="delete-all">
				<?php _e( 'View Notifications', 'buddyboss-theme' ); ?>
				<i class="bb-icon-angle-right"></i>
			</a>
		</footer>
    </section>
</div>