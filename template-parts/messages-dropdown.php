<?php
global $messages_template;
$menu_link            = trailingslashit( bp_loggedin_user_domain() . bp_get_messages_slug() );
$unread_message_count = messages_get_unread_count();
?>
<div id="header-messages-dropdown-elem" class="dropdown-passive dropdown-right notification-wrap messages-wrap menu-item-has-children">
    <a href="<?php echo $menu_link ?>"
       ref="notification_bell"
       class="notification-link">
       <span data-balloon-pos="down" data-balloon="<?php _e( 'Messages', 'buddyboss-theme' ); ?>">
            <i class="bb-icon-inbox-small"></i>
			<?php if ( $unread_message_count > 0 ): ?>
                <span class="count"><?php echo $unread_message_count; ?></span>
			<?php endif; ?>
        </span>
    </a>
    <section class="notification-dropdown">
        <header class="notification-header">
            <h2 class="title"><?php _e( 'Messages', 'buddyboss-theme' ); ?></h2>
        </header>

        <ul class="notification-list">
            <i class="bb-notification-loader"><i></i><i></i><i></i></i>
        </ul>

		<footer class="notification-footer">
			<a href="<?php echo $menu_link ?>" class="delete-all">
				<?php _e( 'View Inbox', 'buddyboss-theme' ); ?>
				<i class="bb-icon-angle-right"></i>
			</a>
		</footer>
    </section>
</div>