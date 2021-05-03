<?php
/**
 * The sidebar containing the bbPress widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuddyBoss_Theme
 */


if ( !is_active_sidebar( 'forums' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area bbpress-sidebar" role="complementary">
    <?php if ( bbp_is_single_forum() && !bbp_is_forum_category() && ( bbp_current_user_can_access_create_topic_form() || bbp_current_user_can_access_anonymous_user_form() ) ) { ?>
        <a href="#new-post" class="button full btn-new-topic" data-modal-id="bbp-topic-form"><i class="bb-icon-edit-square"></i> <?php _e( 'New discussion', 'buddyboss-theme' ); ?></a>
		<?php bbp_forum_subscription_link(); ?>
    <?php } ?>
    
	<?php dynamic_sidebar( 'forums' ); ?>
</div><!-- #secondary -->