<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Fire to add support for third party plugin
 *
 * @since BuddyBoss 1.2.2
 */
function buddyboss_theme_helper_plugins_loaded_callback() {

	if ( function_exists( 'buddypress' ) ) {
		/**
		 * Include plugin when plugin is activated
		 *
		 * Support MemberPress + BuddyPress Integration
		 */
		if ( is_plugin_active( 'memberpress-buddypress/main.php' ) ) {
			/**
			 * This action is use when admin bar is Disable
			 */
			add_action( 'buddyboss_theme_after_bb_profile_menu', 'buddyboss_theme_helper_add_buddyboss_menu_for_memberpress_buddypress', 100 );
		}
	}
}

add_action( 'init', 'buddyboss_theme_helper_plugins_loaded_callback', 100 );

/**
 * Add Menu in Admin section for MemberPress + BuddyPress Integration plugin
 *
 * @since BuddyBoss 1.2.2
 *
 * @param $menus
 */
function buddyboss_theme_helper_add_buddyboss_menu_for_memberpress_buddypress() {
	global $bp;

	$main_slug = apply_filters( 'mepr-bp-info-main-nav-slug', 'mp-membership' );
	$name      = apply_filters( 'mepr-bp-info-main-nav-name', _x( 'Membership', 'ui', 'buddyboss-theme' ) );
	?>
    <li id="wp-admin-bar-mp-membership" class="menupop">
        <a class="ab-item" aria-haspopup="true" href="<?php echo $bp->loggedin_user->domain . $main_slug . '/'; ?>">
            <span class="wp-admin-bar-arrow" aria-hidden="true"></span><?php echo $name; ?>
        </a>
        <div class="ab-sub-wrapper">
            <ul id="wp-admin-bar-mp-membership-default" class="ab-submenu">
                <li id="wp-admin-bar-mp-info">
                    <a class="ab-item" href="<?php echo $bp->loggedin_user->domain . $main_slug . '/'; ?>">
						<?php echo _x( 'Info', 'ui', 'buddyboss-theme' ); ?>
                    </a>
                </li>
                <li id="wp-admin-bar-mp-subscriptions">
                    <a class="ab-item"
                       href="<?php echo $bp->loggedin_user->domain . $main_slug . '/mp-subscriptions/'; ?>">
						<?php echo _x( 'Subscriptions', 'ui', 'buddyboss-theme' ); ?>
                    </a>
                </li>
                <li id="wp-admin-bar-mp-payments">
                    <a class="ab-item" href="<?php echo $bp->loggedin_user->domain . $main_slug . '/mp-payments/'; ?>">
						<?php echo _x( 'Payments', 'ui', 'buddyboss-theme' ); ?>
                    </a>
                </li>
            </ul>
        </div>
    </li>
	<?php
}