<?php
global $post;

if ( 'sfwd-courses' != $post->post_type ) {
	return;
}
$course = $post;
?>

<?php if ( class_exists( 'BuddyPress' ) ) { ?>
	
    <?php if( buddyboss_theme_get_option('learndash_course_author') ) { ?>
	<div class="bb-about-instructor">
		<h4><?php _e( 'About Instructor', 'buddyboss-theme' ); ?></h4>
		<div class="bb-grid">
            <div class="bb-instructor-wrap flex">
                <div class="bb-avatar-wrap">
    				<div>
    					<?php $avatar = get_avatar_url( get_the_author_meta( 'email', $course->post_author ), array( 'size' => 300 ) ); ?>
    					<?php if( ! empty( $avatar ) ) : ?>
                            <?php if ( class_exists( 'BuddyPress' ) ) { ?>
            				<a href="<?php echo bp_core_get_user_domain( get_the_author_meta( 'ID', $post->post_author ) ); ?>">
                			<?php } else { ?>
                			     <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ), get_the_author_meta( 'user_nicename', $post->post_author ) ); ?>">
                			<?php } ?>
    						<img class="round avatar" src="<?php echo $avatar; ?>" />
                            </a>
    					<?php endif; ?>
    				</div>
    			</div>
    			<div class="bb-content-wrap">
    				<h5>
                        <?php if ( class_exists( 'BuddyPress' ) ) { ?>
        				<a href="<?php echo bp_core_get_user_domain( get_the_author_meta( 'ID', $post->post_author ) ); ?>">
            			<?php } else { ?>
            			     <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ), get_the_author_meta( 'user_nicename', $post->post_author ) ); ?>">
            			<?php } ?>
                            <?php echo get_the_author_meta( 'display_name', $course->post_author ); ?>
                        </a>
                    </h5>
    				<p class="bb-author-meta"><?php echo count_user_posts( get_the_author_meta( 'ID', $post->post_author ), 'sfwd-courses' ); ?> <?php echo count_user_posts( get_the_author_meta( 'ID', $post->post_author ), 'sfwd-courses' ) > 1 ? LearnDash_Custom_Label::get_label( 'courses' ) : LearnDash_Custom_Label::get_label( 'course' ); ?></p>
    			</div>
            </div>
            <div class="bb-instructor-message">
                <?php
                if ( ( ( bp_is_active( 'messages' ) && ! bp_force_friendship_to_message() ) ||
                           ( bp_force_friendship_to_message() && bp_is_active( 'friends' ) && friends_check_friendship( bp_loggedin_user_id(), $course->post_author ) ) ) && is_user_logged_in() && ( get_current_user_id() != get_the_author_meta( 'ID', $course->post_author ) ) ) { ?>
					<a href="<?php echo apply_filters( 'bp_get_send_private_message_link', wp_nonce_url( bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=' . bp_core_get_username( $course->post_author ) ) ); ?>" class="button small push-bottom"><i class="bb-icons bb-icon-chat"></i><?php _e( 'Message', 'buddyboss-theme' ); ?></a>
				<?php } ?>
            </div>
		</div>
	</div>
    <?php } ?>

<?php } ?>