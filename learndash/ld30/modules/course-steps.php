<?php
/**
 * Displays a Course Prev/Next navigation.
 *
 * Available Variables:
 *
 * $course_id 		: (int) ID of Course
 * $course_step_post : (int) ID of the lesson/topic post
 * $user_id 		: (int) ID of User
 * $course_settings : (array) Settings specific to current course
 * $can_complete	: (bool) Can the user mark this lesson/topic complete?
 *
 * @since 3.0
 *
 * @package LearnDash
 */

// TODO @37designs this is a bit confusing still, as you can still navigate left / right on lessons even with topics

$learndash_previous_nav = learndash_previous_post_link( null, true );
$learndash_next_nav 	= '';

$button_class = 'ld-button ' . ( $context == 'focus' ? 'ld-button-transparent' : '' );

/*
 * See details for filter 'learndash_show_next_link' https://bitbucket.org/snippets/learndash/5oAEX
 *
 * @since version 2.3
 */

$current_complete = false;

if ( ( isset( $course_settings['course_disable_lesson_progression'] ) ) && ( $course_settings['course_disable_lesson_progression'] === 'on' ) ) {
	$current_complete = true;
} else {

	if ( $course_step_post->post_type == 'sfwd-topic' ) {
		$current_complete = learndash_is_topic_complete( $user_id, $course_step_post->ID );
	} else if ( $course_step_post->post_type == 'sfwd-lessons' ) {
		$current_complete = learndash_is_lesson_complete( $user_id, $course_step_post->ID );
	}

	if ( ( $current_complete !== true) && ( learndash_is_admin_user( $user_id ) ) ) {
		$bypass_course_limits_admin_users = LearnDash_Settings_Section::get_section_setting('LearnDash_Settings_Section_General_Admin_User', 'bypass_course_limits_admin_users' );
		if ( $bypass_course_limits_admin_users == 'yes' ) $current_complete = true;
	}

}

if ( apply_filters( 'learndash_show_next_link', $current_complete, $user_id, $course_step_post->ID ) ) {
	 $learndash_next_nav = learndash_next_post_link( null, true, $course_step_post );
}

$complete_button = learndash_mark_complete($course_step_post);

if( !empty($learndash_previous_nav) || !empty($learndash_next_nav) || !empty($complete_button) ): ?>

	<div class="ld-content-actions">

		<?php
		/**
		 * Action to add custom content before the course steps (all locations)
		 *
		 * @since 3.0
		 */
		do_action( 'learndash-all-course-steps-before', get_post_type(), $course_id, $user_id );
		do_action( 'learndash-' . $context . '-course-steps-before', get_post_type(), $course_id, $user_id ); ?>

		<div class="ld-content-action<?php if (( ! $can_complete ) && ( ! $learndash_next_nav )) : ?> ld-empty<?php endif; ?>">
			<?php
			if( isset($can_complete) && $can_complete && !empty($complete_button) ):
					echo learndash_mark_complete($course_step_post);
			endif; ?>
		</div>

		<?php
		/**
		 * Action to add custom content after the course steps (all locations)
		 *
		 * @since 3.0
		 */
		do_action( 'learndash-all-course-steps-after', get_post_type(), $course_id, $user_id );
		do_action( 'learndash-' . $context . '-course-steps-after', get_post_type(), $course_id, $user_id ); ?>

	</div> <!--/.ld-topic-actions-->

<?php
endif;
