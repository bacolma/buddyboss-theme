<?php
/**
 * Displays the infobar in course context
 *
 * Will have access to same variables as course.php
 *
 * Available Variables:
 * $course_id       : (int) ID of the course
 * $course      : (object) Post object of the course
 * $course_settings : (array) Settings specific to current course
 *
 * $courses_options : Options/Settings as configured on Course Options page
 * $lessons_options : Options/Settings as configured on Lessons Options page
 * $quizzes_options : Options/Settings as configured on Quiz Options page
 *
 * $user_id         : Current User ID
 * $logged_in       : User is logged in
 * $current_user    : (object) Currently logged in user object
 *
 * $course_status   : Course Status
 * $has_access  : User has access to course or is enrolled.
 * $materials       : Course Materials
 * $has_course_content      : Course has course content
 * $lessons         : Lessons Array
 * $quizzes         : Quizzes Array
 * $lesson_progression_enabled  : (true/false)
 * $has_topics      : (true/false)
 * $lesson_topics   : (array) lessons topics
 *
 * @since 3.0
 *
 * @package LearnDash\Course
 */ ?>

<?php
$course_pricing = learndash_get_course_price( $course_id );

 if( is_user_logged_in() && isset($has_access) && $has_access ): ?>

    <div class="ld-course-status ld-course-status-enrolled">

        <?php
        /**
         * Action to add custom content inside the breadcrumbs (before)
         *
         * @since 3.0
         */
        do_action( 'learndash-course-infobar-access-progress-before', get_post_type(), $course_id, $user_id );

        learndash_get_template_part( 'modules/progress.php', array(
         'context'   =>  'course',
         'user_id'   =>  $user_id,
         'course_id' =>  $course_id
        ), true );

        /**
         * Action to add custom content inside the breadcrumbs before the progress bar
         *
         * @since 3.0
         */
        do_action( 'learndash-course-infobar-access-progress-before', get_post_type(), $course_id, $user_id );

        /**
         * Action to add custom content inside the breadcrumbs after the progress bar
         *
         * @since 3.0
         */
        do_action( 'learndash-course-infobar-access-progress-after', get_post_type(), $course_id, $user_id );

        learndash_status_bubble( $course_status );

        /**
         * Action to add custom content inside the breadcrumbs after the status
         *
         * @since 3.0
         */
        do_action( 'learndash-course-infobar-access-status-after', get_post_type(), $course_id, $user_id ); ?>

    </div> <!--/.ld-breacrumbs-->

<?php elseif( $course_pricing['type'] !== 'open' ): ?>



<?php endif; ?>
